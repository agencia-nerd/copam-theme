<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Ajustes del sitio (spec `opciones`). Lo carga inc/acf/runner.php una sola vez por grupo:
 * lo que el cliente edite después no se sobrescribe. El correo de Operaciones queda vacío (pendiente en el diseño).
 */
return [
    'option' => true,
    'fields' => [
        'opciones_aviso' => [
            'activo'  => 1,
            'titulo'  => 'Mantenimiento',
            'detalle' => 'Sáb 27 set · 22:00–02:00 · Portal de clientes',
        ],
        'opciones_pie' => [
            'descripcion' => 'Terminal Portuario de Yurimaguas – Nueva Reforma.',
            'telefono'    => '(01) 500-0450',
            'correo'      => 'servicioclientes@copam.com.pe',
            'copyright'   => '© 2026 Concesionaria Puerto Amazonas S.A. · RUC 20543480291',
        ],
        'opciones_correos' => [
            'contacto'      => [['correo' => 'comercial@copam.com.pe']],
            'buzon'         => [['correo' => 'comercial@copam.com.pe']],
            'transparencia' => [['correo' => 'comercial@copam.com.pe']],
            'reclamos'      => [['correo' => 'comercial@copam.com.pe']],
            'libro'         => [['correo' => 'comercial@copam.com.pe']],
            'deposito'      => [['correo' => 'comercial@copam.com.pe']],
            'hostigamiento' => [['correo' => 'denuncia.hostigamiento.s@gmail.com']],
        ],
    ],
];
