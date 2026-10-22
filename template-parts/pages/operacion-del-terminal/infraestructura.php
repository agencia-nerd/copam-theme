<?php
defined('ABSPATH') || exit;

/**
 * Operación del terminal · infraestructura y equipamiento: tabla de dos columnas (elemento y capacidad) dentro del
 * marco de líneas, con una fila gris por grupo y sus filas de dato.
 * Lee el grupo `operacion_del_terminal_infraestructura` (ACF).
 */
$grupo  = get_field('operacion_del_terminal_infraestructura') ?: [];
$grupos = array_values(array_filter((array) ($grupo['grupos'] ?? []), static fn($g): bool => trim((string) ($g['nombre'] ?? '')) !== ''));
$col_a  = (string) ($grupo['columna_elemento'] ?? '');
$col_b  = (string) ($grupo['columna_capacidad'] ?? '');
$celda  = 'px-[clamp(16px,2.1vw,40px)] py-[clamp(13px,1vw,18px)]';
$texto  = 'block text-[clamp(14px,.85vw,16px)] leading-[1.4]';
$n      = 0; // Índice de fila para escalonar el revelado.
?>
<section class="relative z-[1] bg-white pb-[clamp(88px,7.3vw,140px)]" id="infraestructura">
    <div class="px-[clamp(20px,4.17vw,80px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    </div>
    <?php if ($grupos) : ?>
        <div class="relative mt-[clamp(26px,2.1vw,40px)]">
            <span class="absolute inset-x-0 top-0 z-[3] h-px bg-line" data-sr="lineX" aria-hidden="true"></span>
            <span class="absolute inset-x-0 bottom-0 z-[3] h-px bg-line" data-sr="lineX" data-sr-delay="200" aria-hidden="true"></span>
            <div class="relative mx-[clamp(20px,4.17vw,80px)]">
                <span class="absolute inset-y-0 left-0 z-[2] w-px bg-line" data-sr="lineY" data-sr-delay="120" aria-hidden="true"></span>
                <span class="absolute inset-y-0 right-0 z-[2] w-px bg-line" data-sr="lineY" data-sr-delay="120" aria-hidden="true"></span>
                <table class="w-full table-fixed border-collapse text-left">
                    <thead data-sr="wipe">
                        <tr class="bg-ink text-xs font-semibold tracking-[.16em] text-white uppercase">
                            <th scope="col" class="px-[clamp(16px,2.1vw,40px)] py-[clamp(16px,1.2vw,22px)] text-left font-semibold"><?= esc_html($col_a) ?></th>
                            <th scope="col" class="px-[clamp(16px,2.1vw,40px)] py-[clamp(16px,1.2vw,22px)] text-right font-semibold"><?= esc_html($col_b) ?></th>
                        </tr>
                    </thead>
                    <?php foreach ($grupos as $g) :
                        $filas = array_values(array_filter((array) ($g['filas'] ?? []), static fn($f): bool => trim((string) ($f['elemento'] ?? '')) !== ''));
                        ?>
                        <tbody class="border-line [&+&]:border-t">
                            <tr class="bg-[#F6F6F6]">
                                <th scope="colgroup" colspan="2" class="<?= esc_attr($celda) ?> text-left">
                                    <span class="block overflow-hidden"><span class="<?= esc_attr($texto) ?> font-semibold text-ink" data-sr="rise" data-sr-delay="<?= esc_attr((string) ($n++ * 40)) ?>"><?= esc_html((string) $g['nombre']) ?></span></span>
                                </th>
                            </tr>
                            <?php foreach ($filas as $fila) :
                                $retardo = $n++ * 40;
                                ?>
                                <tr class="border-t border-line">
                                    <th scope="row" class="<?= esc_attr($celda) ?> text-left font-normal">
                                        <span class="block overflow-hidden"><span class="<?= esc_attr($texto) ?> text-ink" data-sr="rise" data-sr-delay="<?= esc_attr((string) $retardo) ?>"><?= esc_html((string) $fila['elemento']) ?></span></span>
                                    </th>
                                    <td class="<?= esc_attr($celda) ?> text-right">
                                        <span class="block overflow-hidden"><span class="<?= esc_attr($texto) ?> text-gris-7a" data-sr="rise" data-sr-delay="<?= esc_attr((string) ($retardo + 30)) ?>"><?= esc_html((string) ($fila['capacidad'] ?? '')) ?></span></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    <?php endif; ?>
</section>
