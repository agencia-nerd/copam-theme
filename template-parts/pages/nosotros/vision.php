<?php
defined('ABSPATH') || exit;

/**
 * Nosotros · visión: título con línea y un párrafo.
 * Lee el grupo `nosotros_vision` (ACF).
 */
$grupo = get_field('nosotros_vision') ?: [];
?>
<section id="vision">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    <p class="mt-[clamp(20px,1.6vw,30px)] text-[clamp(17px,1.1vw,21px)] leading-[1.65] text-pretty text-gris-3a" data-sr="clip" data-sr-delay="200"><?= esc_html((string) ($grupo['texto'] ?? '')) ?></p>
</section>
