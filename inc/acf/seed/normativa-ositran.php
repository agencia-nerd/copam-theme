<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Normativa OSITRAN (spec `normativa-ositran`). Lo carga inc/acf/runner.php una sola vez por grupo:
 * lo que el cliente edite después no se sobrescribe. Los enlaces a páginas del sitio son rutas relativas (/pagina/), así funcionan igual en local y en producción.
 * El RETA y los documentos del contrato están en el portal de OSITRAN: van como enlace externo, sin archivo.
 */
return [
    'page'   => 'normativa-ositran',
    'fields' => [
        'normativa_ositran_hero' => [
            'titulo'         => 'Normativa',
            'bajada'         => 'Reglamentos y resoluciones de OSITRAN aplicables al terminal, y el contrato de concesión suscrito con el Estado peruano.',
            'boton'          => ['title' => 'Ir al portal OSITRAN', 'url' => 'https://www.gob.pe/ositran', 'target' => '_blank'],
            'accesos_titulo' => 'Accesos directos',
            'accesos'        => [
                ['enlace' => ['title' => 'Reglamentos de OSITRAN', 'url' => '#normativa']],
                ['enlace' => ['title' => 'Contrato de concesión', 'url' => '#contrato']],
                ['enlace' => ['title' => 'Documentos relacionados', 'url' => '#documentos']],
                ['enlace' => ['title' => 'Tarifario', 'url' => '/tarifario/']],
                ['enlace' => ['title' => 'Transparencia', 'url' => '/transparencia/']],
            ],
        ],

        'normativa_ositran_normativa' => [
            'titulo' => 'Normativa aplicable',
            'grupos' => [
                [
                    'titulo'     => 'Reglamentos de OSITRAN',
                    'documentos' => [
                        ['titulo' => 'Ley de creación del OSITRAN', 'detalle' => 'Ley N.° 26917 · Ley de Supervisión de la Inversión Privada en Infraestructura de Transporte de Uso Público', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/ley-26917-ositran.pdf']],
                        ['titulo' => 'Reglamento General de Supervisión del OSITRAN', 'detalle' => 'Resolución de Consejo Directivo N.° 024-2011-CD-OSITRAN', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/reglamento-supervision-ositran.pdf']],
                        ['titulo' => 'Reglamento General de Tarifas del OSITRAN (RETA)', 'detalle' => 'Resolución de Consejo Directivo N.° 003-2021-CD-OSITRAN · texto actualizado', 'vigente' => 0, 'enlace_externo' => 'https://www.ositran.gob.pe/anterior/wp-content/uploads/2025/08/reglamento-general-de-tarifas-del-ositran-spij-4-agosto-2025.pdf'],
                        ['titulo' => 'Reglamento de Atención de Reclamos y Solución de Controversias', 'detalle' => 'Resolución de Consejo Directivo N.° 019-2011-CD-OSITRAN y modificatorias · texto actualizado', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/reglamento-reclamos-ositran.pdf']],
                        ['titulo' => 'Reglamento de Usuarios de las Infraestructuras de Transporte de Uso Público', 'detalle' => 'Resolución de Consejo Directivo N.° 035-2017-CD-OSITRAN', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/reglamento-usuarios-ositran.pdf']],
                    ],
                ],
                [
                    'titulo'       => 'Reglamento de Operaciones (APN)',
                    'enlace_extra' => ['title' => 'Ver Operación del terminal', 'url' => '/operacion-del-terminal/'],
                    'documentos'   => [
                        ['titulo' => 'REOP 2026', 'detalle' => 'Código REIN-TPY-001 · Vigente', 'vigente' => 1, 'archivo' => ['_file' => 'assets/docs/reop-2026.pdf']],
                        ['titulo' => 'REOP 2024', 'detalle' => 'Res. N.° 0271-2024-APN-GG', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/reop-2024.pdf']],
                        ['titulo' => 'REOP 2020', 'detalle' => 'Res. N.° 0323-2020-APN-GG', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/reop-2020.pdf']],
                    ],
                ],
                [
                    'titulo'     => 'Resoluciones tarifarias · Fijación de tarifas',
                    'documentos' => [
                        ['titulo' => 'Resolución de Consejo Directivo N.° 0032-2026-CD-OSITRAN', 'detalle' => '09-06-2026 · Tarifas provisionales de servicios especiales (reestiba en nave, reestiba en camión y estadía adicional en antepuerto)', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/rcd-0032-2026-cd-ositran.pdf']],
                        ['titulo' => 'Resolución de Presidencia N.° 0002-2025-PD-OSITRAN', 'detalle' => '06-01-2025 · Tarifas del Depósito Temporal Fluvial (contenedores y carga fraccionada)', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/rp-0002-2025-pd-ositran.pdf']],
                        ['titulo' => 'Resolución de Consejo Directivo N.° 031-2018-CD-OSITRAN', 'detalle' => '07-11-2018 · Segundo grupo de servicios especiales', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/rcd-031-2018-cd-ositran.pdf']],
                        ['titulo' => 'Resolución de Consejo Directivo N.° 032-2017-CD-OSITRAN', 'detalle' => '09-10-2017 · Primer grupo de servicios especiales', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/rcd-032-2017-cd-ositran.pdf']],
                    ],
                ],
                [
                    'titulo'     => 'Resoluciones tarifarias · Reajustes anuales',
                    'documentos' => [
                        ['titulo' => 'Reajuste 2026', 'detalle' => 'Oficio N.° 00335-2025-GRE-OSITRAN · 24-12-2025', 'vigente' => 1, 'archivo' => ['_file' => 'assets/docs/oficio-00335-2025-gre-ositran.pdf']],
                        ['titulo' => 'Reajuste 2025', 'detalle' => 'Oficio N.° 00300-2024-GRE-OSITRAN · 20-12-2024', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/oficio-00300-2024-gre-ositran.pdf']],
                        ['titulo' => 'Reajuste 2024', 'detalle' => 'Oficio N.° 00236-2023-GRE-OSITRAN · 28-12-2023', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/oficio-00236-2023-gre-ositran.pdf']],
                        ['titulo' => 'Reajuste 2023', 'detalle' => 'Oficio N.° 00205-2022-GRE-OSITRAN · 19-12-2022', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/oficio-00205-2022-gre-ositran.pdf']],
                        ['titulo' => 'Reajuste 2022', 'detalle' => 'Oficio N.° 00198-2021-GRE-OSITRAN · 16-12-2021', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/oficio-00198-2021-gre-ositran.pdf']],
                        ['titulo' => 'Reajuste 2021', 'detalle' => 'Oficio N.° 00124-2020-GRE-OSITRAN · 18-12-2020', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/oficio-00124-2020-gre-ositran.pdf']],
                        ['titulo' => 'Reajuste 2020', 'detalle' => 'Oficio N.° 00118-2018-GRE-OSITRAN · 12-12-2019', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/oficio-00118-2018-gre-ositran.pdf']],
                        ['titulo' => 'Reajuste 2019', 'detalle' => 'Oficio N.° 108-18-GRE-OSITRAN · 11-12-2018', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/oficio-108-18-gre-ositran.pdf']],
                        ['titulo' => 'Reajuste 2018', 'detalle' => 'Oficio N.° 108-17-GRE-OSITRAN · 19-12-2017', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/oficio-108-17-gre-ositran.pdf']],
                        ['titulo' => 'Reajuste 2018', 'detalle' => 'Oficio N.° 105-17-GRE-OSITRAN · 12-12-2017', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/oficio-105-17-gre-ositran.pdf']],
                    ],
                ],
                [
                    'titulo'       => 'Otras resoluciones',
                    'estado_vacio' => 'Por confirmar',
                    'documentos'   => [],
                ],
            ],
        ],

        'normativa_ositran_contrato' => [
            'titulo'      => 'Contrato de concesión',
            'descripcion' => 'Suscrito con el Estado peruano el 31 de mayo de 2011 para el diseño, financiamiento, construcción, conservación y explotación del TPY-NR. El contrato, sus anexos y adendas se publican en el portal de OSITRAN.',
            'items'       => [
                ['etiqueta' => 'Contrato', 'titulo' => 'Contrato de concesión y anexos', 'fecha' => 'Publicado por OSITRAN', 'archivo' => ['title' => 'Contrato de concesión y anexos', 'url' => 'https://www.ositran.gob.pe/anterior/wp-content/uploads/2017/12/Contrato20Yurimaguas11.pdf', 'target' => '_blank']],
                ['etiqueta' => 'Adenda', 'titulo' => 'Adenda N.° 1 al Contrato de Concesión', 'fecha' => 'Publicado por OSITRAN', 'archivo' => ['title' => 'Adenda N.° 1 al Contrato de Concesión', 'url' => 'https://www.ositran.gob.pe/anterior/wp-content/uploads/2017/12/adenda-1-terminal-portuario-yurimaguas-nueva-reforma.pdf', 'target' => '_blank']],
                ['etiqueta' => 'Ficha', 'titulo' => 'Ficha de contrato de la concesión', 'fecha' => 'Actualizada al 13-07-2026 · OSITRAN', 'archivo' => ['title' => 'Ficha de contrato de la concesión', 'url' => 'https://www.ositran.gob.pe/anterior/wp-content/uploads/2017/12/Ficha_Yurimaguas-2026.pdf', 'target' => '_blank']],
            ],
            'enlace'      => ['title' => 'Ver anexos y más documentos en el portal de OSITRAN', 'url' => 'https://www.ositran.gob.pe/anterior/puertos/terminal-portuario-de-yurimaguas-nueva-reforma/', 'target' => '_blank'],
        ],

        'normativa_ositran_documentos' => [
            'titulo' => 'Documentos relacionados',
            'items'  => [
                ['etiqueta' => 'Reglamento', 'titulo' => 'Reglamento de Tarifas y Precios de COPAM · V 5.3', 'fecha' => 'Vigente desde junio de 2026', 'archivo' => ['_file' => 'assets/docs/reta-v5-3.pdf']],
                ['etiqueta' => 'Reglamento', 'titulo' => 'Reglamento de Operaciones · REIN-TPY-001', 'fecha' => 'Aprobado el 15-06-2026', 'archivo' => ['_file' => 'assets/docs/reop-2026.pdf']],
                ['etiqueta' => 'OSITRAN', 'titulo' => 'Reglamento de Atención de Reclamos', 'fecha' => 'Res. N.° 019-2011-CD-OSITRAN y modificatorias', 'archivo' => ['_file' => 'assets/docs/reglamento-reclamos-ositran.pdf']],
            ],
        ],
    ],
];
