<?php
defined('ABSPATH') || exit;

/**
 * Acordeón de preguntas frecuentes de las páginas internas (wp-accordion). La primera pregunta empieza abierta.
 * Lo imprime el componente `faq-ayuda`.
 *
 * $args:
 *  - id    (string)  id del acordeón
 *  - items (array)   cada uno ['pregunta' => string, 'respuesta' => string (texto sin formato)]
 */
$items = array_values(array_filter((array) ($args['items'] ?? []), static fn($item): bool => trim((string) ($item['pregunta'] ?? '')) !== ''));
if (!$items) {
    return;
}

copam_theme_accordion_start((string) ($args['id'] ?? 'faq-preguntas'), [
    'icon'          => 'plus',
    'class'         => 'mt-[clamp(40px,3.6vw,68px)] flex flex-col gap-2',
    'item_class'    => 'rounded-md bg-white',
    'summary_class' => 'w-full gap-6 p-[clamp(22px,1.7vw,32px)] text-ink transition-[padding] duration-700 ease-in-out [details[open]>&]:pb-[clamp(10px,.75vw,14px)]',
    'title_class'   => 'text-[clamp(14px,.85vw,16px)] leading-[1.35] font-semibold',
    'icon_class'    => 'size-[30px] rounded-full bg-brand p-[9px] text-white',
]);

foreach ($items as $i => $item) :
    copam_theme_accordion_item_start((string) $item['pregunta'], ['open' => $i === 0]);
    $respuesta = trim((string) ($item['respuesta'] ?? ''));
    if ($respuesta !== '') : ?>
        <p class="m-0 max-w-[1100px] px-[clamp(22px,1.7vw,32px)] pb-[clamp(22px,1.7vw,32px)] text-[15px] leading-[1.55] text-pretty text-[#8C8C8C]"><?= esc_html($respuesta) ?></p>
    <?php endif;
    copam_theme_accordion_item_end();
endforeach;

copam_theme_accordion_end();
