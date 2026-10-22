<?php
defined('ABSPATH') || exit;

/**
 * Política de privacidad · hero: migas, título y línea de última actualización.
 * Lee el grupo `privacidad_hero` (ACF); el contenido inicial está en inc/acf/seed/privacidad.php.
 */
$hero = get_field('privacidad_hero') ?: [];

get_template_part('template-parts/components/hero-legal', null, [
    'migas'         => [
        ['texto' => __('Inicio', 'copam-theme'), 'url' => home_url('/')],
        ['texto' => get_the_title()],
    ],
    'titulo'        => (string) ($hero['titulo'] ?? ''),
    'actualizacion' => (string) ($hero['actualizacion'] ?? ''),
]);
