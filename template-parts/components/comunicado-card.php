<?php
defined('ABSPATH') || exit;

/**
 * Comunicado. Por ahora solo la variante `fila` (portada): categoría, título, fecha y flecha.
 * La variante `tarjeta` llega con la página de comunicados.
 *
 * $args:
 *  - titulo    (string, requerido)
 *  - fecha     (string)  ya formateada, p. ej. "18 jul 2026"
 *  - categoria (string)  Operativo | Noticias | Mantenimiento
 *  - url       (string, requerido)
 *  - separador (bool)    línea sobre la fila (todas menos la primera)
 */
$titulo    = (string) ($args['titulo'] ?? '');
$fecha     = (string) ($args['fecha'] ?? '');
$categoria = (string) ($args['categoria'] ?? '');
$url       = (string) ($args['url'] ?? '');
$separador = !empty($args['separador']);

if ($titulo === '' || $url === '') {
    return;
}

// Colores de la píldora por categoría (valores sueltos del diseño, solo de este componente).
$pildoras = [
    'Operativo'     => 'bg-[#E4F3EA] text-[#0A7434]',
    'Noticias'      => 'bg-[#E6ECF6] text-[#2A4C80]',
    'Mantenimiento' => 'bg-[#FBE8E5] text-[#A8362A]',
];
$pildora = $pildoras[$categoria] ?? 'bg-gris-ec text-ink';
?>
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
