<?php
defined('ABSPATH') || exit;

/**
 * Imagen en banda 3:1 bajo un texto; entra por recorte. Sin imagen no se imprime nada.
 *
 * $args:
 *  - imagen   (mixed)   campo de imagen de ACF
 *  - alt      (string)  alt; si falta se usa el del archivo
 *  - posicion (string)  clase de object-position escrita completa en la página (p. ej. 'object-[45%_62%]')
 */
$imagen   = $args['imagen'] ?? null;
$alt      = $args['alt'] ?? null;
$posicion = (string) ($args['posicion'] ?? '');

$img = copam_theme_image($imagen, ['size' => 'large', 'class' => 'absolute inset-0 block size-full object-cover ' . $posicion, 'alt' => $alt, 'sizes' => '(max-width: 999px) 100vw, 70vw']);
if ($img === '') {
    return;
}
?>
<div class="mt-[clamp(20px,1.6vw,30px)]">
    <div class="relative aspect-[600/200] overflow-hidden rounded bg-gris-ef" data-sr="card"><?= $img ?></div>
</div>
