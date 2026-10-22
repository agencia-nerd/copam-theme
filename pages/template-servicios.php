<?php
/**
 * Template Name: Servicios
 *
 * Página padre de los servicios (/servicios/). No tiene diseño propio: inc/redirecciones.php la redirige a su
 * primera página hija. Esta vista solo se ve si la página aún no tiene hijas publicadas.
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php while (have_posts()) : the_post(); ?>
        <div class="px-[clamp(20px,4.17vw,80px)] py-[clamp(56px,6vw,116px)]">
            <h1 class="m-0 text-[clamp(34px,3.25vw,63px)] leading-none font-bold tracking-[-.02em] text-ink uppercase"><?= esc_html(get_the_title()) ?></h1>
        </div>
    <?php endwhile; ?>
</main>

<?php
get_footer();
