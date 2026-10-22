<?php
defined('ABSPATH') || exit;

/**
 * Depósito Temporal · quejas y reclamos: título, introducción, hoja de reclamación (wp-form,
 * template-parts/forms/hoja-reclamacion-dt.php) y notas legales.
 * Lee el grupo `deposito_temporal_quejas_reclamos` (ACF).
 */
$grupo = get_field('deposito_temporal_quejas_reclamos') ?: [];
$texto = (string) ($grupo['texto'] ?? '');
$notas = array_values(array_filter([
    (string) ($grupo['nota_indecopi'] ?? ''),
    (string) ($grupo['nota_plazo'] ?? ''),
    (string) ($grupo['nota_copia'] ?? ''),
], static fn($nota): bool => trim($nota) !== ''));
?>
<section class="relative z-[1] bg-gris-f9 px-[clamp(20px,4.17vw,80px)] pt-[clamp(64px,5.6vw,108px)] pb-[clamp(72px,6vw,116px)]" id="quejas-y-reclamos">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    <?php if ($texto !== '') : ?>
        <p class="mt-[clamp(10px,.83vw,16px)] mb-0 text-[13px] leading-normal text-ink-muted" data-sr="clip" data-sr-delay="200"><?= esc_html($texto) ?></p>
    <?php endif; ?>

    <?php get_template_part('template-parts/forms/hoja-reclamacion-dt', null, [
        'proveedor' => [
            'razon_social' => (string) ($grupo['razon_social'] ?? ''),
            'ruc'          => (string) ($grupo['ruc'] ?? ''),
            'domicilio'    => (string) ($grupo['domicilio'] ?? ''),
            'codigo'       => (string) ($grupo['codigo'] ?? ''),
        ],
    ]); ?>

    <?php if ($notas) : ?>
        <div class="mt-[clamp(20px,1.7vw,32px)] flex max-w-[860px] flex-col gap-2" data-sr="clip" data-sr-delay="120">
            <?php foreach ($notas as $nota) : ?>
                <p class="m-0 text-[13px] leading-[1.55] text-pretty text-ink-muted"><?= esc_html($nota) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
