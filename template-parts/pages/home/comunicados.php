<?php
defined('ABSPATH') || exit;

/**
 * Portada · comunicados: los tres más recientes como filas. Por ahora son tres comunicados de
 * muestra fijos; al conectar la consulta se reemplaza este arreglo por las entradas reales.
 * El encabezado y el botón leen el grupo `home_comunicados` (ACF; contenido inicial en inc/acf/seed/home.php).
 */
$sec = get_field('home_comunicados') ?: [];
$comunicados = [
    ['categoria' => 'Operativo', 'titulo' => 'Atención restringida en ventanilla durante los feriados del 28 y 29 de julio', 'fecha' => '18 jul 2026'],
    ['categoria' => 'Noticias', 'titulo' => 'Publicación del tarifario vigente 2026 aprobado por OSITRAN', 'fecha' => '02 jul 2026'],
    ['categoria' => 'Noticias', 'titulo' => 'Publicación del Plan Maestro APN 2025 para el TPY-NR', 'fecha' => '03 jun 2026'],
];
$boton = $sec['boton'] ?? null;
$url_comunicados = (string) ($boton['url'] ?? '');
?>
<section class="relative z-[1] bg-white pt-[clamp(72px,5.2vw,100px)] pb-[clamp(96px,7.8vw,150px)]" aria-label="<?= esc_attr((string) ($sec['titulo'] ?? '')) ?>">
    <?php get_template_part('template-parts/components/encabezado-seccion', null, [
        'etiqueta' => (string) ($sec['etiqueta'] ?? ''),
        'titulo'   => (string) ($sec['titulo'] ?? ''),
        'bajada'   => (string) ($sec['bajada'] ?? ''),
    ]); ?>

    <?php if ($comunicados) : ?>
        <div class="relative mt-[clamp(56px,4.4vw,84px)]">
            <span class="absolute inset-x-0 top-0 h-px origin-left bg-line" data-sr="lineX"></span>
            <span class="absolute inset-x-0 bottom-0 h-px origin-left bg-line" data-sr="lineX" data-sr-delay="200"></span>
            <div class="relative mx-[clamp(20px,4.17vw,80px)]">
                <span class="absolute top-0 bottom-0 left-0 w-px origin-top bg-line" data-sr="lineY" data-sr-delay="120"></span>
                <span class="absolute top-0 right-0 bottom-0 w-px origin-top bg-line" data-sr="lineY" data-sr-delay="120"></span>
                <?php foreach ($comunicados as $i => $c) :
                    // Cada fila enlaza a su comunicado; hasta conectar las entradas reales, a la página de comunicados.
                    get_template_part('template-parts/components/comunicado-card', null, $c + ['url' => $url_comunicados, 'separador' => $i > 0]);
                endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="mt-[clamp(56px,4.8vw,92px)] flex justify-center px-5">
        <div class="overflow-hidden rounded-[3px]">
            <?php get_template_part('template-parts/components/boton', null, [
                'texto'  => (string) ($boton['title'] ?? ''),
                'enlace' => $boton,
                'flecha' => true,
                'datos'  => ['sr' => 'rise'],
            ]); ?>
        </div>
    </div>
</section>
