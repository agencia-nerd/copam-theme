<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial del listado de comunicados (spec `comunicados`), en la página de opciones
 * "Archivo de comunicado". Lo carga inc/acf/runner.php una sola vez por grupo; lo que el cliente edite en el
 * admin no se vuelve a pisar.
 */
return [
    'option' => true,
    'fields' => [
        'comunicados_encabezado' => [
            'titulo' => 'Comunicados',
            'bajada' => 'Avisos operativos, novedades y publicaciones regulatorias del Terminal Portuario de Yurimaguas – Nueva Reforma.',
        ],
        'comunicados_vacio' => [
            'mensaje' => 'No hay comunicados que coincidan con tu búsqueda.',
        ],
    ],
];
