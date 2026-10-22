<?php
defined('ABSPATH') || exit;

/**
 * Comunicados · paginación: anterior, números y siguiente, como enlaces reales. Solo con más de una página.
 * Anterior/siguiente sin destino quedan desactivados (sin href, aria-disabled).
 */
global $wp_query;

$paginas = (int) $wp_query->max_num_pages;
if ($paginas < 2) {
    return;
}
$actual = max(1, (int) get_query_var('paged'));
$flecha = 'grid size-11 place-items-center rounded-full border border-[#DADADA] bg-white text-ink transition-colors duration-300';
$enlace = static fn(int $n): string => get_pagenum_link($n) . '#lista';

$extremos = [
    'anterior'  => [$actual > 1 ? $actual - 1 : 0, __('Página anterior', 'copam-theme'), 'M12 7H2M6 3L2 7l4 4'],
    'siguiente' => [$actual < $paginas ? $actual + 1 : 0, __('Página siguiente', 'copam-theme'), 'M2 7h10M8 3l4 4-4 4'],
];
$flecha_html = static function (array $e) use ($flecha, $enlace): void {
    [$destino, $etiqueta, $trazo] = $e;
    if ($destino) {
        echo '<a class="' . esc_attr($flecha . ' hover:border-brand hover:text-ink') . '" href="' . esc_url($enlace($destino)) . '" aria-label="' . esc_attr($etiqueta) . '">';
    } else {
        echo '<a class="' . esc_attr($flecha . ' opacity-35') . '" role="link" aria-disabled="true" aria-label="' . esc_attr($etiqueta) . '">';
    }
    echo '<svg width="12" height="12" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="' . esc_attr($trazo) . '" stroke="currentColor" stroke-width="1.6"></path></svg></a>';
};
?>
<nav class="mt-[clamp(32px,2.6vw,50px)] flex flex-wrap items-center justify-center gap-2 px-[clamp(20px,4.17vw,80px)]" aria-label="<?= esc_attr__('Paginación de comunicados', 'copam-theme') ?>">
    <?php $flecha_html($extremos['anterior']); ?>
    <?php for ($n = 1; $n <= $paginas; $n++) : ?>
        <?php if ($n === $actual) : ?>
            <a class="grid h-11 min-w-11 place-items-center rounded-full border border-brand bg-brand px-1.5 text-[15px] font-medium text-white hover:text-white" href="<?= esc_url($enlace($n)) ?>" aria-current="page"><?= esc_html((string) $n) ?></a>
        <?php else : ?>
            <a class="grid h-11 min-w-11 place-items-center rounded-full border border-[#DADADA] bg-white px-1.5 text-[15px] font-medium text-ink transition-colors duration-300 hover:border-brand hover:text-ink" href="<?= esc_url($enlace($n)) ?>"><?= esc_html((string) $n) ?></a>
        <?php endif; ?>
    <?php endfor; ?>
    <?php $flecha_html($extremos['siguiente']); ?>
</nav>
