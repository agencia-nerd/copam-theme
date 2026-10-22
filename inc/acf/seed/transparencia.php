<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Transparencia (spec `transparencia`). Lo carga inc/acf/runner.php una sola vez por grupo:
 * lo que el cliente edite después no se sobrescribe. Los enlaces a páginas del sitio son rutas relativas (/pagina/), así funcionan igual en local y en producción.
 * El botón del hero lleva siempre a #solicitud (no es campo). El correo de destino del formulario sale de Ajustes del sitio.
 */
return [
    'page'   => 'transparencia',
    'fields' => [
        'transparencia_hero' => [
            'titulo'         => 'Transparencia',
            'bajada'         => 'Consulta la información que publicamos sobre la concesión y solicita el acceso a información adicional.',
            'boton_texto'    => 'Solicitar información',
            'accesos_titulo' => 'Accesos directos',
            'accesos'        => [
                ['texto' => 'Información publicada', 'enlace' => ['title' => 'Información publicada', 'url' => '#info']],
                ['texto' => 'Solicitud de información', 'enlace' => ['title' => 'Solicitud de información', 'url' => '#solicitud']],
                ['texto' => 'Tarifario', 'enlace' => ['title' => 'Tarifario', 'url' => '/tarifario/']],
                ['texto' => 'Operación del terminal', 'enlace' => ['title' => 'Operación del terminal', 'url' => '/operacion-del-terminal/']],
                ['texto' => 'Contrato de concesión', 'enlace' => ['title' => 'Contrato de concesión', 'url' => '/normativa-ositran/#contrato']],
            ],
        ],

        'transparencia_informacion' => [
            'titulo' => 'Información publicada',
            'filas'  => [
                ['titulo' => 'Tarifario y Reglamento de Tarifas y Precios de COPAM', 'texto_enlace' => 'Ver en Tarifario', 'enlace' => ['title' => 'Ver en Tarifario', 'url' => '/tarifario/']],
                ['titulo' => 'Reglamento de Operaciones (REOP)', 'texto_enlace' => 'Ver en Operación del terminal', 'enlace' => ['title' => 'Ver en Operación del terminal', 'url' => '/operacion-del-terminal/']],
                ['titulo' => 'Contrato de concesión y adendas', 'texto_enlace' => 'Ver en Normativa OSITRAN', 'enlace' => ['title' => 'Ver en Normativa OSITRAN', 'url' => '/normativa-ositran/#contrato']],
                ['titulo' => 'Normativa OSITRAN aplicable', 'texto_enlace' => 'Ver en Normativa OSITRAN', 'enlace' => ['title' => 'Ver en Normativa OSITRAN', 'url' => '/normativa-ositran/']],
                ['titulo' => 'Reglamento de atención de reclamos', 'texto_enlace' => 'Ver en Reclamos', 'enlace' => ['title' => 'Ver en Reclamos', 'url' => '/reclamos/']],
                ['titulo' => 'Avisos y comunicados', 'texto_enlace' => 'Ver en Comunicados', 'enlace' => ['title' => 'Ver en Comunicados', 'url' => '/comunicados/']],
            ],
        ],

        'transparencia_solicitud' => [
            'titulo'     => 'Solicitud de acceso a la información',
            'nota_envio' => 'La solicitud se envía a',
        ],
    ],
];
