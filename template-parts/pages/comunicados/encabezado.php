<?php
defined('ABSPATH') || exit;

/**
 * Comunicados · encabezado: migas (Inicio › Zona Clientes › Comunicados), h1 y bajada.
 * Lee el grupo `comunicados_encabezado` de la página de opciones "Archivo de comunicado" (contenido inicial en
 * inc/acf/seed/comunicados.php). En una categoría (category.php) el título y la bajada son los del término.
 *
 * $args:
 *  - termino (WP_Term) la categoría que se está viendo, si es una
 */
$sec     = get_field('comunicados_encabezado', 'option') ?: [];
$termino = ($args['termino'] ?? null) instanceof WP_Term ? $args['termino'] : null;
$titulo  = trim((string) ($sec['titulo'] ?? '')) ?: trim(html_entity_decode(get_the_title((int) get_option('page_for_posts')), ENT_QUOTES)); // sin campo, el título de la página de entradas
$bajada  = trim((string) ($sec['bajada'] ?? ''));

$migas = [
    ['texto' => __('Inicio', 'copam-theme'), 'url' => home_url('/')],
    ['texto' => __('Zona Clientes', 'copam-theme')],
];
if ($termino) {
    $migas[] = ['texto' => $titulo, 'url' => copam_theme_comunicados_url()];
    $titulo  = $termino->name;
    $bajada  = trim(wp_strip_all_tags(term_description($termino)));
}
$migas[] = ['texto' => $titulo];
?>
<section class="relative bg-white pb-[clamp(96px,10vw,190px)]">
    <?php get_template_part('template-parts/components/migas', null, ['items' => $migas]); ?>

    <div class="h-[clamp(28px,4.3vw,82px)]" aria-hidden="true"></div>

    <div class="px-[clamp(20px,4.17vw,80px)] pt-[clamp(36px,5vw,96px)]">
        <?php if ($titulo !== '') : ?>
            <h1 class="m-0 text-[clamp(32px,3vw,58px)] leading-none font-bold tracking-[-.02em] text-ink uppercase">
                <span class="block overflow-hidden pb-[.06em]"><span class="block origin-[left_bottom]" data-sr="rise"><?= esc_html($titulo) ?></span></span>
            </h1>
        <?php endif; ?>
        <?php if ($bajada !== '') : ?>
            <p class="mt-[clamp(10px,.8vw,15px)] mb-0 max-w-[720px] text-[15px] leading-[1.6] text-pretty text-gris-4a" data-sr="clip"><?= esc_html($bajada) ?></p>
        <?php endif; ?>
    </div>
</section>
