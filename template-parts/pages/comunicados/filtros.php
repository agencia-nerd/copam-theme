<?php
defined('ABSPATH') || exit;

/**
 * Comunicados · filtros: pastillas de categoría (enlaces a cada archivo), buscador y año.
 * Funcionan como enlaces y form normales (inc/comunicados-filtros.php filtra la consulta); con JS,
 * src/js/modules/comunicados.js los aplica sin recargar.
 *
 * $args:
 *  - termino (WP_Term) la categoría activa; sin ella, "Todos"
 */
$termino = ($args['termino'] ?? null) instanceof WP_Term ? $args['termino'] : null;
$base    = $termino ? (string) get_category_link($termino) : copam_theme_comunicados_url();
$actual  = copam_theme_comunicados_anio();

$pastillas = [['texto' => __('Todos', 'copam-theme'), 'url' => copam_theme_comunicados_url(), 'activa' => !$termino]];
foreach (get_categories(['orderby' => 'term_id', 'exclude' => [(int) get_option('default_category')]]) as $cat) {
    $pastillas[] = ['texto' => $cat->name, 'url' => (string) get_category_link($cat), 'activa' => $termino && $termino->term_id === $cat->term_id];
}
?>
<form class="flex flex-wrap items-center justify-between gap-x-6 gap-y-4 px-[clamp(20px,4.17vw,80px)]" method="get" action="<?= esc_url($base) ?>" role="search" aria-label="<?= esc_attr__('Filtrar comunicados', 'copam-theme') ?>" data-comunicados-form>
    <ul class="m-0 flex list-none flex-wrap gap-2 p-0" data-comunicados-pastillas>
        <?php foreach ($pastillas as $i => $p) : ?>
            <li class="overflow-hidden rounded-full">
                <a class="flex h-11 items-center rounded-full border px-5 text-[15px] font-medium transition-colors duration-300 <?= $p['activa'] ? 'border-brand bg-brand text-white hover:text-white' : 'border-[#DADADA] bg-white text-ink hover:border-brand hover:text-ink' ?>" href="<?= esc_url(copam_theme_comunicados_url_filtro($p['url'])) ?>" data-sr="rise" data-sr-delay="<?= esc_attr((string) ($i * 60)) ?>"<?= $p['activa'] ? ' aria-current="true"' : '' ?>><?= esc_html($p['texto']) ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="flex max-w-full flex-wrap gap-2.5 sm:flex-nowrap" data-sr="clip" data-sr-delay="200">
        <input type="hidden" name="post_type" value="post">
        <label class="relative block w-80 max-w-full min-w-0 flex-[0_1_320px]">
            <span class="sr-only"><?= esc_html__('Buscar comunicado', 'copam-theme') ?></span>
            <input class="box-border h-12 w-full rounded-[3px] border border-[#DADADA] bg-white pr-11 pl-4 text-[15px] text-ink outline-0 transition-colors duration-300 focus:border-brand" type="search" name="s" value="<?= esc_attr(get_search_query(false)) ?>" placeholder="<?= esc_attr__('Buscar comunicado', 'copam-theme') ?>" autocomplete="off" data-comunicados-buscar>
            <svg class="pointer-events-none absolute top-4 right-4 text-gris-7a" width="16" height="16" viewBox="0 0 20 20" fill="none" aria-hidden="true"><circle cx="8.5" cy="8.5" r="6" stroke="currentColor" stroke-width="1.8"></circle><path d="M13 13l5 5" stroke="currentColor" stroke-width="1.8"></path></svg>
        </label>
        <label class="relative block w-40 flex-none">
            <span class="sr-only"><?= esc_html__('Año', 'copam-theme') ?></span>
            <select class="box-border h-12 w-full cursor-pointer appearance-none rounded-[3px] border border-[#DADADA] bg-white pr-10 pl-4 text-[15px] text-ink outline-0 focus:border-brand" name="anio" data-comunicados-anio>
                <option value=""><?= esc_html__('Año: todos', 'copam-theme') ?></option>
                <?php foreach (copam_theme_comunicados_anios() as $anio) : ?>
                    <option value="<?= esc_attr((string) $anio) ?>"<?php selected($actual, $anio); ?>><?= esc_html(sprintf(/* translators: %s: año */ __('Año: %s', 'copam-theme'), $anio)) ?></option>
                <?php endforeach; ?>
            </select>
            <svg class="pointer-events-none absolute top-[21px] right-4 text-gris-7a" width="10" height="6" viewBox="0 0 10 6" fill="none" aria-hidden="true"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.4"></path></svg>
        </label>
        <button class="sr-only focus:not-sr-only focus:h-12 focus:rounded-[3px] focus:bg-brand focus:px-5 focus:text-white" type="submit"><?= esc_html__('Buscar', 'copam-theme') ?></button>
    </div>
</form>
