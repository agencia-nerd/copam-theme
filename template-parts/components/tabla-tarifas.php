<?php
defined('ABSPATH') || exit;

/**
 * Sección de tarifas de las páginas de servicios: título con línea, tabla de dos columnas (prestación y unidad de
 * cobro) con cabecera oscura y líneas que se dibujan, y una nota (WYSIWYG) bajo la tabla.
 *
 * $args:
 *  - id                 (string)  id de la sección ('tarifas' por defecto)
 *  - titulo             (string)  h2
 *  - columna_prestacion (string)  encabezado de la primera columna
 *  - columna_unidad     (string)  encabezado de la segunda columna
 *  - filas              (array)   cada una ['prestacion' => string, 'unidad' => string]
 *  - nota               (string)  HTML del campo WYSIWYG (pasa por wp_kses_post)
 */
$id    = (string) ($args['id'] ?? 'tarifas');
$filas = array_values(array_filter((array) ($args['filas'] ?? []), static fn($fila): bool => trim((string) ($fila['prestacion'] ?? '')) !== ''));
$nota  = trim((string) ($args['nota'] ?? ''));
$col_a = (string) ($args['columna_prestacion'] ?? '');
$col_b = (string) ($args['columna_unidad'] ?? '');
?>
<section class="relative z-[1] bg-white pb-[clamp(88px,7.3vw,140px)]" id="<?= esc_attr($id) ?>">
    <div class="px-[clamp(20px,4.17vw,80px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($args['titulo'] ?? '')]); ?>
    </div>
    <?php if ($filas) : ?>
        <div class="relative mt-[clamp(26px,2.1vw,40px)]">
            <span class="absolute inset-x-0 top-0 h-px bg-line" data-sr="lineX" aria-hidden="true"></span>
            <span class="absolute inset-x-0 bottom-0 h-px bg-line" data-sr="lineX" data-sr-delay="200" aria-hidden="true"></span>
            <div class="relative mx-[clamp(20px,4.17vw,80px)]">
                <span class="absolute inset-y-0 left-0 z-[3] w-px bg-line" data-sr="lineY" data-sr-delay="120" aria-hidden="true"></span>
                <span class="absolute inset-y-0 right-0 z-[3] w-px bg-line" data-sr="lineY" data-sr-delay="120" aria-hidden="true"></span>
                <table class="w-full border-collapse text-left">
                    <thead data-sr="wipe">
                        <tr class="bg-ink text-[13px] font-semibold tracking-[.16em] text-white uppercase">
                            <th scope="col" class="px-[clamp(20px,2.1vw,40px)] py-[clamp(20px,1.5vw,28px)] font-semibold"><?= esc_html($col_a) ?></th>
                            <th scope="col" class="px-[clamp(20px,2.1vw,40px)] py-[clamp(20px,1.5vw,28px)] text-right font-semibold"><?= esc_html($col_b) ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($filas as $i => $fila) : ?>
                            <tr class="border-line [&+&]:border-t">
                                <th scope="row" class="min-w-0 px-[clamp(20px,2.1vw,40px)] py-[clamp(18px,1.4vw,26px)] text-left font-normal">
                                    <span class="block overflow-hidden"><span class="block text-[15px] leading-normal text-ink" data-sr="rise" data-sr-delay="<?= esc_attr((string) ($i * 80)) ?>"><?= esc_html((string) $fila['prestacion']) ?></span></span>
                                </th>
                                <td class="px-[clamp(20px,2.1vw,40px)] py-[clamp(18px,1.4vw,26px)] text-right">
                                    <span class="block overflow-hidden"><span class="block text-[15px] leading-normal font-medium text-ink" data-sr="rise" data-sr-delay="<?= esc_attr((string) ($i * 80 + 60)) ?>"><?= esc_html((string) ($fila['unidad'] ?? '')) ?></span></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($nota !== '') : ?>
        <div class="mx-[clamp(20px,4.17vw,80px)] mt-[clamp(24px,2.1vw,40px)] text-sm leading-[1.6] text-pretty text-gris-7a [&_a]:text-ink [&_a]:underline [&_a]:underline-offset-[3px] [&_a:hover]:text-brand [&_p]:m-0" data-sr="clip" data-sr-delay="200"><?= wp_kses_post($nota) ?></div>
    <?php endif; ?>
</section>
