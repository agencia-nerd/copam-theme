<?php
defined('ABSPATH') || exit;

/**
 * Bloque de acceso: tarjeta oscura con título, texto y botón, junto a una imagen.
 *
 * $args:
 *  - titulo      (string, requerido)
 *  - descripcion (string)
 *  - boton       (array)   campo Link de ACF; el texto del botón es su título
 *  - nota        (string)  línea pequeña bajo el botón
 *  - imagen      (mixed)   campo de imagen de ACF (se imprime con copam_theme_image)
 *  - alt         (string)  alt de la imagen; vacío usa el del archivo
 *  - variante    (string)  'fila' (por defecto, ancho completo) | 'columna' (al pie de una columna, 320px de alto)
 *  - lineas      (int)     líneas visibles de la descripción: 2 (por defecto) | 4
 */
$titulo      = (string) ($args['titulo'] ?? '');
$descripcion = (string) ($args['descripcion'] ?? '');
$boton       = $args['boton'] ?? null;
$nota        = (string) ($args['nota'] ?? '');
$imagen      = $args['imagen'] ?? null;
$alt         = $args['alt'] ?? null;
$columna     = ($args['variante'] ?? 'fila') === 'columna';
$recorte     = (int) ($args['lineas'] ?? 2) === 4 ? 'line-clamp-4' : 'line-clamp-2';
if ($titulo === '') {
    return;
}

$envoltura = $columna ? '' : 'px-[clamp(20px,4.17vw,80px)] py-16';
$alto      = $columna ? 'lg:min-h-[320px]' : 'lg:min-h-[max(380px,22.9vw)]';
$tarjeta   = $columna
    ? 'p-7 min-[760px]:p-10 lg:flex-[0_0_420px]'
    : 'p-7 min-[760px]:px-[clamp(24px,2.1vw,40px)] min-[760px]:py-[clamp(40px,3.4vw,66px)] lg:flex-[0_0_calc((100%_-_clamp(10px,.83vw,16px))*.3786)]';
$titulo_cl = $columna ? 'text-[28px]' : 'text-[clamp(28px,2.25vw,43px)]';
?>
<div class="<?= esc_attr($envoltura) ?>">
    <div class="flex flex-col gap-[clamp(10px,.83vw,16px)] lg:flex-row <?= esc_attr($alto) ?>">
        <div class="box-border flex max-w-full min-w-0 flex-col items-start justify-center rounded-lg bg-ink <?= esc_attr($tarjeta) ?>" data-sr="card">
            <h2 class="m-0 leading-[1.1] font-semibold tracking-[-.005em] text-balance text-white uppercase <?= esc_attr($titulo_cl) ?>"><?= esc_html($titulo) ?></h2>
            <?php if ($descripcion !== '') : ?>
                <p class="mt-4 <?= esc_attr($recorte) ?> text-[15px] leading-[1.6] text-gris-d2"><?= esc_html($descripcion) ?></p>
            <?php endif; ?>
            <div class="mt-8 overflow-hidden rounded">
                <?php get_template_part('template-parts/components/boton', null, ['texto' => (string) ($boton['title'] ?? ''), 'enlace' => $boton]); ?>
            </div>
            <?php if ($nota !== '') : ?>
                <p class="mt-3.5 text-[13px] leading-normal text-gris-d2"><?= esc_html($nota) ?></p>
            <?php endif; ?>
        </div>
        <div class="relative min-h-[56vw] min-w-0 flex-[1_1_0] overflow-hidden rounded-md bg-gris-e4 lg:min-h-0" data-sr="card" data-sr-delay="140">
            <?= copam_theme_image($imagen, ['size' => 'large', 'class' => 'absolute inset-0 block size-full object-cover', 'alt' => $alt, 'sizes' => '(max-width: 999px) 100vw, 60vw']) ?>
        </div>
    </div>
</div>
