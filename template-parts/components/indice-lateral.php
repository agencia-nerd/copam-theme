<?php
defined('ABSPATH') || exit;

/**
 * Índice lateral "En esta página": solo desde 1000 px, pegado a la columna izquierda.
 * El resaltado del ítem activo lo marca el módulo indice.js con aria-current.
 *
 * $args:
 *  - titulo (string)  rótulo sobre la lista
 *  - items  (array)   cada uno ['texto' => string, 'ancla' => string (id de la sección, sin #)]
 *  - enlace (array)   campo Link de ACF para el enlace con flecha del pie (opcional)
 */
$titulo = (string) ($args['titulo'] ?? '');
$items  = array_values(array_filter((array) ($args['items'] ?? []), static fn($item): bool => trim((string) ($item['texto'] ?? '')) !== '' && trim((string) ($item['ancla'] ?? '')) !== ''));
$enlace = $args['enlace'] ?? null;
if (!$items) {
    return;
}
?>
<aside class="sticky top-24 hidden self-start rounded-md bg-[#F6F6F6] px-[clamp(18px,1.4vw,26px)] py-[clamp(20px,1.5vw,28px)] lg:block" data-sr="card" data-indice>
    <?php if ($titulo !== '') : ?>
        <span class="block text-[15px] font-semibold text-ink"><?= esc_html($titulo) ?></span>
    <?php endif; ?>
    <nav class="mt-2.5 flex flex-col" aria-label="<?= esc_attr($titulo !== '' ? $titulo : __('En esta página', 'copam-theme')) ?>">
        <?php foreach ($items as $i => $item) : ?>
            <a class="group flex items-stretch gap-3 border-b border-gris-e4 py-3 text-sm leading-[1.35] text-[#8C8C8C] transition-colors duration-300 aria-[current=true]:text-ink" href="#<?= esc_attr((string) $item['ancla']) ?>" data-indice-link<?= $i === 0 ? ' aria-current="true"' : '' ?>>
                <span class="w-0.5 flex-none bg-[#D6D6D6] transition-colors duration-300 group-aria-[current=true]:bg-brand" aria-hidden="true"></span>
                <span><?= esc_html((string) $item['texto']) ?></span>
            </a>
        <?php endforeach; ?>
    </nav>
    <?php get_template_part('template-parts/components/enlace-flecha', null, ['enlace' => $enlace, 'tamano' => 'chico', 'clase' => 'mt-4']); ?>
</aside>
