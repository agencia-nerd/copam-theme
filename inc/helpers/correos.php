<?php
defined('ABSPATH') || exit;

/*
 * Destinatarios de los formularios: repetidores de Ajustes del sitio > Correos (`opciones_correos`).
 * Cada formulario lee solo el suyo; el del Canal de hostigamiento nunca se mezcla con otro.
 */

// Correos válidos de un área (`contacto`, `buzon`, `hostigamiento`, `operaciones`...), en el orden del admin.
function copam_theme_correos(string $area): array
{
    $opciones = function_exists('get_field') ? get_field('opciones_correos', 'option') : null;
    $filas    = is_array($opciones) ? (array) ($opciones[$area] ?? []) : [];

    return array_values(array_filter(array_map(
        static fn($fila): string => sanitize_email((string) ($fila['correo'] ?? '')),
        $filas
    )));
}
