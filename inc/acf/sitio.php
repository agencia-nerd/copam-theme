<?php
defined('ABSPATH') || exit;

/*
 * Menús y logo del sitio (skill wp-acf). wp-acf registra las ubicaciones (principal, pie, legal) y, la
 * primera vez, crea cada menú con estos elementos para que el cliente los edite en Apariencia > Menús.
 * Los enlaces a páginas que aún no existen son enlaces personalizados con la ruta de la página.
 * Un elemento con la clase `subtitulo` es un encabezado sin enlace dentro del panel del menú.
 */
return [
    'menus' => [
        'principal' => [
            'nombre' => 'Menú principal',
            'items'  => [
                [
                    'titulo' => 'Nosotros',
                    'url' => '#',
                    'hijos' => [
                        ['titulo' => 'Nosotros', 'url' => '/nosotros/'],
                        ['titulo' => 'Sistema Integrado de Gestión', 'url' => '/sistema-integrado-de-gestion/'],
                        ['titulo' => 'Compromiso Ambiental', 'url' => '/compromiso-ambiental/'],
                    ],
                ],
                [
                    'titulo' => 'Reglamentos',
                    'url' => '#',
                    'hijos' => [
                        ['titulo' => 'Reglamento de Tarifas y Precios', 'url' => '/tarifario/#reta'],
                        ['titulo' => 'Contrato de concesión y adendas', 'url' => '/normativa-ositran/#contrato'],
                        ['titulo' => 'Normativa OSITRAN aplicable', 'url' => '/normativa-ositran/'],
                        ['titulo' => 'Transparencia', 'url' => '/transparencia/'],
                    ],
                ],
                [
                    'titulo' => 'Zona clientes',
                    'url' => '#',
                    'hijos' => [
                        ['titulo' => 'Información', 'url' => '#', 'clases' => 'subtitulo'],
                        ['titulo' => 'Comunicados y avisos', 'url' => '/comunicados/'],
                        ['titulo' => 'Tarifario', 'url' => '/tarifario/'],
                        ['titulo' => 'Operación del terminal', 'url' => '/operacion-del-terminal/'],
                        ['titulo' => 'Servicios', 'url' => '#', 'clases' => 'subtitulo'],
                        ['titulo' => 'Servicios a la nave', 'url' => '/servicios-a-la-nave/'],
                        ['titulo' => 'Servicios a la carga', 'url' => '/servicios-a-la-carga/'],
                        ['titulo' => 'Servicios al pasajero', 'url' => '/servicios-al-pasajero/'],
                        ['titulo' => 'Servicios especiales', 'url' => '/servicios-especiales/'],
                    ],
                ],
                [
                    'titulo' => 'Reclamos',
                    'url' => '#',
                    'hijos' => [
                        ['titulo' => 'Cómo reclamar', 'url' => '/reclamos/'],
                        ['titulo' => 'Presentar reclamo', 'url' => '/reclamos/#formulario'],
                        ['titulo' => 'Derechos del usuario', 'url' => '/reclamos/#derechos'],
                        ['titulo' => 'Libro de Reclamaciones', 'url' => '/libro-de-reclamaciones/'],
                    ],
                ],
                [
                    'titulo' => 'Contacto',
                    'url' => '#',
                    'hijos' => [
                        ['titulo' => 'Contacto', 'url' => '/contacto/'],
                        ['titulo' => 'Formulario de contacto', 'url' => '/contacto/#formulario'],
                        ['titulo' => 'Buzón de sugerencias', 'url' => '/contacto/#buzon'],
                        ['titulo' => 'Canal de hostigamiento sexual', 'url' => '/canal-hostigamiento-sexual/'],
                    ],
                ],
                [
                    'titulo' => 'Depósito temporal',
                    'url' => '#',
                    'hijos' => [
                        ['titulo' => 'Depósito Temporal', 'url' => '/deposito-temporal/'],
                        ['titulo' => 'Autorización SUNAT', 'url' => '/deposito-temporal/?cat=1#documentos'],
                        ['titulo' => 'Tarifario del depósito', 'url' => '/deposito-temporal/#tarifas'],
                        ['titulo' => 'Procedimientos y formatos', 'url' => '/deposito-temporal/?cat=2#documentos'],
                        ['titulo' => 'Quejas y reclamos', 'url' => '/deposito-temporal/#quejas-y-reclamos'],
                        ['titulo' => 'Seguimiento de carga', 'url' => 'http://45.232.151.188:8081/consultacarga/'],
                    ],
                ],
            ],
        ],
        'pie' => [
            'nombre' => 'Menú del pie',
            'items'  => [
                [
                    'titulo' => 'Nosotros',
                    'url' => '#',
                    'hijos' => [
                        ['titulo' => 'Quiénes somos', 'url' => '/nosotros/'],
                        ['titulo' => 'Sistema Integrado de Gestión', 'url' => '/sistema-integrado-de-gestion/'],
                        ['titulo' => 'Compromiso Ambiental', 'url' => '/compromiso-ambiental/'],
                    ],
                ],
                [
                    'titulo' => 'Reglamentos',
                    'url' => '#',
                    'hijos' => [
                        ['titulo' => 'Reglamento de Tarifas y Precios', 'url' => '/tarifario/#reta'],
                        ['titulo' => 'Contrato de concesión', 'url' => '/normativa-ositran/#contrato'],
                        ['titulo' => 'Normativa OSITRAN', 'url' => '/normativa-ositran/'],
                        ['titulo' => 'Transparencia', 'url' => '/transparencia/'],
                    ],
                ],
                [
                    'titulo' => 'Zona Clientes',
                    'url' => '#',
                    'hijos' => [
                        ['titulo' => 'Comunicados', 'url' => '/comunicados/'],
                        ['titulo' => 'Tarifario', 'url' => '/tarifario/'],
                        ['titulo' => 'Operación del terminal', 'url' => '/operacion-del-terminal/'],
                        ['titulo' => 'Servicios', 'url' => '/#servicios'],
                        ['titulo' => 'Servicios al pasajero', 'url' => '/servicios-al-pasajero/'],
                    ],
                ],
                [
                    'titulo' => 'Depósito Temporal',
                    'url' => '#',
                    'hijos' => [
                        ['titulo' => 'Información general', 'url' => '/deposito-temporal/#atendemos'],
                        ['titulo' => 'Autorización SUNAT', 'url' => '/deposito-temporal/#documentos'],
                        ['titulo' => 'Tarifario del depósito', 'url' => '/deposito-temporal/#tarifas'],
                        ['titulo' => 'Quejas y reclamos', 'url' => '/deposito-temporal/#quejas-y-reclamos'],
                        ['titulo' => 'Seguimiento de carga', 'url' => 'http://45.232.151.188:8081/consultacarga/'],
                    ],
                ],
                [
                    'titulo' => 'Atención',
                    'url' => '#',
                    'hijos' => [
                        ['titulo' => 'Contacto', 'url' => '/contacto/'],
                        ['titulo' => 'Reclamos', 'url' => '/reclamos/'],
                        ['titulo' => 'Libro de Reclamaciones', 'url' => '/libro-de-reclamaciones/'],
                        ['titulo' => 'Buzón de sugerencias', 'url' => '/contacto/#buzon'],
                        ['titulo' => 'Canal de hostigamiento sexual', 'url' => '/canal-hostigamiento-sexual/'],
                        ['titulo' => 'Portal OSITRAN', 'url' => 'https://www.gob.pe/ositran'],
                    ],
                ],
            ],
        ],
        'legal' => [
            'nombre' => 'Menú legal',
            'items'  => [
                ['titulo' => 'Política de privacidad', 'url' => '/privacidad/'],
                ['titulo' => 'Términos y condiciones', 'url' => '/terminos/'],
                ['titulo' => 'Política de cookies', 'url' => '/cookies/'],
            ],
        ],
    ],
    'logo'  => 'assets/img/logo-copam.svg',
];
