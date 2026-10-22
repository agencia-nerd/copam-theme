<?php
/**
 * Template Name: Depósito Temporal
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content">
    <?php // Pila: el hero y las secciones quedan fijos y se achican mientras la FAQ sube sobre ellos (pila.js). ?>
    <div class="relative z-0 origin-[50%_100%] bg-white js:sticky js:top-0" data-pila>
        <?php
        get_template_part('template-parts/pages/deposito-temporal/hero');
        get_template_part('template-parts/pages/deposito-temporal/atendemos');
        get_template_part('template-parts/pages/deposito-temporal/tarifas');
        get_template_part('template-parts/pages/deposito-temporal/documentos');
        get_template_part('template-parts/pages/deposito-temporal/quejas-reclamos');
        get_template_part('template-parts/pages/deposito-temporal/seguimiento');
        ?>
        <div class="pointer-events-none absolute inset-0 z-20 bg-white opacity-0" data-pila-velo aria-hidden="true"></div>
    </div>
    <div class="hidden h-[45vh] js:block" aria-hidden="true"></div>

    <?php
    get_template_part('template-parts/pages/deposito-temporal/faq');
    get_template_part('template-parts/pages/deposito-temporal/cta');
    ?>
</main>

<?php
get_footer();
