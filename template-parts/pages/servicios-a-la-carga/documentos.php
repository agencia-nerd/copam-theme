<?php
defined('ABSPATH') || exit;

/**
 * Servicios a la carga · documentos relacionados: tarjetas de PDF.
 * Lee el grupo `servicios_a_la_carga_documentos` (ACF).
 */
$grupo = get_field('servicios_a_la_carga_documentos') ?: [];
?>
<section class="relative z-[1] bg-white pb-[clamp(88px,7.3vw,140px)]" id="documentos">
    <div class="px-[clamp(20px,4.17vw,80px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    </div>
    <?php get_template_part('template-parts/components/rejilla-documentos', null, ['items' => (array) ($grupo['items'] ?? [])]); ?>
</section>
