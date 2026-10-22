<?php
/**
 * Template Name: Nosotros
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php get_template_part('template-parts/pages/nosotros/hero'); ?>

    <section class="relative z-[1] bg-white px-[clamp(20px,4.17vw,80px)] pt-[clamp(56px,5.6vw,108px)] pb-[clamp(88px,7.3vw,140px)]">
        <div class="grid grid-cols-[minmax(0,1fr)] items-start gap-x-[clamp(32px,4vw,80px)] lg:grid-cols-[clamp(220px,17vw,320px)_minmax(0,1fr)]">
            <?php get_template_part('template-parts/pages/nosotros/indice'); ?>
            <div class="flex min-w-0 flex-col gap-[clamp(64px,5.6vw,108px)]">
                <?php
                get_template_part('template-parts/pages/nosotros/mision');
                get_template_part('template-parts/pages/nosotros/vision');
                get_template_part('template-parts/pages/nosotros/concesion');
                get_template_part('template-parts/pages/nosotros/sistema');
                get_template_part('template-parts/pages/nosotros/operamos');
                get_template_part('template-parts/pages/nosotros/acceso');
                ?>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
