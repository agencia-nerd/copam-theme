<?php
defined('ABSPATH') || exit;

/**
 * Comunicado · cabecera: migas (Inicio › Comunicados › título), categoría, fecha y h1. Todo sale de la entrada
 * actual (dentro del loop de single.php): no hay campos ACF.
 */
$c = copam_theme_comunicado();

$pildora  = copam_theme_comunicado_pildora($c['categoria']);
$palabras = preg_split('/\s+/u', trim(wp_strip_all_tags($c['titulo'])), -1, PREG_SPLIT_NO_EMPTY);

get_template_part('template-parts/components/migas', null, ['items' => [
    ['texto' => __('Inicio', 'copam-theme'), 'url' => home_url('/')],
    ['texto' => __('Comunicados', 'copam-theme'), 'url' => copam_theme_comunicados_url()],
    ['texto' => $c['titulo']],
]]);
?>
<div class="px-[clamp(20px,4.17vw,80px)] pt-[clamp(56px,6vw,116px)]">
<header class="mx-auto max-w-[950px] text-center">
    <div class="flex flex-wrap items-center justify-center gap-x-4 gap-y-2.5">
        <?php if ($c['categoria'] !== '') : ?>
            <span class="block overflow-hidden rounded-[3px]"><span class="block rounded-[3px] px-2.5 py-1.5 text-xs leading-[1.2] font-semibold tracking-[.14em] uppercase <?= esc_attr($pildora) ?>" data-sr="rise"><?= esc_html($c['categoria']) ?></span></span>
        <?php endif; ?>
        <?php if ($c['fecha'] !== '') : ?>
            <span class="block overflow-hidden"><span class="block text-sm tracking-[.14em] text-gris-7a uppercase" data-sr="rise" data-sr-delay="60"><?= esc_html(sprintf(/* translators: %s: fecha */ __('Publicado el %s', 'copam-theme'), $c['fecha'])) ?></span></span>
        <?php endif; ?>
    </div>
    <h1 class="mt-[clamp(20px,1.8vw,34px)] mb-0 flex flex-wrap justify-center gap-x-[.25em] text-[clamp(30px,2.9vw,56px)] leading-[1.08] font-semibold tracking-[-.01em] text-ink uppercase">
        <?php foreach ($palabras as $i => $palabra) : ?>
            <span class="block overflow-hidden pb-[.06em]"><span class="block" data-sr="rise" data-sr-delay="<?= esc_attr((string) (100 + $i * 40)) ?>"><?= esc_html($palabra) ?></span></span>
        <?php endforeach; ?>
    </h1>
    <span class="mt-[clamp(36px,3.1vw,60px)] block h-px origin-center bg-[#E1E1E1]" data-sr="lineX" data-sr-delay="300" aria-hidden="true"></span>
</header>
</div>
