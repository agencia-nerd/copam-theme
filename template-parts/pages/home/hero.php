<?php
defined('ABSPATH') || exit;

/**
 * Portada · hero: slider a pantalla con título, descripción y dos botones.
 * Lee el grupo `home_hero` (ACF); el contenido inicial está en inc/acf/seed/home.php.
 */
$hero = get_field('home_hero') ?: [];

$titulo_lineas = array_values(array_filter([
    (string) ($hero['titulo_linea_1'] ?? ''),
    (string) ($hero['titulo_linea_2'] ?? ''),
    (string) ($hero['titulo_linea_3'] ?? ''),
], static fn(string $linea): bool => trim($linea) !== ''));
$descripcion     = (string) ($hero['descripcion'] ?? '');
$boton_tarifario = $hero['boton_tarifario'] ?? null;
$boton_servicios = $hero['boton_servicios'] ?? null;

// Punto de la foto que se mantiene visible en móvil, por posición de la slide (ajuste de diseño, no contenido).
$posicion_movil = [1 => 'max-[759px]:object-[45%_center]', 2 => 'max-[759px]:object-[47%_center]'];

$slides  = array_values(array_filter((array) ($hero['slides'] ?? []), static fn($slide): bool => !empty($slide['imagen'])));
$total   = count($slides);
$numeros = array_map(static fn(int $i): string => str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT), array_keys($slides));

$vineta = 'bg-[radial-gradient(ellipse_farthest-corner_at_50%_46%,rgba(10,22,28,0)_35%,rgba(10,22,28,.22)_70%,rgba(10,22,28,.5)_100%)]';
?>
<section class="sticky top-0 z-0 box-border origin-[50%_100%] bg-white px-[clamp(20px,4.17vw,80px)] pt-[clamp(16px,2.4vw,46px)] pb-[clamp(24px,calc(min(5vw,9svh)+4px),98px)] will-change-transform max-md:flex max-md:min-h-[calc(100svh_-_72px)] max-md:flex-col max-md:justify-center md:block" data-hero role="region" aria-roledescription="carrusel" aria-label="<?= esc_attr__('Imágenes del terminal', 'copam-theme') ?>">
    <div class="pointer-events-none absolute inset-0 z-20 bg-white opacity-0" data-hero-wash></div>

    <div class="flex h-[min(54vw,29svh)] flex-none gap-[clamp(10px,1.67vw,32px)] md:h-[clamp(250px,min(39vw,calc(100svh_-_420px)),800px)]" data-hero-media>
        <div class="relative min-w-0 flex-[2.47_1_0] overflow-hidden rounded bg-gris-ef">
            <?php foreach ($slides as $i => $slide) : ?>
                <div class="hidden first:block js:block absolute inset-0 overflow-hidden" data-hero-slide="<?= esc_attr((string) $i) ?>"<?= $i === 0 ? '' : ' aria-hidden="true"' ?>>
                    <div class="absolute inset-0">
                        <?= copam_theme_image($slide['imagen'], [
                            'size'          => 'full',
                            'class'         => 'block size-full object-cover will-change-transform ' . ($posicion_movil[$i] ?? ''),
                            'alt'           => (string) ($slide['alt'] ?? ''),
                            'sizes'         => '(max-width: 759px) 100vw, 1600px',
                            'loading'       => $i === 0 ? 'eager' : 'lazy',
                            'fetchpriority' => $i === 0 ? 'high' : '',
                        ]) ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="pointer-events-none absolute inset-0 z-[4] <?= esc_attr($vineta) ?>" aria-hidden="true"></div>

            <div class="absolute right-3 bottom-3 z-[5] flex gap-3">
                <?php // Pausa del autoplay (WCAG 2.2.2). Solo con efectos: con movimiento reducido no hay autoplay. ?>
                <div class="hidden overflow-hidden rounded js:block">
                    <button class="group grid size-12 cursor-pointer place-items-center rounded border-0 bg-ink/70 transition-colors duration-300 hover:bg-ink focus-visible:bg-brand" type="button" data-hero-pausa data-hero-rise aria-pressed="false" aria-label="<?= esc_attr__('Pausar presentación', 'copam-theme') ?>" data-label-pausar="<?= esc_attr__('Pausar presentación', 'copam-theme') ?>" data-label-reanudar="<?= esc_attr__('Reanudar presentación', 'copam-theme') ?>">
                        <svg class="block group-aria-pressed:hidden" width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M4.5 2.5v9M9.5 2.5v9" stroke="#fff" stroke-width="1.6"></path></svg>
                        <svg class="hidden group-aria-pressed:block" width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M4 2.5l7 4.5-7 4.5z" fill="#fff"></path></svg>
                    </button>
                </div>
                <div class="overflow-hidden rounded">
                    <button class="group grid h-12 w-[clamp(52px,3.65vw,70px)] cursor-pointer place-items-center rounded border-0 bg-ink transition-colors duration-300 hover:bg-brand focus-visible:bg-brand" type="button" data-hero-prev data-hero-rise aria-label="<?= esc_attr__('Imagen anterior', 'copam-theme') ?>">
                        <span class="block size-[18px] overflow-hidden" aria-hidden="true">
                            <span class="flex w-9 transition-transform duration-[550ms] ease-in-out group-hover:-translate-x-1/2 group-focus-visible:-translate-x-1/2">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M15 9H3M8 4L3 9l5 5" stroke="#fff" stroke-width="1.6"></path></svg>
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M15 9H3M8 4L3 9l5 5" stroke="#fff" stroke-width="1.6"></path></svg>
                            </span>
                        </span>
                    </button>
                </div>
                <div class="overflow-hidden rounded">
                    <button class="group grid h-12 w-[clamp(52px,3.65vw,70px)] cursor-pointer place-items-center rounded border-0 bg-ink transition-colors duration-300 hover:bg-brand focus-visible:bg-brand" type="button" data-hero-next data-hero-rise aria-label="<?= esc_attr__('Imagen siguiente', 'copam-theme') ?>">
                        <span class="block size-[18px] overflow-hidden" aria-hidden="true">
                            <span class="flex w-9 -translate-x-1/2 transition-transform duration-[550ms] ease-in-out group-hover:translate-x-0 group-focus-visible:translate-x-0">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M3 9h12M10 4l5 5-5 5" stroke="#fff" stroke-width="1.6"></path></svg>
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M3 9h12M10 4l5 5-5 5" stroke="#fff" stroke-width="1.6"></path></svg>
                            </span>
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <div class="relative hidden min-w-0 flex-[0_0_9%] overflow-hidden rounded bg-gris-ef js:block md:flex-[1_1_0]" aria-hidden="true">
            <?php foreach ($slides as $i => $slide) : ?>
                <div class="hidden js:block absolute inset-0 overflow-hidden" data-hero-side="<?= esc_attr((string) $i) ?>">
                    <div class="absolute inset-0 grayscale">
                        <?= copam_theme_image($slide['imagen'], ['size' => 'large', 'class' => 'block size-full object-cover object-[left_center] will-change-transform', 'alt' => '', 'sizes' => '30vw']) ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="pointer-events-none absolute inset-0 z-[4] <?= esc_attr($vineta) ?>"></div>
        </div>
    </div>

    <?php // Contador y progreso en móvil: en horizontal, debajo del slider. ?>
    <div class="mt-3.5 flex items-center gap-3.5 text-xs tracking-[.06em] md:hidden">
        <span class="block h-[1.2em] overflow-hidden leading-[1.2em]" aria-hidden="true">
            <span class="block transition-transform duration-[900ms] ease-in-out" data-hero-counter>
                <?php foreach ($numeros as $n) : ?><span class="block"><?= esc_html($n) ?></span><?php endforeach; ?>
            </span>
        </span>
        <span class="relative h-px flex-1 overflow-hidden bg-gris-e3" aria-hidden="true"><span class="absolute inset-0 origin-left scale-x-0 bg-ink" data-hero-progress="x"></span></span>
        <span class="text-gris-b5" aria-hidden="true"><?= esc_html(str_pad((string) $total, 2, '0', STR_PAD_LEFT)) ?></span>
    </div>

    <div class="mt-[clamp(20px,2.8vw,50px)] flex flex-wrap items-start gap-y-5 min-[1200px]:flex-nowrap">
        <h1 class="mr-10 min-w-0 flex-[1_1_auto] text-[clamp(32px,min(4.2vw,8.6svh),72px)] leading-[.86] font-normal tracking-[-.025em] text-ink uppercase" data-hero-h1>
            <?php foreach ($titulo_lineas as $n => $linea) :
                $palabras = preg_split('/\s+/', trim($linea), -1, PREG_SPLIT_NO_EMPTY);
                $clase = [
                    0 => 'flex flex-wrap gap-x-[.25em]',
                    1 => 'flex flex-wrap gap-x-[.25em] font-extrabold',
                    2 => 'mt-[.5em] flex flex-wrap gap-x-[.25em] text-[.52em] tracking-[-.01em]',
                ][$n];
                ?>
                <span class="<?= esc_attr($clase) ?>" data-h1l>
                    <?php foreach ($palabras as $palabra) : ?>
                        <span class="block overflow-hidden pb-[.02em]"><span class="block origin-[left_bottom]" data-hero-rise><?= esc_html($palabra) ?></span></span>
                    <?php endforeach; ?>
                </span>
            <?php endforeach; ?>
        </h1>

        <div class="min-w-0 flex-[0_1_496px]">
            <p class="mb-[clamp(16px,1.6vw,30px)] text-[17px] leading-[1.42] text-pretty text-gris-3a" data-hero-clip><?= copam_theme_highlight($descripcion) ?></p>
            <div class="flex flex-wrap gap-4">
                <div class="flex-[1_1_220px] overflow-hidden rounded">
                    <?php get_template_part('template-parts/components/boton', null, ['texto' => (string) ($boton_tarifario['title'] ?? ''), 'enlace' => $boton_tarifario, 'datos' => ['hero-rise' => '']]); ?>
                </div>
                <div class="flex-[1_1_220px] overflow-hidden rounded">
                    <?php get_template_part('template-parts/components/boton', null, ['texto' => (string) ($boton_servicios['title'] ?? ''), 'enlace' => $boton_servicios, 'variante' => 'oscuro', 'datos' => ['hero-rise' => '']]); ?>
                </div>
            </div>
        </div>

        <?php // Contador y progreso en escritorio: vertical, a la derecha. ?>
        <div class="ml-[clamp(24px,6vw,174px)] hidden flex-none flex-col items-center gap-2.5 text-xs tracking-[.06em] md:flex" aria-hidden="true">
            <span class="block h-[1.2em] overflow-hidden leading-[1.2em]">
                <span class="block transition-transform duration-[900ms] ease-in-out" data-hero-counter>
                    <?php foreach ($numeros as $n) : ?><span class="block"><?= esc_html($n) ?></span><?php endforeach; ?>
                </span>
            </span>
            <span class="relative h-[clamp(120px,8vw,155px)] w-px overflow-hidden bg-gris-e3"><span class="absolute inset-0 origin-top scale-y-0 bg-ink" data-hero-progress="y"></span></span>
            <span class="text-gris-b5"><?= esc_html(str_pad((string) $total, 2, '0', STR_PAD_LEFT)) ?></span>
        </div>
    </div>

    <p class="sr-only" role="status" aria-live="polite" data-hero-status></p>
</section>
