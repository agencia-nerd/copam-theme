<?php
defined('ABSPATH') || exit;

/**
 * Depósito Temporal · tarifas: tabla de cuatro columnas (servicio, unidad, tarifa e IGV) con filas de grupo a todo
 * el ancho, líneas que se dibujan y una nota de vigencia. Las cabeceras de columna son fijas (no son campo).
 * Lee el grupo `deposito_temporal_tarifas` (ACF).
 */
$grupo = get_field('deposito_temporal_tarifas') ?: [];
$filas = array_values(array_filter((array) ($grupo['filas'] ?? []), static fn($fila): bool => trim((string) ($fila['servicio'] ?? '')) !== ''));
$nota  = trim((string) ($grupo['nota'] ?? ''));

$celda    = 'px-2 first:pl-[clamp(16px,2.1vw,40px)] last:pr-[clamp(16px,2.1vw,40px)]';
$columnas = [
    ['texto' => __('Servicio', 'copam-theme'), 'ancho' => 'w-[40%] min-[760px]:w-[52.17%]', 'alinea' => 'text-left'],
    ['texto' => __('Unidad de cobro', 'copam-theme'), 'ancho' => 'w-[25%] min-[760px]:w-[21.74%]', 'alinea' => 'text-left'],
    ['texto' => __('Tarifa S/', 'copam-theme'), 'ancho' => 'w-[17.5%] min-[760px]:w-[13.04%]', 'alinea' => 'text-right'],
    ['texto' => __('IGV (18%)', 'copam-theme'), 'ancho' => 'w-[17.5%] min-[760px]:w-[13.04%]', 'alinea' => 'text-right'],
];
?>
<section class="relative z-[1] bg-white pb-[clamp(88px,7.3vw,140px)]" id="tarifas">
    <div class="px-[clamp(20px,4.17vw,80px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    </div>
    <?php if ($filas) : ?>
        <div class="relative mt-[clamp(26px,2.1vw,40px)]">
            <span class="absolute inset-x-0 top-0 z-[3] h-px bg-line" data-sr="lineX" aria-hidden="true"></span>
            <span class="absolute inset-x-0 bottom-0 z-[3] h-px bg-line" data-sr="lineX" data-sr-delay="200" aria-hidden="true"></span>
            <div class="relative mx-[clamp(20px,4.17vw,80px)]">
                <span class="absolute inset-y-0 left-0 z-[2] w-px bg-line" data-sr="lineY" data-sr-delay="120" aria-hidden="true"></span>
                <span class="absolute inset-y-0 right-0 z-[2] w-px bg-line" data-sr="lineY" data-sr-delay="120" aria-hidden="true"></span>
                <table class="w-full table-fixed border-collapse">
                    <caption class="sr-only"><?= esc_html((string) ($grupo['titulo'] ?? '')) ?></caption>
                    <colgroup>
                        <?php foreach ($columnas as $col) : ?><col class="<?= esc_attr($col['ancho']) ?>"><?php endforeach; ?>
                    </colgroup>
                    <thead data-sr="wipe">
                        <tr class="bg-ink text-xs font-semibold tracking-[.16em] text-white uppercase">
                            <?php foreach ($columnas as $col) : ?>
                                <th scope="col" class="py-[clamp(16px,1.2vw,22px)] font-semibold <?= esc_attr($celda . ' ' . $col['alinea']) ?>"><?= esc_html($col['texto']) ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody class="text-[clamp(14px,.85vw,16px)] leading-[1.4] text-ink">
                        <?php foreach ($filas as $i => $fila) :
                            $retardo = $i * 40;
                            if (!empty($fila['es_grupo'])) : ?>
                                <tr class="border-line bg-[#F6F6F6] [&+&]:border-t">
                                    <th scope="colgroup" colspan="4" class="py-[clamp(13px,1vw,18px)] text-left font-semibold <?= esc_attr($celda) ?>">
                                        <span class="block overflow-hidden"><span class="block" data-sr="rise" data-sr-delay="<?= esc_attr((string) $retardo) ?>"><?= esc_html((string) $fila['servicio']) ?></span></span>
                                    </th>
                                </tr>
                            <?php else :
                                $celdas = [
                                    ['texto' => (string) ($fila['unidad'] ?? ''), 'clase' => 'text-left text-gris-7a'],
                                    ['texto' => (string) ($fila['tarifa'] ?? ''), 'clase' => 'text-right'],
                                    ['texto' => (string) ($fila['igv'] ?? ''), 'clase' => 'text-right'],
                                ]; ?>
                                <tr class="border-line bg-white [&+&]:border-t">
                                    <th scope="row" class="py-[clamp(13px,1vw,18px)] text-left font-normal <?= esc_attr($celda) ?>">
                                        <span class="block overflow-hidden"><span class="block" data-sr="rise" data-sr-delay="<?= esc_attr((string) $retardo) ?>"><?= esc_html((string) $fila['servicio']) ?></span></span>
                                    </th>
                                    <?php foreach ($celdas as $j => $c) : ?>
                                        <td class="py-[clamp(13px,1vw,18px)] <?= esc_attr($celda . ' ' . $c['clase']) ?>">
                                            <span class="block overflow-hidden"><span class="block" data-sr="rise" data-sr-delay="<?= esc_attr((string) ($retardo + ($j + 1) * 30)) ?>"><?= esc_html($c['texto']) ?></span></span>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endif;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($nota !== '') : ?>
        <p class="mx-[clamp(20px,4.17vw,80px)] mt-[clamp(20px,1.8vw,34px)] mb-0 text-sm leading-[1.6] text-pretty text-gris-7a" data-sr="clip" data-sr-delay="200"><?= esc_html($nota) ?></p>
    <?php endif; ?>
</section>
