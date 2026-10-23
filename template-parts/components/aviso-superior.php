<?php
defined('ABSPATH') || exit;

/**
 * Aviso de mantenimiento del sitio. Lee el grupo `opciones_aviso` de Ajustes del sitio.
 *
 * $args['parte']:
 *  - 'franja'      (móvil, dentro del header) banda bajo la barra que se despliega
 *  - 'espaciador'  (móvil, tras el header) reserva el alto de la franja para no tapar la página
 *  - 'flotante'    (escritorio) aviso en la esquina inferior izquierda
 * Con `enlace`, la barra es un <a> a esa entrada. El módulo `header.js` lo muestra y desplaza el detalle si no entra.
 * No se puede cerrar.
 */
$aviso   = get_field('opciones_aviso', 'option') ?: [];
$activo  = !empty($aviso['activo']);
$titulo  = (string) ($aviso['titulo'] ?? '');
$detalle = (string) ($aviso['detalle'] ?? '');
$enlace  = $aviso['enlace'] ?? null;
$parte   = (string) ($args['parte'] ?? 'franja');

if (!$activo || $titulo === '') {
    return;
}

$punto = '<span class="block size-2 flex-none animate-respirar rounded-full bg-ink" aria-hidden="true"></span>';

// Barra del aviso: <a> si hay enlace válido, si no <div>. La flecha y el aviso de pestaña nueva solo van con enlace.
$barra = function (string $clases) use ($enlace): array {
    $attrs = copam_theme_link_attrs($enlace, ['class' => $clases . ' hover:brightness-95 focus-visible:outline-2 focus-visible:-outline-offset-4 focus-visible:outline-ink']);
    if ($attrs === '') {
        return ['<div class="' . esc_attr($clases) . '">', '', '</div>'];
    }
    $fin = '<svg class="flex-none" width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M1 7h11M8 3l4 4-4 4" stroke="#2B2B2B" stroke-width="1.6"></path></svg>';
    if (str_contains($attrs, 'target="_blank"')) {
        $fin .= '<span class="sr-only">(' . esc_html__('se abre en una pestaña nueva', 'copam-theme') . ')</span>';
    }
    return ['<a' . $attrs . '>', $fin, '</a>'];
};
?>
<?php if ($parte === 'franja') : ?>
    <div class="group/av pointer-events-auto grid grid-rows-[1fr] transition-[grid-template-rows] duration-[1400ms] ease-in-out min-[760px]:hidden js:grid-rows-[0fr] js:data-[visible]:grid-rows-[1fr]" data-aviso="franja">
        <div class="min-h-0 overflow-hidden" role="status">
            <?php [$abre, $fin, $cierra] = $barra('flex h-9 items-center gap-2.5 bg-warning px-5 text-ink transition-transform duration-[1500ms] ease-out js:-translate-y-full js:group-data-[visible]/av:translate-y-0'); ?>
            <?= $abre ?>
                <?= $punto ?>
                <span class="flex-none text-xs font-semibold tracking-[.02em] whitespace-nowrap uppercase"><?= esc_html($titulo) ?></span>
                <?php if ($detalle !== '') : ?>
                    <span class="min-w-0 flex-1 truncate text-xs" data-aviso-detalle><span class="aviso-pista"><?= esc_html($detalle) ?></span></span>
                <?php endif; ?>
                <?= $fin ?>
            <?= $cierra ?>
        </div>
    </div>
<?php elseif ($parte === 'espaciador') : ?>
    <div class="grid grid-rows-[1fr] transition-[grid-template-rows] duration-[1400ms] ease-in-out min-[760px]:hidden js:grid-rows-[0fr] js:data-[visible]:grid-rows-[1fr]" data-aviso="espaciador" aria-hidden="true">
        <div class="min-h-0 overflow-hidden"><div class="h-9"></div></div>
    </div>
<?php else : ?>
    <div class="group/av fixed bottom-3 left-3 z-[48] hidden max-w-[calc(100vw-24px)] rounded min-[760px]:block" data-aviso="flotante" role="status">
        <?php [$abre, $fin, $cierra] = $barra('flex h-10 items-center gap-2.5 rounded bg-warning px-3 text-ink transition-transform duration-[900ms] ease-out js:-translate-x-[calc(100%+16px)] js:group-data-[visible]/av:translate-x-0'); ?>
        <?= $abre ?>
            <?= $punto ?>
            <span class="flex-none text-[13px] font-semibold tracking-[.02em] whitespace-nowrap uppercase"><?= esc_html($titulo) ?></span>
            <span class="h-3.5 w-px flex-none bg-ink/30" aria-hidden="true"></span>
            <?php if ($detalle !== '') : ?>
                <span class="min-w-0 flex-1 truncate text-[13px]" data-aviso-detalle><span class="aviso-pista"><?= esc_html($detalle) ?></span></span>
            <?php endif; ?>
            <?= $fin ?>
        <?= $cierra ?>
    </div>
<?php endif; ?>
