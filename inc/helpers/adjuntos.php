<?php
defined('ABSPATH') || exit;

/*
 * Archivos adjuntos de los formularios (el motor de wp-form no envía archivos).
 *
 * Cada formulario que acepta archivos tiene su propio endpoint AJAX, que llama a copam_theme_adjuntos_recibir()
 * con su configuración: los archivos elegidos se validan (PDF, JPG o PNG, cantidad y peso), se guardan en una
 * carpeta temporal privada de uploads y el endpoint responde con el identificador del lote. El form manda ese
 * identificador en un campo de texto; al enviar, los archivos viajan adjuntos en el correo y se borran.
 * Un lote que nadie envía se borra pasado COPAM_THEME_ADJUNTOS_VIDA. Nada pasa por la biblioteca de medios.
 *
 * Configuración ($canal):
 *  - carpeta      (string) carpeta dentro de uploads, propia del formulario ('copam-reporte-tmp')
 *  - limite       (string) clave del límite de subidas por IP
 *  - max_archivos (int)    archivos por lote
 *  - max_bytes    (int)    peso de todos los archivos del lote
 */
const COPAM_THEME_ADJUNTOS_TIPOS = ['pdf' => 'application/pdf', 'jpg|jpeg' => 'image/jpeg', 'png' => 'image/png'];
const COPAM_THEME_ADJUNTOS_VIDA  = 2 * HOUR_IN_SECONDS;

function copam_theme_adjuntos_carpeta(string $carpeta): string
{
    $base = trailingslashit(wp_upload_dir(null, false)['basedir']) . sanitize_file_name($carpeta);
    if (!is_dir($base)) {
        wp_mkdir_p($base);
    }
    // Sin listado ni acceso directo desde la web (Apache); en nginx los nombres aleatorios y la vida corta
    // son la protección.
    if (!file_exists($base . '/.htaccess')) {
        file_put_contents($base . '/.htaccess', "Require all denied\nDeny from all\n");
    }
    if (!file_exists($base . '/index.php')) {
        file_put_contents($base . '/index.php', "<?php\n// Silence is golden.\n");
    }
    return $base;
}

function copam_theme_adjuntos_lote_valido($lote): bool
{
    return is_string($lote) && preg_match('/^[a-f0-9]{32}$/', $lote) === 1;
}

// Rutas de los archivos de un lote, o [] si no existe.
function copam_theme_adjuntos_archivos(string $carpeta, $lote): array
{
    if (!copam_theme_adjuntos_lote_valido($lote)) {
        return [];
    }
    $dir = copam_theme_adjuntos_carpeta($carpeta) . '/' . $lote;
    if (!is_dir($dir)) {
        return [];
    }
    return array_values(array_filter(glob($dir . '/*') ?: [], 'is_file'));
}

function copam_theme_adjuntos_borrar_lote(string $carpeta, $lote): void
{
    if (!copam_theme_adjuntos_lote_valido($lote)) {
        return;
    }
    $dir = copam_theme_adjuntos_carpeta($carpeta) . '/' . $lote;
    foreach (glob($dir . '/*') ?: [] as $archivo) {
        wp_delete_file($archivo);
    }
    if (is_dir($dir)) {
        rmdir($dir);
    }
}

// Borra los lotes que nadie envió.
function copam_theme_adjuntos_borrar_viejos(string $carpeta): void
{
    foreach (glob(copam_theme_adjuntos_carpeta($carpeta) . '/*', GLOB_ONLYDIR) ?: [] as $dir) {
        if (filemtime($dir) < time() - COPAM_THEME_ADJUNTOS_VIDA) {
            copam_theme_adjuntos_borrar_lote($carpeta, wp_basename($dir));
        }
    }
}

// Archivos del envío en curso; se adjuntan en wp_mail y se vacían al terminar el envío.
function copam_theme_adjuntos_pendientes(?array $nuevos = null): array
{
    static $archivos = [];
    if ($nuevos !== null) {
        $archivos = $nuevos;
    }
    return $archivos;
}

add_filter('wp_mail', 'copam_theme_adjuntos_wp_mail');
function copam_theme_adjuntos_wp_mail($args)
{
    $archivos = copam_theme_adjuntos_pendientes();
    if ($archivos) {
        $args['attachments'] = array_merge((array) ($args['attachments'] ?? []), $archivos);
    }
    return $args;
}

/*
 * Cuerpo del endpoint: recibe los archivos elegidos (todos juntos, cada vez que cambia la selección), los valida
 * y responde con el identificador del lote. Termina siempre con una respuesta JSON.
 */
function copam_theme_adjuntos_recibir(array $canal): void
{
    nocache_headers();
    $carpeta      = (string) $canal['carpeta'];
    $max_archivos = (int) $canal['max_archivos'];
    $max_bytes    = (int) $canal['max_bytes'];
    copam_theme_adjuntos_borrar_viejos($carpeta);

    // El lote anterior de esta misma selección se reemplaza.
    $anterior = isset($_POST['anterior']) ? sanitize_key(wp_unslash($_POST['anterior'])) : ''; // phpcs:ignore WordPress.Security.NonceVerification -- endpoint público; los límites de abajo lo protegen
    copam_theme_adjuntos_borrar_lote($carpeta, $anterior);

    if (!copam_theme_form_rate_limit((string) $canal['limite'], 30)) {
        wp_send_json_error(['message' => 'Recibimos varios archivos seguidos. Intenta de nuevo más tarde.'], 429);
    }

    $files = $_FILES['archivos'] ?? null; // phpcs:ignore WordPress.Security.NonceVerification, WordPress.Security.ValidatedSanitizedInput -- se valida cada archivo abajo
    if (!is_array($files) || !isset($files['name']) || !is_array($files['name'])) {
        wp_send_json_error(['message' => 'No recibimos ningún archivo.'], 400);
    }

    $total = count($files['name']);
    if ($total < 1 || $total > $max_archivos) {
        wp_send_json_error(['message' => $max_archivos === 1 ? 'Adjunta un solo archivo.' : sprintf('Puedes adjuntar hasta %d archivos.', $max_archivos)], 400);
    }
    if (array_sum(array_map('intval', (array) $files['size'])) > $max_bytes) {
        wp_send_json_error(['message' => sprintf('Los archivos superan los %s en total.', size_format($max_bytes))], 400);
    }

    // Primero se valida todo; si un archivo no sirve, no se guarda ninguno.
    $validos = [];
    for ($i = 0; $i < $total; $i++) {
        $tmp    = (string) ($files['tmp_name'][$i] ?? '');
        $nombre = sanitize_file_name((string) ($files['name'][$i] ?? ''));
        if ((int) ($files['error'][$i] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK || !is_uploaded_file($tmp)) {
            wp_send_json_error(['message' => 'No pudimos recibir uno de los archivos. Vuelve a elegirlo.'], 400);
        }
        $tipo = wp_check_filetype_and_ext($tmp, $nombre, COPAM_THEME_ADJUNTOS_TIPOS);
        if (empty($tipo['ext']) || empty($tipo['type'])) {
            wp_send_json_error(['message' => 'Solo se aceptan archivos PDF, JPG o PNG.'], 400);
        }
        $base = pathinfo($nombre, PATHINFO_FILENAME);
        $validos[] = [$tmp, ($base !== '' ? $base : 'adjunto') . '.' . $tipo['ext']];
    }

    $lote = bin2hex(random_bytes(16));
    $dir  = copam_theme_adjuntos_carpeta($carpeta) . '/' . $lote;
    if (!wp_mkdir_p($dir)) {
        wp_send_json_error(['message' => 'No pudimos guardar los archivos. Intenta de nuevo.'], 500);
    }
    foreach ($validos as [$tmp, $nombre]) {
        $destino = $dir . '/' . wp_unique_filename($dir, $nombre);
        if (!move_uploaded_file($tmp, $destino)) {
            copam_theme_adjuntos_borrar_lote($carpeta, $lote);
            wp_send_json_error(['message' => 'No pudimos guardar los archivos. Intenta de nuevo.'], 500);
        }
    }

    wp_send_json_success(['lote' => $lote]);
}
