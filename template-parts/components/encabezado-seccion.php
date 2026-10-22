<?php
defined('ABSPATH') || exit;

/**
 * Encabezado de sección: etiqueta con ícono y línea punteada, título y bajada, con animación de entrada.
 *
 * $args:
 *  - etiqueta (string)        texto pequeño sobre el título
 *  - titulo   (string)        título; se parte en palabras para animarlo, pero es un solo encabezado
 *  - lineas   (array)         alternativa a `titulo`: cada elemento es una línea del título
 *  - bajada   (string)        frase bajo el título
 *  - nivel    (int)           nivel del encabezado (2 por defecto)
 *  - variante (string)        'centrado' (por defecto) | 'izquierda' | 'caso'
 *  - retardo_bajada (int)     milisegundos de espera de la bajada (260 por defecto)
 */
$etiqueta = (string) ($args['etiqueta'] ?? '');
$titulo   = (string) ($args['titulo'] ?? '');
$lineas   = array_values(array_filter((array) ($args['lineas'] ?? []), 'strlen'));
$bajada   = (string) ($args['bajada'] ?? '');
$nivel    = max(1, min(6, (int) ($args['nivel'] ?? 2)));
$variante = (string) ($args['variante'] ?? 'centrado');
$retardo  = (int) ($args['retardo_bajada'] ?? 260);

$estilos = [
    'centrado' => [
        'envoltura' => 'flex flex-col items-center px-[clamp(20px,4.17vw,80px)] text-center',
        'cabecera'  => 'items-center',
        'titulo'    => 'mt-[clamp(18px,1.4vw,26px)] justify-center text-[clamp(36px,3.15vw,60px)] leading-none',
        'bajada'    => 'mt-[clamp(18px,1.4vw,26px)]',
        'base'      => 120,
        'paso'      => 60,
    ],
    'izquierda' => [
        'envoltura' => 'flex flex-col items-start',
        'cabecera'  => 'items-start',
        'titulo'    => 'mt-[clamp(16px,1.4vw,26px)] justify-start text-[clamp(30px,3.15vw,60px)] leading-none',
        'bajada'    => 'mt-[clamp(14px,1.2vw,22px)]',
        'base'      => 100,
        'paso'      => 60,
    ],
    'caso' => [
        'envoltura' => 'flex flex-col items-start',
        'cabecera'  => 'items-start',
        'titulo'    => 'mt-[clamp(20px,1.8vw,34px)] flex-col text-[clamp(28px,2.7vw,52px)] leading-[1.12]',
        'bajada'    => 'mt-[clamp(14px,1.1vw,20px)]',
        'base'      => 100,
        'paso'      => 80,
    ],
];
$e = $estilos[$variante] ?? $estilos['centrado'];

// Cada palabra (o línea) va en su máscara para subir desde abajo.
$partes = $lineas ?: preg_split('/\s+/', trim($titulo), -1, PREG_SPLIT_NO_EMPTY);
$tag    = 'h' . $nivel;
?>
<div class="<?= esc_attr($e['envoltura']) ?>">
    <div class="flex flex-col gap-3.5 <?= esc_attr($e['cabecera']) ?>">
        <?php if ($etiqueta !== '') : ?>
            <div class="flex items-center gap-2.5">
                <svg class="block flex-none" data-sr="icon" width="14" height="14" viewBox="0 0 14 14" aria-hidden="true"><path fill-rule="evenodd" d="M3 0h8v3h3v8h-3v3H3v-3H0V3h3zM4 4v6h6V4z" fill="#0B8A3E"></path></svg>
                <span class="block overflow-hidden"><span class="block text-[13px] font-medium tracking-[.03em] text-gris-4a uppercase" data-sr="rise"><?= esc_html($etiqueta) ?></span></span>
            </div>
            <span class="block h-px w-[175px] bg-[repeating-linear-gradient(90deg,var(--color-gris-bd)_0_4px,transparent_4px_8px)]" data-sr="lineX" data-sr-delay="150"></span>
        <?php endif; ?>
    </div>
    <?php if ($partes) : ?>
        <<?= $tag ?> class="flex flex-wrap gap-x-[.25em] font-bold tracking-[-.02em] text-ink uppercase <?= esc_attr($e['titulo']) ?>">
            <?php foreach ($partes as $i => $parte) : ?>
                <span class="block overflow-hidden pb-[.06em]"><span class="block" data-sr="rise" data-sr-delay="<?= esc_attr((string) ($e['base'] + $i * $e['paso'])) ?>"><?= esc_html($parte) ?></span></span>
            <?php endforeach; ?>
        </<?= $tag ?>>
    <?php endif; ?>
    <?php if ($bajada !== '') : ?>
        <p class="max-w-[720px] text-[15px] leading-[1.6] text-pretty text-gris-4a <?= esc_attr($e['bajada']) ?>" data-sr="clip" data-sr-delay="<?= esc_attr((string) $retardo) ?>"><?= esc_html($bajada) ?></p>
    <?php endif; ?>
</div>
