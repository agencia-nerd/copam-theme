<?php
defined('ABSPATH') || exit;

/**
 * Comunicados · vacío: reemplaza la rejilla y la paginación cuando la consulta no trae comunicados.
 * Lee `comunicados_vacio` de la página de opciones "Archivo de comunicado" (contenido inicial en inc/acf/seed/comunicados.php).
 */
$sec     = get_field('comunicados_vacio', 'option') ?: [];
$mensaje = trim((string) ($sec['mensaje'] ?? ''));
if ($mensaje === '') {
    return;
}
?>
<div class="mx-[clamp(20px,4.17vw,80px)] mt-[clamp(18px,1.6vw,30px)] border border-[#E6E6E6] px-6 py-[clamp(40px,4vw,76px)] text-center text-base text-gris-7a" role="status"><?= esc_html($mensaje) ?></div>
