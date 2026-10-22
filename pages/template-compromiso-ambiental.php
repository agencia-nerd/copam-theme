<?php
/**
 * Template Name: Compromiso Ambiental
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php get_template_part('template-parts/pages/compromiso-ambiental/hero'); ?>

    <section class="relative z-[1] bg-white px-[clamp(20px,4.17vw,80px)] pt-[clamp(56px,5.6vw,108px)] pb-[clamp(88px,7.3vw,140px)]">
        <div class="grid grid-cols-[minmax(0,1fr)] items-start gap-x-[clamp(32px,4vw,80px)] lg:grid-cols-[clamp(220px,17vw,320px)_minmax(0,1fr)]">
            <?php get_template_part('template-parts/pages/compromiso-ambiental/indice'); ?>
            <div class="flex min-w-0 flex-col gap-[clamp(64px,5.6vw,108px)]">
                <?php
                get_template_part('template-parts/pages/compromiso-ambiental/compromiso');
                get_template_part('template-parts/pages/compromiso-ambiental/politica');
                get_template_part('template-parts/pages/compromiso-ambiental/operacion');
                get_template_part('template-parts/pages/compromiso-ambiental/instrumentos');
                get_template_part('template-parts/pages/compromiso-ambiental/cumplimiento');
                get_template_part('template-parts/pages/compromiso-ambiental/galeria');
                get_template_part('template-parts/pages/compromiso-ambiental/acceso');
                ?>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
