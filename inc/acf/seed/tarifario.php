<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Tarifario (spec `tarifario`). Lo carga inc/acf/runner.php una sola vez por grupo:
 * lo que el cliente edite después no se sobrescribe. Los enlaces a páginas del sitio son rutas relativas (/pagina/), así funcionan igual en local y en producción.
 */
return [
    'page'   => 'tarifario',
    'fields' => [
        'tarifario_hero' => [
            'titulo'         => 'Tarifario',
            'bajada'         => 'Tarifas de los servicios estándar y especiales, aprobadas por OSITRAN. Consulta la versión vigente, el Reglamento de Tarifas y Precios de COPAM y el histórico de versiones.',
            'archivo'        => ['_file' => 'assets/docs/tarifario-2026-06-16.pdf'],
            'boton_texto'    => 'Descargar tarifario',
            'accesos_titulo' => 'Accesos directos',
            'accesos'        => [
                ['enlace' => ['title' => 'Reglamento de Tarifas y Precios de COPAM', 'url' => '#reta']],
                ['enlace' => ['title' => 'Tarifario del Depósito Temporal', 'url' => '/deposito-temporal/#tarifas']],
                ['enlace' => ['title' => 'Operación del terminal', 'url' => '/operacion-del-terminal/']],
                ['enlace' => ['title' => 'Preguntas frecuentes', 'url' => '#faq']],
                ['enlace' => ['title' => 'Seguimiento de carga', 'url' => 'http://45.232.151.188:8081/consultacarga/', 'target' => '_blank']],
            ],
        ],

        'tarifario_versiones' => [
            'titulo'      => 'Versiones del tarifario',
            'anios'       => [
                ['anio' => '2026', 'documentos' => [
                    ['titulo' => 'Tarifario de Servicios Portuarios', 'subtitulo' => 'Vigente a partir del 16-06-2026', 'vigente' => true, 'archivo' => ['_file' => 'assets/docs/tarifario-2026-06-16.pdf']],
                    ['titulo' => 'Tarifario de Servicios Portuarios', 'subtitulo' => 'Vigente a partir del 01-01-2026', 'vigente' => false, 'archivo' => ['_file' => 'assets/docs/tarifario-2026-01-01.pdf']],
                ]],
                ['anio' => '2023', 'documentos' => [
                    ['titulo' => 'Tarifario de Servicios Portuarios', 'subtitulo' => 'Vigente a partir del 17-04-2023', 'vigente' => false, 'archivo' => ['_file' => 'assets/docs/tarifario-2023-04-17.pdf']],
                    ['titulo' => 'Tarifario de Servicios Portuarios', 'subtitulo' => 'Vigente a partir del 01-01-2023', 'vigente' => false, 'archivo' => ['_file' => 'assets/docs/tarifario-2023-01-01.pdf']],
                ]],
                ['anio' => '2022', 'documentos' => [
                    ['titulo' => 'Tarifario de Servicios Portuarios', 'subtitulo' => 'Vigente a partir del 06-01-2022', 'vigente' => false, 'archivo' => ['_file' => 'assets/docs/tarifario-2022-01-06.pdf']],
                ]],
                ['anio' => '2021', 'documentos' => [
                    ['titulo' => 'Tarifario de Servicios Portuarios', 'subtitulo' => 'Vigente a partir del 01-01-2021', 'vigente' => false, 'archivo' => ['_file' => 'assets/docs/tarifario-2021-01-01.pdf']],
                ]],
            ],
            'boton_texto' => 'Descargar PDF',
            'vacio'       => 'Los documentos de esta sección se publicarán próximamente.',
        ],

        'tarifario_reta' => [
            'titulo'      => 'Reglamento de Tarifas y Precios de COPAM',
            'grupos'      => [
                ['nombre' => '2026', 'documentos' => [
                    ['titulo' => 'Reglamento de Tarifas y Precios de COPAM · V 5.3 · junio 2026', 'subtitulo' => 'Vigente', 'vigente' => true, 'archivo' => ['_file' => 'assets/docs/reta-v5-3.pdf']],
                ]],
                ['nombre' => 'Anterior', 'documentos' => [
                    ['titulo' => 'Reglamento de Tarifas y Precios de COPAM · V 5.2', 'subtitulo' => 'Versión anterior', 'vigente' => false, 'archivo' => ['_file' => 'assets/docs/reta-v5-2.pdf']],
                ]],
            ],
            'boton_texto' => 'Descargar PDF',
            'vacio'       => 'Los documentos de esta sección se publicarán próximamente.',
        ],

        'tarifario_documentos' => [
            'titulo' => 'Documentos relacionados',
            'items'  => [
                ['etiqueta' => 'Tarifario', 'titulo' => 'Tarifario del Depósito Temporal', 'fecha' => 'Vigente desde el 23-10-2025', 'archivo' => ['_file' => 'assets/docs/tarifario-deposito-temporal.pdf']],
                ['etiqueta' => 'Política', 'titulo' => 'Política Comercial y Descuentos', 'fecha' => 'Vigente desde el 07-10-2020', 'archivo' => ['_file' => 'assets/docs/politica-comercial.pdf']],
                ['etiqueta' => 'Reglamento', 'titulo' => 'Reglamento de Operaciones · REIN-TPY-001', 'fecha' => 'Aprobado el 15-06-2026', 'archivo' => ['_file' => 'assets/docs/reop-2026.pdf']],
            ],
        ],

        'tarifario_faq' => [
            'etiqueta'    => 'Ayuda',
            'titulo'      => 'Preguntas frecuentes',
            'descripcion' => 'Respuestas a las consultas más comunes sobre la aplicación de las tarifas.',
            'items'       => [
                ['pregunta' => '¿En qué moneda se cobran los servicios?', 'respuesta' => 'Todas las tarifas del terminal se expresan en soles (S/) y no incluyen el IGV, salvo que el documento indique expresamente lo contrario. El impuesto se agrega al momento de la facturación, según la normativa tributaria vigente. En el caso de servicios prestados a usuarios del exterior, la moneda y el tratamiento tributario se confirman con el área comercial antes de emitir la cotización.'],
                ['pregunta' => '¿Cada cuánto se actualiza el tarifario?', 'respuesta' => 'El tarifario se actualiza cuando OSITRAN aprueba una nueva versión. Cada versión indica su fecha de vigencia y se publica en esta página.'],
                ['pregunta' => '¿Dónde encuentro las versiones anteriores del tarifario?', 'respuesta' => 'En la sección Versiones del tarifario de esta página, ordenadas por año.'],
                ['pregunta' => '¿Dónde encuentro el tarifario del Depósito Temporal?', 'respuesta' => 'En Documentos relacionados de esta página y en la sección Depósito Temporal.'],
                ['pregunta' => '¿Aplican descuentos sobre las tarifas?', 'respuesta' => 'Los descuentos se aplican según la Política Comercial y Descuentos vigente, disponible en Documentos relacionados.'],
            ],
        ],

        'tarifario_cta' => [
            'titulo' => '¿Necesitas una cotización?',
            'bajada' => 'Nuestro equipo Comercial calcula el costo de tu operación según el tarifario vigente.',
            'boton'  => ['title' => 'Solicitar cotización', 'url' => '/contacto/#formulario'],
            'imagen' => ['_file' => 'assets/img/cta-tarifario.webp', 'alt' => 'Camión en la báscula del terminal'],
        ],
    ],
];
