<?php
/**
 * Template Name: Transparencia
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php
    get_template_part('template-parts/pages/transparencia/hero');
    get_template_part('template-parts/pages/transparencia/informacion');
    get_template_part('template-parts/pages/transparencia/solicitud');
    ?>
</main>

<?php
get_footer();
