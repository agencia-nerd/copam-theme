<?php
defined('ABSPATH') || exit;

/**
 * Libro de Reclamaciones · formulario: título, nota de obligatorios, aviso con enlace al formulario de reclamos
 * OSITRAN, hoja de reclamación (wp-form, template-parts/forms/libro-de-reclamaciones.php) y notas legales.
 * Lee el grupo `libro_de_reclamaciones_formulario` (ACF).
 */
$grupo         = get_field('libro_de_reclamaciones_formulario') ?: [];
$obligatorios  = (string) ($grupo['nota_obligatorios'] ?? '');
$aviso         = (string) ($grupo['aviso_ositran'] ?? '');
$aviso_enlace  = $grupo['aviso_enlace'] ?? null;
$aviso_link    = copam_theme_link_data($aviso_enlace);
$notas         = array_values(array_filter([
    (string) ($grupo['nota_legal_indecopi'] ?? ''),
    (string) ($grupo['nota_legal_plazo'] ?? ''),
], static fn($nota): bool => trim($nota) !== ''));
?>
<section class="relative z-[1] bg-gris-f9 px-[clamp(20px,4.17vw,80px)] pt-[clamp(64px,5.6vw,108px)] pb-[clamp(72px,6vw,116px)]" id="formulario">
    <div class="flex flex-col items-start gap-[clamp(10px,.83vw,16px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
        <?php if ($obligatorios !== '') : ?>
            <p class="m-0 text-[13px] leading-normal text-ink-muted" data-sr="clip" data-sr-delay="200"><?= esc_html($obligatorios) ?></p>
        <?php endif; ?>
    </div>

    <?php if ($aviso !== '' || $aviso_link) : ?>
        <div class="mt-[clamp(22px,1.8vw,34px)] max-w-[860px] border-l-2 border-brand pl-3" data-sr="clip" data-sr-delay="160">
            <p class="m-0 text-[15px] leading-[1.55] text-pretty text-gris-4a">
                <?= esc_html($aviso) ?>
                <?php if ($aviso_link) : ?>
                    <a<?= copam_theme_link_attrs($aviso_enlace, ['class' => 'font-medium text-brand underline underline-offset-[3px] hover:text-brand-hover']) ?>><?= esc_html($aviso_link['title'] ?? '') ?></a>.
                <?php endif; ?>
            </p>
        </div>
    <?php endif; ?>

    <?php get_template_part('template-parts/forms/libro-de-reclamaciones', null, [
        'proveedor'     => [
            'razon_social' => (string) ($grupo['proveedor_razon_social'] ?? ''),
            'ruc'          => (string) ($grupo['proveedor_ruc'] ?? ''),
            'direccion'    => (string) ($grupo['proveedor_direccion'] ?? ''),
        ],
        'observaciones' => (string) ($grupo['nota_observaciones'] ?? ''),
        'nota_envio'    => (string) ($grupo['nota_envio'] ?? ''),
    ]); ?>

    <?php if ($notas) : ?>
        <div class="mt-[clamp(20px,1.7vw,32px)] flex max-w-[860px] flex-col gap-2" data-sr="clip" data-sr-delay="120">
            <?php foreach ($notas as $nota) : ?>
                <p class="m-0 text-[13px] leading-[1.55] text-pretty text-ink-muted"><?= esc_html($nota) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
