<?php
defined('ABSPATH') || exit;

/*
 * Numeración correlativa por año de las hojas y solicitudes que llegan por formulario
 * (Depósito Temporal `DT-2026-00001`, Libro de Reclamaciones `LR-…`, Reclamos `RC-…`).
 * Cada prefijo tiene su propio contador en la opción `copam_theme_hoja_<prefijo>_<año>`.
 */

// Siguiente número del año. El incremento se hace en una sola consulta para que dos envíos simultáneos
// no reciban el mismo número.
function copam_theme_hoja_siguiente_numero(string $prefijo): string
{
    global $wpdb;

    $anio   = wp_date('Y');
    $opcion = 'copam_theme_hoja_' . strtolower($prefijo) . '_' . $anio;
    add_option($opcion, '0', '', false);
    $wpdb->query($wpdb->prepare("UPDATE {$wpdb->options} SET option_value = LAST_INSERT_ID(option_value + 1) WHERE option_name = %s", $opcion));
    $numero = (int) $wpdb->get_var('SELECT LAST_INSERT_ID()');
    wp_cache_delete($opcion, 'options');
    wp_cache_delete('notoptions', 'options');

    return sprintf('%s-%s-%05d', strtoupper($prefijo), $anio, $numero);
}

// Hoja en curso (número, fecha y envío guardado): se asigna una sola vez por envío, al armar el correo.
function copam_theme_hoja_en_curso(?array $nueva = null): ?array
{
    static $hoja = null;
    if ($nueva !== null) {
        $hoja = $nueva ?: null;
    }
    return $hoja;
}

// El envío guardado en el admin lleva el número de hoja en el título; se anota su id para completarlo después.
add_filter('wp_insert_post_data', 'copam_theme_hoja_titulo_envio', 20, 2);
function copam_theme_hoja_titulo_envio($post_data, $postarr)
{
    $hoja = copam_theme_hoja_en_curso();
    if ($hoja && empty($postarr['ID']) && defined('COPAM_THEME_ENTRY_TYPE') && ($post_data['post_type'] ?? '') === COPAM_THEME_ENTRY_TYPE) {
        $post_data['post_title'] = wp_slash('N.° ' . $hoja['numero'] . ' — ') . $post_data['post_title'];
    }
    return $post_data;
}

add_action('wp_insert_post', 'copam_theme_hoja_anotar_envio', 10, 3);
function copam_theme_hoja_anotar_envio($post_id, $post, $update)
{
    $hoja = copam_theme_hoja_en_curso();
    if ($hoja && !$update && defined('COPAM_THEME_ENTRY_TYPE') && $post->post_type === COPAM_THEME_ENTRY_TYPE) {
        copam_theme_hoja_en_curso($hoja + ['envio' => (int) $post_id]);
    }
}

/*
 * Líneas "Etiqueta: valor" de los campos de un form, agrupadas por sección (correo al área y copia al usuario).
 * $secciones: ['TÍTULO' => ['campo', ...]]. $omitir: campos que no van (los de un bloque cerrado).
 * $valores: valores ya resueltos que reemplazan al enviado (nombres de archivos en lugar del lote).
 */
function copam_theme_hoja_lineas(array $form, array $data, array $secciones, array $omitir = [], array $valores = []): array
{
    $lineas = [];
    foreach ($secciones as $titulo => $claves) {
        $lineas[] = '';
        $lineas[] = $titulo;
        foreach ($claves as $clave) {
            if (in_array($clave, $omitir, true) || !isset($form['fields'][$clave])) {
                continue;
            }
            $campo = $form['fields'][$clave];
            $valor = $valores[$clave] ?? ($data[$clave] ?? '');
            if (is_bool($valor)) {
                $valor = $valor ? 'Sí' : 'No';
            } elseif (in_array($campo['type'], ['select', 'radio'], true) && $valor !== '') {
                $valor = (string) ($campo['options'][$valor] ?? $valor);
            }
            $lineas[] = $campo['type'] === 'textarea'
                ? $campo['label'] . ":\n" . ($valor !== '' ? $valor : '—')
                : $campo['label'] . ': ' . ($valor !== '' ? $valor : '—');
        }
    }
    return $lineas;
}

// Copia de la hoja al correo de quien la envió, en HTML (inc/correos-html.php) con el texto como versión plana.
// $form ayuda a reconocer las filas del texto. Devuelve si salió, para que la respuesta no prometa una copia
// que no llegó; un fallo se anota y no corta el envío (la hoja ya está registrada).
function copam_theme_hoja_enviar_copia(string $correo, string $asunto, string $texto, array $form = []): bool
{
    if (!is_email($correo)) {
        return false;
    }
    $html = copam_theme_correo_html('usuario', ['asunto' => $asunto, 'doc' => copam_theme_correo_ordenar($texto, $form)]);
    copam_theme_correo_texto_plano($asunto, $texto);
    if (!wp_mail($correo, $asunto, $html, ['Content-Type: text/html; charset=UTF-8'])) {
        copam_theme_form_log('No se pudo enviar la copia "' . $asunto . '" a quien la presentó.');
        return false;
    }
    return true;
}

/*
 * Texto final de la respuesta de una hoja: si el correo al área falló, avisa que la hoja igual quedó registrada
 * (se guardó en Envíos) para que el usuario conserve el número; luego dice si la copia llegó o no.
 */
function copam_theme_hoja_aviso_envio(bool $enviado, bool $copia, string $correo): string
{
    $partes = [];
    if (!$enviado) {
        $partes[] = 'No pudimos avisar al área por correo, pero tu hoja ya está en nuestro registro: guarda este número.';
    }
    $partes[] = $copia
        ? sprintf('Enviamos una copia a %s.', $correo)
        : 'No pudimos enviarte la copia por correo; imprime o guarda esta hoja.';
    return implode(' ', $partes);
}

// Página que usa una plantilla (los envíos llegan por AJAX, sin la página en contexto).
function copam_theme_hoja_pagina(string $plantilla): int
{
    $paginas = get_pages(['meta_key' => '_wp_page_template', 'meta_value' => $plantilla, 'number' => 1]);
    return $paginas ? (int) $paginas[0]->ID : 0;
}
