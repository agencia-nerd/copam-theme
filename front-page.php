<?php

/**
 * Portada del sitio. WordPress la usa sola para la página fijada como inicio
 * (no tiene Template Name ni se elige en el admin).
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php
    get_template_part('template-parts/pages/home/hero');
    get_template_part('template-parts/pages/home/reglamentos');
    get_template_part('template-parts/pages/home/conoce');
    get_template_part('template-parts/pages/home/conectividad');
    get_template_part('template-parts/pages/home/carga');
    get_template_part('template-parts/pages/home/caso-destacado');
    get_template_part('template-parts/pages/home/servicios');
    get_template_part('template-parts/pages/home/desarrollo-futuro');
    get_template_part('template-parts/pages/home/comunicados');
    get_template_part('template-parts/pages/home/cta');
    ?>
</main>

<?php
get_footer();
