<?php
/**
 * Template Name: Política de privacidad
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php
    get_template_part('template-parts/pages/privacidad/hero');
    get_template_part('template-parts/pages/privacidad/contenido');
    ?>
</main>

<?php
get_footer();
