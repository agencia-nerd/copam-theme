<?php
defined('ABSPATH') || exit;

/*
 * Comunicados de ejemplo del diseño (spec `comunicado`): entradas del blog con su categoría.
 * Lo carga inc/acf/runner.php; una entrada ya creada (por su `id`) no se vuelve a tocar.
 * Solo el primero trae el texto completo del diseño; el de los otros tres es provisional: COPAM debe entregarlo.
 */
$provisional = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>';

return [
    'post_type' => 'post',
    'terms'     => ['category' => ['Operativo', 'Noticias', 'Mantenimiento']],
    'items'     => [
        [
            'id'        => 'comunicado-1',
            'titulo'    => 'Atención restringida en ventanilla durante los feriados del 28 y 29 de julio',
            'fecha'     => '2026-07-18 09:00:00',
            'extracto'  => 'El terminal atenderá en horario restringido la prenumeración y la ventanilla durante los feriados de Fiestas Patrias.',
            'contenido' => implode("\n\n", [
                '<p>Con motivo de los feriados por Fiestas Patrias del 28 y 29 de julio, el Terminal Portuario de Yurimaguas – Nueva Reforma atenderá en horario restringido las solicitudes de prenumeración y la atención en ventanilla.</p>',
                '<p>Las operaciones de embarque y descarga continúan con normalidad durante ambos días, conforme a la programación coordinada con las líneas y agentes.</p>',
                '<p>Las solicitudes de prenumeración que no puedan atenderse durante los feriados se procesarán el siguiente día hábil, en el orden en que fueron recibidas. Recomendamos a los usuarios anticipar sus trámites para evitar demoras en el retiro o el ingreso de su carga.</p>',
                '<p>La atención presencial en ventanilla se retomará en su horario habitual a partir del 30 de julio. Para consultas urgentes durante los feriados, los usuarios pueden comunicarse con el área de Operaciones por los canales de atención del terminal.</p>',
                '<p><strong><a href="/contacto/#canales">Para más información, comunícate con el área de Operaciones</a></strong></p>',
            ]),
            'terms'     => ['category' => ['Operativo']],
        ],
        [
            'id'        => 'comunicado-2',
            'titulo'    => 'Publicación del tarifario vigente 2026 aprobado por OSITRAN',
            'fecha'     => '2026-07-02 09:00:00',
            'contenido' => $provisional,
            'terms'     => ['category' => ['Noticias']],
        ],
        [
            'id'        => 'comunicado-3',
            'titulo'    => 'Publicación del Plan Maestro APN 2025 para el TPY-NR',
            'fecha'     => '2026-06-03 09:00:00',
            'contenido' => $provisional,
            'terms'     => ['category' => ['Noticias']],
        ],
        [
            'id'        => 'comunicado-4',
            'titulo'    => 'Mantenimiento programado de grúas — 20 de mayo',
            'fecha'     => '2026-05-15 09:00:00',
            'contenido' => $provisional,
            'terms'     => ['category' => ['Mantenimiento']],
        ],
    ],
];
