<?php
defined('ABSPATH') || exit;

/**
 * Compromiso Ambiental · nuestro compromiso: título, párrafo e imagen en banda.
 * Lee el grupo `compromiso_ambiental_compromiso` (ACF).
 */
$grupo = get_field('compromiso_ambiental_compromiso') ?: [];
?>
<section id="compromiso">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    <p class="mt-[clamp(20px,1.6vw,30px)] text-[clamp(17px,1.1vw,21px)] leading-[1.65] text-pretty text-gris-3a" data-sr="clip" data-sr-delay="200"><?= esc_html((string) ($grupo['texto'] ?? '')) ?></p>
    <?php get_template_part('template-parts/components/imagen-banda', null, ['imagen' => $grupo['imagen'] ?? null]); ?>
</section>
