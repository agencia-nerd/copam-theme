<?php
defined('ABSPATH') || exit;

/**
 * Transparencia · hero: migas, título, bajada, botón al formulario de solicitud y accesos directos. Sin imagen.
 * Lee el grupo `transparencia_hero` (ACF); el contenido inicial está en inc/acf/seed/transparencia.php.
 * El botón lleva siempre al ancla #solicitud (no es campo); solo su texto es editable.
 */
$hero        = get_field('transparencia_hero') ?: [];
$boton_texto = trim((string) ($hero['boton_texto'] ?? ''));
$accesos     = [];
foreach ((array) ($hero['accesos'] ?? []) as $fila) {
    if (is_array($fila['enlace'] ?? null) && !empty($fila['enlace']['url'])) {
        $accesos[] = array_merge($fila['enlace'], ['title' => (string) ($fila['texto'] ?? '')]);
    }
}

get_template_part('template-parts/components/hero-servicio', null, [
    'migas'          => [
        ['texto' => __('Inicio', 'copam-theme'), 'url' => home_url('/')],
        ['texto' => __('Reglamentos', 'copam-theme')],
        ['texto' => get_the_title()],
    ],
    'titulo'         => (string) ($hero['titulo'] ?? ''),
    'bajada'         => (string) ($hero['bajada'] ?? ''),
    'boton'          => $boton_texto !== '' ? ['title' => $boton_texto, 'url' => '#solicitud'] : null,
    'accesos_titulo' => (string) ($hero['accesos_titulo'] ?? ''),
    'accesos'        => $accesos,
]);
