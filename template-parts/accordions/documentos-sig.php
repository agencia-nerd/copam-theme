<?php
defined('ABSPATH') || exit;

/**
 * Acordeón de documentos del SIG: un panel por grupo, con el conteo de documentos junto al ícono.
 * Lo imprime la sección `documentos` de Sistema Integrado de Gestión (wp-accordion).
 *
 * $args:
 *  - grupos        (array)   cada uno ['nombre', 'estado_vacio', 'documentos' => [['titulo', 'subtitulo', 'vigente', 'archivo']]]
 *  - mensaje_vacio (string)  texto dentro de un grupo sin documentos
 */
$grupos        = array_values(array_filter((array) ($args['grupos'] ?? []), static fn($grupo): bool => trim((string) ($grupo['nombre'] ?? '')) !== ''));
$mensaje_vacio = (string) ($args['mensaje_vacio'] ?? '');
if (!$grupos) {
    return;
}

copam_theme_accordion_start('documentos-sig', [
    'icon'          => 'plus',
    'class'         => 'relative border-y border-line',
    'item_class'    => 'border-t border-line first:border-t-0',
    'summary_class' => 'w-full bg-white px-[clamp(20px,2.1vw,40px)] py-[clamp(18px,1.4vw,26px)] text-ink',
    'title_class'   => 'text-[clamp(19px,1.2vw,23px)] font-semibold tracking-[-.005em]',
    'icon_class'    => 'size-[30px] rounded-full bg-brand p-[9px] text-white',
    'panel_class'   => 'bg-[#F8F8F8]',
]);

foreach ($grupos as $i => $grupo) :
    $documentos = array_values(array_filter((array) ($grupo['documentos'] ?? []), static fn($doc): bool => trim((string) ($doc['titulo'] ?? '')) !== ''));
    $total      = count($documentos);
    $estado     = $total > 0
        ? sprintf(_n('%d documento', '%d documentos', $total, 'copam-theme'), $total)
        : (string) ($grupo['estado_vacio'] ?? '');

    // El conteo va a la derecha, pegado al ícono: se inserta en el <summary> que imprime el motor.
    ob_start();
    copam_theme_accordion_item_start((string) $grupo['nombre'], ['open' => $i === 0]);
    $cabecera = (string) ob_get_clean();
    $conteo   = $estado !== '' ? '<span class="ml-auto flex-none text-[clamp(15px,.9vw,17px)] text-gris-7a">' . esc_html($estado) . '</span>' : '';
    echo str_replace('<svg class="accordion__icon', $conteo . '<svg class="accordion__icon', $cabecera); // phpcs:ignore WordPress.Security.EscapeOutput -- el motor ya escapa su salida y $conteo está escapado

    foreach ($documentos as $doc) :
        $archivo = $doc['archivo'] ?? null;
        $enlace  = is_array($archivo) && !empty($archivo['url']) ? ['url' => $archivo['url'], 'target' => '_blank'] : null;
        $peso    = is_array($archivo) && !empty($archivo['filesize']) ? ' · ' . size_format((int) $archivo['filesize'], 0) : '';
        $sub     = (string) ($doc['subtitulo'] ?? '');
        ?>
        <div class="flex flex-wrap items-center justify-between gap-x-6 gap-y-4 border-t border-[#E6E6E6] py-[clamp(18px,1.4vw,26px)] pr-[clamp(20px,2.1vw,40px)] pl-[clamp(24px,4vw,76px)] first:border-t-0">
            <div class="flex min-w-0 flex-wrap items-center gap-x-[18px] gap-y-2.5">
                <div class="flex min-w-0 flex-col gap-1">
                    <span class="text-[clamp(16px,.95vw,18px)] leading-[1.35] font-medium text-ink"><?= esc_html((string) $doc['titulo']) ?></span>
                    <?php if ($sub !== '') : ?><span class="text-sm text-gris-7a"><?= esc_html($sub) ?></span><?php endif; ?>
                </div>
                <?php if (!empty($doc['vigente'])) : ?>
                    <span class="block rounded-[3px] bg-warning px-2.5 py-1.5 text-xs leading-[1.2] font-semibold tracking-[.14em] text-ink uppercase"><?= esc_html__('Vigente', 'copam-theme') ?></span>
                <?php endif; ?>
            </div>
            <?php if ($enlace) : ?>
                <a<?= copam_theme_link_attrs($enlace, ['class' => 'group flex h-[46px] flex-none items-center rounded-[3px] bg-brand px-5 text-base font-medium text-white transition-colors duration-[350ms] hover:bg-brand-hover hover:text-white']) ?> title="<?= esc_attr('PDF' . $peso) ?>">
                    <span class="block h-[1.15em] overflow-hidden leading-[1.15em]">
                        <span class="flex flex-col transition-transform duration-[550ms] ease-in-out group-hover:-translate-y-1/2">
                            <span class="whitespace-nowrap"><?= esc_html__('Descargar PDF', 'copam-theme') ?></span>
                            <span class="whitespace-nowrap" aria-hidden="true"><?= esc_html__('Descargar PDF', 'copam-theme') ?></span>
                        </span>
                    </span>
                    <span class="sr-only">(<?= esc_html__('se abre en una pestaña nueva', 'copam-theme') ?>)</span>
                </a>
            <?php endif; ?>
        </div>
    <?php endforeach;

    if (!$documentos && $mensaje_vacio !== '') : ?>
        <p class="m-0 py-[clamp(18px,1.4vw,26px)] pr-[clamp(20px,2.1vw,40px)] pl-[clamp(24px,4vw,76px)] text-[clamp(15px,.9vw,17px)] text-gris-7a"><?= esc_html($mensaje_vacio) ?></p>
    <?php endif;

    copam_theme_accordion_item_end();
endforeach;

copam_theme_accordion_end();
