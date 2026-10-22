<?php
defined('ABSPATH') || exit;

/**
 * Operación del terminal · información operativa: tarjetas (3 columnas desde 1180 px, 2 desde 600 px) sobre una
 * banda gris; cada una con título, texto y un botón que descarga un PDF (si hay archivo) o lleva a su enlace.
 * Lee el grupo `operacion_del_terminal_informacion` (ACF).
 */
$grupo    = get_field('operacion_del_terminal_informacion') ?: [];
$tarjetas = array_values(array_filter((array) ($grupo['tarjetas'] ?? []), static fn($t): bool => trim((string) ($t['titulo'] ?? '')) !== ''));
?>
<section class="relative z-[1] bg-white pt-[clamp(40px,3.6vw,68px)] pb-[clamp(88px,7.3vw,140px)]" id="informacion">
    <div class="px-[clamp(20px,4.17vw,80px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    </div>
    <?php if ($tarjetas) : ?>
        <div class="relative mt-[clamp(26px,2.1vw,40px)]">
            <div class="absolute inset-0 bg-[linear-gradient(90deg,var(--color-gris-e4),var(--color-gris-ee)_60%,var(--color-gris-e9))]" data-sr="band" aria-hidden="true"></div>
            <div class="relative grid grid-cols-[minmax(0,1fr)] gap-1 px-[clamp(20px,4.17vw,80px)] py-1 sm:grid-cols-[repeat(2,minmax(0,1fr))] xl:grid-cols-[repeat(3,minmax(0,1fr))]">
                <?php foreach ($tarjetas as $i => $tarjeta) :
                    $descripcion = (string) ($tarjeta['descripcion'] ?? '');
                    $archivo     = $tarjeta['archivo'] ?? null;
                    $enlace      = $tarjeta['boton'] ?? null;
                    if (is_array($archivo) && !empty($archivo['url'])) {
                        $boton_texto  = (string) ($tarjeta['boton_texto'] ?? '');
                        $boton_enlace = ['url' => (string) $archivo['url'], 'target' => '_blank'];
                        $boton_titulo = 'PDF' . (!empty($archivo['filesize']) ? ' · ' . size_format((int) $archivo['filesize'], 0) : '');
                    } else {
                        $enlace_data  = copam_theme_link_data($enlace);
                        $boton_texto  = (string) ($enlace_data['title'] ?? '');
                        $boton_enlace = $enlace_data ? $enlace : null;
                        $boton_titulo = '';
                    }
                    $retardo = ($i % 3) * 110 + intdiv($i, 3) * 90;
                    ?>
                    <article class="flex min-h-[clamp(150px,9vw,172px)] min-w-0 flex-col items-start rounded bg-white px-[clamp(22px,1.7vw,32px)] py-[clamp(24px,1.9vw,36px)]" data-sr="card" data-sr-delay="<?= esc_attr((string) $retardo) ?>">
                        <h3 class="m-0 text-[clamp(16px,.9vw,17px)] leading-[1.3] font-bold tracking-[.01em] text-ink uppercase"><?= esc_html((string) $tarjeta['titulo']) ?></h3>
                        <?php if ($descripcion !== '') : ?>
                            <p class="mt-3 mb-0 text-[15px] leading-[1.55] whitespace-pre-line text-pretty text-ink-muted"><?= esc_html($descripcion) ?></p>
                        <?php endif; ?>
                        <?php if ($boton_enlace && trim($boton_texto) !== '') : ?>
                            <div class="mt-auto pt-[clamp(22px,1.7vw,32px)]">
                                <?php get_template_part('template-parts/components/boton', null, [
                                    'texto'  => $boton_texto,
                                    'enlace' => $boton_enlace,
                                    'titulo' => $boton_titulo,
                                    'flecha' => true,
                                    'tamano' => 'chico',
                                ]); ?>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</section>
