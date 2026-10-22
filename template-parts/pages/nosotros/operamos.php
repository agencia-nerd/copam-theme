<?php
defined('ABSPATH') || exit;

/**
 * Nosotros · cómo operamos: título, párrafo, imagen en banda y enlace.
 * Lee el grupo `nosotros_operamos` (ACF).
 */
$grupo = get_field('nosotros_operamos') ?: [];
?>
<section id="operamos">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    <p class="mt-[clamp(20px,1.6vw,30px)] text-[15px] leading-[1.65] text-pretty text-gris-3a" data-sr="clip" data-sr-delay="200"><?= esc_html((string) ($grupo['texto'] ?? '')) ?></p>
    <?php get_template_part('template-parts/components/imagen-banda', null, ['imagen' => $grupo['imagen'] ?? null, 'posicion' => 'object-[45%_62%]']); ?>
    <?php get_template_part('template-parts/components/enlace-flecha', null, ['enlace' => $grupo['enlace'] ?? null, 'clase' => 'mt-[18px]']); ?>
</section>
