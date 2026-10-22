<?php
defined('ABSPATH') || exit;

/**
 * Comunicado. Dos variantes:
 *  - `fila` (portada): categoría, título, fecha y flecha en una fila ancha.
 *  - `tarjeta` (listado y relacionados del detalle): celda de la rejilla `.rejilla-comunicados`, que pone las líneas.
 * Los datos de una entrada salen de copam_theme_comunicado($post).
 *
 * $args:
 *  - titulo    (string, requerido)
 *  - fecha     (string)  ya formateada, p. ej. "18 jul 2026"
 *  - categoria (string)  Operativo | Noticias | Mantenimiento (otra: gris)
 *  - url       (string, requerido)
 *  - variante  (string)  fila (por defecto) | tarjeta
 *  - separador (bool)    fila: línea sobre la fila (todas menos la primera)
 *  - retardo   (int)     tarjeta: ms de retardo de la entrada (escalonado por columna y fila)
 */
$titulo    = (string) ($args['titulo'] ?? '');
$fecha     = (string) ($args['fecha'] ?? '');
$categoria = (string) ($args['categoria'] ?? '');
$url       = (string) ($args['url'] ?? '');
$variante  = ($args['variante'] ?? 'fila') === 'tarjeta' ? 'tarjeta' : 'fila';
$separador = !empty($args['separador']);
$retardo   = max(0, (int) ($args['retardo'] ?? 0));

if ($titulo === '' || $url === '') {
    return;
}

$pildora = copam_theme_comunicado_pildora($categoria, $variante === 'tarjeta' ? 'bg-gris-f2 text-ink' : 'bg-gris-ec text-ink');
?>
<?php if ($variante === 'tarjeta') : ?>
<a class="group relative flex min-w-0 flex-col items-start p-[clamp(28px,2.1vw,40px)] text-ink hover:text-ink" href="<?= esc_url($url) ?>">
    <?php if ($categoria !== '') : ?>
        <span class="block rounded-[3px] px-2.5 py-1.5 text-xs leading-[1.2] font-semibold tracking-[.14em] uppercase <?= esc_attr($pildora) ?>" data-sr="clip" data-sr-delay="<?= esc_attr((string) ($retardo + 100)) ?>"><?= esc_html($categoria) ?></span>
    <?php endif; ?>
    <h3 class="mt-[clamp(14px,1vw,20px)] mb-0 text-[clamp(20px,1.35vw,26px)] leading-[1.3] font-medium tracking-[-.005em] text-pretty" data-sr="clip" data-sr-delay="<?= esc_attr((string) ($retardo + 170)) ?>"><?= esc_html($titulo) ?></h3>
    <?php if ($fecha !== '') : ?>
        <span class="mt-[clamp(12px,.9vw,18px)] mb-[clamp(20px,1.4vw,26px)] block overflow-hidden">
            <span class="block text-sm tracking-[.08em] text-gris-7a" data-sr="rise" data-sr-delay="<?= esc_attr((string) ($retardo + 240)) ?>"><?= esc_html($fecha) ?></span>
        </span>
    <?php endif; ?>
    <span class="mt-auto grid size-[clamp(48px,2.95vw,56px)] place-items-center rounded-full bg-brand transition-colors duration-[350ms] group-hover:bg-brand-hover" data-sr="pop" data-sr-delay="<?= esc_attr((string) ($retardo + 300)) ?>">
        <span class="relative block size-4 overflow-hidden" aria-hidden="true">
            <svg class="absolute inset-0 transition-transform duration-[550ms] ease-in-out group-hover:translate-x-[130%] group-hover:-translate-y-[130%]" width="16" height="16" viewBox="0 0 14 14" fill="none"><path d="M3 11L11 3M4.5 3H11v6.5" stroke="#fff" stroke-width="1.8"></path></svg>
            <svg class="absolute inset-0 -translate-x-[130%] translate-y-[130%] transition-transform duration-[550ms] ease-in-out group-hover:translate-x-0 group-hover:translate-y-0" width="16" height="16" viewBox="0 0 14 14" fill="none"><path d="M3 11L11 3M4.5 3H11v6.5" stroke="#fff" stroke-width="1.8"></path></svg>
        </span>
    </span>
</a>
<?php else : ?>
<a class="group relative grid grid-cols-[minmax(0,1fr)_auto] items-center gap-x-8 px-[clamp(20px,4.2vw,80px)] py-[clamp(28px,2.4vw,46px)] text-ink hover:text-ink" href="<?= esc_url($url) ?>">
    <?php if ($separador) : ?>
        <span class="absolute inset-x-0 top-0 h-px origin-left bg-line" data-sr="lineX"></span>
    <?php endif; ?>
    <div class="flex min-w-0 flex-col items-start">
        <?php if ($categoria !== '') : ?>
            <span class="block rounded-[3px] px-2.5 py-1.5 text-xs leading-[1.2] font-semibold tracking-[.14em] uppercase <?= esc_attr($pildora) ?>" data-sr="clip"><?= esc_html($categoria) ?></span>
        <?php endif; ?>
        <span class="mt-[clamp(14px,1.1vw,20px)] block overflow-hidden pb-[.08em]">
            <span class="block text-[clamp(20px,1.55vw,30px)] leading-[1.25] font-medium tracking-[-.005em] text-pretty" data-sr="rise" data-sr-delay="80"><?= esc_html($titulo) ?></span>
        </span>
        <?php if ($fecha !== '') : ?>
            <span class="mt-[clamp(10px,.9vw,16px)] block overflow-hidden">
                <span class="block text-sm tracking-[.14em] text-ink-muted uppercase" data-sr="rise" data-sr-delay="160"><?= esc_html($fecha) ?></span>
            </span>
        <?php endif; ?>
    </div>
    <span class="grid size-[clamp(52px,4.17vw,80px)] place-items-center rounded-full bg-brand transition-colors duration-[350ms] group-hover:bg-brand-hover" data-sr="pop" data-sr-delay="200">
        <span class="relative block size-[22px] overflow-hidden" aria-hidden="true">
            <svg class="absolute inset-0 transition-transform duration-[550ms] ease-in-out group-hover:translate-x-[130%] group-hover:-translate-y-[130%]" width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M5 17L17 5M7.5 5H17v9.5" stroke="#fff" stroke-width="2"></path></svg>
            <svg class="absolute inset-0 -translate-x-[130%] translate-y-[130%] transition-transform duration-[550ms] ease-in-out group-hover:translate-x-0 group-hover:translate-y-0" width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M5 17L17 5M7.5 5H17v9.5" stroke="#fff" stroke-width="2"></path></svg>
        </span>
    </span>
</a>
<?php endif; ?>
