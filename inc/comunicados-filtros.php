<?php
defined('ABSPATH') || exit;

/**
 * Filtros del listado de comunicados (home.php, category.php, search.php): categoría (su archivo), búsqueda
 * (`s`) y año (`anio`). El filtrado lo hace la consulta principal de WordPress; src/js/modules/comunicados.js
 * pide la misma URL por fetch para cambiar los resultados sin recargar.
 */

// Año pedido en `?anio=`; 0 si no hay o no es un año válido.
function copam_theme_comunicados_anio(): int
{
    $anio = isset($_GET['anio']) ? absint(wp_unslash($_GET['anio'])) : 0; // phpcs:ignore WordPress.Security.NonceVerification -- filtro público de solo lectura.

    return $anio >= 1000 && $anio <= 9999 ? $anio : 0;
}

// Aplica el año y limita la búsqueda a comunicados en la consulta principal del listado.
function copam_theme_comunicados_filtrar(WP_Query $query): void
{
    if (is_admin() || !$query->is_main_query() || !($query->is_home() || $query->is_category() || $query->is_search())) {
        return;
    }

    $anio = copam_theme_comunicados_anio();
    if ($anio) {
        $query->set('year', $anio);
    }
    if ($query->is_search()) {
        $query->set('post_type', 'post');
    }
}
add_action('pre_get_posts', 'copam_theme_comunicados_filtrar');

// Años con comunicados publicados, del más reciente al más antiguo.
function copam_theme_comunicados_anios(): array
{
    $anios = get_transient('copam_theme_comunicados_anios');
    if (is_array($anios)) {
        return $anios;
    }

    global $wpdb;
    $anios = array_map('intval', $wpdb->get_col($wpdb->prepare(
        "SELECT DISTINCT YEAR(post_date) FROM {$wpdb->posts} WHERE post_type = %s AND post_status = %s ORDER BY 1 DESC",
        'post',
        'publish'
    )));
    set_transient('copam_theme_comunicados_anios', $anios, DAY_IN_SECONDS);

    return $anios;
}

function copam_theme_comunicados_anios_limpiar(): void
{
    delete_transient('copam_theme_comunicados_anios');
}
add_action('save_post_post', 'copam_theme_comunicados_anios_limpiar');
add_action('deleted_post', 'copam_theme_comunicados_anios_limpiar');

// Le suma a una URL de listado la búsqueda y el año actuales (las pastillas los conservan al cambiar de categoría).
function copam_theme_comunicados_url_filtro(string $base): string
{
    $args = array_filter([
        's'         => get_search_query(false),
        'anio'      => copam_theme_comunicados_anio() ?: '',
    ], static fn($valor): bool => $valor !== '');
    if (isset($args['s'])) {
        $args['post_type'] = 'post';
    }

    return $args ? add_query_arg(array_map('rawurlencode', $args), $base) : $base;
}
