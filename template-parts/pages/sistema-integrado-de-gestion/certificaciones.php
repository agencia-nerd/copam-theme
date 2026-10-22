<?php
defined('ABSPATH') || exit;

/**
 * Sistema Integrado de Gestión · certificaciones: una tarjeta por norma con códigos, fechas y enlaces a los PDF.
 * Lee el grupo `sistema_integrado_de_gestion_certificaciones` (ACF).
 */
$grupo = get_field('sistema_integrado_de_gestion_certificaciones') ?: [];
$items = array_values(array_filter((array) ($grupo['items'] ?? []), static fn($item): bool => trim((string) ($item['norma'] ?? '')) !== ''));

// El campo entrega dd/mm/aaaa; el diseño muestra dd-mm-aaaa.
$fecha = static fn($valor): string => str_replace('/', '-', (string) $valor);
?>
<section id="certificaciones">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>

    <?php if ($items) : ?>
        <div class="relative mt-[clamp(20px,1.6vw,30px)]">
            <div class="absolute inset-0 bg-[linear-gradient(90deg,var(--color-gris-e4),var(--color-gris-ee)_60%,var(--color-gris-e9))]" data-sr="band" aria-hidden="true"></div>
            <div class="relative grid grid-cols-1 gap-1 p-1 sm:grid-cols-2 xl:grid-cols-3">
                <?php foreach ($items as $i => $item) :
                    $iqnet  = (string) ($item['certificado_iqnet'] ?? '');
                    $enlaces = array_values(array_filter((array) ($item['enlaces'] ?? []), static fn($enlace): bool => !empty($enlace['archivo']['url'])));
                    ?>
                    <article class="flex min-h-[clamp(170px,9.7vw,186px)] flex-col rounded bg-white px-[clamp(24px,1.67vw,32px)] py-[clamp(28px,2.1vw,40px)]" data-sr="card" data-sr-delay="<?= esc_attr((string) (($i % 3) * 110)) ?>">
                        <h3 class="m-0 text-[clamp(17px,.95vw,18px)] leading-[1.3] font-bold tracking-[.01em] text-ink uppercase"><?= esc_html((string) $item['norma']) ?></h3>
                        <p class="mt-1.5 text-[15px] leading-normal text-gris-5a"><?= esc_html((string) ($item['nombre'] ?? '')) ?></p>
                        <p class="mt-4 text-sm leading-[1.6] text-pretty text-gris-5a">
                            <?= esc_html((string) ($item['certificado_aenor'] ?? '')) ?>
                            <?php if ($iqnet !== '') : ?><br><?= esc_html($iqnet) ?><?php endif; ?>
                        </p>
                        <p class="mt-3 text-sm leading-[1.6] text-pretty text-gris-7a">
                            <?= esc_html__('Primera emisión:', 'copam-theme') ?> <?= esc_html($fecha($item['primera_emision'] ?? '')) ?><br>
                            <?= esc_html__('Última emisión:', 'copam-theme') ?> <?= esc_html($fecha($item['ultima_emision'] ?? '')) ?><br>
                            <?= esc_html__('Vigente hasta:', 'copam-theme') ?> <span class="font-semibold text-[#0B7A38]"><?= esc_html($fecha($item['vigente_hasta'] ?? '')) ?></span>
                        </p>
                        <?php if ($enlaces) : ?>
                            <div class="mt-auto flex flex-wrap gap-x-[18px] gap-y-2 pt-[clamp(20px,1.6vw,28px)]">
                                <?php foreach ($enlaces as $enlace) :
                                    $archivo = $enlace['archivo'];
                                    $peso    = !empty($archivo['filesize']) ? ' · ' . size_format((int) $archivo['filesize'], 0) : '';
                                    ?>
                                    <a<?= copam_theme_link_attrs(['url' => $archivo['url'], 'title' => (string) ($enlace['texto'] ?? ''), 'target' => '_blank'], ['class' => 'inline-flex items-center gap-1.5 text-[15px] font-medium text-brand transition-colors duration-[250ms] hover:text-brand-hover']) ?> title="<?= esc_attr('PDF' . $peso) ?>">
                                        <?= esc_html((string) ($enlace['texto'] ?? '')) ?>
                                        <svg class="block flex-none" width="10" height="10" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M3 11L11 3M4.5 3H11v6.5" stroke="currentColor" stroke-width="1.8"></path></svg>
                                        <span class="sr-only">(<?= esc_html__('se abre en una pestaña nueva', 'copam-theme') ?>)</span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</section>
