<?php
defined('ABSPATH') || exit;

/**
 * Cierre de las páginas de servicios: tarjeta oscura con título (entra palabra por palabra), bajada y botón,
 * junto a una imagen recortada. A dos columnas desde 1000 px; apilado en móvil.
 *
 * $args:
 *  - titulo   (string, requerido)  h2
 *  - bajada   (string)
 *  - boton    (array)   campo Link de ACF; el texto del botón es su título
 *  - imagen   (mixed)   campo de imagen de ACF (carga lazy)
 *  - posicion (string)  clase de object-position, escrita completa en la página que la usa
 */
$titulo   = trim((string) ($args['titulo'] ?? ''));
$bajada   = (string) ($args['bajada'] ?? '');
$boton    = $args['boton'] ?? null;
$imagen   = $args['imagen'] ?? null;
$posicion = (string) ($args['posicion'] ?? 'object-center');
if ($titulo === '') {
    return;
}
$palabras = preg_split('/\s+/', $titulo, -1, PREG_SPLIT_NO_EMPTY);
?>
<section class="relative z-[1] bg-gris-f4 px-[clamp(20px,4.17vw,80px)] pb-[clamp(94px,7.71vw,148px)]">
    <div class="grid grid-cols-[minmax(0,1fr)] gap-[clamp(10px,.83vw,16px)] lg:grid-cols-[minmax(0,886fr)_minmax(0,1454fr)]">
        <div class="flex min-w-0 flex-col items-start justify-center rounded-md bg-ink px-[clamp(24px,2.1vw,40px)] py-[clamp(40px,3.4vw,66px)]" data-sr="wipe">
            <h2 class="m-0 flex flex-wrap gap-x-[.25em] text-[clamp(28px,2.25vw,43px)] leading-[1.08] font-semibold tracking-[-.005em] text-white uppercase">
                <?php foreach ($palabras as $i => $palabra) : ?>
                    <span class="block overflow-hidden pb-[.06em]"><span class="block" data-sr="rise" data-sr-delay="<?= esc_attr((string) (220 + $i * 45)) ?>"><?= esc_html($palabra) ?></span></span>
                <?php endforeach; ?>
            </h2>
            <?php if ($bajada !== '') : ?>
                <p class="mt-[clamp(18px,1.4vw,26px)] mb-0 text-[15px] leading-normal text-pretty text-gris-d2" data-sr="clip" data-sr-delay="560"><?= esc_html($bajada) ?></p>
            <?php endif; ?>
            <div class="mt-[clamp(26px,1.95vw,37px)] overflow-hidden rounded">
                <?php get_template_part('template-parts/components/boton', null, [
                    'texto'  => (string) ($boton['title'] ?? ''),
                    'enlace' => $boton,
                    'datos'  => ['sr' => 'rise', 'sr-delay' => '660'],
                ]); ?>
            </div>
        </div>
        <div class="relative min-h-[56vw] min-w-0 overflow-hidden rounded-md bg-gris-e4 lg:min-h-[max(380px,22.9vw)]" data-sr="card" data-sr-delay="140">
            <?= copam_theme_image($imagen, [
                'size'    => 'large',
                'class'   => 'absolute inset-0 block size-full object-cover ' . $posicion,
                'loading' => 'lazy',
                'sizes'   => '(max-width: 999px) 100vw, 62vw',
            ]) ?>
        </div>
    </div>
</section>
