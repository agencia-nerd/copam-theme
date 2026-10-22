<?php
defined('ABSPATH') || exit;

/**
 * Nosotros · sistema integrado de gestión: título, subtítulo con las normas, textos, lista de datos y enlace.
 * Lee el grupo `nosotros_sistema` (ACF).
 */
$grupo     = get_field('nosotros_sistema') ?: [];
$subtitulo = (string) ($grupo['subtitulo'] ?? '');
$alcance   = (string) ($grupo['alcance'] ?? '');
?>
<section id="sistema">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    <?php if ($subtitulo !== '') : ?>
        <h3 class="mt-[clamp(22px,1.8vw,34px)] mb-0 overflow-hidden pb-[.08em]"><span class="block text-[clamp(26px,1.8vw,34px)] leading-[1.15] font-semibold tracking-[-.01em] text-ink" data-sr="rise" data-sr-delay="120"><?= esc_html($subtitulo) ?></span></h3>
    <?php endif; ?>
    <p class="mt-[clamp(16px,1.3vw,24px)] text-[15px] leading-[1.65] text-pretty text-gris-3a" data-sr="clip" data-sr-delay="180"><?= esc_html((string) ($grupo['texto'] ?? '')) ?></p>
    <?php if ($alcance !== '') : ?>
        <p class="mt-[clamp(12px,1vw,18px)] text-[15px] leading-[1.65] text-pretty text-gris-3a" data-sr="clip" data-sr-delay="240"><?= esc_html($alcance) ?></p>
    <?php endif; ?>
    <?php get_template_part('template-parts/components/lista-datos', null, ['filas' => (array) ($grupo['datos'] ?? [])]); ?>
    <?php get_template_part('template-parts/components/enlace-flecha', null, ['enlace' => $grupo['enlace'] ?? null, 'clase' => 'mt-[clamp(20px,1.6vw,30px)]']); ?>
</section>
