<?php
defined('ABSPATH') || exit;

/**
 * Operación del terminal · versiones del REOP: acordeón por año dentro del marco de líneas de la página
 * (wp-accordion, vista template-parts/accordions/documentos-grupos.php).
 * Lee el grupo `operacion_del_terminal_versiones` (ACF).
 */
$grupo  = get_field('operacion_del_terminal_versiones') ?: [];
$grupos = array_map(static fn($a): array => [
    'nombre'     => (string) ($a['anio'] ?? ''),
    'documentos' => (array) ($a['documentos'] ?? []),
], (array) ($grupo['anios'] ?? []));
?>
<section class="relative z-[1] bg-white pb-[clamp(88px,7.3vw,140px)]" id="versiones">
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
                'id'            => 'versiones-reop',
                'grupos'        => $grupos,
                'mensaje_vacio' => (string) ($grupo['vacio'] ?? ''),
                'boton_texto'   => (string) ($grupo['boton_texto'] ?? ''),
                'vigente_texto' => (string) ($grupo['vigente_texto'] ?? ''),
            ]); ?>
        </div>
    </div>
</section>
