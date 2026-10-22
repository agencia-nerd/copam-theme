<?php
defined('ABSPATH') || exit;

/**
 * Tarifario · hero: migas, título, bajada, botón para descargar el tarifario vigente y accesos directos (sin imagen).
 * Lee el grupo `tarifario_hero` (ACF); el contenido inicial está en inc/acf/seed/tarifario.php.
 */
$hero    = get_field('tarifario_hero') ?: [];
$archivo = $hero['archivo'] ?? null;
$boton   = is_array($archivo) && !empty($archivo['url'])
    ? ['title' => (string) ($hero['boton_texto'] ?? ''), 'url' => (string) $archivo['url'], 'target' => '_blank']
    : null;

get_template_part('template-parts/components/hero-servicio', null, [
    'migas'          => [
        ['texto' => __('Inicio', 'copam-theme'), 'url' => home_url('/')],
        ['texto' => __('Zona Clientes', 'copam-theme')],
        ['texto' => get_the_title()],
    ],
    'titulo'         => (string) ($hero['titulo'] ?? ''),
    'bajada'         => (string) ($hero['bajada'] ?? ''),
    'boton'          => $boton,
    'accesos_titulo' => (string) ($hero['accesos_titulo'] ?? ''),
    'accesos'        => array_map(static fn($fila) => $fila['enlace'] ?? null, (array) ($hero['accesos'] ?? [])),
]);
