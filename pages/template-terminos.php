<?php
/**
 * Template Name: Términos y condiciones
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php get_template_part('template-parts/pages/terminos/hero'); ?>

    <section class="relative z-[1] bg-white px-[clamp(20px,4.17vw,80px)] pb-[clamp(88px,7.3vw,140px)]">
        <div class="grid grid-cols-[minmax(0,1fr)] items-start gap-x-[clamp(32px,4vw,80px)] gap-y-[clamp(28px,4vw,44px)] lg:grid-cols-[clamp(220px,17vw,320px)_minmax(0,1fr)]">
            <?php
            get_template_part('template-parts/pages/terminos/indice');
            get_template_part('template-parts/pages/terminos/contenido');
            ?>
        </div>
    </section>
</main>

<?php
get_footer();
