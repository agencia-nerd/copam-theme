<?php
defined('ABSPATH') || exit;

/*
 * Buzón de sugerencias (spec `contacto`, sección buzon). La vista es template-parts/forms/buzon-sugerencias.php.
 *
 * Además de lo que hace el motor (inc/forms.php), este form:
 *  - solo toma el área cuando quien envía es "Trabajador de COPAM" (lo decide el servidor, no la vista);
 *  - acepta envíos anónimos: nombre y correo son opcionales;
 *  - toma el mensaje de éxito del campo `contacto_buzon_exito` de la página Contacto.
 * Los destinatarios salen de Ajustes del sitio > Correos > Buzón de sugerencias.
 */
const COPAM_THEME_FORM_BUZON = 'buzon-sugerencias';

add_filter('copam_theme_forms', 'copam_theme_buzon_definicion');
function copam_theme_buzon_definicion($forms)
{
    // El área solo existe para trabajadores; con otra opción se descarta aunque llegue en el POST.
    $es_envio = wp_doing_ajax()
        && isset($_POST['form']) // phpcs:ignore WordPress.Security.NonceVerification -- el motor verifica el nonce antes de validar
        && sanitize_key(wp_unslash($_POST['form'])) === COPAM_THEME_FORM_BUZON;
    $trabajador = !$es_envio
        || (isset($_POST['quien']) && sanitize_key(wp_unslash($_POST['quien'])) === 'trabajador'); // phpcs:ignore WordPress.Security.NonceVerification

    $fields = [
        'quien' => [
            'type'     => 'radio',
            'label'    => '¿Quién envía la sugerencia?',
            'required' => true,
            'options'  => [
                'usuario'    => 'Usuario o persona externa',
                'trabajador' => 'Trabajador de COPAM',
            ],
        ],
        'area' => [
            'type'         => 'name',
            'label'        => 'Área',
            'min'          => 3,
            'autocomplete' => 'off',
        ],
        'tipo' => [
            'type'     => 'radio',
            'label'    => '¿Qué quieres compartir?',
            'required' => true,
            'options'  => [
                'sugerencia'  => 'Sugerencia',
                'consulta'    => 'Consulta',
                'felicitacion' => 'Felicitación',
                'otro'        => 'Otro',
            ],
        ],
        'mensaje' => [
            'type'     => 'textarea',
            'label'    => 'Mensaje',
            'required' => true,
            'min'      => 10,
            'max'      => 2000,
        ],
        'nombre' => [
            'type'  => 'name',
            'label' => 'Nombre',
            'min'   => 3,
        ],
        'correo' => [
            'type'  => 'email',
            'label' => 'Correo electrónico',
        ],
        'privacidad' => [
            'type'  => 'consent',
            'label' => 'Acepta la Política de privacidad y el tratamiento de sus datos personales',
        ],
    ];
    if (!$trabajador) {
        unset($fields['area']);
    }

    $forms[COPAM_THEME_FORM_BUZON] = [
        'title'    => 'Buzón de sugerencias',
        'subject'  => 'Nuevo mensaje del Buzón de sugerencias',
        'to'       => copam_theme_correos('buzon'),
        'reply_to' => 'correo',
        'store'    => 'all',
        'redirect' => '',
        'success'  => $es_envio ? copam_theme_buzon_exito() : '',
        'fields'   => $fields,
    ];

    return $forms;
}

// Mensaje de éxito: campo de la página Contacto (el envío llega por AJAX, sin la página en contexto).
function copam_theme_buzon_exito()
{
    $paginas = get_pages(['meta_key' => '_wp_page_template', 'meta_value' => 'pages/template-contacto.php', 'number' => 1]);
    $grupo   = ($paginas && function_exists('get_field')) ? (get_field('contacto_buzon', (int) $paginas[0]->ID) ?: []) : [];

    return (string) ($grupo['exito'] ?? '');
}
