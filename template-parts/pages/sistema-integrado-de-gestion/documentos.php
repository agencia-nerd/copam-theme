<?php
defined('ABSPATH') || exit;

/**
 * Sistema Integrado de Gestión · documentos: título y acordeón de documentos por grupo (wp-accordion).
 * Lee el grupo `sistema_integrado_de_gestion_documentos` (ACF).
 */
$grupo = get_field('sistema_integrado_de_gestion_documentos') ?: [];
?>
<section id="documentos">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    <div class="mt-[clamp(26px,2.1vw,40px)]">
        <?php get_template_part('template-parts/accordions/documentos-sig', null, [
            'grupos'        => (array) ($grupo['grupos'] ?? []),
            'mensaje_vacio' => (string) ($grupo['mensaje_vacio'] ?? ''),
        ]); ?>
    </div>
</section>
