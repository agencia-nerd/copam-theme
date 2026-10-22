<?php
/**
 * Template Name: Normativa OSITRAN
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php
    get_template_part('template-parts/pages/normativa-ositran/hero');
    get_template_part('template-parts/pages/normativa-ositran/normativa');
    get_template_part('template-parts/pages/normativa-ositran/contrato');
    get_template_part('template-parts/pages/normativa-ositran/documentos');
    ?>
</main>

<?php
get_footer();
