<?php
defined('ABSPATH') || exit;

/**
 * Título de sección con una línea punteada debajo; entra subiendo y la línea se dibuja.
 *
 * $args:
 *  - titulo (string, requerido)
 *  - nivel  (int)  nivel del encabezado (2 por defecto)
 */
$titulo = (string) ($args['titulo'] ?? '');
$nivel  = max(1, min(6, (int) ($args['nivel'] ?? 2)));
if ($titulo === '') {
    return;
}
$tag = 'h' . $nivel;
?>
<div class="flex flex-col items-start gap-[clamp(10px,.83vw,16px)]">
    <<?= $tag ?> class="m-0 overflow-hidden pb-[.08em]"><span class="block text-[clamp(26px,1.8vw,34px)] leading-[1.15] font-semibold tracking-[-.01em] text-ink" data-sr="rise"><?= esc_html($titulo) ?></span></<?= $tag ?>>
    <span class="block h-px w-[175px] bg-[repeating-linear-gradient(90deg,var(--color-gris-bd)_0_4px,transparent_4px_8px)]" data-sr="lineX" data-sr-delay="150" aria-hidden="true"></span>
</div>
