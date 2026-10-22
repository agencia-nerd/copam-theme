<?php
/**
 * Template Name: Política de cookies
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php
    get_template_part('template-parts/pages/cookies/hero');
    get_template_part('template-parts/pages/cookies/contenido');
    ?>
</main>

<?php
get_footer();
