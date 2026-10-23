<?php
/**
 * Página no encontrada: cabecera de página legal (migas y h1), un texto breve, el botón que abre el buscador del
 * header (data-buscar-abrir, src/js/modules/header.js) y accesos a Inicio, Comunicados y Contacto.
 * Sin spec ni campos ACF: los textos son fijos y traducibles.
 */

defined('ABSPATH') || exit;

$titulo   = __('Página no encontrada', 'copam-theme');
$contacto = copam_theme_hoja_pagina('pages/template-contacto.php');

get_header();
?>

<main id="main-content">
    <?php get_template_part('template-parts/components/hero-legal', null, [
        'migas'         => [
            ['texto' => __('Inicio', 'copam-theme'), 'url' => home_url('/')],
            ['texto' => $titulo],
        ],
        'titulo'        => $titulo,
        'actualizacion' => __('Es posible que el enlace esté mal escrito o que la página se haya movido.', 'copam-theme'),
    ]); ?>

    <section class="relative -mt-[clamp(56px,6vw,120px)] bg-white px-[clamp(20px,4.17vw,80px)] pb-[clamp(96px,10vw,190px)]">
        <p class="m-0 max-w-[620px] text-[clamp(16px,.95vw,18px)] leading-[1.6] text-pretty text-gris-3a" data-sr="clip">
            <?= esc_html__('Busca lo que necesitas en todo el sitio o vuelve a una de las secciones principales.', 'copam-theme') ?>
        </p>

        <div class="mt-[clamp(28px,2.4vw,46px)] flex flex-wrap items-center gap-4">
            <div class="overflow-hidden rounded">
                <button class="group flex h-[52px] cursor-pointer items-center gap-3 rounded border-0 bg-ink px-6 text-[clamp(16px,.95vw,18px)] font-medium tracking-[.02em] text-white uppercase transition-colors duration-[350ms] hover:bg-gris-1a" type="button" data-buscar-abrir aria-expanded="false" aria-controls="buscador">
                    <svg class="block flex-none" width="18" height="18" viewBox="0 0 20 20" fill="none" aria-hidden="true"><circle cx="8.5" cy="8.5" r="6" stroke="currentColor" stroke-width="1.6"></circle><path d="M13 13l5 5" stroke="currentColor" stroke-width="1.6"></path></svg>
                    <?= esc_html__('Buscar en el sitio', 'copam-theme') ?>
                </button>
            </div>
            <?php get_template_part('template-parts/components/boton', null, [
                'texto'  => __('Ir al inicio', 'copam-theme'),
                'enlace' => home_url('/'),
                'flecha' => true,
            ]); ?>
        </div>

        <div class="mt-[clamp(28px,2.4vw,46px)] flex flex-wrap gap-x-8 gap-y-3">
            <?php get_template_part('template-parts/components/enlace-flecha', null, [
                'texto'  => __('Comunicados y avisos', 'copam-theme'),
                'enlace' => copam_theme_comunicados_url(),
            ]); ?>
            <?php if ($contacto) :
                get_template_part('template-parts/components/enlace-flecha', null, [
                    'texto'  => __('Contacto', 'copam-theme'),
                    'enlace' => get_permalink($contacto),
                ]);
            endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();
