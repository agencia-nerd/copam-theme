<?php
defined('ABSPATH') || exit;

/**
 * Normativa OSITRAN · documentos relacionados: tarjetas de PDF en 3 columnas.
 * Lee el grupo `normativa_ositran_documentos` (ACF).
 */
$grupo = get_field('normativa_ositran_documentos') ?: [];
?>
<section class="relative z-[1] bg-white pb-[clamp(88px,7.3vw,140px)]" id="documentos">
    <div class="px-[clamp(20px,4.17vw,80px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    </div>
    <?php get_template_part('template-parts/components/rejilla-documentos', null, ['items' => (array) ($grupo['items'] ?? []), 'columnas' => 3]); ?>
</section>
