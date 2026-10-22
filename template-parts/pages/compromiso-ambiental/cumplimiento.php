<?php
defined('ABSPATH') || exit;

/**
 * Compromiso Ambiental · cumplimiento normativo: párrafo, imagen en banda y enlace.
 * Lee el grupo `compromiso_ambiental_cumplimiento` (ACF).
 */
$grupo = get_field('compromiso_ambiental_cumplimiento') ?: [];
?>
<section id="cumplimiento">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    <p class="mt-[clamp(20px,1.6vw,30px)] text-[15px] leading-[1.65] text-pretty text-gris-3a" data-sr="clip" data-sr-delay="200"><?= esc_html((string) ($grupo['texto'] ?? '')) ?></p>
    <?php get_template_part('template-parts/components/imagen-banda', null, ['imagen' => $grupo['imagen'] ?? null]); ?>
    <?php get_template_part('template-parts/components/enlace-flecha', null, ['enlace' => $grupo['enlace'] ?? null, 'clase' => 'mt-[18px]']); ?>
</section>
