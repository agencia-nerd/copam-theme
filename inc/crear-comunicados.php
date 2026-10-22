<?php
defined('ABSPATH') || exit;

/**
 * Al activar el tema, crea la página "Comunicados" y la fija como página de entradas (la usa home.php).
 * Abajo, los enlaces de los comunicados pasan a /comunicados/<entrada>/.
 * Solo actúa si el sitio aún no tiene una página de entradas publicada: nunca pisa una elegida.
 * El listado muestra 9 comunicados por página: se fija solo si sigue el valor por defecto de WordPress (10).
 */
function copam_theme_setup_posts_page()
{
    if ((int) get_option('posts_per_page') === 10) {
        update_option('posts_per_page', 9);
    }

    if (get_post_status((int) get_option('page_for_posts')) === 'publish') {
        return;
    }

    $page = get_page_by_path('comunicados');
    if ($page && $page->post_status === 'publish') {
        $page_id = $page->ID;
    } else {
        $page_id = wp_insert_post([
            'post_type'   => 'page',
            'post_status' => 'publish',
            'post_title'  => __('Comunicados', 'copam-theme'),
            'post_name'   => 'comunicados',
        ], true);
    }

    if (is_wp_error($page_id) || !$page_id) {
        return;
    }

    update_option('page_for_posts', $page_id);
}
add_action('after_switch_theme', 'copam_theme_setup_posts_page', 20);

/**
 * Los comunicados cuelgan del listado: /comunicados/<entrada>/ (Ajustes › Enlaces permanentes). Solo cambia la
 * estructura si sigue en una de las de WordPress (`/%postname%/` o la simple): nunca pisa una personalizada.
 * Con esa base, las categorías quedan en /comunicados/category/<categoría>/.
 */
function copam_theme_setup_comunicados_permalink()
{
    $page_id = (int) get_option('page_for_posts');
    if (!in_array((string) get_option('permalink_structure'), ['', '/%postname%/'], true) || get_post_status($page_id) !== 'publish') {
        return;
    }

    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/' . get_page_uri($page_id) . '/%postname%/');
    // Las reglas se regeneran en la próxima visita: en esta petición las categorías aún tienen la base anterior.
    update_option('rewrite_rules', '');
}
add_action('after_switch_theme', 'copam_theme_setup_comunicados_permalink', 30);

// En un sitio donde el tema ya estaba activo (producción), lo anterior corre una sola vez al entrar al admin.
function copam_theme_setup_comunicados_una_vez()
{
    if (get_option('copam_theme_comunicados_listo') || !current_user_can('manage_options')) {
        return;
    }
    copam_theme_setup_posts_page();
    copam_theme_setup_comunicados_permalink();
    update_option('copam_theme_comunicados_listo', 1);
}
add_action('admin_init', 'copam_theme_setup_comunicados_una_vez');
