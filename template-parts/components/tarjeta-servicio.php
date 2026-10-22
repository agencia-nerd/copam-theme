<?php
defined('ABSPATH') || exit;

/**
 * Tarjeta blanca de una prestación: título en mayúsculas y descripción. Las columnas las decide el contenedor.
 *
 * $args:
 *  - titulo      (string, requerido)
 *  - descripcion (string)
 *  - nivel       (int)    nivel del encabezado (3 por defecto)
 *  - boton       (array)  campo Link de ACF, opcional (enlace con flecha; en 'compacta', botón verde chico)
 *  - tamano      (string) 'normal' (por defecto) | 'compacta' (Depósito Temporal: menos alto y texto gris medio)
 *  - retardo     (int)    milisegundos de espera de la entrada
 */
$titulo      = (string) ($args['titulo'] ?? '');
$descripcion = (string) ($args['descripcion'] ?? '');
$nivel       = max(2, min(6, (int) ($args['nivel'] ?? 3)));
$boton       = $args['boton'] ?? null;
$retardo     = (int) ($args['retardo'] ?? 0);
$compacta    = ($args['tamano'] ?? 'normal') === 'compacta';
if ($titulo === '') {
    return;
}
$tag = 'h' . $nivel;
$caja = $compacta
    ? 'min-h-[clamp(150px,9vw,172px)] min-w-0 px-[clamp(22px,1.7vw,32px)] py-[clamp(24px,1.9vw,36px)]'
    : 'min-h-[clamp(170px,9.7vw,186px)] px-[clamp(24px,1.67vw,32px)] py-[clamp(28px,2.1vw,40px)]';
$boton_data = copam_theme_link_data($boton);
?>
<article class="flex flex-col items-start rounded bg-white <?= esc_attr($caja) ?>" data-sr="card" data-sr-delay="<?= esc_attr((string) $retardo) ?>">
    <<?= $tag ?> class="m-0 leading-[1.3] font-bold tracking-[.01em] text-ink uppercase <?= $compacta ? 'text-[clamp(16px,.9vw,17px)]' : 'text-[clamp(17px,.95vw,18px)]' ?>"><?= esc_html($titulo) ?></<?= $tag ?>>
    <?php if ($descripcion !== '') : ?>
        <p class="mt-3 mb-0 text-[15px] text-pretty <?= $compacta ? 'leading-[1.55] whitespace-pre-line text-ink-muted' : 'leading-normal text-gris-5a' ?>"><?= esc_html($descripcion) ?></p>
    <?php endif; ?>
    <?php if ($boton_data && $compacta) : ?>
        <div class="mt-auto pt-[clamp(22px,1.7vw,32px)]">
            <?php get_template_part('template-parts/components/boton', null, [
                'texto'  => (string) ($boton_data['title'] ?? ''),
                'enlace' => $boton,
                'flecha' => true,
                'tamano' => 'chico',
            ]); ?>
        </div>
    <?php elseif ($boton_data) : ?>
        <?php get_template_part('template-parts/components/enlace-flecha', null, ['enlace' => $boton, 'clase' => 'mt-auto pt-5']); ?>
    <?php endif; ?>
</article>
