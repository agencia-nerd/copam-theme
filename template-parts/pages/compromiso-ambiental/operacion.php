<?php
defined('ABSPATH') || exit;

/**
 * Compromiso Ambiental · cómo lo aplicamos en la operación: tarjetas numeradas (el número sale del orden).
 * Lee el grupo `compromiso_ambiental_operacion` (ACF).
 */
$grupo = get_field('compromiso_ambiental_operacion') ?: [];
$items = array_values(array_filter((array) ($grupo['items'] ?? []), static fn($item): bool => trim((string) ($item['titulo'] ?? '')) !== ''));
?>
<section id="operacion">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    <?php if ($items) : ?>
        <div class="mt-[clamp(20px,1.6vw,30px)] grid grid-cols-[repeat(auto-fit,minmax(min(100%,280px),1fr))] gap-1.5">
            <?php foreach ($items as $i => $item) : ?>
                <div class="flex flex-col gap-2.5 rounded-md bg-[#F6F6F6] p-[clamp(20px,1.6vw,30px)]" data-sr="card" data-sr-delay="<?= esc_attr((string) (($i % 4) * 110)) ?>">
                    <span class="text-[13px] font-semibold tracking-[.08em] text-brand" aria-hidden="true"><?= esc_html(str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT)) ?></span>
                    <h3 class="m-0 text-[17px] leading-[1.3] font-semibold text-ink"><?= esc_html((string) $item['titulo']) ?></h3>
                    <p class="m-0 text-[15px] leading-[1.65] text-pretty text-gris-3a"><?= esc_html((string) ($item['texto'] ?? '')) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
