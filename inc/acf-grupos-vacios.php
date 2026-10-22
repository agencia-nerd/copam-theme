<?php
defined('ABSPATH') || exit;

/**
 * wp-acf genera un grupo por cada spec de página aunque no tenga campos (p. ej. "Comunicado": el detalle usa
 * solo el título y el contenido de la entrada). ACF pinta igual su caja vacía en el editor: aquí se quita.
 */
function copam_theme_acf_quitar_cajas_vacias($post_type, $post, $field_groups): void
{
    foreach ((array) $field_groups as $group) {
        if (!acf_get_fields($group)) {
            remove_meta_box('acf-' . $group['key'], $post_type, (string) $group['position']);
        }
    }
}
add_action('acf/add_meta_boxes', 'copam_theme_acf_quitar_cajas_vacias', 10, 3);
