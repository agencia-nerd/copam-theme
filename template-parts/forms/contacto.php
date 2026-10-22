<?php
defined('ABSPATH') || exit;

/*
 * Formulario de contacto (wp-form). Definición y reglas: inc/forms/contacto.php.
 * Lo muestra la sección formulario de Contacto; la tarjeta "Comercial" de Canales elige su área (contacto.js).
 *
 * $args:
 *  - nota_envio (string)  aviso bajo el formulario, antes del correo de destino
 */
$form_id = COPAM_THEME_FORM_CONTACTO;
$nota    = (string) ($args['nota_envio'] ?? '');
$destino = copam_theme_correos('contacto')[0] ?? '';
$privacy = get_privacy_policy_url() ?: home_url('/privacidad/');

$campo   = 'flex min-w-0 flex-col gap-2.5';
$control = 'box-border w-full rounded-[3px] border border-[#DADADA] bg-white px-4 text-[15px] text-ink outline-0 transition-[border-color] duration-300 hover:border-[#A6A6A6] focus:border-brand aria-invalid:shadow-[inset_0_0_0_1px_var(--color-danger)]';
$input   = $control . ' h-[52px]';
$error   = 'm-0 text-[13px] leading-[1.4] text-danger empty:hidden';

$label = static function (string $key, string $texto) use ($form_id): void {
    printf('<label class="text-sm font-medium text-ink" for="%s">%s</label>', esc_attr(copam_theme_field_id($form_id, $key)), esc_html($texto));
};
$caja_error = static function (string $key) use ($form_id, $error): void {
    printf('<p class="%s" ', esc_attr($error));
    copam_theme_error_attrs($form_id, $key);
    echo '></p>';
};
?>
<form class="mt-[clamp(28px,2.4vw,46px)] rounded-md bg-white p-[clamp(24px,2.6vw,50px)]" data-sr="wipe" data-contacto-form <?php copam_theme_form_attrs($form_id); ?>>
    <div class="grid grid-cols-[minmax(0,1fr)] gap-x-[clamp(16px,1.25vw,24px)] gap-y-[clamp(18px,1.4vw,26px)] min-[760px]:grid-cols-[minmax(0,1fr)_minmax(0,1fr)]">
        <div class="<?= esc_attr($campo) ?>">
            <?php $label('nombre', 'Nombre y apellidos'); ?>
            <input class="<?= esc_attr($input) ?>" placeholder="Ingresa tu nombre completo" <?php copam_theme_field_attrs($form_id, 'nombre'); ?>>
            <?php $caja_error('nombre'); ?>
        </div>
        <div class="<?= esc_attr($campo) ?>">
            <?php $label('correo', 'Correo electrónico'); ?>
            <input class="<?= esc_attr($input) ?>" placeholder="nombre@empresa.com" <?php copam_theme_field_attrs($form_id, 'correo'); ?>>
            <?php $caja_error('correo'); ?>
        </div>
        <div class="<?= esc_attr($campo) ?>">
            <?php $label('telefono', 'Teléfono'); ?>
            <input class="<?= esc_attr($input) ?>" inputmode="tel" placeholder="Ej. 987 654 321" <?php copam_theme_field_attrs($form_id, 'telefono'); ?>>
            <?php $caja_error('telefono'); ?>
        </div>
        <div class="<?= esc_attr($campo) ?>">
            <?php $label('area', 'Área'); ?>
            <span class="relative block">
                <select class="<?= esc_attr($input) ?> cursor-pointer appearance-none pr-10" data-contacto-area <?php copam_theme_field_attrs($form_id, 'area'); ?>>
                    <option value="" disabled selected>Selecciona un área</option>
                    <?php foreach (copam_theme_field_options($form_id, 'area') as $valor => $texto) : ?>
                        <option value="<?= esc_attr((string) $valor) ?>"><?= esc_html((string) $texto) ?></option>
                    <?php endforeach; ?>
                </select>
                <svg class="pointer-events-none absolute top-[23px] right-4" width="10" height="6" viewBox="0 0 10 6" fill="none" aria-hidden="true"><path d="M1 1l4 4 4-4" stroke="#7A7A7A" stroke-width="1.4"></path></svg>
            </span>
            <?php $caja_error('area'); ?>
        </div>
        <div class="col-span-full <?= esc_attr($campo) ?>">
            <?php $label('mensaje', 'Mensaje'); ?>
            <textarea class="<?= esc_attr($control) ?> min-h-[150px] resize-y py-3.5 leading-normal" rows="5" placeholder="Cuéntanos tu consulta" <?php copam_theme_field_attrs($form_id, 'mensaje'); ?>></textarea>
            <?php $caja_error('mensaje'); ?>
        </div>
    </div>

    <?php copam_theme_form_honeypot(); ?>
    <div class="mt-[clamp(20px,1.7vw,32px)] flex flex-wrap items-center justify-between gap-5">
        <div class="flex flex-col gap-2.5">
            <div class="flex items-center gap-2.5">
                <input class="m-0 size-4 flex-none accent-brand" <?php copam_theme_field_attrs($form_id, 'privacidad'); ?>>
                <label class="cursor-pointer text-sm leading-[1.4] text-ink-muted" for="<?= esc_attr(copam_theme_field_id($form_id, 'privacidad')) ?>">
                    Acepto la <a class="text-ink underline underline-offset-[3px] hover:text-brand" href="<?= esc_url($privacy) ?>" target="_blank" rel="noopener">Política de privacidad<span class="sr-only"> (se abre en una pestaña nueva)</span></a> y el tratamiento de mis datos personales.
                </label>
            </div>
            <?php $caja_error('privacidad'); ?>
        </div>
        <button class="group flex h-[52px] cursor-pointer items-center justify-center rounded border-0 bg-brand px-[clamp(24px,1.8vw,34px)] text-[clamp(16px,.95vw,18px)] font-medium tracking-[.02em] text-white uppercase transition-colors duration-[350ms] hover:bg-brand-hover data-loading:cursor-wait data-loading:opacity-70" type="submit" data-loading-label="Enviando...">
            <span class="block h-[1.15em] overflow-hidden leading-[1.15em]">
                <span class="flex flex-col transition-transform duration-[550ms] ease-in-out group-hover:-translate-y-1/2">
                    <span class="whitespace-nowrap" data-submit-label>Enviar mensaje</span>
                    <span class="whitespace-nowrap" aria-hidden="true">Enviar mensaje</span>
                </span>
            </span>
        </button>
    </div>
    <p class="mt-4 mb-0 rounded bg-[#EBF4EE] px-4 py-3.5 text-[15px] leading-normal text-[#0B7A38] empty:hidden data-[state=error]:bg-transparent data-[state=error]:p-0 data-[state=error]:text-[13px] data-[state=error]:text-danger" data-form-status role="status" aria-live="polite"></p>
    <?php if ($nota !== '' && $destino !== '') : ?>
        <p class="mt-3.5 mb-0 text-[13px] leading-normal text-gris-7a"><?= esc_html($nota) ?> <a class="font-medium text-brand underline underline-offset-[3px]" href="<?= esc_url('mailto:' . $destino) ?>"><?= esc_html($destino) ?></a></p>
    <?php endif; ?>
</form>
