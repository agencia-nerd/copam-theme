<?php
defined('ABSPATH') || exit;

/**
 * Lista de datos etiqueta/valor, separados por una línea fina que se dibuja al entrar.
 *
 * $args:
 *  - filas (array) cada una ['etiqueta' => string, 'valor' => string]
 */
$filas = array_values(array_filter((array) ($args['filas'] ?? []), static fn($fila): bool => trim((string) ($fila['etiqueta'] ?? '')) !== '' || trim((string) ($fila['valor'] ?? '')) !== ''));
if (!$filas) {
    return;
}
?>
<dl class="m-0 mt-[clamp(20px,1.6vw,30px)]">
    <?php foreach ($filas as $i => $fila) :
        $retardo = min($i, 4) * 60;
        ?>
        <div class="relative flex flex-wrap justify-between gap-x-6 gap-y-1 py-3.5">
            <span class="absolute right-0 bottom-0 left-0 h-px bg-line" data-sr="lineX" data-sr-delay="<?= esc_attr((string) $retardo) ?>" aria-hidden="true"></span>
            <dt class="block overflow-hidden"><span class="block text-sm text-[#8C8C8C]" data-sr="rise" data-sr-delay="<?= esc_attr((string) $retardo) ?>"><?= esc_html((string) ($fila['etiqueta'] ?? '')) ?></span></dt>
            <dd class="m-0 block overflow-hidden"><span class="block text-right text-sm text-ink" data-sr="rise" data-sr-delay="<?= esc_attr((string) ($retardo + 40)) ?>"><?= esc_html((string) ($fila['valor'] ?? '')) ?></span></dd>
        </div>
    <?php endforeach; ?>
</dl>
