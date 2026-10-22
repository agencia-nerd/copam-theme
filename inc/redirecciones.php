<?php
defined('ABSPATH') || exit;

/**
 * La página padre "Servicios" (/servicios/) no tiene diseño: redirige con 301 a su primera página hija
 * publicada (por orden del menú y luego por fecha), hoy Servicios a la nave.
 */
function copam_theme_redirigir_servicios(): void
{
    if (!is_page() || !is_page_template('pages/template-servicios.php')) {
        return;
    }

    $hijas = get_pages([
        'parent'      => (int) get_queried_object_id(),
        'sort_column' => 'menu_order,post_date',
        'number'      => 1,
        'post_status' => 'publish',
    ]);
    if (!$hijas) {
        return;
    }

    wp_safe_redirect(get_permalink($hijas[0]), 301);
    exit;
}
add_action('template_redirect', 'copam_theme_redirigir_servicios');
