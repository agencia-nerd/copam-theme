<?php
/**
 * Listado de comunicados: la página de entradas (Ajustes › Lectura; la fija inc/crear-comunicados.php).
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php get_template_part('template-parts/pages/comunicados/archivo'); ?>
</main>

<?php
get_footer();
