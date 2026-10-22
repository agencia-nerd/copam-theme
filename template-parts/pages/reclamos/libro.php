<?php
defined('ABSPATH') || exit;

/**
 * Reclamos · Libro de Reclamaciones: bloque de acceso (componente bloque-acceso) hacia la página del Libro.
 * Lee el grupo `reclamos_libro` (ACF).
 */
$grupo = get_field('reclamos_libro') ?: [];
?>
<section class="relative z-[1]" id="libro">
    <?php get_template_part('template-parts/components/bloque-acceso', null, [
        'titulo'      => (string) ($grupo['titulo'] ?? ''),
        'descripcion' => (string) ($grupo['descripcion'] ?? ''),
        'boton'       => $grupo['boton'] ?? null,
        'imagen'      => $grupo['imagen'] ?? null,
        'lineas'      => 4,
    ]); ?>
</section>
