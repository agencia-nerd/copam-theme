<?php
defined('ABSPATH') || exit;

/**
 * Compromiso Ambiental · galería: franja de imágenes de cierre, sin título.
 * Lee el grupo `compromiso_ambiental_galeria` (ACF).
 */
$grupo    = get_field('compromiso_ambiental_galeria') ?: [];
$imagenes = array_values(array_filter((array) ($grupo['imagenes'] ?? [])));
if (!$imagenes) {
    return;
}
?>
<div class="grid grid-cols-3 gap-1.5">
    <?php foreach ($imagenes as $i => $imagen) : ?>
        <div class="relative aspect-[200/144] overflow-hidden rounded bg-gris-ef" data-sr="card" data-sr-delay="<?= esc_attr((string) (($i % 3) * 110)) ?>">
            <?= copam_theme_image($imagen, ['size' => 'large', 'class' => 'absolute inset-0 block size-full object-cover', 'sizes' => '(max-width: 999px) 33vw, 22vw']) ?>
        </div>
    <?php endforeach; ?>
</div>
