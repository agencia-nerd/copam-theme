<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Servicios al pasajero (spec `servicios-al-pasajero`). Lo carga inc/acf/runner.php una sola vez por grupo:
 * lo que el cliente edite después no se sobrescribe. Los enlaces a páginas del sitio son rutas relativas (/pagina/), así funcionan igual en local y en producción.
 */
return [
    'page'   => 'servicios-al-pasajero',
    'fields' => [
        'servicios_al_pasajero_hero' => [
            'titulo'         => 'Servicios al pasajero',
            'bajada'         => 'Embarque y desembarque de pasajeros en el Terminal Portuario de Yurimaguas – Nueva Reforma, con control de acceso, de equipaje y atención preferente.',
            'boton'          => ['title' => 'Solicitar cotización', 'url' => '/contacto/#formulario'],
            'imagen'         => ['_file' => 'assets/img/hero-1.webp', 'alt' => 'Vista aérea del Terminal Portuario de Yurimaguas – Nueva Reforma junto al río'],
            'accesos_titulo' => 'Accesos directos',
            'accesos'        => [
                ['enlace' => ['title' => 'Qué incluye', 'url' => '#que-incluye']],
                ['enlace' => ['title' => 'Infraestructura', 'url' => '#infraestructura']],
                ['enlace' => ['title' => 'Tarifas', 'url' => '#tarifas']],
                ['enlace' => ['title' => 'Documentos relacionados', 'url' => '#documentos']],
                ['enlace' => ['title' => 'Preguntas frecuentes', 'url' => '#faq']],
            ],
        ],

        'servicios_al_pasajero_que_incluye' => [
            'titulo' => 'Qué incluye',
            'items'  => [
                ['titulo' => 'Embarque y desembarque', 'descripcion' => 'Acceso seguro desde la nave hasta la salida del terminal y viceversa, con los equipos, recursos y ambientes preparados para recibir al pasajero.'],
                ['titulo' => 'Control de boarding pass', 'descripcion' => 'Verificación del boarding pass de cada pasajero al momento del embarque y del desembarque.'],
                ['titulo' => 'Control de equipaje', 'descripcion' => 'Inspección de equipaje, independiente de los controles aduaneros que realiza la SUNAT.'],
                ['titulo' => 'Atención médica y de emergencias', 'descripcion' => 'Atención al pasajero en caso de ser necesaria.'],
            ],
            'nota'   => 'Se prioriza el embarque y desembarque de personas con discapacidad, adultos mayores, mujeres gestantes y menores de edad.',
        ],

        'servicios_al_pasajero_infraestructura' => [
            'titulo' => 'Infraestructura para pasajeros',
            'items'  => [
                ['titulo' => 'Muelle de pasajeros', 'descripcion' => 'Pontón flotante de 10 m x 5 m con pilotes deslizantes que se adaptan al nivel del río y pasarela basculante.'],
                ['titulo' => 'Accesibilidad', 'descripcion' => 'Escaleras y ascensor para personas con discapacidad.'],
                ['titulo' => 'Terminal de Pasajeros', 'descripcion' => 'Áreas de espera y atención, separadas de la zona de operaciones de carga (fuera de la Zona PBIP).'],
                ['titulo' => 'Estacionamiento', 'descripcion' => 'Espacios para 2 buses, 7 automóviles (1 para personas con discapacidad), 6 motocicletas y 4 mototaxis, con accesos separados del tránsito pesado.'],
            ],
        ],

        'servicios_al_pasajero_tarifas' => [
            'titulo'             => 'Tarifas',
            'columna_prestacion' => 'Prestación',
            'columna_unidad'     => 'Unidad de cobro',
            'filas'              => [
                ['prestacion' => 'Servicio al pasajero (servicio estándar, regulado)', 'unidad' => 'Pasajero embarcado o desembarcado'],
            ],
            'nota'               => '<p>Los montos se aplican según el Tarifario de Servicios Portuarios vigente, aprobado por OSITRAN. Consulta el documento oficial en la página de <a href="/tarifario/">Tarifario</a>. El pago se realiza antes de soltar amarre de la nave de transporte.</p>',
        ],

        'servicios_al_pasajero_documentos' => [
            'titulo' => 'Documentos relacionados',
            'items'  => [
                ['etiqueta' => 'Tarifario', 'titulo' => 'Tarifario de Servicios Portuarios', 'fecha' => 'Vigente desde el 16-06-2026', 'archivo' => ['_file' => 'assets/docs/tarifario-2026-06-16.pdf']],
                ['etiqueta' => 'Reglamento', 'titulo' => 'Reglamento de Tarifas y Precios de COPAM · V 5.3', 'fecha' => 'Vigente desde junio de 2026', 'archivo' => ['_file' => 'assets/docs/reta-v5-3.pdf']],
                ['etiqueta' => 'Reglamento', 'titulo' => 'Reglamento de Operaciones · REIN-TPY-001', 'fecha' => 'Aprobado el 15-06-2026', 'archivo' => ['_file' => 'assets/docs/reop-2026.pdf']],
            ],
        ],

        'servicios_al_pasajero_faq' => [
            'etiqueta'    => 'Ayuda',
            'titulo'      => 'Preguntas frecuentes',
            'descripcion' => 'Respuestas a las consultas más comunes sobre los servicios al pasajero.',
            'items'       => [
                ['pregunta' => '¿Qué incluye el servicio al pasajero?', 'respuesta' => 'Las facilidades para el embarque y desembarque de pasajeros: acceso seguro entre la nave y la salida del terminal, control de boarding pass, control de equipaje y atención médica o de emergencias cuando sea necesaria.'],
                ['pregunta' => '¿Cómo se cobra?', 'respuesta' => 'Por pasajero embarcado o desembarcado, según el tarifario vigente. El pago se realiza antes de soltar amarre de la nave.'],
                ['pregunta' => '¿Qué información debe enviar la nave o agencia antes del arribo?', 'respuesta' => 'Para naves de pasajeros, la lista de pasajeros, la lista de tripulantes y los requerimientos especiales, 24 horas antes del arribo estimado (ETA).'],
                ['pregunta' => '¿Cuándo pueden embarcar o desembarcar los pasajeros?', 'respuesta' => 'Una vez cumplidos los controles respectivos ante Migraciones y SUNAT.'],
                ['pregunta' => '¿El terminal brinda servicios turísticos o de recreación?', 'respuesta' => 'No. El terminal no brinda servicios de recreación a los pasajeros durante la estadía de las naves.'],
            ],
        ],

        'servicios_al_pasajero_cta' => [
            'titulo' => '¿Necesitas cotizar un servicio o coordinar una operación?',
            'bajada' => 'Te acompañamos desde la cotización hasta la operación en el terminal.',
            'boton'  => ['title' => 'Contáctanos', 'url' => '/contacto/#formulario'],
            'imagen' => ['_file' => 'assets/img/hero-4-1280.webp', 'alt' => 'Accesos y edificios administrativos del terminal'],
        ],
    ],
];
