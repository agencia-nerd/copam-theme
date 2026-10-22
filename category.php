<?php
/**
 * Comunicados de una categoría: el mismo listado que home.php, con el título del término.
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php get_template_part('template-parts/pages/comunicados/archivo'); ?>
</main>

<?php
get_footer();
