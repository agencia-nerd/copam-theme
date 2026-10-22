<?php
defined('ABSPATH') || exit;

/**
 * Canal de hostigamiento sexual · enviar un reporte: título y el form de wp-form
 * (template-parts/forms/reporte-hostigamiento.php). El mensaje de éxito (`mensaje_exito`) lo usa la definición del form.
 * Lee el grupo `canal_hostigamiento_sexual_reporte` (ACF).
 */
$grupo = get_field('canal_hostigamiento_sexual_reporte') ?: [];
?>
<section class="relative z-[1] bg-gris-f9 px-[clamp(20px,4.17vw,80px)] pt-[clamp(64px,5.6vw,108px)] pb-[clamp(72px,6vw,116px)]" id="reporte">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    <?php get_template_part('template-parts/forms/reporte-hostigamiento', null, ['nota_envio' => (string) ($grupo['nota_envio'] ?? '')]); ?>
</section>
