<?php
defined('ABSPATH') || exit;

/**
 * Migas de pan de las páginas internas. El primer ítem lleva el ícono de la casa; el último es la página actual.
 *
 * $args:
 *  - items (array) cada uno ['texto' => string, 'url' => string]; el último sin url
 */
$items = array_values(array_filter((array) ($args['items'] ?? []), static fn($item): bool => trim((string) ($item['texto'] ?? '')) !== ''));
if (!$items) {
    return;
}
$ultimo = count($items) - 1;
?>
<nav class="bg-[#EDEDED] px-[clamp(20px,4.17vw,80px)]" aria-label="<?= esc_attr__('Ruta de navegación', 'copam-theme') ?>">
    <ol class="m-0 flex list-none flex-wrap items-center gap-x-3.5 gap-y-1.5 py-[clamp(12px,.95vw,18px)] pl-0 text-[clamp(14px,.85vw,16px)] leading-[1.3]">
        <?php foreach ($items as $i => $item) :
            $texto = (string) $item['texto'];
            $actual = $i === $ultimo;
            ?>
            <?php if ($i > 0) : ?>
                <li class="block overflow-hidden" aria-hidden="true"><span class="block" data-sr="rise"><svg class="block" width="7" height="11" viewBox="0 0 7 11" fill="none"><path d="M1 1l4.5 4.5L1 10" stroke="#8A8A8A" stroke-width="1.4"></path></svg></span></li>
            <?php endif; ?>
            <li class="overflow-hidden">
                <?php if ($actual) : ?>
                    <span class="block text-ink" data-sr="rise" aria-current="page"><?= esc_html($texto) ?></span>
                <?php elseif ($i === 0) : ?>
                    <a<?= copam_theme_link_attrs((string) ($item['url'] ?? ''), ['class' => 'flex items-center gap-1.5 text-gris-7a transition-colors duration-[250ms] hover:text-brand']) ?> data-sr="rise">
                        <svg class="block flex-none" width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M1.75 6.4L7 2l5.25 4.4M3.25 5.3v6.45h2.9V8.6h1.7v3.15h2.9V5.3" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"></path></svg><?= esc_html($texto) ?>
                    </a>
                <?php else : ?>
                    <a<?= copam_theme_link_attrs((string) ($item['url'] ?? ''), ['class' => 'block text-gris-7a transition-colors duration-[250ms] hover:text-brand']) ?> data-sr="rise"><?= esc_html($texto) ?></a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>
