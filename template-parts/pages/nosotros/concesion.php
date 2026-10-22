<?php
defined('ABSPATH') || exit;

/**
 * Nosotros · concesión: título, subtítulo, textos, lista de datos e imagen en banda.
 * Lee el grupo `nosotros_concesion` (ACF).
 */
$grupo     = get_field('nosotros_concesion') ?: [];
$subtitulo = (string) ($grupo['subtitulo'] ?? '');
$bajada    = (string) ($grupo['bajada'] ?? '');
?>
<section id="concesion">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    <?php if ($subtitulo !== '') : ?>
        <h3 class="mt-[clamp(22px,1.8vw,34px)] mb-0 overflow-hidden pb-[.08em]"><span class="block text-[clamp(26px,1.8vw,34px)] leading-[1.15] font-semibold tracking-[-.01em] text-ink" data-sr="rise" data-sr-delay="120"><?= esc_html($subtitulo) ?></span></h3>
    <?php endif; ?>
    <?php if ($bajada !== '') : ?>
        <p class="mt-2 text-base leading-normal text-pretty text-gris-5a" data-sr="clip" data-sr-delay="180"><?= esc_html($bajada) ?></p>
    <?php endif; ?>
    <p class="mt-[clamp(16px,1.3vw,24px)] text-[15px] leading-[1.65] text-pretty text-gris-3a" data-sr="clip" data-sr-delay="240"><?= esc_html((string) ($grupo['texto'] ?? '')) ?></p>
    <?php get_template_part('template-parts/components/lista-datos', null, ['filas' => (array) ($grupo['datos'] ?? [])]); ?>
    <?php get_template_part('template-parts/components/imagen-banda', null, ['imagen' => $grupo['imagen'] ?? null]); ?>
</section>
