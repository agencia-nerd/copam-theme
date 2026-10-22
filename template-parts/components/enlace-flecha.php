<?php
defined('ABSPATH') || exit;

/**
 * Enlace verde con flecha. Sin destino válido o sin texto no se imprime.
 *
 * $args:
 *  - texto  (string)       si falta se usa el título del campo Link
 *  - enlace (array|string) campo Link de ACF o URL
 *  - clase  (string)       clases extra para el contenedor
 *  - tamano (string)       'normal' (15px, por defecto) | 'chico' (14px, índice lateral)
 */
$enlace = $args['enlace'] ?? '';
$data   = copam_theme_link_data($enlace);
$texto  = trim((string) ($args['texto'] ?? ($data['title'] ?? '')));
$clase  = (string) ($args['clase'] ?? '');
$chico  = ($args['tamano'] ?? '') === 'chico';
if (!$data || $texto === '') {
    return;
}
$abre_nueva = copam_theme_link_resolve($data, [])['blank'];
?>
<div class="overflow-hidden <?= esc_attr($clase) ?>">
    <a<?= copam_theme_link_attrs($enlace, ['class' => 'inline-flex items-center gap-2 font-medium text-brand transition-colors duration-[250ms] hover:text-brand-hover ' . ($chico ? 'text-sm' : 'text-[15px]')]) ?> data-sr="rise">
        <?= esc_html($texto) ?>
        <svg width="12" height="12" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.6"></path></svg>
        <?php if ($abre_nueva) : ?><span class="sr-only">(<?= esc_html__('se abre en una pestaña nueva', 'copam-theme') ?>)</span><?php endif; ?>
    </a>
</div>
