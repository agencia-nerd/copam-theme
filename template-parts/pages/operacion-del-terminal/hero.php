<?php
defined('ABSPATH') || exit;

/**
 * Operación del terminal · hero: migas, imagen, título, bajada, botón de descarga del REOP y accesos directos.
 * Lee el grupo `operacion_del_terminal_hero` (ACF); el contenido inicial está en inc/acf/seed/operacion-del-terminal.php.
 */
$hero    = get_field('operacion_del_terminal_hero') ?: [];
$archivo = $hero['boton_archivo'] ?? null;
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
    'imagen'         => $hero['imagen'] ?? null,
    'posicion'       => 'object-[50%_55%]',
    'accesos_titulo' => (string) ($hero['accesos_titulo'] ?? ''),
    'accesos'        => array_map(static fn($fila) => $fila['enlace'] ?? null, (array) ($hero['accesos'] ?? [])),
]);
