<?php
defined('ABSPATH') || exit;

/**
 * Tarifario · Reglamento de Tarifas y Precios: acordeón por grupo (año o "Anterior") con los PDF del reglamento,
 * dentro del marco de líneas de la página (wp-accordion, vista template-parts/accordions/documentos-grupos.php).
 * Lee el grupo `tarifario_reta` (ACF).
 */
$grupo  = get_field('tarifario_reta') ?: [];
$grupos = array_map(static fn($g): array => [
    'nombre'     => (string) ($g['nombre'] ?? ''),
    'documentos' => (array) ($g['documentos'] ?? []),
], (array) ($grupo['grupos'] ?? []));
?>
<section class="relative z-[1] bg-white pb-[clamp(88px,7.3vw,140px)]" id="reta">
    <div class="px-[clamp(20px,4.17vw,80px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    </div>
    <div class="relative mt-[clamp(26px,2.1vw,40px)]">
        <span class="absolute inset-x-0 top-0 z-[3] h-px bg-line" data-sr="lineX" aria-hidden="true"></span>
        <span class="absolute inset-x-0 bottom-0 z-[3] h-px bg-line" data-sr="lineX" data-sr-delay="200" aria-hidden="true"></span>
        <div class="relative mx-[clamp(20px,4.17vw,80px)]">
            <span class="absolute inset-y-0 left-0 z-[2] w-px bg-line" data-sr="lineY" data-sr-delay="120" aria-hidden="true"></span>
            <span class="absolute inset-y-0 right-0 z-[2] w-px bg-line" data-sr="lineY" data-sr-delay="120" aria-hidden="true"></span>
            <?php get_template_part('template-parts/accordions/documentos-grupos', null, [
                'id'            => 'tarifario-reta',
                'grupos'        => $grupos,
                'boton_texto'   => (string) ($grupo['boton_texto'] ?? ''),
                'mensaje_vacio' => (string) ($grupo['vacio'] ?? ''),
            ]); ?>
        </div>
    </div>
</section>
