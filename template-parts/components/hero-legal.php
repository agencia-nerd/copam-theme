<?php
defined('ABSPATH') || exit;

/**
 * Cabecera de las páginas legales (privacidad, términos, cookies): migas, título (h1) y la línea de última
 * actualización. Sin imagen: una sola columna alineada a la izquierda.
 *
 * $args:
 *  - migas         (array)   items para el componente migas
 *  - titulo        (string)
 *  - actualizacion (string)  se omite si está vacía
 */
$titulo        = trim((string) ($args['titulo'] ?? ''));
$actualizacion = trim((string) ($args['actualizacion'] ?? ''));
?>
<section class="relative bg-white pb-[clamp(96px,10vw,190px)]">
    <?php get_template_part('template-parts/components/migas', null, ['items' => $args['migas'] ?? []]); ?>

    <div class="h-[clamp(28px,4.3vw,82px)]" aria-hidden="true"></div>

    <div class="px-[clamp(20px,4.17vw,80px)] pt-[clamp(36px,5vw,96px)]">
        <?php if ($titulo !== '') : ?>
            <h1 class="m-0 text-[clamp(32px,3vw,58px)] leading-none font-bold tracking-[-.02em] text-ink uppercase">
                <span class="block overflow-hidden pb-[.06em]"><span class="block origin-[left_bottom]" data-sr="rise"><?= esc_html($titulo) ?></span></span>
            </h1>
        <?php endif; ?>
        <?php if ($actualizacion !== '') : ?>
            <p class="mt-[clamp(10px,.8vw,15px)] mb-0 max-w-[720px] text-[15px] leading-[1.6] text-pretty text-gris-4a" data-sr="clip"><?= esc_html($actualizacion) ?></p>
        <?php endif; ?>
    </div>
</section>
