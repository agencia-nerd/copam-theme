<?php
defined('ABSPATH') || exit;

/**
 * Reclamos · formulario: título, nota de obligatorios, el formulario (wp-form, template-parts/forms/reclamos.php)
 * y, debajo, los plazos y el enlace al diagrama del procedimiento.
 * Lee el grupo `reclamos_formulario` (ACF).
 */
$grupo        = get_field('reclamos_formulario') ?: [];
$obligatorios = (string) ($grupo['nota_obligatorios'] ?? '');
$plazos       = array_values(array_filter([
    (string) ($grupo['plazo_1'] ?? ''),
    (string) ($grupo['plazo_2'] ?? ''),
], static fn($plazo): bool => trim($plazo) !== ''));
$diagrama       = $grupo['diagrama_archivo'] ?? null;
$diagrama_texto = trim((string) ($grupo['diagrama_texto'] ?? ''));
$diagrama_link  = is_array($diagrama) && !empty($diagrama['url']) && $diagrama_texto !== '' ? ['url' => $diagrama['url'], 'target' => '_blank'] : null;
?>
<section class="relative z-[1] bg-gris-f9 px-[clamp(20px,4.17vw,80px)] pt-[clamp(64px,5.6vw,108px)] pb-[clamp(72px,6vw,116px)]" id="formulario">
    <div class="flex flex-col items-start gap-[clamp(10px,.83vw,16px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
        <?php if ($obligatorios !== '') : ?>
            <p class="m-0 text-[13px] leading-normal text-ink-muted" data-sr="clip" data-sr-delay="200"><?= esc_html($obligatorios) ?></p>
        <?php endif; ?>
    </div>

    <?php get_template_part('template-parts/forms/reclamos', null, [
        'notas'         => [
            'reclamo'         => (string) ($grupo['nota_reclamo'] ?? ''),
            'reconsideracion' => (string) ($grupo['nota_reconsideracion'] ?? ''),
            'apelacion'       => (string) ($grupo['nota_apelacion'] ?? ''),
        ],
        'procedimiento' => [
            'texto'   => (string) ($grupo['procedimiento_texto'] ?? ''),
            'archivo' => $grupo['procedimiento_archivo'] ?? null,
        ],
        'nota_envio'    => (string) ($grupo['nota_envio'] ?? ''),
    ]); ?>

    <?php if ($plazos || $diagrama_link) : ?>
        <div class="mt-[clamp(20px,1.7vw,32px)] flex flex-col items-start gap-2" data-sr="clip" data-sr-delay="120">
            <?php foreach ($plazos as $plazo) : ?>
                <p class="m-0 text-[15px] leading-[1.55] text-pretty text-gris-5a"><?= esc_html($plazo) ?></p>
            <?php endforeach; ?>
            <?php if ($diagrama_link) : ?>
                <a<?= copam_theme_link_attrs($diagrama_link, ['class' => 'mt-1.5 flex items-center gap-1.5 text-[15px] font-medium text-brand transition-colors duration-[250ms] hover:text-brand-hover']) ?> title="<?= esc_attr('PDF' . (!empty($diagrama['filesize']) ? ' · ' . size_format((int) $diagrama['filesize'], 0) : '')) ?>">
                    <?= esc_html($diagrama_texto) ?>
                    <svg width="10" height="10" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M3 11L11 3M4.5 3H11v6.5" stroke="currentColor" stroke-width="1.8"></path></svg>
                    <span class="sr-only">(<?= esc_html__('se abre en una pestaña nueva', 'copam-theme') ?>)</span>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>
