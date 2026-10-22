<?php
defined('ABSPATH') || exit;

/**
 * Normativa OSITRAN · contrato de concesión: párrafo, tarjetas de los documentos del contrato (PDF externos de
 * OSITRAN) en 3 columnas y enlace final al portal de OSITRAN.
 * Lee el grupo `normativa_ositran_contrato` (ACF).
 */
$grupo       = get_field('normativa_ositran_contrato') ?: [];
$descripcion = (string) ($grupo['descripcion'] ?? '');
?>
<section class="relative z-[1] bg-white pb-[clamp(88px,7.3vw,140px)]" id="contrato">
    <div class="px-[clamp(20px,4.17vw,80px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
        <?php if ($descripcion !== '') : ?>
            <p class="mt-[clamp(22px,1.8vw,34px)] mb-0 max-w-[1180px] text-[15px] leading-[1.6] text-pretty text-gris-5a" data-sr="clip" data-sr-delay="200"><?= esc_html($descripcion) ?></p>
        <?php endif; ?>
    </div>
    <?php get_template_part('template-parts/components/rejilla-documentos', null, ['items' => (array) ($grupo['items'] ?? []), 'columnas' => 3]); ?>
    <?php get_template_part('template-parts/components/enlace-flecha', null, [
        'enlace' => $grupo['enlace'] ?? null,
        'clase'  => 'mt-[clamp(20px,1.6vw,30px)] px-[clamp(20px,4.17vw,80px)]',
    ]); ?>
</section>
