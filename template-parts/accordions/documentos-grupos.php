<?php
defined('ABSPATH') || exit;

/**
 * Acordeón de documentos por grupo: un panel por grupo, con el conteo de documentos junto al ícono y una fila
 * por documento (título, detalle, insignia "Vigente" y botón de descarga). El primer grupo empieza abierto.
 * Lo usan Sistema Integrado de Gestión, Depósito Temporal, Normativa OSITRAN, Tarifario y Operación del terminal (wp-accordion).
 *
 * $args:
 *  - id            (string)  id del acordeón
 *  - grupos        (array)   cada uno ['nombre', 'estado_vacio', 'abierto' (bool, opcional), 'enlace_extra' (Link, opcional),
 *                              'documentos' => [['titulo', 'subtitulo', 'vigente', 'archivo', 'enlace_externo',
 *                              'boton_texto', 'archivo_alterno']]]. Sin 'abierto', solo el primer grupo empieza abierto.
 *                              'enlace_externo' (URL) se usa cuando el documento no tiene archivo.
 *  - mensaje_vacio (string)  texto dentro de un grupo sin documentos
 *  - boton_texto   (string)  texto del botón de descarga cuando el documento no trae el suyo ('Descargar PDF' por defecto)
 *  - vigente_texto (string)  texto de la insignia de los documentos vigentes ('Vigente' por defecto)
 */
$grupos        = array_values(array_filter((array) ($args['grupos'] ?? []), static fn($grupo): bool => trim((string) ($grupo['nombre'] ?? '')) !== ''));
$mensaje_vacio = (string) ($args['mensaje_vacio'] ?? '');
$boton_base    = trim((string) ($args['boton_texto'] ?? '')) ?: __('Descargar PDF', 'copam-theme');
$vigente_texto = trim((string) ($args['vigente_texto'] ?? '')) ?: __('Vigente', 'copam-theme');
if (!$grupos) {
    return;
}

// Tipo y peso del archivo para el title del enlace ("PDF · 1 MB", "Excel · 40 KB").
$descripcion_archivo = static function ($archivo): string {
    $ext  = strtolower((string) pathinfo((string) ($archivo['filename'] ?? $archivo['url'] ?? ''), PATHINFO_EXTENSION));
    $tipo = in_array($ext, ['xls', 'xlsx', 'csv'], true) ? 'Excel' : 'PDF';
    return $tipo . (!empty($archivo['filesize']) ? ' · ' . size_format((int) $archivo['filesize'], 0) : '');
};

copam_theme_accordion_start((string) ($args['id'] ?? 'documentos-grupos'), [
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
    $abierto    = array_key_exists('abierto', $grupo) ? !empty($grupo['abierto']) : $i === 0;
    copam_theme_accordion_item_start((string) $grupo['nombre'], ['open' => $abierto]);
    $cabecera = (string) ob_get_clean();
    $conteo   = $estado !== '' ? '<span class="ml-auto flex-none text-[clamp(15px,.9vw,17px)] text-gris-7a">' . esc_html($estado) . '</span>' : '';
    echo str_replace('<svg class="accordion__icon', $conteo . '<svg class="accordion__icon', $cabecera); // phpcs:ignore WordPress.Security.EscapeOutput -- el motor ya escapa su salida y $conteo está escapado

    foreach ($documentos as $doc) :
        $archivo = $doc['archivo'] ?? null;
        $externo = trim((string) ($doc['enlace_externo'] ?? ''));
        $enlace  = is_array($archivo) && !empty($archivo['url'])
            ? ['url' => $archivo['url'], 'target' => '_blank']
            : ($externo !== '' ? ['url' => $externo, 'target' => '_blank'] : null);
        $alterno = $doc['archivo_alterno'] ?? null;
        $ver     = is_array($alterno) && !empty($alterno['url']) ? ['url' => $alterno['url'], 'target' => '_blank'] : null;
        $boton   = trim((string) ($doc['boton_texto'] ?? '')) ?: $boton_base;
        $sub     = (string) ($doc['subtitulo'] ?? '');
        ?>
        <div class="flex flex-wrap items-center justify-between gap-x-6 gap-y-4 border-t border-[#E6E6E6] py-[clamp(18px,1.4vw,26px)] pr-[clamp(20px,2.1vw,40px)] pl-[clamp(24px,4vw,76px)] first:border-t-0">
            <div class="flex min-w-0 flex-wrap items-center gap-x-[18px] gap-y-2.5">
                <div class="flex min-w-0 flex-col gap-1">
                    <span class="text-[clamp(16px,.95vw,18px)] leading-[1.35] font-medium text-ink"><?= esc_html((string) $doc['titulo']) ?></span>
                    <?php if ($sub !== '') : ?><span class="text-sm text-gris-7a"><?= esc_html($sub) ?></span><?php endif; ?>
                </div>
                <?php if (!empty($doc['vigente'])) : ?>
                    <span class="block rounded-[3px] bg-warning px-2.5 py-1.5 text-xs leading-[1.2] font-semibold tracking-[.14em] text-ink uppercase"><?= esc_html($vigente_texto) ?></span>
                <?php endif; ?>
            </div>
            <?php if ($enlace || $ver) : ?>
                <div class="flex flex-none flex-wrap items-center gap-x-[22px] gap-y-2.5">
                    <?php if ($ver) : ?>
                        <a<?= copam_theme_link_attrs($ver, ['class' => 'inline-flex items-center gap-1.5 text-[15px] font-medium text-brand transition-colors duration-[250ms] hover:text-brand-hover']) ?> title="<?= esc_attr($descripcion_archivo($alterno)) ?>">
                            <?= esc_html__('Ver PDF', 'copam-theme') ?>
                            <svg width="10" height="10" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M3 11L11 3M4.5 3H11v6.5" stroke="currentColor" stroke-width="1.8"></path></svg>
                            <span class="sr-only">(<?= esc_html__('se abre en una pestaña nueva', 'copam-theme') ?>)</span>
                        </a>
                    <?php endif; ?>
                    <?php if ($enlace) : ?>
                        <a<?= copam_theme_link_attrs($enlace, ['class' => 'group flex h-[46px] flex-none items-center rounded-[3px] bg-brand px-5 text-base font-medium text-white transition-colors duration-[350ms] hover:bg-brand-hover hover:text-white']) ?><?= is_array($archivo) && !empty($archivo['url']) ? ' title="' . esc_attr($descripcion_archivo($archivo)) . '"' : '' ?>>
                            <span class="block h-[1.15em] overflow-hidden leading-[1.15em]">
                                <span class="flex flex-col transition-transform duration-[550ms] ease-in-out group-hover:-translate-y-1/2">
                                    <span class="whitespace-nowrap"><?= esc_html($boton) ?></span>
                                    <span class="whitespace-nowrap" aria-hidden="true"><?= esc_html($boton) ?></span>
                                </span>
                            </span>
                            <span class="sr-only">(<?= esc_html__('se abre en una pestaña nueva', 'copam-theme') ?>)</span>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach;

    if (!$documentos && $mensaje_vacio !== '') : ?>
        <p class="m-0 py-[clamp(18px,1.4vw,26px)] pr-[clamp(20px,2.1vw,40px)] pl-[clamp(24px,4vw,76px)] text-[clamp(15px,.9vw,17px)] text-gris-7a"><?= esc_html($mensaje_vacio) ?></p>
    <?php endif;

    // Enlace opcional al final del grupo (p. ej. "Ver Operación del terminal").
    get_template_part('template-parts/components/enlace-flecha', null, [
        'enlace' => $grupo['enlace_extra'] ?? null,
        'clase'  => 'border-t border-[#E6E6E6] py-[clamp(18px,1.4vw,26px)] pr-[clamp(20px,2.1vw,40px)] pl-[clamp(24px,4vw,76px)]',
    ]);

    copam_theme_accordion_item_end();
endforeach;

copam_theme_accordion_end();
