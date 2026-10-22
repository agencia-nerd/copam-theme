<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de la portada (spec `home`). Lo carga inc/acf/runner.php una sola vez por grupo:
 * lo que el cliente edite después no se sobrescribe. Imágenes y PDF pasan a la biblioteca de medios. Los enlaces a páginas del sitio son rutas relativas (/pagina/), así
 * funcionan igual en local y en producción.
 */
return [
    'page'   => 'home',
    'fields' => [
        'home_hero' => [
            'titulo_linea_1'  => 'Terminal Portuario',
            'titulo_linea_2'  => 'De Yurimaguas.',
            'titulo_linea_3'  => '(Nueva Reforma)',
            'descripcion'     => '|COPAM S.A.| opera el *Terminal Portuario de Yurimaguas – Nueva Reforma* bajo concesión del Estado peruano, articulando el Eje Multimodal Amazonas Norte con el resto del país.',
            'boton_tarifario' => ['title' => 'Tarifario vigente', 'url' => '/tarifario/'],
            'boton_servicios' => ['title' => 'Ver servicios', 'url' => '#servicios'],
            'slides'          => [
                ['imagen' => ['_file' => 'assets/img/hero-1.webp', 'alt' => 'Vista aérea del Terminal Portuario de Yurimaguas – Nueva Reforma junto al río'], 'alt' => 'Vista aérea del Terminal Portuario de Yurimaguas – Nueva Reforma junto al río'],
                ['imagen' => ['_file' => 'assets/img/hero-2.webp', 'alt' => 'Carga de proyecto sobre una barcaza en el muelle del terminal'], 'alt' => 'Carga de proyecto sobre una barcaza en el muelle del terminal'],
                ['imagen' => ['_file' => 'assets/img/hero-3.webp', 'alt' => 'Reach stacker cargando un contenedor en el patio del terminal'], 'alt' => 'Reach stacker cargando un contenedor en el patio del terminal'],
                ['imagen' => ['_file' => 'assets/img/hero-4.webp', 'alt' => 'Accesos y edificios administrativos del terminal'], 'alt' => 'Accesos y edificios administrativos del terminal'],
            ],
        ],

        'home_reglamentos' => [
            'etiqueta'   => 'Cumplimiento de la concesión',
            'titulo'     => 'Reglamentos',
            'bajada'     => 'Documentos vigentes exigidos por la concesión y por OSITRAN.',
            'documentos' => [
                ['etiqueta' => 'OSITRAN', 'titulo' => 'Reglamento de Reclamos', 'descripcion' => 'Reglamento de Atención de Reclamos y Solución de Controversias de OSITRAN (Res. 019-2011-CD-OSITRAN y modificatorias).', 'archivo' => ['_file' => 'assets/docs/reglamento-reclamos-ositran.pdf']],
                ['etiqueta' => 'Tarifa', 'titulo' => 'Reglamento de Tarifas y Precios de COPAM', 'descripcion' => 'Reglamento de Tarifas y Precios, versión 5.3, vigente desde junio de 2026.', 'archivo' => ['_file' => 'assets/docs/reta-v5-3.pdf']],
                ['etiqueta' => 'OSITRAN', 'titulo' => 'Reglamento de Usuarios', 'descripcion' => 'Reglamento de Usuarios de las Infraestructuras de Transporte de Uso Público de OSITRAN, Res. N.° 035-2017-CD-OSITRAN.', 'archivo' => ['_file' => 'assets/docs/reglamento-usuarios-ositran.pdf']],
                ['etiqueta' => 'Operaciones', 'titulo' => 'REOP', 'descripcion' => 'Reglamento de Operaciones del TPY-NR · Código REIN-TPY-001, aprobado el 15-06-2026.', 'archivo' => ['_file' => 'assets/docs/reop-2026.pdf']],
            ],
            'enlace'     => ['title' => 'Ver toda la normativa', 'url' => '/normativa-ositran/'],
        ],

        'home_conoce' => [
            'etiqueta' => '[ Conoce COPAM ]',
            'paneles'  => [
                [
                    'imagen'      => ['_file' => 'assets/img/terminal-bg.webp', 'alt' => 'Equipo de operaciones reunido en el muelle del terminal junto a una nave y carga de proyecto'],
                    'alt'         => 'Equipo de operaciones reunido en el muelle del terminal junto a una nave y carga de proyecto',
                    'titulo'      => 'El terminal',
                    'descripcion' => 'Infraestructura fluvial multipropósito que articula la red vial del norte del Perú con la red fluvial amazónica, integrada al Eje Multimodal Amazonas Norte.',
                    'cifras'      => [
                        ['numero' => '2016', 'rotulo' => 'Inicio de operaciones'],
                        ['numero' => '600 mil t', 'rotulo' => 'Capacidad instalada anual'],
                        ['numero' => '181,046.99 t', 'rotulo' => 'Carga movilizada'],
                        ['numero' => '4,061', 'rotulo' => 'Naves atendidas'],
                    ],
                ],
                [
                    'imagen'      => ['_file' => 'assets/img/infra-bg.webp', 'alt' => 'Almacén techado del terminal con montacargas y carga de madera apilada'],
                    'alt'         => 'Almacén techado del terminal con montacargas y carga de madera apilada',
                    'titulo'      => 'Infraestructura principal',
                    'descripcion' => 'Almacenamiento techado y refrigerado, patio de contenedores, muelle marginal y equipamiento de maniobra.',
                    'cifras'      => [
                        ['numero' => '6,092 m²', 'rotulo' => 'Almacén techado'],
                        ['numero' => '10,000 m²', 'rotulo' => 'Patio de contenedores'],
                        ['numero' => '600 m²', 'rotulo' => 'Cámara de frío'],
                        ['numero' => '72', 'rotulo' => 'Tomas reefer'],
                        ['numero' => '120 × 47 m', 'rotulo' => 'Muelle marginal'],
                        ['numero' => '130 t', 'rotulo' => 'Grúa celosía principal'],
                    ],
                ],
                [
                    'imagen'      => ['_file' => 'assets/img/servicios-bg.webp', 'alt' => 'Grúa izando carga de proyecto en el muelle del terminal'],
                    'alt'         => 'Grúa izando carga de proyecto en el muelle del terminal',
                    'titulo'      => 'Servicios principales',
                    'descripcion' => 'Operación integral a la nave y a la carga: desde el amarre hasta el despacho, con soporte logístico y aduanero en el mismo terminal.',
                    'lista'       => [
                        ['texto' => 'Servicio a la nave y uso de amarradero'],
                        ['texto' => 'Embarque, descarga y transferencia'],
                        ['texto' => 'Almacenamiento y depósito'],
                        ['texto' => 'Contenedores secos y refrigerados'],
                        ['texto' => 'Carga fraccionada y de proyecto'],
                        ['texto' => 'Soporte logístico y aduanero'],
                        ['texto' => 'Carga rodante, granel sólido y líquido'],
                    ],
                ],
            ],
        ],

        'home_conectividad' => [
            'etiqueta' => 'Conectividad',
            'titulo'   => 'Eje Multimodal Amazonas Norte',
            'bajada'   => 'El TPY-NR es el nodo estratégico que conecta la red vial del norte del Perú con la red fluvial amazónica, articulando el tránsito de carga entre el Pacífico y el Atlántico.',
            'etapas'   => [
                ['titulo' => 'Pacífico / Paita', 'imagen' => ['_file' => 'assets/img/conn-paita.webp', 'alt' => 'Pacífico / Paita'], 'puntos' => [
                    ['texto' => 'Puerto de salida al océano Pacífico'], ['texto' => 'Conexión con el corredor IIRSA Norte'], ['texto' => 'Transferencia marítimo–terrestre'], ['texto' => 'Acceso a rutas de Asia–Pacífico'],
                ]],
                ['titulo' => 'IIRSA Norte', 'imagen' => ['_file' => 'assets/img/conn-iirsa.webp', 'alt' => 'IIRSA Norte'], 'puntos' => [
                    ['texto' => 'Corredor vial costa – sierra – selva'], ['texto' => 'Enlace carretero Paita – Yurimaguas'], ['texto' => 'Tránsito de carga pesada todo el año'],
                ]],
                ['titulo' => 'Yurimaguas', 'imagen' => ['_file' => 'assets/img/conn-yurimaguas.webp', 'alt' => 'Yurimaguas'], 'puntos' => [
                    ['texto' => 'Nodo de transferencia vial – fluvial'], ['texto' => 'Terminal Portuario de Yurimaguas Nueva Reforma'], ['texto' => 'Almacenamiento y servicios a la carga'],
                ]],
                ['titulo' => 'Iquitos', 'imagen' => ['_file' => 'assets/img/conn-iquitos.webp', 'alt' => 'Iquitos'], 'puntos' => [
                    ['texto' => 'Principal ciudad de la Amazonía peruana'], ['texto' => 'Abastecimiento regional por vía fluvial'], ['texto' => 'Conexión fluvial con Yurimaguas'],
                ]],
                ['titulo' => 'Manaos / Roraima', 'imagen' => ['_file' => 'assets/img/conn-manaus.webp', 'alt' => 'Manaos / Roraima'], 'puntos' => [
                    ['texto' => 'Conexión con Brasil por el Amazonas'], ['texto' => 'Ruta del primer piloto internacional Roraima–Manaos–Iquitos–Yurimaguas'], ['texto' => 'Flujos de intercambio Brasil–Perú'],
                ]],
                ['titulo' => 'Amazonas / Atlántico', 'imagen' => ['_file' => 'assets/img/conn-atlantico.webp', 'alt' => 'Amazonas / Atlántico'], 'puntos' => [
                    ['texto' => 'Red fluvial amazónica hacia el este'], ['texto' => 'Proyección logística hacia el océano Atlántico'],
                ]],
            ],
        ],

        'home_carga' => [
            'titulo'      => 'Carga de la Amazonía',
            'imagen'      => ['_file' => 'assets/img/carga-amazonia-2400.webp', 'alt' => 'Reach stacker descargando un generador desde un camión en el patio del terminal'],
            'alt'         => 'Reach stacker descargando un generador desde un camión en el patio del terminal',
            'tipos'       => [
                ['nombre' => 'Madera y triplay'], ['nombre' => 'Estructuras de fierro'], ['nombre' => 'Carga fraccionada'], ['nombre' => 'Contenedores y reefer'], ['nombre' => 'Torta de soya Brasil'],
            ],
            'descripcion' => 'Movemos la carga que abastece y conecta a la región: desde insumos para la construcción hasta productos de exportación.',
        ],

        'home_caso_destacado' => [
            'imagen_grande'  => ['_file' => 'assets/img/piloto-camiones.webp', 'alt' => 'Vista aérea de camiones con la carga del primer piloto internacional en el patio del terminal'],
            'alt_grande'     => 'Vista aérea de camiones con la carga del primer piloto internacional en el patio del terminal',
            'imagen_pequena' => ['_file' => 'assets/img/piloto-equipo.webp', 'alt' => 'Equipo del terminal junto a la carga del primer piloto internacional con bandera de Brasil'],
            'alt_pequena'    => 'Equipo del terminal junto a la carga del primer piloto internacional con bandera de Brasil',
            'etiqueta'       => 'Caso destacado',
            'titulo'         => 'Primer piloto internacional del corredor amazónico',
            'descripcion'    => 'Torta de soya desde Roraima, Brasil, mediante la ruta Roraima–Manaos–Iquitos–Yurimaguas–Tarapoto. La operación validó en condiciones reales la viabilidad técnica y comercial del corredor multimodal.',
            'cifras'         => [
                ['numero' => '2,000 t', 'rotulo' => 'Total movilizado'],
                ['numero' => '15 días', 'rotulo' => 'Recorrido fluvial'],
                ['numero' => 'Brasil – Perú', 'rotulo' => 'Ruta internacional'],
            ],
        ],

        'home_servicios' => [
            'etiqueta' => 'Qué hacemos',
            'titulo'   => 'Servicios',
            'bajada'   => 'Cada servicio está descrito con la misma denominación del tarifario vigente.',
            'items'    => [
                ['titulo' => 'Servicios a la nave', 'descripcion' => 'Amarre y desamarre y uso de amarradero para las naves que recalan en el terminal.', 'enlace' => ['title' => 'Ver detalle de Servicios a la nave', 'url' => '/servicios-a-la-nave/']],
                ['titulo' => 'Servicios a la carga', 'descripcion' => 'Embarque, descarga, transferencia y almacenamiento de carga general, contenedores y graneles.', 'enlace' => ['title' => 'Ver detalle de Servicios a la carga', 'url' => '/servicios-a-la-carga/']],
                ['titulo' => 'Servicios especiales', 'descripcion' => 'Almacenamiento prolongado, consolidación, pesaje, energía reefer, provisión de equipos y otros servicios del tarifario vigente.', 'enlace' => ['title' => 'Ver detalle de Servicios especiales', 'url' => '/servicios-especiales/']],
                ['titulo' => 'Depósito temporal', 'descripcion' => 'Recepción, almacenamiento y retiro de mercancía bajo control aduanero de SUNAT, con requisitos y plazos propios.', 'enlace' => ['title' => 'Ver detalle de Depósito temporal', 'url' => '/deposito-temporal/']],
                ['titulo' => 'Servicios al pasajero', 'descripcion' => 'Embarque, desembarque y tránsito de pasajeros en naves fluviales, con áreas de espera y control de acceso.', 'enlace' => ['title' => 'Ver detalle de Servicios al pasajero', 'url' => '/servicios-al-pasajero/']],
            ],
        ],

        'home_desarrollo_futuro' => [
            'etiqueta'         => 'Proyección',
            'titulo'           => 'Desarrollo futuro',
            'bajada'           => 'Infraestructura con capacidad de expansión: un marco de planificación aprobado y una fase de crecimiento prevista en la concesión.',
            'plan_etiqueta'    => 'Plan Maestro · APN',
            'plan_titulo'      => 'Aprobado en mayo de 2025',
            'plan_descripcion' => 'La Autoridad Portuaria Nacional aprobó el Plan Maestro del Terminal Portuario de Yurimaguas Nueva Reforma. Es el marco técnico que orienta el desarrollo ordenado del terminal y las decisiones sobre su evolución.',
            'plan_nota'        => 'Resolución de Acuerdo de Directorio N.° 0052-2025-APN-DIR',
            'fase_etiqueta'    => 'Fase II contractual',
            'fase_cifras'      => [
                ['numero' => '+400,000 t', 'rotulo' => 'Capacidad instalada adicional'],
                ['numero' => 'USD 13.8 M + IGV', 'rotulo' => 'Inversión referencial'],
            ],
            'fase_nota'        => 'Referencia de la concesión y del Plan de Negocios COPAM 2026. No forma parte del Plan Maestro.',
        ],

        'home_comunicados' => [
            'etiqueta' => 'Actualidad',
            'titulo'   => 'Comunicados',
            'bajada'   => 'Avisos operativos, novedades y publicaciones regulatorias del terminal.',
            'boton'    => ['title' => 'Ver todos los comunicados', 'url' => '/comunicados/'],
        ],

        'home_cta' => [
            'titulo'      => '¿Necesitas cotizar un servicio o coordinar una operación?',
            'descripcion' => 'Te acompañamos desde la cotización hasta la operación en el terminal.',
            'boton'       => ['title' => 'Contáctanos', 'url' => '/contacto/#formulario'],
            'imagen'      => ['_file' => 'assets/img/home-cta.webp', 'alt' => 'Montacargas y tráiler con carga en sacos en el patio del terminal'],
            'alt'         => 'Montacargas y tráiler con carga en sacos en el patio del terminal',
        ],
    ],
];
