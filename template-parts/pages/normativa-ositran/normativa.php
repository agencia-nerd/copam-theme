<?php
defined('ABSPATH') || exit;

/**
 * Normativa OSITRAN · normativa aplicable: acordeón por grupo (reglamentos, REOP, resoluciones tarifarias, otras)
 * dentro del marco de líneas de la página (wp-accordion, vista template-parts/accordions/documentos-grupos.php).
 * Con `?grupo=resoluciones` en la URL se abren también los grupos de resoluciones tarifarias.
 * Lee el grupo `normativa_ositran_normativa` (ACF).
 */
$grupo        = get_field('normativa_ositran_normativa') ?: [];
$param        = $_GET['grupo'] ?? ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- solo elige qué grupos abren
$resoluciones = is_string($param) && sanitize_key(wp_unslash($param)) === 'resoluciones';

$grupos = [];
foreach (array_values((array) ($grupo['grupos'] ?? [])) as $i => $g) {
    $nombre = (string) ($g['titulo'] ?? '');
    $fila   = [
        'nombre'       => $nombre,
        'estado_vacio' => (string) ($g['estado_vacio'] ?? ''),
        'enlace_extra' => $g['enlace_extra'] ?? null,
        'documentos'   => array_map(static fn($doc): array => [
            'titulo'         => (string) ($doc['titulo'] ?? ''),
            'subtitulo'      => (string) ($doc['detalle'] ?? ''),
            'vigente'        => !empty($doc['vigente']),
            'archivo'        => $doc['archivo'] ?? null,
            'enlace_externo' => (string) ($doc['enlace_externo'] ?? ''),
        ], (array) ($g['documentos'] ?? [])),
    ];
    if ($resoluciones) {
        $fila['abierto'] = $i === 0 || mb_stripos($nombre, 'resoluciones tarifarias') !== false;
    }
    $grupos[] = $fila;
}
?>
<section class="relative z-[1] bg-white pt-[clamp(40px,3.6vw,68px)] pb-[clamp(88px,7.3vw,140px)]" id="normativa">
    <div class="px-[clamp(20px,4.17vw,80px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    </div>
    <div class="relative mt-[clamp(26px,2.1vw,40px)]">
        <span class="absolute inset-x-0 top-0 z-[3] h-px bg-line" data-sr="lineX" aria-hidden="true"></span>
        <span class="absolute inset-x-0 bottom-0 z-[3] h-px bg-line" data-sr="lineX" data-sr-delay="200" aria-hidden="true"></span>
        <div class="relative mx-[clamp(20px,4.17vw,80px)]">
            <span class="absolute inset-y-0 left-0 z-[2] w-px bg-line" data-sr="lineY" data-sr-delay="120" aria-hidden="true"></span>
            <span class="absolute inset-y-0 right-0 z-[2] w-px bg-line" data-sr="lineY" data-sr-delay="120" aria-hidden="true"></span>
            <?php get_template_part('template-parts/accordions/documentos-grupos', null, [
                'id'            => 'normativa-grupos',
                'grupos'        => $grupos,
                'mensaje_vacio' => __('Los documentos de esta sección se publicarán próximamente.', 'copam-theme'),
            ]); ?>
        </div>
    </div>
</section>
