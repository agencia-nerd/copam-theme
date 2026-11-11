<?php
defined('ABSPATH') || exit;

/**
 * Canal de hostigamiento sexual · enviar un reporte: título y el form de wp-form
 * (template-parts/forms/reporte-hostigamiento.php). Sin campos ACF: título y nota de envío son fijos; el mensaje de
 * éxito está en la definición del form (copam_theme_reporte_exito()). El título se repite en los accesos del hero.
 */
?>
<section class="relative z-[1] bg-gris-f9 px-[clamp(20px,4.17vw,80px)] pt-[clamp(64px,5.6vw,108px)] pb-[clamp(72px,6vw,116px)]" id="reporte">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => __('Enviar un reporte', 'copam-theme')]); ?>
    <?php get_template_part('template-parts/forms/reporte-hostigamiento', null, ['nota_envio' => __('Llega únicamente al Delegado de prevención y sanción del hostigamiento sexual:', 'copam-theme')]); ?>
</section>
