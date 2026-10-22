<?php
defined('ABSPATH') || exit;

/**
 * Canal de hostigamiento sexual · otros canales: dos párrafos y los enlaces con flecha (en fila; pasan a la
 * línea siguiente cuando no caben). Lee el grupo `canal_hostigamiento_sexual_otros_canales` (ACF).
 */
$grupo   = get_field('canal_hostigamiento_sexual_otros_canales') ?: [];
$bajada  = (string) ($grupo['bajada'] ?? '');
$aviso   = (string) ($grupo['aviso'] ?? '');
$enlaces = array_values(array_filter(
    array_map(static fn($fila) => $fila['enlace'] ?? null, (array) ($grupo['enlaces'] ?? [])),
    static fn($enlace): bool => copam_theme_link_data($enlace) !== null
));
?>
<section class="relative z-[1] bg-white px-[clamp(20px,4.17vw,80px)] pt-[clamp(56px,5vw,96px)] pb-[clamp(88px,7.3vw,140px)]" id="otros-canales">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    <?php if ($bajada !== '') : ?>
        <p class="mt-[clamp(16px,1.3vw,24px)] mb-0 max-w-[720px] text-[15px] leading-[1.6] text-pretty text-ink-muted" data-sr="clip" data-sr-delay="200"><?= esc_html($bajada) ?></p>
    <?php endif; ?>
    <?php if ($aviso !== '') : ?>
        <p class="mt-3 mb-0 max-w-[720px] text-[15px] leading-[1.6] text-pretty text-ink-muted" data-sr="clip" data-sr-delay="240"><?= esc_html($aviso) ?></p>
    <?php endif; ?>
    <?php if ($enlaces) : ?>
        <div class="mt-[18px] flex flex-wrap gap-x-8 gap-y-3">
            <?php foreach ($enlaces as $enlace) {
                get_template_part('template-parts/components/enlace-flecha', null, ['enlace' => $enlace]);
            } ?>
        </div>
    <?php endif; ?>
</section>
