<?php
defined('ABSPATH') || exit;

/**
 * Rejilla de tarjetas de documento (3 o 4 columnas desde 1180 px, 2 desde 600 px, 1 en móvil) con líneas que se
 * dibujan arriba, abajo, a la derecha y entre tarjetas. Admite cualquier cantidad de documentos.
 *
 * $args:
 *  - items    (array) cada uno ['etiqueta', 'titulo', 'fecha', 'archivo'] (ver documento-card)
 *  - columnas (int)   columnas en escritorio: 4 (por defecto) o 3
 */
$items = array_values(array_filter((array) ($args['items'] ?? []), static fn($item): bool => trim((string) ($item['titulo'] ?? '')) !== ''));
$cols  = (int) ($args['columnas'] ?? 4) === 3 ? 3 : 4;
if (!$items) {
    return;
}
$rejilla = $cols === 3 ? 'xl:grid-cols-[repeat(3,minmax(0,1fr))]' : 'xl:grid-cols-[repeat(4,minmax(0,1fr))]';
?>
<div class="relative mt-[clamp(26px,2.1vw,40px)]">
    <span class="absolute inset-x-0 top-0 h-px bg-line" data-sr="lineX" aria-hidden="true"></span>
    <span class="absolute inset-x-0 bottom-0 h-px bg-line" data-sr="lineX" data-sr-delay="200" aria-hidden="true"></span>
    <div class="relative mx-[clamp(20px,4.17vw,80px)] grid grid-cols-[minmax(0,1fr)] sm:grid-cols-[repeat(2,minmax(0,1fr))] <?= esc_attr($rejilla) ?>">
        <span class="absolute inset-y-0 right-0 z-[3] w-px bg-line" data-sr="lineY" data-sr-delay="120" aria-hidden="true"></span>
        <?php foreach ($items as $i => $item) :
            // La línea superior solo va en las tarjetas que no están en la primera fila de cada ancho.
            $linea = ($i >= 1 ? 'block' : 'hidden') . ' ' . ($i >= 2 ? 'sm:block' : 'sm:hidden') . ' ' . ($i >= $cols ? 'xl:block' : 'xl:hidden');
            get_template_part('template-parts/components/documento-card', null, [
                'etiqueta'  => (string) ($item['etiqueta'] ?? ''),
                'titulo'    => (string) $item['titulo'],
                'fecha'     => (string) ($item['fecha'] ?? ''),
                'archivo'   => $item['archivo'] ?? null,
                'retardo'   => ($i % $cols) * 110 + intdiv($i, $cols) * 90,
                'linea_sup' => $linea,
            ]);
        endforeach; ?>
    </div>
</div>
