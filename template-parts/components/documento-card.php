<?php
defined('ABSPATH') || exit;

/**
 * Tarjeta de documento: la tarjeta entera es el enlace al PDF (pestaña nueva), con etiqueta, título, fecha y
 * un botón circular verde cuya flecha sale por una esquina y entra por la otra al pasar el cursor o enfocar.
 * Va dentro de la rejilla de `rejilla-documentos`, que dibuja las líneas entre tarjetas.
 *
 * $args:
 *  - etiqueta  (string)        tipo de documento, sobre el título
 *  - titulo    (string, req.)  nombre del documento (h3)
 *  - fecha     (string)        vigencia o fecha, tal como se muestra
 *  - archivo   (array|string)  campo File de ACF, o campo Link / URL si el documento está alojado fuera
 *  - retardo   (int)           milisegundos base de la entrada
 *  - linea_sup (string)        clases de visibilidad de la línea superior (la rejilla las calcula por columnas)
 */
$etiqueta  = (string) ($args['etiqueta'] ?? '');
$titulo    = (string) ($args['titulo'] ?? '');
$fecha     = (string) ($args['fecha'] ?? '');
$archivo   = $args['archivo'] ?? null;
$retardo   = (int) ($args['retardo'] ?? 0);
$linea_sup = (string) ($args['linea_sup'] ?? 'hidden');

// Un campo File trae url y peso; un Link o una URL se usan tal cual.
$es_file = is_array($archivo) && isset($archivo['filesize']);
$enlace  = $es_file
    ? (!empty($archivo['url']) ? ['url' => (string) $archivo['url'], 'target' => '_blank'] : null)
    : $archivo;
$peso    = $es_file && !empty($archivo['filesize']) ? 'PDF · ' . size_format((int) $archivo['filesize'], 0) : '';
$data    = copam_theme_link_data($enlace);
if ($titulo === '' || !$data) {
    return;
}
$abre_nueva = copam_theme_link_resolve($data, [])['blank'];
$d = static fn(int $extra): string => esc_attr((string) ($retardo + $extra));
?>
<a<?= copam_theme_link_attrs($enlace, ['class' => 'group relative flex min-w-0 flex-col items-start p-[clamp(28px,2.1vw,40px)] text-ink outline-offset-[-2px] hover:text-ink']) ?><?= $peso !== '' ? ' title="' . esc_attr($peso) . '"' : '' ?>>
    <span class="absolute inset-y-0 left-0 w-px bg-line" data-sr="lineY" data-sr-delay="<?= $d(120) ?>" aria-hidden="true"></span>
    <span class="absolute inset-x-0 top-0 h-px bg-line <?= esc_attr($linea_sup) ?>" data-sr="lineX" aria-hidden="true"></span>
    <?php if ($etiqueta !== '') : ?>
        <span class="block rounded-[3px] bg-gris-f2 px-2.5 py-1.5 text-xs leading-[1.2] font-semibold tracking-[.14em] text-ink uppercase" data-sr="clip" data-sr-delay="<?= $d(100) ?>"><?= esc_html($etiqueta) ?></span>
    <?php endif; ?>
    <h3 class="mt-[clamp(14px,1vw,20px)] mb-0 text-[clamp(20px,1.35vw,26px)] leading-[1.3] font-medium tracking-[-.005em] text-pretty" data-sr="clip" data-sr-delay="<?= $d(170) ?>"><?= esc_html($titulo) ?></h3>
    <?php if ($fecha !== '') : ?>
        <span class="mt-[clamp(12px,.9vw,18px)] block overflow-hidden"><span class="block text-sm tracking-[.08em] text-gris-7a" data-sr="rise" data-sr-delay="<?= $d(240) ?>"><?= esc_html($fecha) ?></span></span>
    <?php endif; ?>
    <span class="mt-auto block pt-[clamp(20px,1.4vw,26px)]" aria-hidden="true"><span class="relative grid size-[clamp(48px,2.95vw,56px)] place-items-center rounded-full bg-brand transition-colors duration-[350ms] group-hover:bg-brand-hover group-focus-visible:bg-brand-hover" data-sr="pop" data-sr-delay="<?= $d(300) ?>">
        <span class="relative block size-4 overflow-hidden">
            <svg class="absolute inset-0 transition-transform duration-[550ms] ease-in-out group-hover:translate-x-[130%] group-hover:-translate-y-[130%] group-focus-visible:translate-x-[130%] group-focus-visible:-translate-y-[130%]" width="16" height="16" viewBox="0 0 14 14" fill="none"><path d="M3 11L11 3M4.5 3H11v6.5" stroke="#fff" stroke-width="1.8"></path></svg>
            <svg class="absolute inset-0 -translate-x-[130%] translate-y-[130%] transition-transform duration-[550ms] ease-in-out group-hover:translate-0 group-focus-visible:translate-0" width="16" height="16" viewBox="0 0 14 14" fill="none"><path d="M3 11L11 3M4.5 3H11v6.5" stroke="#fff" stroke-width="1.8"></path></svg>
        </span>
    </span></span>
    <?php if ($abre_nueva) : ?>
        <span class="sr-only">(<?= esc_html__('se abre en una pestaña nueva', 'copam-theme') ?>)</span>
    <?php endif; ?>
</a>
