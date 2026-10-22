<?php
defined('ABSPATH') || exit;

/*
 * Reporte del Canal de hostigamiento sexual (wp-form). Definición, reglas y evidencia:
 * inc/forms/reporte-hostigamiento.php. Lo muestra la sección reporte del Canal.
 * Los datos según "¿Deseas identificarte?", la fecha y la zona de evidencia: src/js/modules/reporte-hostigamiento.js.
 *
 * $args:
 *  - nota_envio (string)  aviso bajo el formulario, antes del correo del Delegado
 */
$form_id = COPAM_THEME_FORM_REPORTE;
$nota    = (string) ($args['nota_envio'] ?? '');
$destino = copam_theme_correos('hostigamiento')[0] ?? '';

$dos_col  = 'grid grid-cols-[minmax(0,1fr)] gap-x-[clamp(16px,1.25vw,24px)] gap-y-[clamp(18px,1.4vw,26px)] min-[760px]:grid-cols-[minmax(0,1fr)_minmax(0,1fr)]';
$campo    = 'flex min-w-0 flex-col gap-2.5';
$control  = 'box-border w-full rounded-[3px] border border-[#DADADA] bg-white px-4 text-[15px] text-ink outline-0 transition-[border-color] duration-300 hover:border-[#A6A6A6] focus:border-brand aria-invalid:shadow-[inset_0_0_0_1px_var(--color-danger)]';
$input    = $control . ' h-[52px]';
$error    = 'm-0 text-[13px] leading-[1.4] text-danger empty:hidden';
$linea    = '<span class="my-[clamp(24px,1.9vw,36px)] block h-px bg-[#E6E6E6]" aria-hidden="true"></span>';
$opcional = '<span class="font-normal text-[#8C8C8C]"> (opcional)</span>';

$label = static function (string $key, string $texto, bool $obligatorio = true) use ($form_id, $opcional): void {
    printf(
        '<label class="text-sm font-medium text-ink" for="%s">%s%s</label>',
        esc_attr(copam_theme_field_id($form_id, $key)),
        esc_html($texto),
        $obligatorio ? '' : $opcional // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo
    );
};
$caja_error = static function (string $key) use ($form_id, $error): void {
    printf('<p class="%s" ', esc_attr($error));
    copam_theme_error_attrs($form_id, $key);
    echo '></p>';
};

// Opciones en píldora: radio real oculto a la vista; la opción por defecto va marcada para que form.reset() vuelva a ella.
$radios = static function (string $key, string $leyenda, string $marcada, array $datos = []) use ($form_id, $caja_error): void { ?>
    <fieldset class="m-0 min-w-0 border-0 p-0">
        <legend class="p-0 text-sm font-medium text-ink"><?= esc_html($leyenda) ?></legend>
        <div class="mt-3.5 flex flex-wrap gap-2">
            <?php foreach (copam_theme_field_options($form_id, $key) as $valor => $texto) : ?>
                <label class="group flex h-11 cursor-pointer items-center gap-2.5 rounded-[3px] border border-[#DADADA] bg-white px-[18px] text-[15px] text-ink transition-[background-color,border-color] duration-300 has-checked:border-brand has-checked:bg-[#F0F8F3] has-focus-visible:outline-2 has-focus-visible:outline-offset-2 has-focus-visible:outline-brand">
                    <input class="sr-only" <?php copam_theme_field_attrs($form_id, $key, $valor); ?><?php checked((string) $valor, $marcada); ?><?php foreach ($datos as $nombre => $v) { echo ' data-' . esc_attr($nombre) . '="' . esc_attr($v) . '"'; } ?>>
                    <span class="relative block size-3.5 flex-none rounded-full border border-[#DADADA] bg-white transition-[border-color] duration-300 group-has-checked:border-brand" aria-hidden="true">
                        <span class="absolute inset-[3px] scale-0 rounded-full bg-brand transition-transform duration-[350ms] ease-in-out group-has-checked:scale-100"></span>
                    </span>
                    <span><?= esc_html((string) $texto) ?></span>
                </label>
            <?php endforeach; ?>
        </div>
        <?php $caja_error($key); ?>
    </fieldset>
<?php };

// Bloque que se abre o se cierra según la identificación; cerrado, su fieldset queda deshabilitado.
$bloque_inicio = static function (string $cual, bool $abierto) { ?>
    <div class="grid grid-rows-[0fr] opacity-0 transition-[grid-template-rows,opacity] duration-500 ease-out motion-reduce:transition-none data-abierto:grid-rows-[1fr] data-abierto:opacity-100" data-reporte-bloque="<?= esc_attr($cual) ?>"<?= $abierto ? ' data-abierto' : '' ?>>
        <div class="min-h-0 overflow-hidden">
            <fieldset class="m-0 min-w-0 border-0 px-0 pt-[18px] pb-0.5"<?= $abierto ? '' : ' disabled' ?>>
<?php };
$bloque_fin = static function () { ?>
            </fieldset>
        </div>
    </div>
<?php };
?>
<form class="mt-[clamp(28px,2.4vw,46px)] rounded-md bg-white px-[clamp(20px,1.9vw,36px)] pt-[clamp(26px,2.5vw,48px)] pb-[clamp(26px,2.3vw,44px)]" data-sr="clip" data-reporte <?php copam_theme_form_attrs($form_id); ?>>
    <?php $radios('quien', '¿Quién reporta?', 'trabajador'); ?>

    <?= $linea // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo ?>
    <?php $radios('identificarse', '¿Deseas identificarte?', 'si', ['reporte-identificarse' => '']); ?>
    <p class="mt-3.5 mb-0 text-[13px] leading-normal text-ink-muted">Puedes presentar tu reporte de forma anónima. Si deseas recibir respuesta, deja un correo de contacto.</p>

    <?php $bloque_inicio('anonimo', false); ?>
        <legend class="sr-only">Contacto opcional</legend>
        <div class="<?= esc_attr($dos_col) ?>">
            <div class="<?= esc_attr($campo) ?>">
                <?php $label('correo_contacto', 'Correo de contacto', false); ?>
                <input class="<?= esc_attr($input) ?>" placeholder="nombre@correo.com" <?php copam_theme_field_attrs($form_id, 'correo_contacto'); ?>>
                <?php $caja_error('correo_contacto'); ?>
            </div>
        </div>
    <?php $bloque_fin(); ?>

    <?php $bloque_inicio('identificado', true); ?>
        <legend class="sr-only">Tus datos</legend>
        <div class="<?= esc_attr($dos_col) ?>">
            <div class="<?= esc_attr($campo) ?>">
                <?php $label('nombre', 'Nombre y apellidos'); ?>
                <input class="<?= esc_attr($input) ?>" <?php copam_theme_field_attrs($form_id, 'nombre'); ?>>
                <?php $caja_error('nombre'); ?>
            </div>
            <div class="<?= esc_attr($campo) ?>">
                <?php $label('documento', 'Documento de identidad'); ?>
                <input class="<?= esc_attr($input) ?>" placeholder="DNI o CE" <?php copam_theme_field_attrs($form_id, 'documento'); ?>>
                <?php $caja_error('documento'); ?>
            </div>
            <div class="<?= esc_attr($campo) ?>">
                <?php $label('correo', 'Correo electrónico'); ?>
                <input class="<?= esc_attr($input) ?>" placeholder="nombre@correo.com" <?php copam_theme_field_attrs($form_id, 'correo'); ?>>
                <?php $caja_error('correo'); ?>
            </div>
            <div class="<?= esc_attr($campo) ?>">
                <?php $label('telefono', 'Teléfono', false); ?>
                <input class="<?= esc_attr($input) ?>" inputmode="tel" <?php copam_theme_field_attrs($form_id, 'telefono'); ?>>
                <?php $caja_error('telefono'); ?>
            </div>
        </div>
    <?php $bloque_fin(); ?>

    <?= $linea // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo ?>
    <?php $radios('afectada', '¿Eres la persona afectada?', 'si'); ?>

    <?= $linea // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo ?>
    <div class="<?= esc_attr($dos_col) ?>">
        <div class="<?= esc_attr($campo) ?>">
            <?php $label('fecha', 'Fecha aproximada de los hechos', false); ?>
            <input class="<?= esc_attr($input) ?>" data-reporte-fecha <?php copam_theme_field_attrs($form_id, 'fecha'); ?>>
            <?php $caja_error('fecha'); ?>
        </div>
        <div class="<?= esc_attr($campo) ?>">
            <?php $label('lugar', 'Lugar', false); ?>
            <input class="<?= esc_attr($input) ?>" <?php copam_theme_field_attrs($form_id, 'lugar'); ?>>
            <?php $caja_error('lugar'); ?>
        </div>
    </div>
    <div class="mt-[clamp(18px,1.4vw,26px)] grid grid-cols-[minmax(0,1fr)] gap-[clamp(18px,1.4vw,26px)]">
        <div class="<?= esc_attr($campo) ?>">
            <?php $label('descripcion', 'Descripción de los hechos'); ?>
            <textarea class="<?= esc_attr($control) ?> min-h-[120px] resize-y py-3.5 leading-normal" rows="5" <?php copam_theme_field_attrs($form_id, 'descripcion'); ?>></textarea>
            <?php $caja_error('descripcion'); ?>
        </div>
        <div class="<?= esc_attr($campo) ?>">
            <?php $label('involucrados', 'Persona(s) involucrada(s)', false); ?>
            <input class="<?= esc_attr($input) ?>" <?php copam_theme_field_attrs($form_id, 'involucrados'); ?>>
            <?php $caja_error('involucrados'); ?>
        </div>
        <div class="<?= esc_attr($campo) ?>" data-reporte-evidencia data-ajax-url="<?= esc_url(admin_url('admin-ajax.php')) ?>">
            <label class="text-sm font-medium text-ink" for="reporte-evidencia">Adjuntar evidencia<span class="font-normal text-[#8C8C8C]"> (opcional)</span></label>
            <div class="group relative flex min-h-24 cursor-pointer flex-col items-center justify-center gap-3.5 rounded-[3px] border border-dashed border-[#DADADA] bg-white px-4 py-5 text-center transition-[border-color,background-color] duration-300 hover:border-brand hover:bg-[#F0F8F3] has-focus-visible:border-brand has-focus-visible:outline-2 has-focus-visible:outline-offset-2 has-focus-visible:outline-brand data-arrastre:border-brand data-arrastre:bg-[#F0F8F3]" data-reporte-zona>
                <input class="absolute inset-0 size-full cursor-pointer opacity-0" id="reporte-evidencia" type="file" multiple accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png" aria-describedby="reporte-evidencia-estado" data-reporte-archivos>
                <span class="grid size-9 place-items-center rounded-full bg-gris-ef text-[#7A7A7A] transition-[background-color,color,transform] duration-300 group-hover:scale-[1.08] group-hover:bg-brand group-hover:text-white group-data-arrastre:scale-[1.08] group-data-arrastre:bg-brand group-data-arrastre:text-white" aria-hidden="true">
                    <svg class="block overflow-visible" width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 9V1.5M4 4.5l3-3 3 3" stroke="currentColor" stroke-width="1.3"></path><path d="M1.5 9v3h11V9" stroke="currentColor" stroke-width="1.3"></path></svg>
                </span>
                <span class="text-[13px] leading-[1.45] text-[#8C8C8C] data-[state=error]:text-danger" id="reporte-evidencia-estado" data-reporte-estado aria-live="polite">Arrastra tus archivos o haz clic para adjuntar · PDF, JPG o PNG, hasta 10 MB</span>
            </div>
            <input hidden <?php copam_theme_field_attrs($form_id, 'adjuntos'); ?> data-reporte-lote>
            <?php $caja_error('adjuntos'); ?>
        </div>
    </div>

    <?= $linea // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo ?>
    <?php copam_theme_form_honeypot(); ?>
    <div class="flex flex-wrap items-center justify-between gap-5">
        <div class="flex max-w-[640px] flex-col gap-2.5 rounded bg-[#EBF4EE] px-4 py-3.5">
            <div class="flex items-center gap-2.5">
                <input class="m-0 size-4 flex-none accent-brand" <?php copam_theme_field_attrs($form_id, 'declaracion'); ?>>
                <label class="cursor-pointer text-sm leading-[1.4] text-ink" for="<?= esc_attr(copam_theme_field_id($form_id, 'declaracion')) ?>">Declaro que la información es veraz y acepto que sea tratada de forma confidencial por el Delegado.</label>
            </div>
            <?php $caja_error('declaracion'); ?>
        </div>
        <button class="group flex h-[52px] cursor-pointer items-center justify-center rounded border-0 bg-brand px-[clamp(24px,1.8vw,34px)] text-[clamp(16px,.95vw,18px)] font-medium tracking-[.02em] text-white uppercase transition-colors duration-[350ms] hover:bg-brand-hover disabled:cursor-wait data-loading:cursor-wait data-loading:opacity-70" type="submit" data-loading-label="Enviando...">
            <span class="whitespace-nowrap" data-submit-label>Enviar reporte</span>
        </button>
    </div>
    <p class="mt-4 mb-0 rounded bg-[#EBF4EE] px-4 py-3.5 text-[15px] leading-normal text-[#0B7A38] empty:hidden data-[state=error]:bg-transparent data-[state=error]:p-0 data-[state=error]:text-[13px] data-[state=error]:text-danger" data-form-status role="status" aria-live="polite"></p>
    <?php if ($nota !== '' && $destino !== '') : ?>
        <p class="mt-3.5 mb-0 text-[13px] leading-normal text-gris-7a"><?= esc_html($nota) ?> <a class="font-medium text-brand underline underline-offset-[3px]" href="<?= esc_url('mailto:' . $destino) ?>"><?= esc_html($destino) ?></a></p>
    <?php endif; ?>
</form>
