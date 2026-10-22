<?php
defined('ABSPATH') || exit;

/**
 * Portada · caso destacado: dos fotos superpuestas con parallax y la historia del primer piloto
 * internacional (módulo `parallax.js`). Lee el grupo `home_caso_destacado` (ACF); el contenido
 * inicial está en inc/acf/seed/home.php.
 */
$caso   = get_field('home_caso_destacado') ?: [];
$cifras = (array) ($caso['cifras'] ?? []);

// El título se muestra en dos líneas con la misma cantidad de palabras (decisión de diseño).
$palabras_titulo = preg_split('/\s+/', trim((string) ($caso['titulo'] ?? '')), -1, PREG_SPLIT_NO_EMPTY);
$corte           = (int) ceil(count($palabras_titulo) / 2);
$lineas_titulo   = array_filter([
    implode(' ', array_slice($palabras_titulo, 0, $corte)),
    implode(' ', array_slice($palabras_titulo, $corte)),
]);
?>
<section class="relative z-[1] bg-white px-[clamp(20px,4.17vw,80px)] py-[clamp(80px,7.3vw,140px)]" data-parallax-root aria-label="<?= esc_attr((string) ($caso['etiqueta'] ?? '')) ?>">
    <div class="grid grid-cols-1 items-center gap-x-[clamp(40px,4.17vw,80px)] gap-y-14 md:grid-cols-[minmax(0,760fr)_minmax(0,920fr)]">
        <div class="relative aspect-[760/620]">
            <div class="absolute top-0 left-0 h-[80.6%] w-[84.2%]" data-sr="wipe">
                <div class="absolute inset-0 overflow-hidden rounded will-change-transform" data-parallax="200">
                    <?= copam_theme_image($caso['imagen_grande'] ?? null, ['class' => 'block size-full object-cover', 'alt' => (string) ($caso['alt_grande'] ?? '')]) ?>
                </div>
            </div>
            <div class="absolute top-[56%] left-[46%] z-[2] h-[41.5%] w-[52%] will-change-transform" data-parallax="-90">
                <div class="absolute inset-0" data-sr="wipe" data-sr-delay="220">
                    <div class="absolute inset-0 overflow-hidden rounded">
                        <?= copam_theme_image($caso['imagen_pequena'] ?? null, ['class' => 'block size-full object-cover object-[48%_50%]', 'alt' => (string) ($caso['alt_pequena'] ?? '')]) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="min-w-0">
            <?php get_template_part('template-parts/components/encabezado-seccion', null, [
                'etiqueta'       => (string) ($caso['etiqueta'] ?? ''),
                'lineas'         => $lineas_titulo,
                'bajada'         => (string) ($caso['descripcion'] ?? ''),
                'variante'       => 'caso',
                'retardo_bajada' => 280,
            ]); ?>
            <ul class="m-0 mt-[clamp(40px,3.6vw,70px)] flex list-none flex-wrap gap-x-[clamp(32px,2.6vw,50px)] gap-y-6 p-0">
                <?php foreach ($cifras as $i => $cifra) : ?>
                    <li class="overflow-hidden">
                        <div data-sr="rise" data-sr-delay="<?= esc_attr((string) (360 + $i * 80)) ?>">
                            <div class="text-[clamp(30px,2.1vw,40px)] leading-[1.1] font-bold tracking-[-.01em] whitespace-nowrap text-brand"><?= esc_html((string) ($cifra['numero'] ?? '')) ?></div>
                            <div class="mt-2 text-[15px] text-gris-5a"><?= esc_html((string) ($cifra['rotulo'] ?? '')) ?></div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>
