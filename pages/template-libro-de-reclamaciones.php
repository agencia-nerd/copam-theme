<?php
/**
 * Template Name: Libro de Reclamaciones
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php
    get_template_part('template-parts/pages/libro-de-reclamaciones/hero');
    get_template_part('template-parts/pages/libro-de-reclamaciones/formulario');
    ?>
</main>

<?php
get_footer();
