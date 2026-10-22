<?php
defined('ABSPATH') || exit;

/**
 * Depósito Temporal · documentos: acordeón por grupo (tarifario, autorización SUNAT, procedimientos, formatos)
 * dentro del marco de líneas de la página (wp-accordion, vista template-parts/accordions/documentos-grupos.php).
 * Lee el grupo `deposito_temporal_documentos` (ACF).
 */
$grupo  = get_field('deposito_temporal_documentos') ?: [];
$grupos = array_map(static fn($g): array => [
    'nombre'       => (string) ($g['titulo'] ?? ''),
    'estado_vacio' => (string) ($g['estado_vacio'] ?? ''),
    'documentos'   => (array) ($g['documentos'] ?? []),
], (array) ($grupo['grupos'] ?? []));
?>
<section class="relative z-[1] bg-white pb-[clamp(88px,7.3vw,140px)]" id="documentos">
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
                'id'            => 'documentos-deposito',
                'grupos'        => $grupos,
                'mensaje_vacio' => __('Los documentos de esta sección se publicarán próximamente.', 'copam-theme'),
            ]); ?>
        </div>
    </div>
</section>
