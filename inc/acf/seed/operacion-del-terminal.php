<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Operación del terminal (spec `operacion-del-terminal`). Lo carga inc/acf/runner.php una sola vez por grupo:
 * lo que el cliente edite después no se sobrescribe. Los enlaces a páginas del sitio son rutas relativas (/pagina/), así funcionan igual en local y en producción.
 * El REOP vigente (reop-2026.pdf) se usa en tres campos: hero, primera tarjeta de información y versión 2026.
 */
return [
    'page'   => 'operacion-del-terminal',
    'fields' => [
        'operacion_del_terminal_hero' => [
            'titulo'         => 'Operaciones',
            'bajada'         => 'Reglamento de Operaciones, horario de atención e infraestructura disponible para la atención de naves, carga y unidades de transporte en el terminal.',
            'boton_texto'    => 'Descargar REOP',
            'boton_archivo'  => ['_file' => 'assets/docs/reop-2026.pdf'],
            'imagen'         => ['_file' => 'assets/img/operacion-hero.webp', 'alt' => 'Grúa celosía en el muelle del terminal junto a una nave fluvial cargada con madera en el río Huallaga'],
            'accesos_titulo' => 'Accesos directos',
            'accesos'        => [
                ['enlace' => ['title' => 'Versiones del REOP', 'url' => '#versiones']],
                ['enlace' => ['title' => 'Horario de atención', 'url' => '#informacion']],
                ['enlace' => ['title' => 'Infraestructura y equipamiento', 'url' => '#infraestructura']],
                ['enlace' => ['title' => 'Tarifario', 'url' => '/tarifario/']],
                ['enlace' => ['title' => 'Preguntas frecuentes', 'url' => '#faq']],
            ],
        ],

        'operacion_del_terminal_informacion' => [
            'titulo'   => 'Información operativa',
            'tarjetas' => [
                [
                    'titulo'      => 'Reglamento de Operaciones',
                    'descripcion' => 'Código REIN-TPY-001, aprobado mediante Resolución de Gerencia General N.° 0344-2026-APN/GG del 15-06-2026.',
                    'archivo'     => ['_file' => 'assets/docs/reop-2026.pdf'],
                    'boton_texto' => 'Descargar REOP',
                ],
                [
                    'titulo'      => 'Horario de atención',
                    'descripcion' => 'Atención operativa las 24 horas, de forma continua. Atención documental de lunes a viernes de 08:00 a 17:00 h y sábados de 08:00 a 13:00 h, excepto feriados.',
                    'boton'       => ['title' => 'Contactar operaciones', 'url' => '/contacto/#canales'],
                ],
                [
                    'titulo'      => 'Infraestructura',
                    'descripcion' => 'Muelle marginal de 120 × 47 m, patio de contenedores y equipamiento de maniobra propio.',
                    'boton'       => ['title' => 'Ver infraestructura', 'url' => '#infraestructura'],
                ],
            ],
        ],

        'operacion_del_terminal_infraestructura' => [
            'titulo'            => 'Infraestructura y equipamiento',
            'columna_elemento'  => 'Elemento',
            'columna_capacidad' => 'Capacidad',
            'grupos'            => [
                [
                    'nombre' => 'Infraestructura',
                    'filas'  => [
                        ['elemento' => 'Muelle marginal', 'capacidad' => '120 m × 47 m'],
                        ['elemento' => 'Almacén techado', 'capacidad' => '6,092 m²'],
                        ['elemento' => 'Patio de contenedores', 'capacidad' => '10,000 m²'],
                        ['elemento' => 'Cámara de frío', 'capacidad' => '600 m²'],
                        ['elemento' => 'Tomas reefer', 'capacidad' => '72'],
                    ],
                ],
                [
                    'nombre' => 'Equipamiento',
                    'filas'  => [
                        ['elemento' => 'Grúa celosía', 'capacidad' => '130 t'],
                        ['elemento' => 'Grúa camión', 'capacidad' => '55 t'],
                        ['elemento' => 'Reach stacker', 'capacidad' => '45 t'],
                    ],
                ],
            ],
        ],

        'operacion_del_terminal_versiones' => [
            'titulo'        => 'Versiones del Reglamento de Operaciones (REOP)',
            'boton_texto'   => 'Descargar PDF',
            'vigente_texto' => 'Vigente',
            'vacio'         => 'Los documentos de esta sección se publicarán próximamente.',
            'anios'         => [
                [
                    'anio'       => '2026',
                    'documentos' => [
                        ['titulo' => 'Reglamento de Operaciones del TPY-NR · Código REIN-TPY-001', 'subtitulo' => 'Res. N.° 0344-2026-APN/GG · 15-06-2026', 'vigente' => 1, 'archivo' => ['_file' => 'assets/docs/reop-2026.pdf']],
                    ],
                ],
                [
                    'anio'       => '2024',
                    'documentos' => [
                        ['titulo' => 'Reglamento de Operaciones del TPY-NR · V 2024', 'subtitulo' => 'Res. de Gerencia General N.° 0271-2024-APN-GG (24-04-2024)', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/reop-2024.pdf']],
                    ],
                ],
                [
                    'anio'       => '2020',
                    'documentos' => [
                        ['titulo' => 'Reglamento de Operaciones del TPY-NR · V 2020', 'subtitulo' => 'Res. de Gerencia General N.° 0323-2020-APN-GG', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/reop-2020.pdf']],
                    ],
                ],
            ],
        ],

        'operacion_del_terminal_faq' => [
            'etiqueta'    => 'Ayuda',
            'titulo'      => 'Preguntas frecuentes',
            'descripcion' => 'Respuestas a las consultas más comunes sobre la operación del terminal.',
            'items'       => [
                ['pregunta' => '¿Qué es el Reglamento de Operaciones (REOP)?', 'respuesta' => 'Es el reglamento aprobado por la Autoridad Portuaria Nacional que regula los procedimientos operativos, los estándares de seguridad y las condiciones de uso del terminal. La versión vigente, con código REIN-TPY-001, fue aprobada el 15-06-2026.'],
                ['pregunta' => '¿Cuál es el horario de atención de Operaciones?', 'respuesta' => 'La atención operativa es continua, las 24 horas. La atención documental es de lunes a viernes de 08:00 a 17:00 h y los sábados de 08:00 a 13:00 h, excepto feriados. Fuera de ese horario, las solicitudes de servicio enviadas por correo se evalúan según disponibilidad.'],
                ['pregunta' => '¿Qué necesito para ingresar al terminal?', 'respuesta' => 'Las unidades de transporte y el personal deben cumplir los requisitos de acceso y seguridad establecidos en el Reglamento de Operaciones.'],
                ['pregunta' => '¿Cómo coordino el arribo de una nave?', 'respuesta' => 'Con el área de Operaciones, enviando la información de arribo con la anticipación que indica el Reglamento de Operaciones.'],
                ['pregunta' => '¿Dónde encuentro las versiones anteriores del REOP?', 'respuesta' => 'En la sección Versiones del Reglamento de Operaciones de esta página, ordenadas por año.'],
            ],
        ],

        'operacion_del_terminal_cta' => [
            'titulo' => '¿Necesitas coordinar una operación?',
            'bajada' => 'La atención operativa del terminal funciona las 24 horas, de forma continua.',
            'boton'  => ['title' => 'Contáctanos', 'url' => '/contacto/#formulario'],
            'imagen' => ['_file' => 'assets/img/cta-operacion.webp', 'alt' => 'Montacargas trasladando tubos en el patio del terminal'],
        ],
    ],
];
