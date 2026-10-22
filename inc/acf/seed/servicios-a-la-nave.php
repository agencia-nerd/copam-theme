<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Servicios a la nave (spec `servicios-a-la-nave`). Lo carga inc/acf/runner.php una sola vez por grupo:
 * lo que el cliente edite después no se sobrescribe. Los enlaces a páginas del sitio son rutas relativas (/pagina/), así funcionan igual en local y en producción.
 */
return [
    'page'   => 'servicios-a-la-nave',
    'fields' => [
        'servicios_a_la_nave_hero' => [
            'titulo'         => 'Servicios a la nave',
            'bajada'         => 'Amarre y desamarre y uso de amarradero para las naves que recalan en el Terminal Portuario de Yurimaguas – Nueva Reforma.',
            'boton'          => ['title' => 'Solicitar cotización', 'url' => '/contacto/#formulario'],
            'imagen'         => ['_file' => 'assets/img/servicio-nave-hero.webp', 'alt' => 'Barcaza atracada en el muelle del terminal, junto al almacén y el río Huallaga'],
            'accesos_titulo' => 'Accesos directos',
            'accesos'        => [
                ['enlace' => ['title' => 'Qué incluye', 'url' => '#que-incluye']],
                ['enlace' => ['title' => 'Tarifas', 'url' => '#tarifas']],
                ['enlace' => ['title' => 'Documentos relacionados', 'url' => '#documentos']],
                ['enlace' => ['title' => 'Preguntas frecuentes', 'url' => '#faq']],
            ],
        ],

        'servicios_a_la_nave_que_incluye' => [
            'titulo' => 'Qué incluye',
            'items'  => [
                ['titulo' => 'Amarre y desamarre', 'descripcion' => 'Fijación y liberación de las amarras de la nave durante el atraque y el zarpe.'],
                ['titulo' => 'Uso de amarradero', 'descripcion' => 'Permanencia de la nave atracada en el muelle marginal del terminal.'],
            ],
        ],

        'servicios_a_la_nave_tarifas' => [
            'titulo'             => 'Tarifas',
            'columna_prestacion' => 'Prestación',
            'columna_unidad'     => 'Unidad de cobro',
            'filas'              => [
                ['prestacion' => 'Servicio a la nave (uso de amarradero)', 'unidad' => 'Eslora-hora'],
            ],
            'nota'               => '<p>Los montos se aplican según el Tarifario de Servicios Portuarios vigente, aprobado por OSITRAN. Consulta el documento oficial en la página de <a href="/tarifario/">Tarifario</a>.</p>',
        ],

        'servicios_a_la_nave_documentos' => [
            'titulo' => 'Documentos relacionados',
            'items'  => [
                ['etiqueta' => 'Tarifario', 'titulo' => 'Tarifario de Servicios Portuarios', 'fecha' => 'Vigente desde el 16-06-2026', 'archivo' => ['_file' => 'assets/docs/tarifario-2026-06-16.pdf']],
                ['etiqueta' => 'Reglamento', 'titulo' => 'Reglamento de Tarifas y Precios de COPAM · V 5.3', 'fecha' => 'Vigente desde junio de 2026', 'archivo' => ['_file' => 'assets/docs/reta-v5-3.pdf']],
                ['etiqueta' => 'Reglamento', 'titulo' => 'Reglamento de Operaciones · REIN-TPY-001', 'fecha' => 'Aprobado el 15-06-2026', 'archivo' => ['_file' => 'assets/docs/reop-2026.pdf']],
                ['etiqueta' => 'Política', 'titulo' => 'Política Comercial y Descuentos', 'fecha' => 'Vigente desde el 07-10-2020', 'archivo' => ['_file' => 'assets/docs/politica-comercial.pdf']],
            ],
        ],

        'servicios_a_la_nave_faq' => [
            'etiqueta'    => 'Ayuda',
            'titulo'      => 'Preguntas frecuentes',
            'descripcion' => 'Respuestas a las consultas más comunes sobre los servicios a la nave.',
            'items'       => [
                ['pregunta' => '¿Qué incluye el servicio a la nave?', 'respuesta' => 'Incluye el amarre y desamarre y el uso de amarradero de las naves que recalan en el terminal.'],
                ['pregunta' => '¿Cómo se cobra el servicio estándar a la nave?', 'respuesta' => 'Se cobra por eslora-hora, según el tarifario vigente.'],
                ['pregunta' => '¿Con cuánta anticipación debo solicitar el servicio?', 'respuesta' => 'La solicitud debe enviarse con la anticipación indicada en el Reglamento de Operaciones, junto con la información de arribo de la nave.'],
                ['pregunta' => '¿Dónde consulto el tarifario vigente?', 'respuesta' => 'En la página de Tarifario de Zona Clientes o en la sección Documentos relacionados de esta página.'],
                ['pregunta' => '¿A quién contacto para coordinar el arribo de una nave?', 'respuesta' => 'Al área de Operaciones, a través de los canales de atención publicados en Contacto.'],
            ],
        ],

        'servicios_a_la_nave_cta' => [
            'titulo' => '¿Necesitas cotizar un servicio o coordinar una operación?',
            'bajada' => 'Te acompañamos desde la cotización hasta la operación en el terminal.',
            'boton'  => ['title' => 'Contáctanos', 'url' => '/contacto/#formulario'],
            'imagen' => ['_file' => 'assets/img/cta-nave.webp', 'alt' => 'Tanques de carga de proyecto en el patio, con la nave atracada en el muelle'],
        ],
    ],
];
