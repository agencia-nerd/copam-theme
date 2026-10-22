<?php
defined('ABSPATH') || exit;

/**
 * Compromiso Ambiental · política ambiental: introducción, lista de compromisos y enlace.
 * Lee el grupo `compromiso_ambiental_politica` (ACF).
 */
$grupo       = get_field('compromiso_ambiental_politica') ?: [];
$compromisos = array_values(array_filter((array) ($grupo['compromisos'] ?? []), static fn($c): bool => trim((string) ($c['texto'] ?? '')) !== ''));
?>
<section id="politica">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    <p class="mt-[clamp(20px,1.6vw,30px)] text-[15px] leading-[1.65] text-pretty text-[#8C8C8C]" data-sr="clip" data-sr-delay="200"><?= esc_html((string) ($grupo['intro'] ?? '')) ?></p>
    <?php if ($compromisos) : ?>
        <ul class="m-0 mt-4 flex list-none flex-col gap-2.5 p-0" data-sr="clip" data-sr-delay="260">
            <?php foreach ($compromisos as $compromiso) : ?>
                <li class="flex gap-3 text-[15px] leading-[1.65] text-pretty text-gris-3a">
                    <span class="mt-[.62em] size-1.5 flex-none rounded-full bg-brand" aria-hidden="true"></span>
                    <span><?= esc_html((string) $compromiso['texto']) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <?php get_template_part('template-parts/components/enlace-flecha', null, ['enlace' => $grupo['enlace'] ?? null, 'clase' => 'mt-[18px]']); ?>
</section>
