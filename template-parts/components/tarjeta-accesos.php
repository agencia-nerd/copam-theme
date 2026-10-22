<?php
defined('ABSPATH') || exit;

/**
 * Tarjeta "Accesos directos": título y una lista de enlaces (normalmente anclas a las secciones de la página).
 * Al pasar el cursor o enfocar, el enlace se pone verde con borde y la flecha se mueve 2 px.
 *
 * $args:
 *  - titulo (string)  título de la tarjeta (h2)
 *  - items  (array)   campos Link de ACF; sin destino válido se omiten
 *  - clase  (string)  clases extra para el <aside> (p. ej. el margen negativo del hero)
 */
$titulo = (string) ($args['titulo'] ?? '');
$clase  = (string) ($args['clase'] ?? '');
$items  = array_values(array_filter((array) ($args['items'] ?? []), static fn($item): bool => copam_theme_link_data($item) !== null && trim((string) ($item['title'] ?? '')) !== ''));
if (!$items) {
    return;
}
?>
<aside class="relative z-[2] flex flex-col self-end rounded-md bg-[#F6F6F6] px-[clamp(22px,1.7vw,32px)] pt-[clamp(22px,1.7vw,32px)] pb-[clamp(6px,.6vw,12px)] shadow-[inset_0_0_0_1px_#E6E6E6] <?= esc_attr($clase) ?>" data-sr="card" data-sr-delay="250" data-sr-shadow>
    <?php if ($titulo !== '') : ?>
        <div class="overflow-hidden"><h2 class="m-0 text-[clamp(18px,1.05vw,20px)] font-semibold text-ink" data-sr="rise"><?= esc_html($titulo) ?></h2></div>
    <?php endif; ?>
    <ul class="mt-[clamp(12px,1vw,18px)] mb-0 flex list-none flex-col gap-1.5 pb-[clamp(16px,1.1vw,22px)] pl-0">
        <?php foreach ($items as $item) : ?>
            <li class="overflow-hidden">
                <a<?= copam_theme_link_attrs($item, ['class' => 'group box-border flex min-h-12 items-center justify-between gap-3 rounded-md bg-white px-4 text-[clamp(14px,.85vw,16px)] leading-[1.3] text-ink shadow-[inset_0_0_0_1px_rgba(11,138,62,0)] outline-0 transition-[box-shadow,color] duration-200 hover:text-brand hover:shadow-[inset_0_0_0_1px_#0B8A3E] focus-visible:text-brand focus-visible:shadow-[inset_0_0_0_1px_#0B8A3E]']) ?>>
                    <span class="min-w-0 py-1.5 text-pretty"><?= esc_html((string) $item['title']) ?><?php if (copam_theme_link_resolve(copam_theme_link_data($item), [])['blank']) : ?><span class="sr-only"> (<?= esc_html__('se abre en una pestaña nueva', 'copam-theme') ?>)</span><?php endif; ?></span>
                    <svg class="block flex-none transition-transform duration-200 group-hover:translate-x-0.5 group-focus-visible:translate-x-0.5" width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.6"></path></svg>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</aside>
