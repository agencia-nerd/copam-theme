<?php
defined('ABSPATH') || exit;

/**
 * Contacto · formulario de contacto: título y el form de wp-form (template-parts/forms/contacto.php).
 * Lee el grupo `contacto_formulario` (ACF).
 */
$grupo = get_field('contacto_formulario') ?: [];
?>
<section class="relative z-[1] bg-gris-f4 px-[clamp(20px,4.17vw,80px)] pt-[clamp(64px,5.6vw,108px)] pb-[clamp(72px,6vw,116px)]" id="formulario">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    <?php get_template_part('template-parts/forms/contacto', null, ['nota_envio' => (string) ($grupo['nota_envio'] ?? '')]); ?>
</section>
