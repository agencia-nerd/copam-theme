<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Nosotros (spec `nosotros`). Lo carga inc/acf/runner.php una sola vez por grupo:
 * lo que el cliente edite después no se sobrescribe. Los enlaces a páginas del sitio son rutas relativas (/pagina/), así funcionan igual en local y en producción.
 */
return [
    'page'   => 'nosotros',
    'fields' => [
        'nosotros_hero' => [
            'titulo' => 'Nosotros',
            'bajada' => 'Concesionaria Puerto Amazonas S.A. diseña, financia, construye, opera y conserva el Terminal Portuario de Yurimaguas – Nueva Reforma, en concesión del Estado peruano.',
            'imagen' => ['_file' => 'assets/img/nosotros-hero.webp', 'alt' => 'Muelle del terminal con barcaza atracada, grúa, almacenes y equipo de operaciones'],
        ],

        'nosotros_indice' => [
            'titulo' => 'En esta página',
            'enlace' => ['title' => 'Compromiso Ambiental', 'url' => '/compromiso-ambiental/'],
        ],

        'nosotros_mision' => [
            'titulo' => 'Misión',
            'texto'  => 'Brindar servicios portuarios eficientes, seguros y confiables en el Terminal Portuario de Yurimaguas – Nueva Reforma, articulando la red vial del norte del Perú con la red fluvial amazónica, para impulsar el comercio de la región y contribuir al desarrollo sostenible de las comunidades en las que operamos.',
        ],

        'nosotros_vision' => [
            'titulo' => 'Visión',
            'texto'  => 'Ser el nodo logístico de referencia del Eje Multimodal Amazonas Norte, reconocido por la calidad de su servicio, su cumplimiento regulatorio y su compromiso con el medio ambiente, conectando la Amazonía peruana con los mercados del Pacífico y del Atlántico.',
        ],

        'nosotros_concesion' => [
            'titulo'    => 'La concesión',
            'subtitulo' => 'Terminal Portuario de Yurimaguas – Nueva Reforma',
            'bajada'    => 'Operado por Concesionaria Puerto Amazonas S.A. (COPAM), concesionario del terminal',
            'texto'     => 'El Terminal Portuario de Yurimaguas – Nueva Reforma se encuentra en etapa de explotación desde el 15 de diciembre de 2016. Su diseño, financiamiento, construcción, explotación y conservación están a cargo de Concesionaria Puerto Amazonas S.A., persona jurídica de derecho privado constituida como sociedad anónima, conforme al Contrato de Concesión suscrito con el Estado peruano el 31 de mayo de 2011.',
            'datos'     => [
                ['etiqueta' => 'Concesionario', 'valor' => 'Concesionaria Puerto Amazonas S.A.'],
                ['etiqueta' => 'Concedente', 'valor' => 'Estado peruano, a través del Ministerio de Transportes y Comunicaciones'],
                ['etiqueta' => 'Regulador', 'valor' => 'OSITRAN'],
                ['etiqueta' => 'Autoridad portuaria', 'valor' => 'Autoridad Portuaria Nacional (APN)'],
                ['etiqueta' => 'Gerencia General', 'valor' => 'Ing. Carmen Benítez Hernández'],
            ],
            'imagen'    => ['_file' => 'assets/img/hero-1-1280.webp', 'alt' => 'Vista aérea del terminal junto al río Huallaga'],
        ],

        'nosotros_sistema' => [
            'titulo'    => 'Sistema integrado de gestión',
            'subtitulo' => 'ISO 9001 · ISO 14001 · ISO 45001',
            'texto'     => 'Gestionamos la operación y conservación del Terminal Portuario de Yurimaguas – Nueva Reforma bajo un Sistema Integrado de Gestión que reúne en un solo marco tres normas internacionales: calidad, gestión ambiental y seguridad y salud en el trabajo. Está certificado por AENOR y reconocido por la red internacional IQNet.',
            'alcance'   => 'La certificación cubre la operación portuaria —servicios a la nave, a la carga y a los pasajeros— y la conservación del terminal: mantenimiento rutinario, periódico y reparación por emergencia.',
            'datos'     => [
                ['etiqueta' => 'ISO 9001', 'valor' => 'Gestión de la calidad · Certificado AENOR ER-0730/2018'],
                ['etiqueta' => 'ISO 14001', 'valor' => 'Gestión ambiental · Certificado AENOR GA-2018/0324'],
                ['etiqueta' => 'ISO 45001', 'valor' => 'Seguridad y salud en el trabajo · Certificado AENOR SST-0165/2018'],
                ['etiqueta' => 'Vigencia', 'valor' => 'Hasta el 10 de diciembre de 2027'],
                ['etiqueta' => 'Política del SIG', 'valor' => 'Aprobada por la Gerencia General el 21 de octubre de 2025'],
            ],
            'enlace'    => ['title' => 'Ver Sistema Integrado de Gestión', 'url' => '/sistema-integrado-de-gestion/'],
        ],

        'nosotros_operamos' => [
            'titulo' => 'Cómo operamos',
            'texto'  => 'El terminal opera bajo el Reglamento de Operaciones aprobado por la Autoridad Portuaria Nacional, cuya versión vigente (código REIN-TPY-001) fue aprobada el 15 de junio de 2026. Desde el inicio de sus operaciones en 2016 ha atendido 4,061 naves y movilizado 181,046.99 toneladas de carga. Además, opera bajo el Código Internacional para la Protección de los Buques y de las Instalaciones Portuarias (PBIP), con certificado vigente emitido por la DICAPI.',
            'imagen' => ['_file' => 'assets/img/nosotros-equipo.webp', 'alt' => 'Equipo de COPAM con la carga del primer piloto internacional hacia Brasil'],
            'enlace' => ['title' => 'Ver Operación del terminal', 'url' => '/operacion-del-terminal/'],
        ],

        'nosotros_acceso' => [
            'titulo'      => 'Compromiso Ambiental',
            'descripcion' => 'Política ambiental e instrumentos de gestión del terminal.',
            'boton'       => ['title' => 'Ver compromiso ambiental', 'url' => '/compromiso-ambiental/'],
            'imagen'      => ['_file' => 'assets/img/ambiental-acceso.webp', 'alt' => 'Vista aérea del terminal rodeado de bosque amazónico'],
        ],
    ],
];
