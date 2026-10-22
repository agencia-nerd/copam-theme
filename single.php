<?php
/**
 * Detalle de un comunicado (entrada del blog).
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php while (have_posts()) : the_post(); ?>
        <article class="relative bg-white">
            <?php
            get_template_part('template-parts/pages/comunicado/cabecera');
            get_template_part('template-parts/pages/comunicado/cuerpo');
            ?>
        </article>
        <?php get_template_part('template-parts/pages/comunicado/otros'); ?>
    <?php endwhile; ?>
</main>

<?php
get_footer();
