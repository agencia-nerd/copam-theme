<?php
defined('ABSPATH') || exit;

/**
 * Transparencia · solicitud de acceso a la información: título y el form de wp-form
 * (template-parts/forms/solicitud-informacion.php), que imprime la nota y el correo de Ajustes del sitio.
 * Lee el grupo `transparencia_solicitud` (ACF).
 */
$grupo = get_field('transparencia_solicitud') ?: [];
?>
<section class="relative z-[1] bg-gris-f4 px-[clamp(20px,4.17vw,80px)] pt-[clamp(64px,5.6vw,108px)] pb-[clamp(40px,3.2vw,60px)]" id="solicitud">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    <?php get_template_part('template-parts/forms/solicitud-informacion', null, ['nota_envio' => (string) ($grupo['nota_envio'] ?? '')]); ?>
</section>
