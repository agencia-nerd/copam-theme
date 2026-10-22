<?php
defined('ABSPATH') || exit;

/**
 * Comunicados: el armado del listado que comparten home.php, category.php y search.php.
 * Encabezado y, en la sección `#lista`, filtros + rejilla + paginación, o el estado vacío si no hay entradas.
 * src/js/modules/comunicados.js cambia las zonas `data-comunicados-*` sin recargar (inc/comunicados-filtros.php).
 */
$termino = null;
if (is_category()) {
    $termino = get_queried_object();
} elseif (get_query_var('category_name')) {
    $termino = get_category_by_slug((string) get_query_var('category_name')) ?: null;
}
$args = ['termino' => $termino instanceof WP_Term ? $termino : null];
?>
<div data-comunicados-encabezado>
    <?php get_template_part('template-parts/pages/comunicados/encabezado', null, $args); ?>
</div>
<section class="relative z-[1] bg-white pb-[clamp(88px,7.3vw,140px)]" id="lista" aria-label="<?= esc_attr__('Listado de comunicados', 'copam-theme') ?>" data-comunicados>
    <?php get_template_part('template-parts/pages/comunicados/filtros', null, $args); ?>
    <div class="transition-opacity duration-300 aria-busy:opacity-50" data-comunicados-resultados aria-live="polite">
        <?php
        if (have_posts()) {
            get_template_part('template-parts/pages/comunicados/listado');
            get_template_part('template-parts/pages/comunicados/paginacion');
        } else {
            get_template_part('template-parts/pages/comunicados/vacio');
        }
        ?>
    </div>
</section>
