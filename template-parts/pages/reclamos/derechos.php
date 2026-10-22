<?php
defined('ABSPATH') || exit;

/**
 * Reclamos · derechos y deberes del usuario: título, norma y dos tarjetas con listas sobre una banda gris
 * (la de derechos en dos columnas de texto cuando hay espacio).
 * Lee el grupo `reclamos_derechos` (ACF).
 */
$grupo  = get_field('reclamos_derechos') ?: [];
$bajada = (string) ($grupo['bajada'] ?? '');
$textos = static fn($filas): array => array_values(array_filter(
    array_map(static fn($fila): string => trim((string) ($fila['texto'] ?? '')), (array) $filas),
    'strlen'
));
$tarjetas = array_values(array_filter([
    [
        'etiqueta' => (string) ($grupo['derechos_etiqueta'] ?? ''),
        'titulo'   => (string) ($grupo['derechos_titulo'] ?? ''),
        'items'    => $textos($grupo['derechos_items'] ?? []),
        'columnas' => true,
    ],
    [
        'etiqueta' => (string) ($grupo['deberes_etiqueta'] ?? ''),
        'titulo'   => (string) ($grupo['deberes_titulo'] ?? ''),
        'items'    => $textos($grupo['deberes_items'] ?? []),
        'columnas' => false,
    ],
], static fn($tarjeta): bool => $tarjeta['titulo'] !== '' || $tarjeta['items']));
?>
<section class="relative z-[1] bg-white pt-[clamp(72px,6vw,116px)] pb-[clamp(72px,6vw,112px)]" id="derechos">
    <div class="flex flex-col items-start gap-[clamp(10px,.83vw,16px)] px-[clamp(20px,4.17vw,80px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
        <?php if ($bajada !== '') : ?>
            <p class="mt-[clamp(6px,.5vw,10px)] mb-0 max-w-[720px] text-[15px] leading-[1.6] text-pretty text-ink-muted" data-sr="clip" data-sr-delay="200"><?= esc_html($bajada) ?></p>
        <?php endif; ?>
    </div>
    <?php if ($tarjetas) : ?>
        <div class="relative mt-[clamp(26px,2.1vw,40px)]">
            <div class="absolute inset-0 bg-[linear-gradient(90deg,var(--color-gris-e4),var(--color-gris-ee)_60%,var(--color-gris-e9))]" data-sr="band" aria-hidden="true"></div>
            <div class="relative grid grid-cols-[repeat(auto-fit,minmax(min(100%,420px),1fr))] gap-1 px-[clamp(20px,4.17vw,80px)] py-1">
                <?php foreach ($tarjetas as $i => $tarjeta) : ?>
                    <article class="flex min-w-0 flex-col rounded bg-white px-[clamp(22px,1.9vw,36px)] py-[clamp(26px,2.1vw,40px)]" data-sr="card" data-sr-delay="<?= esc_attr((string) ($i * 110)) ?>">
                        <?php if ($tarjeta['etiqueta'] !== '') : ?>
                            <span class="text-xs leading-[1.3] font-semibold tracking-[.14em] text-brand uppercase"><?= esc_html($tarjeta['etiqueta']) ?></span>
                        <?php endif; ?>
                        <?php if ($tarjeta['titulo'] !== '') : ?>
                            <h3 class="mt-3.5 mb-[18px] text-[clamp(20px,1.3vw,24px)] leading-[1.25] font-semibold text-ink"><?= esc_html($tarjeta['titulo']) ?></h3>
                        <?php endif; ?>
                        <?php if ($tarjeta['items']) : ?>
                            <ul class="m-0 list-none p-0 <?= $tarjeta['columnas'] ? 'columns-[2_260px] gap-x-[clamp(24px,2vw,40px)]' : '' ?>">
                                <?php foreach ($tarjeta['items'] as $item) : ?>
                                    <li class="relative break-inside-avoid border-t border-[#EDEDED] py-3 pl-5 text-[15px] leading-normal text-pretty text-gris-5a"><span class="absolute top-[19px] left-0 size-1.5 rounded-[1px] bg-brand" aria-hidden="true"></span><?= esc_html($item) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</section>
