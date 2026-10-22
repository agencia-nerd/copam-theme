<?php
/**
 * Template Name: Contacto
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php
    get_template_part('template-parts/pages/contacto/hero');
    get_template_part('template-parts/pages/contacto/canales');
    get_template_part('template-parts/pages/contacto/datos');
    get_template_part('template-parts/pages/contacto/formulario');
    get_template_part('template-parts/pages/contacto/buzon');
    ?>
</main>

<?php
get_footer();
