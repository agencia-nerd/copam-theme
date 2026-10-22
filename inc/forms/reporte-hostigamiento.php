<?php
defined('ABSPATH') || exit;

/*
 * Reporte del Canal de hostigamiento sexual (spec `canal-hostigamiento-sexual`, sección reporte).
 * La vista es template-parts/forms/reporte-hostigamiento.php; lo propio del front está en
 * src/js/modules/reporte-hostigamiento.js.
 *
 * Es confidencial. Además de lo que hace el motor (inc/forms.php), este form:
 *  - envía solo a Ajustes del sitio > Correos > Canal de hostigamiento: si no hay correo, el envío falla
 *    (nunca cae en el correo del administrador ni en otro destinatario);
 *  - no guarda envíos en la base (`store` none) ni escribe sus campos en el log;
 *  - con "Prefiero no identificarme" descarta nombre, documento, correo y teléfono aunque lleguen en el POST,
 *    y solo toma el correo de contacto opcional;
 *  - recibe la evidencia por su propio endpoint (el motor no envía archivos): se guarda en una carpeta
 *    temporal privada, viaja adjunta en el correo y se borra al enviar. Nada pasa por la biblioteca de medios.
 */
const COPAM_THEME_FORM_REPORTE = 'reporte-hostigamiento';
const COPAM_THEME_REPORTE_TIPOS = ['pdf' => 'application/pdf', 'jpg|jpeg' => 'image/jpeg', 'png' => 'image/png'];
const COPAM_THEME_REPORTE_MAX_ARCHIVOS = 5;
const COPAM_THEME_REPORTE_MAX_BYTES = 10 * MB_IN_BYTES; // Entre todos los archivos de un envío.
const COPAM_THEME_REPORTE_VIDA = 2 * HOUR_IN_SECONDS;   // Un lote sin enviar se borra pasado este tiempo.

add_filter('copam_theme_forms', 'copam_theme_reporte_definicion');
function copam_theme_reporte_definicion($forms)
{
    $es_envio = copam_theme_reporte_es_envio();
    $anonimo  = $es_envio
        && isset($_POST['identificarse']) // phpcs:ignore WordPress.Security.NonceVerification -- el motor verifica el nonce antes de validar
        && sanitize_key(wp_unslash($_POST['identificarse'])) === 'no'; // phpcs:ignore WordPress.Security.NonceVerification

    // Los datos personales solo son obligatorios al identificarse; la vista los muestra según la opción.
    $identificado = $es_envio && !$anonimo;

    $fields = [
        'quien' => [
            'type'     => 'radio',
            'label'    => '¿Quién reporta?',
            'required' => true,
            'options'  => [
                'trabajador' => 'Trabajador de COPAM',
                'proveedor'  => 'Proveedor o contratista',
                'usuario'    => 'Usuario o visitante',
                'otro'       => 'Otro',
            ],
        ],
        'identificarse' => [
            'type'     => 'radio',
            'label'    => '¿Desea identificarse?',
            'required' => true,
            'options'  => [
                'si' => 'Sí',
                'no' => 'Prefiero no identificarme',
            ],
        ],
        'nombre' => [
            'type'     => 'name',
            'label'    => 'Nombre y apellidos',
            'required' => $identificado,
            'min'      => 3,
        ],
        'documento' => [
            'type'     => 'digits',
            'label'    => 'Documento de identidad',
            'required' => $identificado,
            'min'      => 8,
            'max'      => 11,
            'messages' => ['min' => 'Ingresa entre 8 y 11 dígitos.'],
        ],
        'correo' => [
            'type'     => 'email',
            'label'    => 'Correo electrónico',
            'required' => $identificado,
        ],
        'telefono' => [
            'type'  => 'phone',
            'label' => 'Teléfono',
        ],
        'correo_contacto' => [
            'type'  => 'email',
            'label' => 'Correo de contacto',
        ],
        'afectada' => [
            'type'     => 'radio',
            'label'    => '¿Es la persona afectada?',
            'required' => true,
            'options'  => [
                'si' => 'Sí',
                'no' => 'No, soy testigo o tercero',
            ],
        ],
        'fecha' => [
            'type'         => 'text',
            'label'        => 'Fecha aproximada de los hechos',
            'max'          => 10,
            'autocomplete' => 'off',
        ],
        'lugar' => [
            'type'         => 'text',
            'label'        => 'Lugar',
            'autocomplete' => 'off',
        ],
        'descripcion' => [
            'type'     => 'textarea',
            'label'    => 'Descripción de los hechos',
            'required' => true,
            'min'      => 10,
            'max'      => 5000,
        ],
        'involucrados' => [
            'type'         => 'text',
            'label'        => 'Persona(s) involucrada(s)',
            'max'          => 300,
            'autocomplete' => 'off',
        ],
        // Identificador del lote de evidencia subido por copam_theme_reporte_adjuntos(); la vista lo oculta.
        'adjuntos' => [
            'type'         => 'text',
            'label'        => 'Evidencia adjunta',
            'max'          => 32,
            'autocomplete' => 'off',
        ],
        'declaracion' => [
            'type'     => 'consent',
            'label'    => 'Declara que la información es veraz y acepta que sea tratada de forma confidencial por el Delegado',
            'messages' => ['required' => 'Debes aceptar la declaración para enviar el reporte.'],
        ],
    ];

    if ($es_envio && $anonimo) {
        unset($fields['nombre'], $fields['documento'], $fields['correo'], $fields['telefono']);
    } elseif ($es_envio) {
        unset($fields['correo_contacto']);
    }

    $forms[COPAM_THEME_FORM_REPORTE] = [
        'title'      => 'Canal de hostigamiento sexual',
        'subject'    => 'Nuevo reporte del Canal de hostigamiento sexual',
        'to'         => copam_theme_correos('hostigamiento'),
        'reply_to'   => $anonimo ? 'correo_contacto' : 'correo',
        'store'      => 'none',
        'redirect'   => '',
        'success'    => $es_envio ? copam_theme_reporte_exito() : '',
        'rate_limit' => 5,
        'fields'     => $fields,
    ];

    return $forms;
}

function copam_theme_reporte_es_envio()
{
    return wp_doing_ajax()
        && isset($_POST['form']) // phpcs:ignore WordPress.Security.NonceVerification -- el motor verifica el nonce antes de validar
        && sanitize_key(wp_unslash($_POST['form'])) === COPAM_THEME_FORM_REPORTE;
}

// Mensaje de éxito: campo de la página del Canal (el envío llega por AJAX, sin la página en contexto).
function copam_theme_reporte_exito()
{
    $paginas = get_pages(['meta_key' => '_wp_page_template', 'meta_value' => 'pages/template-canal-hostigamiento-sexual.php', 'number' => 1]);
    $grupo   = ($paginas && function_exists('get_field')) ? (get_field('canal_hostigamiento_sexual_reporte', (int) $paginas[0]->ID) ?: []) : [];

    return (string) ($grupo['mensaje_exito'] ?? '');
}

/* -------------------------------------------------------------------------
 * Correo: solo al Delegado, con la evidencia adjunta
 * ---------------------------------------------------------------------- */

// Archivos del envío en curso; se adjuntan en wp_mail y se borran al terminar.
function copam_theme_reporte_pendientes(?array $nuevos = null)
{
    static $archivos = [];
    if ($nuevos !== null) {
        $archivos = $nuevos;
    }
    return $archivos;
}

add_filter('copam_theme_form_mail', 'copam_theme_reporte_correo', 10, 3);
function copam_theme_reporte_correo($mail, $form, $data)
{
    if (!copam_theme_reporte_es_envio()) {
        return $mail;
    }

    // Solo el Delegado: si el repetidor está vacío, wp_mail falla y el visitante ve el error (no hay respaldo).
    $mail['to'] = copam_theme_correos('hostigamiento');

    $lote     = (string) ($data['adjuntos'] ?? '');
    $archivos = copam_theme_reporte_archivos($lote);
    copam_theme_reporte_pendientes($archivos);

    // En el cuerpo, el identificador del lote se cambia por los nombres de los archivos.
    if ($lote !== '') {
        $nombres = $archivos ? implode(', ', array_map('wp_basename', $archivos)) : 'no se recibieron archivos';
        $mail['message'] = str_replace('Evidencia adjunta: ' . $lote, 'Evidencia adjunta: ' . $nombres, $mail['message']);
    }
    // Sin la URL de la página: el correo no debe decir más de lo necesario.
    $mail['message'] = preg_replace('/\n\nPágina: .*$/u', '', $mail['message']);

    return $mail;
}

add_filter('wp_mail', 'copam_theme_reporte_wp_mail');
function copam_theme_reporte_wp_mail($args)
{
    $archivos = copam_theme_reporte_pendientes();
    if ($archivos) {
        $args['attachments'] = array_merge((array) ($args['attachments'] ?? []), $archivos);
    }
    return $args;
}

// Enviado el correo, la evidencia se borra del servidor. Si falló, el lote queda para el reintento
// y se borra solo pasado COPAM_THEME_REPORTE_VIDA.
add_action('copam_theme_form_submitted', 'copam_theme_reporte_limpiar', 10, 3);
function copam_theme_reporte_limpiar($form_id, $data, $sent)
{
    if ($form_id !== COPAM_THEME_FORM_REPORTE) {
        return;
    }
    copam_theme_reporte_pendientes([]);
    if ($sent) {
        copam_theme_reporte_borrar_lote((string) ($data['adjuntos'] ?? ''));
    }
}

/* -------------------------------------------------------------------------
 * Evidencia: carpeta temporal privada
 * ---------------------------------------------------------------------- */

function copam_theme_reporte_carpeta()
{
    $base = trailingslashit(wp_upload_dir(null, false)['basedir']) . 'copam-reporte-tmp';
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

function copam_theme_reporte_lote_valido($lote)
{
    return is_string($lote) && preg_match('/^[a-f0-9]{32}$/', $lote) === 1;
}

// Rutas de los archivos de un lote, o [] si no existe.
function copam_theme_reporte_archivos($lote)
{
    if (!copam_theme_reporte_lote_valido($lote)) {
        return [];
    }
    $dir = copam_theme_reporte_carpeta() . '/' . $lote;
    if (!is_dir($dir)) {
        return [];
    }
    return array_values(array_filter(glob($dir . '/*') ?: [], 'is_file'));
}

function copam_theme_reporte_borrar_lote($lote)
{
    if (!copam_theme_reporte_lote_valido($lote)) {
        return;
    }
    $dir = copam_theme_reporte_carpeta() . '/' . $lote;
    foreach (glob($dir . '/*') ?: [] as $archivo) {
        wp_delete_file($archivo);
    }
    if (is_dir($dir)) {
        rmdir($dir);
    }
}

// Borra los lotes que nadie envió.
function copam_theme_reporte_borrar_viejos()
{
    foreach (glob(copam_theme_reporte_carpeta() . '/*', GLOB_ONLYDIR) ?: [] as $dir) {
        if (filemtime($dir) < time() - COPAM_THEME_REPORTE_VIDA) {
            copam_theme_reporte_borrar_lote(wp_basename($dir));
        }
    }
}

/*
 * Endpoint de la evidencia: recibe los archivos elegidos (todos juntos, cada vez que cambia la selección),
 * los valida y responde con el identificador del lote, que el form envía en el campo `adjuntos`.
 */
add_action('wp_ajax_copam_theme_reporte_adjuntos', 'copam_theme_reporte_adjuntos');
add_action('wp_ajax_nopriv_copam_theme_reporte_adjuntos', 'copam_theme_reporte_adjuntos');
function copam_theme_reporte_adjuntos()
{
    nocache_headers();
    copam_theme_reporte_borrar_viejos();

    // El lote anterior de esta misma selección se reemplaza.
    $anterior = isset($_POST['anterior']) ? sanitize_key(wp_unslash($_POST['anterior'])) : ''; // phpcs:ignore WordPress.Security.NonceVerification -- endpoint público; los límites de abajo lo protegen
    copam_theme_reporte_borrar_lote($anterior);

    if (!copam_theme_form_rate_limit('reporte-adjuntos', 30)) {
        wp_send_json_error(['message' => 'Recibimos varios archivos seguidos. Intenta de nuevo más tarde.'], 429);
    }

    $files = $_FILES['archivos'] ?? null; // phpcs:ignore WordPress.Security.NonceVerification, WordPress.Security.ValidatedSanitizedInput -- se valida cada archivo abajo
    if (!is_array($files) || !isset($files['name']) || !is_array($files['name'])) {
        wp_send_json_error(['message' => 'No recibimos ningún archivo.'], 400);
    }

    $total = count($files['name']);
    if ($total < 1 || $total > COPAM_THEME_REPORTE_MAX_ARCHIVOS) {
        wp_send_json_error(['message' => sprintf('Puedes adjuntar hasta %d archivos.', COPAM_THEME_REPORTE_MAX_ARCHIVOS)], 400);
    }
    if (array_sum(array_map('intval', (array) $files['size'])) > COPAM_THEME_REPORTE_MAX_BYTES) {
        wp_send_json_error(['message' => 'Los archivos superan los 10 MB en total.'], 400);
    }

    // Primero se valida todo; si un archivo no sirve, no se guarda ninguno.
    $validos = [];
    for ($i = 0; $i < $total; $i++) {
        $tmp    = (string) ($files['tmp_name'][$i] ?? '');
        $nombre = sanitize_file_name((string) ($files['name'][$i] ?? ''));
        if ((int) ($files['error'][$i] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK || !is_uploaded_file($tmp)) {
            wp_send_json_error(['message' => 'No pudimos recibir uno de los archivos. Vuelve a elegirlo.'], 400);
        }
        $tipo = wp_check_filetype_and_ext($tmp, $nombre, COPAM_THEME_REPORTE_TIPOS);
        if (empty($tipo['ext']) || empty($tipo['type'])) {
            wp_send_json_error(['message' => 'Solo se aceptan archivos PDF, JPG o PNG.'], 400);
        }
        $base = pathinfo($nombre, PATHINFO_FILENAME);
        $validos[] = [$tmp, ($base !== '' ? $base : 'evidencia') . '.' . $tipo['ext']];
    }

    $lote = bin2hex(random_bytes(16));
    $dir  = copam_theme_reporte_carpeta() . '/' . $lote;
    if (!wp_mkdir_p($dir)) {
        wp_send_json_error(['message' => 'No pudimos guardar los archivos. Intenta de nuevo.'], 500);
    }
    foreach ($validos as [$tmp, $nombre]) {
        $destino = $dir . '/' . wp_unique_filename($dir, $nombre);
        if (!move_uploaded_file($tmp, $destino)) {
            copam_theme_reporte_borrar_lote($lote);
            wp_send_json_error(['message' => 'No pudimos guardar los archivos. Intenta de nuevo.'], 500);
        }
    }

    wp_send_json_success(['lote' => $lote]);
}
