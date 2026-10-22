<?php
defined('ABSPATH') || exit;

/*
 * Solicitud de acceso a la información (spec `transparencia`, sección solicitud). La vista es
 * template-parts/forms/solicitud-informacion.php. Los destinatarios salen de Ajustes del sitio > Correos > Transparencia.
 */
const COPAM_THEME_FORM_SOLICITUD_INFORMACION = 'solicitud-informacion';

add_filter('copam_theme_forms', 'copam_theme_solicitud_informacion_definicion');
function copam_theme_solicitud_informacion_definicion($forms)
{
    $forms[COPAM_THEME_FORM_SOLICITUD_INFORMACION] = [
        'title'    => 'Solicitud de acceso a la información',
        'subject'  => 'Nueva solicitud de acceso a la información',
        'to'       => copam_theme_correos('transparencia'),
        'reply_to' => 'correo',
        'store'    => 'all',
        'redirect' => '',
        'success'  => 'Gracias. Tu solicitud fue enviada; te responderemos al correo indicado.',

        'fields' => [
            'nombre' => [
                'type'     => 'name',
                'label'    => 'Nombre y apellidos',
                'required' => true,
                'min'      => 3,
            ],
            'documento' => [
                'type'     => 'digits',
                'label'    => 'Documento de identidad',
                'required' => true,
                'min'      => 8,
                'max'      => 11,
                'messages' => ['min' => 'Ingresa entre 8 y 11 dígitos.'],
            ],
            'correo' => [
                'type'     => 'email',
                'label'    => 'Correo electrónico',
                'required' => true,
            ],
            'telefono' => [
                'type'     => 'phone',
                'label'    => 'Teléfono',
                'required' => true,
            ],
            'detalle' => [
                'type'     => 'textarea',
                'label'    => 'Información solicitada',
                'required' => true,
                'min'      => 10,
                'max'      => 2000,
            ],
            'privacidad' => [
                'type'  => 'consent',
                'label' => 'Acepta la Política de privacidad y el tratamiento de sus datos personales',
            ],
        ],
    ];

    return $forms;
}
