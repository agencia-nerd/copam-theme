<?php
defined('ABSPATH') || exit;

/*
 * Correos HTML de los formularios. Dos diseños con la misma vista (template-parts/correos/correo.php):
 *  - 'area':    lo que recibe COPAM (todas las cuentas de Ajustes del sitio > Correos). Sobrio, para trabajar.
 *  - 'usuario': la copia que recibe quien presentó una hoja o solicitud (copam_theme_hoja_enviar_copia).
 * No cambia qué se envía ni a quién: toma el texto que ya arman el motor y cada formulario, lo ordena en
 * secciones y filas, y lo manda como HTML con ese mismo texto como versión plana (AltBody).
 */

// Etiquetas que arman los formularios fuera de sus campos (datos del proveedor de las hojas, pie del motor).
const COPAM_THEME_CORREO_ETIQUETAS = ['Fecha', 'Razón social', 'RUC', 'Dirección', 'Domicilio del establecimiento', 'Código de identificación', 'Página'];

/*
 * Ordena el texto plano de un envío: ['numero', 'fecha', 'pagina', 'intro' => [párrafos],
 * 'secciones' => [['titulo', 'indice', 'filas' => [['etiqueta', 'valor', 'largo']], 'notas' => [...]]]].
 * Reconoce las filas por las etiquetas de los campos del form, así un ":" dentro de un mensaje no corta nada.
 */
function copam_theme_correo_ordenar(string $texto, array $form = []): array
{
    $largos = [];
    $cortos = array_flip(COPAM_THEME_CORREO_ETIQUETAS);
    foreach ((array) ($form['fields'] ?? []) as $clave => $campo) {
        $etiqueta = (string) (($campo['label'] ?? '') !== '' ? $campo['label'] : $clave);
        $cortos[$etiqueta] = true;
        if (($campo['type'] ?? '') === 'textarea') {
            $largos[$etiqueta] = true;
        }
    }

    $doc = ['numero' => '', 'fecha' => '', 'pagina' => '', 'intro' => [], 'secciones' => []];
    $seccion = -1;
    $largo   = null; // [sección, fila] del valor de varias líneas que se está leyendo

    $agregar_fila = function (string $etiqueta, string $valor, bool $es_largo) use (&$doc, &$seccion): array {
        if ($seccion < 0) {
            $doc['secciones'][] = ['titulo' => '', 'indice' => '', 'filas' => [], 'notas' => []];
            $seccion = count($doc['secciones']) - 1;
        }
        $doc['secciones'][$seccion]['filas'][] = ['etiqueta' => $etiqueta, 'valor' => $valor, 'largo' => $es_largo];
        return [$seccion, count($doc['secciones'][$seccion]['filas']) - 1];
    };

    foreach (explode("\n", str_replace("\r", '', $texto)) as $linea) {
        $t = trim($linea);

        if ($t === '') {
            // Un párrafo nuevo dentro de un mensaje: el salto se suma al leer la línea siguiente.
            if ($largo && $doc['secciones'][$largo[0]]['filas'][$largo[1]]['valor'] !== '') {
                $doc['secciones'][$largo[0]]['filas'][$largo[1]]['valor'] .= "\n";
            }
            continue;
        }
        if ($seccion < 0 && preg_match('/^(?:Hoja de reclamación|Solicitud) N\.° (\S+)$/u', $t, $m)) {
            $doc['numero'] = $m[1];
            continue;
        }
        if (str_starts_with($t, 'Nuevo envío del formulario')) {
            continue;
        }
        // Título de sección: todo en mayúsculas, sin ":" ("1. DATOS DEL PROVEEDOR").
        if (!str_contains($t, ':') && preg_match('/\p{Lu}{3,}/u', $t) && mb_strtoupper($t) === $t) {
            $largo = null;
            $indice = preg_match('/^(\d+)\.\s*(.+)$/u', $t, $m) ? sprintf('%02d', (int) $m[1]) : '';
            $titulo = $indice !== '' ? $m[2] : $t;
            $titulo = mb_strtolower($titulo);
            $doc['secciones'][] = [
                'titulo' => mb_strtoupper(mb_substr($titulo, 0, 1)) . mb_substr($titulo, 1),
                'indice' => $indice,
                'filas'  => [],
                'notas'  => [],
            ];
            $seccion = count($doc['secciones']) - 1;
            continue;
        }
        if (preg_match('/^([^:]{1,120}):(?:\s(.*))?$/u', $t, $m) && isset($cortos[$m[1]])) {
            $largo = null;
            $etiqueta = $m[1];
            $valor    = trim($m[2] ?? '');
            if ($etiqueta === 'Fecha' && $seccion < 0) {
                $doc['fecha'] = $valor;
            } elseif ($etiqueta === 'Página') {
                $doc['pagina'] = $valor;
            } elseif ($valor === '' && isset($largos[$etiqueta])) {
                $largo = $agregar_fila($etiqueta, '', true);
            } else {
                $agregar_fila($etiqueta, $valor, false);
            }
            continue;
        }
        if ($largo) {
            $fila = &$doc['secciones'][$largo[0]]['filas'][$largo[1]];
            $fila['valor'] .= ($fila['valor'] !== '' ? "\n" : '') . $linea;
            unset($fila);
            continue;
        }
        if ($seccion < 0) {
            $doc['intro'][] = $t;
        } else {
            $doc['secciones'][$seccion]['notas'][] = $t;
        }
    }

    foreach ($doc['secciones'] as &$s) {
        foreach ($s['filas'] as &$f) {
            $f['valor'] = trim($f['valor']);
        }
    }
    unset($s, $f);

    return $doc;
}

// HTML completo del correo con la vista de template-parts/correos/correo.php.
function copam_theme_correo_html(string $tipo, array $args): string
{
    ob_start();
    get_template_part('template-parts/correos/correo', null, ['tipo' => $tipo] + $args);
    return (string) ob_get_clean();
}

// Versión plana del próximo correo, por asunto: la toma phpmailer_init (wp_mail vacía AltBody antes de cada envío).
function copam_theme_correo_texto_plano(?string $asunto = null, ?string $texto = null): array
{
    static $pendientes = [];
    if ($asunto !== null && $texto !== null) {
        $pendientes[$asunto] = $texto;
    } elseif ($asunto !== null && isset($pendientes[$asunto])) {
        $texto = $pendientes[$asunto];
        unset($pendientes[$asunto]);
        return [$texto];
    }
    return [];
}

add_action('phpmailer_init', 'copam_theme_correo_alt_body');
function copam_theme_correo_alt_body($phpmailer)
{
    $texto = copam_theme_correo_texto_plano((string) $phpmailer->Subject);
    if ($texto) {
        $phpmailer->AltBody = $texto[0];
    }
}

// Cambia el Content-Type de una lista de cabeceras a HTML.
function copam_theme_correo_cabeceras_html(array $headers): array
{
    $headers = array_values(array_filter($headers, static fn($h): bool => stripos((string) $h, 'content-type:') !== 0));
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    return $headers;
}

/*
 * Correo al área (todas las cuentas). Corre al final, después de que cada formulario armó su texto,
 * su número de hoja y sus destinatarios.
 */
add_filter('copam_theme_form_mail', 'copam_theme_correo_area', 99, 3);
function copam_theme_correo_area($mail, $form, $data)
{
    $texto = (string) ($mail['message'] ?? '');
    $doc   = copam_theme_correo_ordenar($texto, $form);

    $responder = '';
    foreach ((array) $mail['headers'] as $cabecera) {
        if (stripos((string) $cabecera, 'reply-to:') === 0) {
            $responder = trim(substr((string) $cabecera, 9));
        }
    }
    $nombre = trim((string) ($data['nombre'] ?? ''));

    $mail['message'] = copam_theme_correo_html('area', [
        'asunto'    => (string) $mail['subject'],
        'formulario'=> (string) ($form['title'] ?? ''),
        'doc'       => $doc,
        'enviado'   => wp_date('d/m/Y · H:i'),
        'responder' => is_email($responder) ? $responder : '',
        'nombre'    => $nombre,
    ]);
    $mail['headers'] = copam_theme_correo_cabeceras_html((array) $mail['headers']);
    copam_theme_correo_texto_plano((string) $mail['subject'], $texto);

    return $mail;
}
