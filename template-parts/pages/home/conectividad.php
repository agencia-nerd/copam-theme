<?php
defined('ABSPATH') || exit;

/**
 * Portada · conectividad: recorrido de seis etapas con mapa a la izquierda y texto a la derecha.
 * Con JS (módulo `pin-conectividad.js`) la sección se fija y cambia de etapa al hacer scroll; sin JS
 * o con movimiento reducido, las seis etapas se leen una tras otra. Lee el grupo `home_conectividad`
 * (ACF); el contenido inicial está en inc/acf/seed/home.php.
 */
$conectividad = get_field('home_conectividad') ?: [];
$bajada = (string) ($conectividad['bajada'] ?? '');
$etapas = array_values(array_filter((array) ($conectividad['etapas'] ?? []), static fn($etapa): bool => !empty($etapa['imagen'])));
$total = count($etapas);
$numeros = array_map(static fn(int $i): string => str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT), array_keys($etapas));
?>
<section class="relative z-[1] bg-white" data-pin="conectividad" data-pin-hold="0.45" aria-label="<?= esc_attr((string) ($conectividad['titulo'] ?? '')) ?>">
    <div class="px-[clamp(20px,4.17vw,80px)] pt-[100px] pb-[clamp(40px,min(6vw,10vh),110px)] min-[760px]:pt-[clamp(84px,min(7.3vw,13vh),140px)] js:sticky js:top-0 js:flex js:h-screen js:flex-col js:overflow-hidden" data-pin-stage>
        <div class="flex-none">
            <?php get_template_part('template-parts/components/encabezado-seccion', null, [
                'etiqueta'       => (string) ($conectividad['etiqueta'] ?? ''),
                'titulo'         => (string) ($conectividad['titulo'] ?? ''),
                'bajada'         => $bajada,
                'variante'       => 'izquierda',
                'retardo_bajada' => 320,
            ]); ?>
        </div>

        <div class="mt-[clamp(20px,min(3.4vw,6vh),66px)] grid grid-cols-1 gap-x-[clamp(24px,2.1vw,40px)] gap-y-7 md:grid-cols-[minmax(0,1.5fr)_1px_minmax(300px,1fr)] xl:grid-cols-[minmax(0,1132fr)_1px_minmax(0,548fr)]">
            <div class="relative flex flex-col gap-3 overflow-hidden rounded-[3px] js:block js:h-[clamp(240px,32vw,620px)]" data-conn-stage>
                <?php foreach ($etapas as $i => $etapa) : ?>
                    <figure class="relative m-0 aspect-[1920/1150] w-full overflow-hidden rounded-[3px] bg-gris-ef js:absolute js:top-0 js:left-0 js:h-0 js:w-0 js:aspect-auto" data-conn-figure>
                        <div class="absolute inset-0 overflow-hidden js:inset-auto js:top-1/2 js:left-1/2" data-conn-media>
                            <?= copam_theme_image($etapa['imagen'], ['class' => 'absolute inset-0 size-full object-cover', 'alt' => (string) ($etapa['titulo'] ?? ''), 'loading' => $i === 0 ? 'eager' : 'lazy']) ?>
                        </div>
                    </figure>
                <?php endforeach; ?>
            </div>

            <span class="hidden w-px bg-line md:block" aria-hidden="true"></span>

            <div class="flex min-w-0 flex-col pt-1">
                <div class="hidden items-center gap-5 text-[13px] tracking-[.04em] text-ink js:flex" aria-hidden="true">
                    <span class="block h-[1.2em] overflow-hidden leading-[1.2em]">
                        <span class="block transition-transform duration-[800ms] ease-in-out" data-conn-counter>
                            <?php foreach ($numeros as $n) : ?><span class="block"><?= esc_html($n) ?></span><?php endforeach; ?>
                        </span>
                    </span>
                    <span class="text-gris-9a">/</span>
                    <span><?= esc_html(str_pad((string) $total, 2, '0', STR_PAD_LEFT)) ?></span>
                </div>

                <div class="mt-[clamp(18px,min(3vw,5vh),58px)] flex flex-col gap-10 js:grid js:grid-rows-[auto_auto] js:gap-x-0 js:gap-y-[clamp(16px,min(2.6vw,4.5vh),50px)]">
                    <?php foreach ($etapas as $i => $etapa) : ?>
                        <div class="flex flex-col gap-4 js:col-start-1 js:row-start-1 js:row-span-2 js:grid js:grid-rows-subgrid<?= $i === 0 ? ' is-active' : '' ?>" data-conn-step>
                            <div class="overflow-hidden pb-[.08em]">
                                <h3 class="m-0 h-full text-[clamp(26px,1.9vw,36px)] leading-[1.1] font-bold tracking-[-.01em] text-ink uppercase" data-conn-title><?= esc_html((string) ($etapa['titulo'] ?? '')) ?></h3>
                            </div>
                            <ul class="m-0 flex list-none flex-col gap-[clamp(8px,min(.9vw,1.6vh),16px)] p-0">
                                <?php foreach ((array) ($etapa['puntos'] ?? []) as $punto) : ?>
                                    <li class="overflow-hidden">
                                        <span class="flex gap-3 text-[clamp(15px,.95vw,18px)] leading-[1.4] text-ink" data-conn-point><span aria-hidden="true">•</span><span><?= esc_html((string) ($punto['texto'] ?? '')) ?></span></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
