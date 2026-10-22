<?php
defined('ABSPATH') || exit;

/**
 * Portada · reglamentos: cuatro tarjetas con el documento a descargar.
 * Lee el grupo `home_reglamentos` (ACF); el contenido inicial está en inc/acf/seed/home.php.
 */
$reglamentos = get_field('home_reglamentos') ?: [];
$documentos  = (array) ($reglamentos['documentos'] ?? []);
$enlace_normativa = $reglamentos['enlace'] ?? null;

// Tipo y peso del archivo para el atributo title del botón ("PDF · 770 KB").
$peso_archivo = static function ($archivo): string {
    $id = is_array($archivo) ? (int) ($archivo['ID'] ?? $archivo['id'] ?? 0) : (int) $archivo;
    $ruta = $id ? get_attached_file($id) : '';
    $tamano = $ruta && is_readable($ruta) ? size_format((int) filesize($ruta), 0) : '';
    $tipo = $id ? strtoupper((string) pathinfo((string) $ruta, PATHINFO_EXTENSION)) : '';
    return trim($tipo . ($tamano !== '' ? ' · ' . $tamano : ''), ' ·');
};
?>
<section class="relative z-[1] overflow-hidden rounded-t-[clamp(20px,2vw,36px)] bg-gris-f9 pt-[clamp(80px,7.3vw,140px)] pb-[clamp(96px,9.4vw,180px)]" data-hero-next>
    <?php get_template_part('template-parts/components/encabezado-seccion', null, [
        'etiqueta' => (string) ($reglamentos['etiqueta'] ?? ''),
        'titulo'   => (string) ($reglamentos['titulo'] ?? ''),
        'bajada'   => (string) ($reglamentos['bajada'] ?? ''),
    ]); ?>

    <div class="relative mt-[clamp(56px,4.4vw,84px)]">
        <div class="absolute inset-0 bg-[linear-gradient(90deg,var(--color-gris-e4),var(--color-gris-ee)_60%,var(--color-gris-e9))]" data-sr="band"></div>
        <div class="relative grid grid-cols-1 gap-1 px-[clamp(20px,4.17vw,80px)] py-1 sm:grid-cols-2 xl:grid-cols-4">
            <?php foreach ($documentos as $i => $d) : ?>
                <article class="relative flex min-h-[clamp(260px,16vw,307px)] flex-col items-start overflow-hidden rounded bg-white p-[clamp(24px,1.67vw,32px)]" data-sr="card" data-sr-delay="<?= esc_attr((string) ($i * 110)) ?>">
                    <span class="flex items-center gap-2 text-[13px] font-semibold tracking-[.03em] text-brand uppercase">
                        <svg class="block flex-none" width="8" height="9" viewBox="0 0 8 9" aria-hidden="true"><path d="M0 0l8 4.5L0 9z" fill="#0B8A3E"></path></svg>
                        <span><?= esc_html($d['etiqueta']) ?></span>
                    </span>
                    <h3 class="mt-[clamp(20px,1.4vw,26px)] w-full text-[clamp(17px,.95vw,18px)] leading-[1.3] font-bold tracking-[.01em] text-ink uppercase"><?= esc_html($d['titulo']) ?></h3>
                    <p class="mt-3.5 mb-[clamp(28px,2.4vw,46px)] w-full text-[15px] leading-[1.5] text-pretty text-gris-5a"><?= esc_html($d['descripcion']) ?></p>
                    <?php
                    $archivo = $d['archivo'] ?? null;
                    $url = is_array($archivo) ? (string) ($archivo['url'] ?? '') : (string) wp_get_attachment_url((int) $archivo);
                    get_template_part('template-parts/components/boton', null, [
                        'texto'  => __('Descargar', 'copam-theme'),
                        'enlace' => ['url' => $url, 'title' => sprintf(__('Descargar %s', 'copam-theme'), (string) ($d['titulo'] ?? '')), 'target' => '_blank'],
                        'flecha' => true,
                        'titulo' => $peso_archivo($archivo),
                        'clase'  => 'mt-auto',
                    ]); ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if (copam_theme_link_data($enlace_normativa)) : ?>
        <div class="mt-[clamp(28px,2.4vw,46px)] flex justify-center overflow-hidden px-[clamp(20px,4.17vw,80px)]">
            <a<?= copam_theme_link_attrs($enlace_normativa, ['class' => 'inline-flex items-center gap-2 text-[15px] font-medium text-brand hover:text-brand-hover']) ?> data-sr="rise">
                <?= esc_html((string) ($enlace_normativa['title'] ?? '')) ?>
                <svg width="12" height="12" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.6"></path></svg>
            </a>
        </div>
    <?php endif; ?>
</section>
