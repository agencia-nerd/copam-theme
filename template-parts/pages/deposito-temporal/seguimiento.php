<?php
defined('ABSPATH') || exit;

/**
 * Depósito Temporal · seguimiento de carga: bloque de acceso al aplicativo externo (componente bloque-acceso).
 * Lee el grupo `deposito_temporal_seguimiento` (ACF).
 */
$grupo = get_field('deposito_temporal_seguimiento') ?: [];
?>
<section class="relative z-[1] bg-white" id="seguimiento">
    <?php get_template_part('template-parts/components/bloque-acceso', null, [
        'titulo'      => (string) ($grupo['titulo'] ?? ''),
        'descripcion' => (string) ($grupo['descripcion'] ?? ''),
        'boton'       => $grupo['boton'] ?? null,
        'imagen'      => $grupo['imagen'] ?? null,
    ]); ?>
</section>
