<?php
defined('ABSPATH') || exit;

/**
 * Aviso de mantenimiento del sitio. Lee el grupo `opciones_aviso` de Ajustes del sitio.
 *
 * $args['parte']:
 *  - 'franja'      (móvil, dentro del header) banda bajo la barra que se despliega
 *  - 'espaciador'  (móvil, tras el header) reserva el alto de la franja para no tapar la página
 *  - 'flotante'    (escritorio) aviso en la esquina inferior izquierda
 * El módulo `header.js` lo muestra y recuerda en sessionStorage si se cerró.
 */
$aviso   = get_field('opciones_aviso', 'option') ?: [];
$activo  = !empty($aviso['activo']);
$titulo  = (string) ($aviso['titulo'] ?? '');
$detalle = (string) ($aviso['detalle'] ?? '');
$parte   = (string) ($args['parte'] ?? 'franja');

if (!$activo || $titulo === '') {
    return;
}

$punto = '<span class="block size-2 flex-none animate-respirar rounded-full bg-ink" aria-hidden="true"></span>';
$cerrar = '<svg width="10" height="10" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M2 2l10 10M12 2L2 12" stroke="#2B2B2B" stroke-width="2"></path></svg>';
?>
<?php if ($parte === 'franja') : ?>
    <div class="group/av pointer-events-auto grid grid-rows-[1fr] transition-[grid-template-rows] duration-[1400ms] ease-in-out min-[760px]:hidden js:grid-rows-[0fr] js:data-[visible]:grid-rows-[1fr]" data-aviso="franja">
        <div class="min-h-0 overflow-hidden">
            <div class="flex h-9 items-center gap-2.5 bg-warning pr-1.5 pl-5 text-ink transition-transform duration-[1500ms] ease-out js:-translate-y-full js:group-data-[visible]/av:translate-y-0" role="status">
                <?= $punto ?>
                <span class="flex-none text-xs font-semibold tracking-[.02em] whitespace-nowrap uppercase"><?= esc_html($titulo) ?></span>
                <span class="min-w-0 flex-1 truncate text-xs"><?= esc_html($detalle) ?></span>
                <button class="grid size-8 flex-none cursor-pointer place-items-center rounded-[3px] border-0 bg-transparent" type="button" data-aviso-cerrar aria-label="<?= esc_attr__('Cerrar aviso', 'copam-theme') ?>"><?= $cerrar ?></button>
            </div>
        </div>
    </div>
<?php elseif ($parte === 'espaciador') : ?>
    <div class="grid grid-rows-[1fr] transition-[grid-template-rows] duration-[1400ms] ease-in-out min-[760px]:hidden js:grid-rows-[0fr] js:data-[visible]:grid-rows-[1fr]" data-aviso="espaciador" aria-hidden="true">
        <div class="min-h-0 overflow-hidden"><div class="h-9"></div></div>
    </div>
<?php else : ?>
    <div class="group/av fixed bottom-3 left-3 z-[48] hidden max-w-[calc(100vw-24px)] rounded min-[760px]:block" data-aviso="flotante" role="status">
        <div class="flex h-10 items-center gap-2.5 rounded bg-warning pr-1.5 pl-3 text-ink transition-transform duration-[900ms] ease-out js:-translate-x-[calc(100%+16px)] js:group-data-[visible]/av:translate-x-0">
            <?= $punto ?>
            <span class="flex-none text-[13px] font-semibold tracking-[.02em] whitespace-nowrap uppercase"><?= esc_html($titulo) ?></span>
            <span class="h-3.5 w-px flex-none bg-ink/30" aria-hidden="true"></span>
            <span class="min-w-0 flex-1 truncate text-[13px]"><?= esc_html($detalle) ?></span>
            <button class="grid size-7 flex-none cursor-pointer place-items-center rounded-[3px] border-0 bg-transparent hover:bg-ink/10" type="button" data-aviso-cerrar aria-label="<?= esc_attr__('Cerrar aviso', 'copam-theme') ?>"><?= $cerrar ?></button>
        </div>
    </div>
<?php endif; ?>
