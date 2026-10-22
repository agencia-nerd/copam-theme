<?php
defined('ABSPATH') || exit;

/*
 * Formulario de contacto (spec `contacto`, sección formulario). La vista es template-parts/forms/contacto.php.
 * Los destinatarios salen de Ajustes del sitio > Correos > Contacto. La tarjeta "Comercial" de Canales
 * deja elegida su área al bajar al formulario (src/js/modules/contacto.js).
 */
const COPAM_THEME_FORM_CONTACTO = 'contacto';

add_filter('copam_theme_forms', 'copam_theme_contacto_definicion');
function copam_theme_contacto_definicion($forms)
{
    $forms[COPAM_THEME_FORM_CONTACTO] = [
        'title'    => 'Formulario de contacto',
        'subject'  => 'Nuevo mensaje desde el formulario de contacto',
        'to'       => copam_theme_correos('contacto'),
        'reply_to' => 'correo',
        'store'    => 'all',
        'redirect' => '',
        'success'  => 'Gracias. Tu mensaje fue enviado; te responderemos pronto.',

        'fields' => [
            'nombre' => [
                'type'     => 'name',
                'label'    => 'Nombre y apellidos',
                'required' => true,
                'min'      => 3,
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
            'area' => [
                'type'     => 'select',
                'label'    => 'Área',
                'required' => true,
                'options'  => [
                    'atencion'    => 'Atención al usuario',
                    'operaciones' => 'Operaciones',
                    'comercial'   => 'Comercial',
                ],
            ],
            'mensaje' => [
                'type'     => 'textarea',
                'label'    => 'Mensaje',
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
