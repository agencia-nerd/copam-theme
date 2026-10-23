<?php
defined('ABSPATH') || exit;

/**
 * Cabecera de las páginas internas: migas, título (h1), bajada e imagen panorámica con parallax.
 *
 * $args:
 *  - migas    (array)   items para el componente migas
 *  - lineas   (array)   líneas del h1 (cada una en su máscara); si falta, `titulo` se parte por palabras
 *  - titulo   (string)  título completo cuando no se pasan `lineas`
 *  - bajada   (string)
 *  - imagen   (mixed)   campo de imagen de ACF; es la imagen principal (carga eager)
 *  - posicion (string)  clase de object-position, escrita completa en la página que la usa (p. ej. 'object-[50%_55%]')
 */
$lineas   = array_values(array_filter((array) ($args['lineas'] ?? []), static fn($l): bool => trim((string) $l) !== ''));
$titulo   = trim((string) ($args['titulo'] ?? ''));
$bajada   = (string) ($args['bajada'] ?? '');
$imagen   = $args['imagen'] ?? null;
$posicion = (string) ($args['posicion'] ?? 'object-center');
// Sin título en el campo, el h1 usa el de la página (nunca queda vacío).
if (!$lineas && $titulo === '') {
    $titulo = trim(html_entity_decode(get_the_title(), ENT_QUOTES));
}
if (!$lineas && $titulo !== '') {
    $lineas = preg_split('/\s+/', $titulo, -1, PREG_SPLIT_NO_EMPTY);
}
?>
<section class="relative bg-white">
    <?php get_template_part('template-parts/components/migas', null, ['items' => $args['migas'] ?? []]); ?>

    <div class="px-[clamp(20px,4.17vw,80px)] pt-[clamp(56px,6vw,116px)] text-center">
        <h1 class="m-0 flex flex-wrap justify-center gap-x-[.25em] text-[clamp(34px,3.25vw,63px)] leading-none font-bold tracking-[-.02em] text-ink uppercase">
            <?php foreach ($lineas as $linea) : ?>
                <span class="block overflow-hidden pb-[.06em]"><span class="block origin-[left_bottom]" data-sr="rise"><?= esc_html((string) $linea) ?></span></span>
            <?php endforeach; ?>
        </h1>
        <?php if ($bajada !== '') : ?>
            <p class="mx-auto mt-[clamp(14px,1.2vw,22px)] max-w-[700px] text-[15px] leading-[1.6] text-pretty text-gris-4a" data-sr="clip"><?= esc_html($bajada) ?></p>
        <?php endif; ?>
    </div>

    <div class="px-[clamp(20px,4.17vw,80px)] pt-[clamp(44px,4.2vw,80px)]">
        <div class="relative h-[clamp(310px,min(43vw,100svh_-_280px),820px)] overflow-hidden rounded bg-gris-ef" data-sr="side" data-sr-delay="200" data-parallax-root>
            <div class="absolute inset-x-0 top-[-14%] bottom-0 will-change-transform" data-parallax="60">
                <?= copam_theme_image($imagen, [
                    'size'          => 'full',
                    'class'         => 'block size-full object-cover ' . $posicion,
                    'loading'       => 'eager',
                    'fetchpriority' => 'high',
                    'sizes'         => '100vw',
                ]) ?>
            </div>
        </div>
    </div>
</section>
