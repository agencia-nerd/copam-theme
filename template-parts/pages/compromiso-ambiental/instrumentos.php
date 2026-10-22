<?php
defined('ABSPATH') || exit;

/**
 * Compromiso Ambiental · instrumentos de gestión ambiental: párrafo y dos imágenes en fila.
 * Lee el grupo `compromiso_ambiental_instrumentos` (ACF).
 */
$grupo      = get_field('compromiso_ambiental_instrumentos') ?: [];
$principal  = copam_theme_image($grupo['imagen_principal'] ?? null, ['size' => 'large', 'class' => 'absolute inset-0 block size-full object-cover', 'sizes' => '(max-width: 999px) 60vw, 40vw']);
$secundaria = copam_theme_image($grupo['imagen_secundaria'] ?? null, ['size' => 'large', 'class' => 'absolute inset-0 block size-full object-cover', 'sizes' => '(max-width: 999px) 50vw, 35vw']);
?>
<section id="instrumentos">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    <p class="mt-[clamp(20px,1.6vw,30px)] text-[15px] leading-[1.65] text-pretty text-gris-3a" data-sr="clip" data-sr-delay="200"><?= esc_html((string) ($grupo['texto'] ?? '')) ?></p>
    <?php if ($principal !== '' || $secundaria !== '') : ?>
        <div class="mt-[clamp(20px,1.6vw,30px)] grid grid-cols-[minmax(0,1.629fr)_minmax(0,1.5fr)] gap-1.5">
            <?php if ($principal !== '') : ?>
                <div class="relative aspect-[3376/2073] overflow-hidden rounded bg-gris-ef" data-sr="card"><?= $principal ?></div>
            <?php endif; ?>
            <?php if ($secundaria !== '') : ?>
                <div class="relative aspect-[4731/3153] overflow-hidden rounded bg-gris-ef" data-sr="card" data-sr-delay="110"><?= $secundaria ?></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>
