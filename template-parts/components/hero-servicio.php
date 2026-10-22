<?php
defined('ABSPATH') || exit;

/**
 * Cabecera de las páginas de servicios: migas, imagen a todo el ancho con zoom al hacer scroll, título (h1),
 * bajada, botón y la tarjeta de accesos directos (a la derecha en escritorio, debajo en móvil).
 *
 * $args:
 *  - migas          (array)   items para el componente migas
 *  - titulo         (string)  se parte por palabras, cada una en su máscara
 *  - lineas         (array)   alternativa a `titulo`: cada elemento es un bloque del h1
 *  - bajada         (string)
 *  - boton          (array)   campo Link de ACF; el texto del botón es su título
 *  - imagen         (mixed)   campo de imagen de ACF; es la imagen principal (carga eager)
 *  - posicion       (string)  clase de object-position, escrita completa en la página que la usa
 *  - accesos_titulo (string)  título de la tarjeta lateral
 *  - accesos        (array)   campos Link de ACF (texto y ancla de cada acceso)
 */
$lineas   = array_values(array_filter((array) ($args['lineas'] ?? []), static fn($l): bool => trim((string) $l) !== ''));
$titulo   = trim((string) ($args['titulo'] ?? ''));
$bajada   = (string) ($args['bajada'] ?? '');
$boton    = $args['boton'] ?? null;
$imagen   = $args['imagen'] ?? null;
$posicion = (string) ($args['posicion'] ?? 'object-center');
if (!$lineas && $titulo !== '') {
    $lineas = preg_split('/\s+/', $titulo, -1, PREG_SPLIT_NO_EMPTY);
}
?>
<section class="relative bg-white pb-[clamp(64px,5vw,96px)]">
    <?php get_template_part('template-parts/components/migas', null, ['items' => $args['migas'] ?? []]); ?>

    <div class="relative h-[max(310px,min(36vw,100svh_-_426px))] overflow-hidden bg-gris-ef" data-sr="side">
        <div class="absolute inset-x-0 top-[-14%] bottom-0 origin-[50%_40%] will-change-transform" data-parallax-zoom>
            <?= copam_theme_image($imagen, [
                'size'          => 'full',
                'class'         => 'block size-full object-cover ' . $posicion,
                'loading'       => 'eager',
                'fetchpriority' => 'high',
                'sizes'         => '100vw',
            ]) ?>
        </div>
    </div>

    <div class="grid grid-cols-[minmax(0,1fr)] items-stretch gap-x-[clamp(32px,4vw,80px)] gap-y-11 px-[clamp(20px,4.17vw,80px)] md:grid-cols-[minmax(0,1fr)_33.3vw]">
        <div class="min-w-0 pt-[clamp(28px,min(3.6vw,5svh),68px)]">
            <h1 class="m-0 flex flex-wrap gap-x-[.25em] text-[clamp(32px,3vw,58px)] leading-none font-bold tracking-[-.02em] text-ink uppercase">
                <?php foreach ($lineas as $linea) : ?>
                    <span class="block overflow-hidden pb-[.06em]"><span class="block origin-[left_bottom]" data-sr="rise"><?= esc_html((string) $linea) ?></span></span>
                <?php endforeach; ?>
            </h1>
            <?php if ($bajada !== '') : ?>
                <p class="mt-[clamp(10px,.8vw,15px)] max-w-[720px] text-[15px] leading-[1.6] text-pretty text-gris-4a" data-sr="clip"><?= esc_html($bajada) ?></p>
            <?php endif; ?>
            <div class="mt-[clamp(20px,1.8vw,34px)] flex">
                <div class="overflow-hidden rounded">
                    <?php get_template_part('template-parts/components/boton', null, [
                        'texto' => (string) ($boton['title'] ?? ''),
                        'enlace' => $boton,
                        'datos' => ['sr' => 'rise'],
                    ]); ?>
                </div>
            </div>
        </div>

        <?php get_template_part('template-parts/components/tarjeta-accesos', null, [
            'titulo' => (string) ($args['accesos_titulo'] ?? ''),
            'items'  => $args['accesos'] ?? [],
            'clase'  => 'md:-mt-[200vh]',
        ]); ?>
    </div>
</section>
