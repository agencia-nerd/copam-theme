<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Compromiso Ambiental (spec `compromiso-ambiental`). Lo carga inc/acf/runner.php una sola vez
 * por grupo: lo que el cliente edite después no se sobrescribe. Las imágenes pasan a la biblioteca de medios.
 */
return [
    'page'   => 'compromiso-ambiental',
    'fields' => [
        'compromiso_ambiental_hero' => [
            'titulo' => 'Compromiso Ambiental',
            'bajada' => 'Operamos en la Amazonía peruana, a orillas del río Huallaga. Conoce la política ambiental y los instrumentos de gestión que orientan nuestra operación.',
            'imagen' => ['_file' => 'assets/img/ambiental-hero-v2.webp', 'alt' => 'Reach stacker cargando un contenedor sobre un camión en el patio del terminal, con vegetación amazónica al fondo'],
        ],

        'compromiso_ambiental_indice' => [
            'titulo' => 'En esta página',
            'enlace' => ['title' => 'Nosotros', 'url' => '/nosotros/'],
        ],

        'compromiso_ambiental_compromiso' => [
            'titulo' => 'Nuestro compromiso',
            'texto'  => 'El Terminal Portuario de Yurimaguas – Nueva Reforma opera a orillas del río Huallaga, en un entorno amazónico de alto valor ecológico. Por eso integramos la prevención de impactos ambientales en la planificación de nuestras operaciones, cumplimos la normativa ambiental aplicable y promovemos prácticas responsables entre nuestros colaboradores, usuarios y proveedores.',
            'imagen' => ['_file' => 'assets/img/ambiental-rio-v2.webp', 'alt' => 'Comunidad ribereña reflejada en un río amazónico'],
        ],

        'compromiso_ambiental_politica' => [
            'titulo'      => 'Política ambiental',
            'intro'       => 'Nuestra política ambiental forma parte de la Política del Sistema Integrado de Gestión, con un sistema de gestión ambiental certificado en ISO 14001 (AENOR GA-2018/0324).',
            'compromisos' => [
                ['texto' => 'Conservar el ambiente mediante el buen uso de nuestros recursos y la prevención de la contaminación.'],
                ['texto' => 'Contribuir a la mitigación (reducción de emisiones) y a la adaptación del terminal ante el cambio climático.'],
            ],
            'enlace'      => ['title' => 'Ver Sistema Integrado de Gestión', 'url' => '/sistema-integrado-de-gestion/'],
        ],

        'compromiso_ambiental_operacion' => [
            'titulo' => 'Cómo lo aplicamos en la operación',
            'items'  => [
                ['titulo' => 'Prevención de derrames', 'texto' => 'Las áreas de trabajo cuentan con kits antiderrames para evitar la contaminación del suelo y del agua.'],
                ['titulo' => 'Gestión de residuos', 'texto' => 'Los residuos generados en cada actividad se disponen conforme al procedimiento de gestión de residuos del terminal.'],
                ['titulo' => 'Recojo de residuos de naves', 'texto' => 'El recojo de residuos sólidos y líquidos lo realizan empresas con licencia de la APN, que entregan el Certificado de Descarga de Residuos.'],
                ['titulo' => 'Reglas para usuarios y proveedores', 'texto' => 'Está prohibido generar vertimientos, emisiones, derrames o abandonar residuos dentro del terminal.'],
            ],
        ],

        'compromiso_ambiental_instrumentos' => [
            'titulo'            => 'Instrumentos de gestión ambiental',
            'texto'             => 'COPAM cuenta con un Instrumento de Gestión Ambiental (IGA) aprobado.',
            'imagen_principal'  => ['_file' => 'assets/img/ambiental-mono-v2.webp', 'alt' => 'Mono tocón descansando sobre una rama en la Amazonía'],
            'imagen_secundaria' => ['_file' => 'assets/img/ambiental-tucan-v2.webp', 'alt' => 'Tucán posado sobre una rama en el bosque amazónico'],
        ],

        'compromiso_ambiental_cumplimiento' => [
            'titulo' => 'Cumplimiento normativo',
            'texto'  => 'La operación del terminal se rige por el Contrato de Concesión, el Reglamento de Operaciones aprobado por la Autoridad Portuaria Nacional y la normativa ambiental aplicable a la actividad portuaria.',
            'imagen' => ['_file' => 'assets/img/ambiental-aereo-v2.webp', 'alt' => 'Vista aérea de un río amazónico entre el bosque tropical'],
            'enlace' => ['title' => 'Ver Normativa OSITRAN', 'url' => '/normativa-ositran/'],
        ],

        'compromiso_ambiental_galeria' => [
            'imagenes' => [
                ['_file' => 'assets/img/ambiental-bosque-v2.webp', 'alt' => 'Bosque tropical y casas ribereñas reflejadas en un río amazónico'],
                ['_file' => 'assets/img/ambiental-guacamayos-v2.webp', 'alt' => 'Pareja de guacamayos rojos posados en una rama del bosque amazónico'],
                ['_file' => 'assets/img/ambiental-terminal-v2.webp', 'alt' => 'Vista aérea del terminal portuario rodeado de bosque amazónico junto al río'],
            ],
        ],

        'compromiso_ambiental_acceso' => [
            'titulo'      => 'Conoce más sobre COPAM',
            'descripcion' => 'La concesión, nuestra misión y visión, y cómo operamos.',
            'boton'       => ['title' => 'Ir a Nosotros', 'url' => '/nosotros/'],
            'imagen'      => ['_file' => 'assets/img/cta-nosotros.webp', 'alt' => 'Equipo de COPAM en el terminal'],
        ],
    ],
];
