<?php
defined('ABSPATH') || exit;

/**
 * Tarjeta blanca de una prestación: título en mayúsculas y descripción. Las columnas las decide el contenedor.
 *
 * $args:
 *  - titulo      (string, requerido)
 *  - descripcion (string)
 *  - nivel       (int)    nivel del encabezado (3 por defecto)
 *  - boton       (array)  campo Link de ACF, opcional
 *  - retardo     (int)    milisegundos de espera de la entrada
 */
$titulo      = (string) ($args['titulo'] ?? '');
$descripcion = (string) ($args['descripcion'] ?? '');
$nivel       = max(2, min(6, (int) ($args['nivel'] ?? 3)));
$boton       = $args['boton'] ?? null;
$retardo     = (int) ($args['retardo'] ?? 0);
if ($titulo === '') {
    return;
}
$tag = 'h' . $nivel;
?>
<article class="flex min-h-[clamp(170px,9.7vw,186px)] flex-col items-start rounded bg-white px-[clamp(24px,1.67vw,32px)] py-[clamp(28px,2.1vw,40px)]" data-sr="card" data-sr-delay="<?= esc_attr((string) $retardo) ?>">
    <<?= $tag ?> class="m-0 text-[clamp(17px,.95vw,18px)] leading-[1.3] font-bold tracking-[.01em] text-ink uppercase"><?= esc_html($titulo) ?></<?= $tag ?>>
    <?php if ($descripcion !== '') : ?>
        <p class="mt-3 mb-0 text-[15px] leading-normal text-pretty text-gris-5a"><?= esc_html($descripcion) ?></p>
    <?php endif; ?>
    <?php if (copam_theme_link_data($boton)) : ?>
        <?php get_template_part('template-parts/components/enlace-flecha', null, ['enlace' => $boton, 'clase' => 'mt-auto pt-5']); ?>
    <?php endif; ?>
</article>
