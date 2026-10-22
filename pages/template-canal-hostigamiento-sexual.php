<?php
/**
 * Template Name: Canal de hostigamiento sexual
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php
    get_template_part('template-parts/pages/canal-hostigamiento-sexual/hero');
    get_template_part('template-parts/pages/canal-hostigamiento-sexual/como-funciona');
    get_template_part('template-parts/pages/canal-hostigamiento-sexual/reporte');
    get_template_part('template-parts/pages/canal-hostigamiento-sexual/politica');
    get_template_part('template-parts/pages/canal-hostigamiento-sexual/otros-canales');
    ?>
</main>

<?php
get_footer();
