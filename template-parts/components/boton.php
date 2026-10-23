<?php
defined('ABSPATH') || exit;

/**
 * Botón con texto que se desliza al pasar el cursor y, si lleva flecha, un ícono que entra en diagonal.
 *
 * $args:
 *  - texto    (string, requerido)  texto visible
 *  - contexto (string)             texto solo para lectores de pantalla tras el visible, cuando el texto se
 *                                  repite en varias tarjetas ("Descargar" + título del documento)
 *  - enlace   (array|string)       campo Link de ACF o URL; sin destino válido no se imprime
 *  - variante (string)             'verde' (por defecto) | 'oscuro'
 *  - flecha   (bool)               agrega la flecha diagonal
 *  - titulo   (string)             atributo title (tipo y peso del archivo en descargas)
 *  - datos    (array)              atributos data-* extra: ['sr' => 'rise', 'sr-delay' => '120']
 *  - relleno  (string)             relleno horizontal con flecha ('px-[26px]' por defecto)
 *  - tamano   (string)             'normal' (por defecto) | 'chico' (46px de alto, 14px, flecha de 12px; tarjetas)
 *  - clase    (string)             clases extra para el <a>
 */
$texto    = (string) ($args['texto'] ?? '');
$contexto = trim((string) ($args['contexto'] ?? ''));
$enlace   = $args['enlace'] ?? '';
$variante = (string) ($args['variante'] ?? 'verde');
$flecha   = !empty($args['flecha']);
$titulo   = (string) ($args['titulo'] ?? '');
$datos    = (array) ($args['datos'] ?? []);
$relleno  = (string) ($args['relleno'] ?? 'px-[26px]');
$clase    = (string) ($args['clase'] ?? '');
$chico    = ($args['tamano'] ?? 'normal') === 'chico';

$data = copam_theme_link_data($enlace);
if ($texto === '' || !$data) {
    return;
}

$colores = $variante === 'oscuro'
    ? 'bg-[#3D3D3D] hover:bg-[#1F1F1F]'
    : 'bg-brand hover:bg-brand-hover';
$forma = match (true) {
    $chico  => 'h-[46px] gap-2.5 rounded-[3px] px-[18px] text-sm',
    $flecha => "h-[52px] gap-3.5 rounded-[3px] $relleno text-base",
    default => 'h-[52px] justify-center rounded px-6 text-[clamp(16px,.95vw,18px)]',
};
$icono = $chico ? 'size-3' : 'size-3.5';

$clases = trim("group flex items-center font-medium tracking-[.02em] text-white uppercase transition-colors duration-[350ms] hover:text-white $colores $forma $clase");

$extra = '';
foreach ($datos as $nombre => $valor) {
    $extra .= ' data-' . esc_attr((string) $nombre) . '="' . esc_attr((string) $valor) . '"';
}
if ($titulo !== '') {
    $extra .= ' title="' . esc_attr($titulo) . '"';
}

$abre_nueva = copam_theme_link_resolve($data, [])['blank'];
?>
<a<?= copam_theme_link_attrs($enlace, ['class' => $clases]) . $extra ?>>
    <span class="block h-[1.15em] overflow-hidden leading-[1.15em]">
        <span class="flex flex-col transition-transform duration-[550ms] ease-in-out group-hover:-translate-y-1/2">
            <span class="whitespace-nowrap"><?= esc_html($texto) ?></span>
            <span class="whitespace-nowrap" aria-hidden="true"><?= esc_html($texto) ?></span>
        </span>
    </span>
    <?php if ($contexto !== '') : ?>
        <span class="sr-only"> <?= esc_html($contexto) ?></span>
    <?php endif; ?>
    <?php if ($flecha) : ?>
        <span class="relative block flex-none overflow-hidden <?= esc_attr($icono) ?>" aria-hidden="true">
            <svg class="absolute inset-0 size-full transition-transform duration-[550ms] ease-in-out group-hover:translate-x-[120%] group-hover:-translate-y-[120%]" width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M3 11L11 3M4.5 3H11v6.5" stroke="#fff" stroke-width="<?= $chico ? '1.8' : '1.6' ?>"></path></svg>
            <svg class="absolute inset-0 size-full -translate-x-[120%] translate-y-[120%] transition-transform duration-[550ms] ease-in-out group-hover:translate-x-0 group-hover:translate-y-0" width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M3 11L11 3M4.5 3H11v6.5" stroke="#fff" stroke-width="<?= $chico ? '1.8' : '1.6' ?>"></path></svg>
        </span>
    <?php endif; ?>
    <?php if ($abre_nueva) : ?>
        <span class="sr-only">(<?= esc_html__('se abre en una pestaña nueva', 'copam-theme') ?>)</span>
    <?php endif; ?>
</a>
