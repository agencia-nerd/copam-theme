<?php
defined('ABSPATH') || exit;

/**
 * Términos y condiciones · índice lateral "En esta página". Los enlaces salen de los h2 del campo
 * `terminos_contenido` (no son campos propios); copam_theme_texto_legal les da el mismo id en el contenido.
 */
$contenido = get_field('terminos_contenido') ?: [];
$legal     = copam_theme_texto_legal($contenido['texto'] ?? '', true);

get_template_part('template-parts/components/indice-lateral', null, [
    'titulo' => __('En esta página', 'copam-theme'),
    'items'  => $legal['indice'],
]);
