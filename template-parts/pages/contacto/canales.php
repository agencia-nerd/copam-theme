<?php
defined('ABSPATH') || exit;

/**
 * Contacto · canales de atención: una tarjeta por área (3 columnas desde 1180 px) sobre una banda gris,
 * cada una con un botón opcional. El botón que baja al formulario deja elegida el área de su tarjeta (contacto.js).
 * Lee el grupo `contacto_canales` (ACF). En la tarjeta "Operaciones", el correo de Ajustes del sitio > Correos >
 * Operaciones se antepone a la segunda línea de la descripción.
 */
$grupo = get_field('contacto_canales') ?: [];
$items = array_values(array_filter((array) ($grupo['items'] ?? []), static fn($item): bool => trim((string) ($item['titulo'] ?? '')) !== ''));

$correo_operaciones = copam_theme_correos('operaciones')[0] ?? '';
foreach ($items as &$item) {
    $descripcion = (string) ($item['descripcion'] ?? '');
    if ($correo_operaciones === '' || sanitize_title((string) $item['titulo']) !== 'operaciones' || str_contains($descripcion, $correo_operaciones)) {
        continue;
    }
    $lineas = preg_split('/\R/', $descripcion);
    if (isset($lineas[1])) {
        $lineas[1] = $correo_operaciones . ' · ' . $lineas[1];
    } else {
        $lineas[] = $correo_operaciones;
    }
    $item['descripcion'] = implode("\n", $lineas);
}
unset($item);
?>
<section class="relative z-[1] bg-white pt-[clamp(40px,3.6vw,68px)] pb-[clamp(88px,7.3vw,140px)]" id="canales" data-canales>
    <div class="px-[clamp(20px,4.17vw,80px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    </div>
    <?php if ($items) : ?>
        <div class="relative mt-[clamp(26px,2.1vw,40px)]">
            <div class="absolute inset-0 bg-[linear-gradient(90deg,var(--color-gris-e4),var(--color-gris-ee)_60%,var(--color-gris-e9))]" data-sr="band" aria-hidden="true"></div>
            <div class="relative grid grid-cols-[minmax(0,1fr)] gap-1 px-[clamp(20px,4.17vw,80px)] py-1 min-[600px]:grid-cols-[repeat(2,minmax(0,1fr))] min-[1180px]:grid-cols-[repeat(3,minmax(0,1fr))]">
                <?php foreach ($items as $i => $item) {
                    get_template_part('template-parts/components/tarjeta-servicio', null, [
                        'titulo'      => (string) $item['titulo'],
                        'descripcion' => (string) ($item['descripcion'] ?? ''),
                        'boton'       => $item['boton'] ?? null,
                        'tamano'      => 'compacta',
                        'retardo'     => ($i % 3) * 110 + intdiv($i, 3) * 90,
                    ]);
                } ?>
            </div>
        </div>
    <?php endif; ?>
</section>
