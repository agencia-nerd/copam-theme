<?php
defined('ABSPATH') || exit;

/*
 * Hoja de reclamación del Libro de Reclamaciones (wp-form). Definición y reglas:
 * inc/forms/libro-de-reclamaciones.php. La muestra la sección formulario de la página. Comportamiento propio
 * (menor de edad, reglas del documento, fecha, panel de éxito e impresión de la copia):
 * src/js/modules/hoja-reclamacion.js, el mismo de la hoja del Depósito Temporal.
 *
 * $args:
 *  - proveedor     (array)  ['razon_social', 'ruc', 'direccion'] (campos de la página)
 *  - observaciones (string) texto de la parte 5, que completa COPAM al responder
 *  - nota_envio    (string) texto antes del correo de destino
 */
$form_id       = COPAM_THEME_FORM_LIBRO;
$proveedor     = wp_parse_args((array) ($args['proveedor'] ?? []), ['razon_social' => '', 'ruc' => '', 'direccion' => '']);
$observaciones = (string) ($args['observaciones'] ?? '');
$nota_envio    = (string) ($args['nota_envio'] ?? '');
$destino       = copam_theme_correos('libro')[0] ?? '';
$privacy       = get_privacy_policy_url() ?: home_url('/privacidad/');

$dos_col  = 'grid grid-cols-[minmax(0,1fr)] gap-x-[clamp(16px,1.25vw,24px)] gap-y-[clamp(18px,1.4vw,26px)] min-[760px]:grid-cols-[minmax(0,1fr)_minmax(0,1fr)]';
$campo    = 'flex min-w-0 flex-col gap-2.5';
$etiqueta = 'text-sm font-medium text-ink';
$control  = 'box-border w-full rounded-[3px] border border-[#DADADA] bg-white px-4 text-base text-ink outline-0 transition-[border-color] duration-300 hover:border-[#A6A6A6] focus:border-brand aria-invalid:shadow-[inset_0_0_0_1px_var(--color-danger)] disabled:bg-gris-f4';
$input    = $control . ' h-[52px]';
$area     = $control . ' resize-y py-3.5 leading-normal';
$error    = 'm-0 text-[13px] leading-[1.4] text-danger empty:hidden';
$titulo   = 'm-0 text-[clamp(16px,1vw,18px)] font-semibold text-ink';
$linea    = '<span class="my-[clamp(26px,2.1vw,40px)] block h-px bg-[#E6E6E6]" aria-hidden="true"></span>';
$req      = '<span class="text-brand" aria-hidden="true"> *</span>';

$label = static function (string $key, string $texto, bool $obligatorio = true) use ($form_id, $etiqueta, $req): void {
    printf(
        '<label class="%s" for="%s">%s%s</label>',
        esc_attr($etiqueta),
        esc_attr(copam_theme_field_id($form_id, $key)),
        esc_html($texto),
        $obligatorio ? $req : '<span class="font-normal text-[#8C8C8C]"> (opcional)</span>'
    );
};
$caja_error = static function (string $key) use ($form_id, $error): void {
    printf('<p class="%s" ', esc_attr($error));
    copam_theme_error_attrs($form_id, $key);
    echo '></p>';
};

// Opciones con tarjeta: radio real oculto a la vista, el punto y el borde siguen su estado.
$radios = static function (string $key, string $leyenda, array $definiciones = []) use ($form_id, $req, $caja_error): void { ?>
    <fieldset class="m-0 mt-4 min-w-0 border-0 p-0">
        <legend class="p-0 text-sm font-medium text-ink"><?= esc_html($leyenda) . $req // phpcs:ignore WordPress.Security.EscapeOutput -- $req es marcado fijo ?></legend>
        <div class="mt-3 grid grid-cols-[minmax(0,1fr)] gap-2 min-[760px]:grid-cols-[minmax(0,1fr)_minmax(0,1fr)]">
            <?php foreach (copam_theme_field_options($form_id, $key) as $valor => $texto) : ?>
                <label class="group flex min-h-[52px] cursor-pointer items-start gap-3 rounded-[3px] border border-[#DADADA] bg-white px-[18px] py-[15px] text-ink transition-[background-color,border-color] duration-300 has-checked:border-brand has-checked:bg-[#F0F8F3] has-focus-visible:outline-2 has-focus-visible:outline-offset-2 has-focus-visible:outline-brand has-aria-invalid:border-danger">
                    <input class="sr-only" <?php copam_theme_field_attrs($form_id, $key, $valor); ?>>
                    <span class="relative mt-[3px] block size-3.5 flex-none rounded-full border border-[#DADADA] bg-white transition-[border-color] duration-300 group-has-checked:border-brand" aria-hidden="true">
                        <span class="absolute inset-[3px] scale-0 rounded-full bg-brand transition-transform duration-[350ms] ease-in-out group-has-checked:scale-100"></span>
                    </span>
                    <span class="flex min-w-0 flex-col gap-1.5">
                        <span class="text-[15px]" data-hoja-opcion><?= esc_html((string) $texto) ?></span>
                        <?php if (!empty($definiciones[$valor])) : ?>
                            <span class="text-[13px] leading-normal text-pretty text-ink-muted"><?= esc_html($definiciones[$valor]) ?></span>
                        <?php endif; ?>
                    </span>
                </label>
            <?php endforeach; ?>
        </div>
        <?php $caja_error($key); ?>
    </fieldset>
<?php };
?>
<div class="mt-[clamp(28px,2.4vw,46px)]" data-hoja-reclamacion data-hoja-separador="-" data-sr="clip">
    <form class="rounded-md bg-white px-[clamp(20px,1.9vw,36px)] pt-[clamp(26px,2.5vw,48px)] pb-[clamp(26px,2.3vw,44px)] [&_[data-error-for]]:mt-0" <?php copam_theme_form_attrs($form_id); ?>>
        <div class="<?= esc_attr($dos_col) ?>">
            <div class="flex min-w-0 flex-col gap-1.5"><span class="text-[13px] text-gris-7a">Fecha</span><span class="text-[15px] leading-[1.45] text-ink" data-hoja-fecha><?= esc_html(wp_date('d-m-Y')) ?></span></div>
        </div>

        <?= $linea // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo ?>
        <h3 class="<?= esc_attr($titulo) ?>">1. Datos del proveedor</h3>
        <dl class="mt-[18px] mb-0 <?= esc_attr($dos_col) ?>" data-hoja-proveedor>
            <?php
            $datos = [
                ['Razón social', $proveedor['razon_social'], false],
                ['RUC', $proveedor['ruc'], false],
                ['Dirección', $proveedor['direccion'], true],
            ];
            foreach ($datos as [$nombre, $valor, $ancho]) :
                if (trim((string) $valor) === '') {
                    continue;
                } ?>
                <div class="flex min-w-0 flex-col gap-1.5 <?= $ancho ? 'col-span-full' : '' ?>">
                    <dt class="text-[13px] text-gris-7a"><?= esc_html($nombre) ?></dt>
                    <dd class="m-0 text-[15px] leading-[1.45] text-ink"><?= esc_html((string) $valor) ?></dd>
                </div>
            <?php endforeach; ?>
        </dl>

        <?= $linea // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo ?>
        <h3 class="<?= esc_attr($titulo) ?>">2. Identificación del consumidor reclamante</h3>
        <div class="mt-[18px] <?= esc_attr($dos_col) ?>">
            <div class="col-span-full <?= esc_attr($campo) ?>">
                <?php $label('nombre', 'Nombres y apellidos'); ?>
                <input class="<?= esc_attr($input) ?>" placeholder="Ingresa tu nombre completo" <?php copam_theme_field_attrs($form_id, 'nombre'); ?>>
                <?php $caja_error('nombre'); ?>
            </div>
            <div class="<?= esc_attr($campo) ?>">
                <?php $label('doc_tipo', 'Tipo de documento'); ?>
                <span class="relative block">
                    <select class="<?= esc_attr($input) ?> cursor-pointer appearance-none pr-10" data-hoja-doc-tipo <?php copam_theme_field_attrs($form_id, 'doc_tipo'); ?>>
                        <option value="">Selecciona</option>
                        <?php foreach (copam_theme_field_options($form_id, 'doc_tipo') as $valor => $texto) : ?>
                            <option value="<?= esc_attr((string) $valor) ?>"><?= esc_html((string) $texto) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <svg class="pointer-events-none absolute top-[23px] right-4" width="10" height="6" viewBox="0 0 10 6" fill="none" aria-hidden="true"><path d="M1 1l4 4 4-4" stroke="#7A7A7A" stroke-width="1.4"></path></svg>
                </span>
                <?php $caja_error('doc_tipo'); ?>
            </div>
            <div class="<?= esc_attr($campo) ?>">
                <?php $label('num_doc', 'Número de documento'); ?>
                <input class="<?= esc_attr($input) ?>" placeholder="Ej. 45678912" data-hoja-documento <?php copam_theme_field_attrs($form_id, 'num_doc'); ?>>
                <?php $caja_error('num_doc'); ?>
            </div>
            <div class="col-span-full <?= esc_attr($campo) ?>">
                <?php $label('domicilio', 'Domicilio'); ?>
                <input class="<?= esc_attr($input) ?>" placeholder="Dirección completa" <?php copam_theme_field_attrs($form_id, 'domicilio'); ?>>
                <?php $caja_error('domicilio'); ?>
            </div>
            <div class="<?= esc_attr($campo) ?>">
                <?php $label('telefono', 'Teléfono'); ?>
                <input class="<?= esc_attr($input) ?>" placeholder="Ej. 987 654 321" <?php copam_theme_field_attrs($form_id, 'telefono'); ?>>
                <?php $caja_error('telefono'); ?>
            </div>
            <div class="<?= esc_attr($campo) ?>">
                <?php $label('correo', 'Correo electrónico'); ?>
                <input class="<?= esc_attr($input) ?>" placeholder="nombre@empresa.com" <?php copam_theme_field_attrs($form_id, 'correo'); ?>>
                <?php $caja_error('correo'); ?>
            </div>
        </div>

        <div class="mt-5 flex items-center gap-2.5">
            <input class="m-0 size-4 flex-none accent-brand" data-hoja-menor <?php copam_theme_field_attrs($form_id, 'menor'); ?>>
            <label class="cursor-pointer text-sm leading-[1.4] text-ink" for="<?= esc_attr(copam_theme_field_id($form_id, 'menor')) ?>">Soy menor de edad</label>
        </div>
        <div class="grid grid-rows-[0fr] opacity-0 transition-[grid-template-rows,opacity] duration-500 ease-out motion-reduce:transition-none data-abierto:grid-rows-[1fr] data-abierto:opacity-100" data-hoja-apoderado>
            <div class="min-h-0 overflow-hidden">
                <fieldset class="m-0 min-w-0 border-0 px-0 pt-[18px] pb-0.5" disabled>
                    <legend class="sr-only">Datos del padre, madre o apoderado</legend>
                    <div class="<?= esc_attr($dos_col) ?>">
                        <div class="<?= esc_attr($campo) ?>">
                            <?php $label('apo_nombre', 'Nombre del padre, madre o apoderado'); ?>
                            <input class="<?= esc_attr($input) ?>" placeholder="Nombre completo" <?php copam_theme_field_attrs($form_id, 'apo_nombre'); ?>>
                            <?php $caja_error('apo_nombre'); ?>
                        </div>
                        <div class="<?= esc_attr($campo) ?>">
                            <?php $label('apo_documento', 'Número de documento del padre, madre o apoderado'); ?>
                            <input class="<?= esc_attr($input) ?>" placeholder="DNI o CE" <?php copam_theme_field_attrs($form_id, 'apo_documento'); ?>>
                            <?php $caja_error('apo_documento'); ?>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>

        <?= $linea // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo ?>
        <h3 class="<?= esc_attr($titulo) ?>">3. Identificación del bien contratado</h3>
        <?php $radios('bien', 'Tipo'); ?>
        <div class="mt-[18px] <?= esc_attr($dos_col) ?>">
            <div class="<?= esc_attr($campo) ?>">
                <?php $label('monto', 'Monto reclamado (S/)', false); ?>
                <input class="<?= esc_attr($input) ?>" inputmode="decimal" placeholder="Ej. 250.00" data-hoja-monto <?php copam_theme_field_attrs($form_id, 'monto'); ?>>
                <?php $caja_error('monto'); ?>
            </div>
        </div>
        <div class="mt-[clamp(18px,1.4vw,26px)] <?= esc_attr($campo) ?>">
            <?php $label('bien_desc', 'Descripción'); ?>
            <textarea class="<?= esc_attr($area) ?> min-h-[72px]" rows="2" placeholder="Describe el producto o servicio contratado" <?php copam_theme_field_attrs($form_id, 'bien_desc'); ?>></textarea>
            <?php $caja_error('bien_desc'); ?>
        </div>

        <?= $linea // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo ?>
        <h3 class="<?= esc_attr($titulo) ?>">4. Detalle de la reclamación y pedido del consumidor</h3>
        <?php $radios('tipo', 'Tipo', [
            'reclamo' => 'Disconformidad relacionada a los productos o servicios.',
            'queja'   => 'Disconformidad no relacionada a los productos o servicios, o malestar o descontento respecto a la atención al público.',
        ]); ?>
        <div class="mt-[clamp(18px,1.4vw,26px)] grid grid-cols-[minmax(0,1fr)] gap-[clamp(18px,1.4vw,26px)]">
            <div class="<?= esc_attr($campo) ?>">
                <?php $label('detalle', 'Detalle'); ?>
                <textarea class="<?= esc_attr($area) ?> min-h-[120px]" rows="4" placeholder="Describe lo ocurrido" <?php copam_theme_field_attrs($form_id, 'detalle'); ?>></textarea>
                <?php $caja_error('detalle'); ?>
            </div>
            <div class="<?= esc_attr($campo) ?>">
                <?php $label('pedido', 'Pedido'); ?>
                <textarea class="<?= esc_attr($area) ?> min-h-[72px]" rows="2" placeholder="Indica qué solicitas" <?php copam_theme_field_attrs($form_id, 'pedido'); ?>></textarea>
                <?php $caja_error('pedido'); ?>
            </div>
        </div>

        <?= $linea // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo ?>
        <h3 class="<?= esc_attr($titulo) ?>" data-hoja-observaciones-titulo>5. Observaciones y acciones adoptadas por el proveedor</h3>
        <?php if ($observaciones !== '') : ?>
            <p class="mt-3 mb-0 rounded bg-gris-f4 px-4 py-3.5 text-sm leading-normal text-ink-muted" data-hoja-observaciones><?= esc_html($observaciones) ?></p>
        <?php endif; ?>

        <?= $linea // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo ?>
        <?php copam_theme_form_honeypot(); ?>
        <div class="flex flex-wrap items-center justify-between gap-5">
            <div class="flex flex-col gap-2.5 rounded bg-[#EBF4EE] px-4 py-3.5">
                <div class="flex items-center gap-2.5">
                    <input class="m-0 size-4 flex-none accent-brand" <?php copam_theme_field_attrs($form_id, 'consentimiento'); ?>>
                    <label class="cursor-pointer text-sm leading-[1.4] text-ink" for="<?= esc_attr(copam_theme_field_id($form_id, 'consentimiento')) ?>">
                        Declaro que la información proporcionada es verdadera y acepto la <a class="text-ink underline underline-offset-[3px] hover:text-brand" href="<?= esc_url($privacy) ?>" target="_blank" rel="noopener">Política de privacidad<span class="sr-only"> (se abre en una pestaña nueva)</span></a>.<?= $req // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo ?>
                    </label>
                </div>
                <?php $caja_error('consentimiento'); ?>
            </div>
            <button class="group flex h-[52px] cursor-pointer items-center justify-center rounded border-0 bg-brand px-[clamp(24px,1.8vw,34px)] text-[clamp(16px,.95vw,18px)] font-medium tracking-[.02em] text-white uppercase transition-colors duration-[350ms] hover:bg-brand-hover data-loading:cursor-wait data-loading:opacity-70" type="submit" data-loading-label="Enviando...">
                <span class="block h-[1.15em] overflow-hidden leading-[1.15em]">
                    <span class="flex flex-col transition-transform duration-[550ms] ease-in-out group-hover:-translate-y-1/2">
                        <span class="whitespace-nowrap" data-submit-label>Enviar hoja de reclamación</span>
                        <span class="whitespace-nowrap" aria-hidden="true">Enviar hoja de reclamación</span>
                    </span>
                </span>
            </button>
        </div>
        <p class="mt-4 mb-0 text-[13px] leading-normal text-gris-7a empty:hidden data-[state=error]:text-danger data-[state=success]:text-brand" data-form-status role="status" aria-live="polite"></p>
        <?php if ($nota_envio !== '' && $destino !== '') : ?>
            <p class="mt-5 mb-0 text-[13px] leading-normal text-gris-7a"><?= esc_html($nota_envio) ?> <a class="font-medium text-brand underline underline-offset-[3px]" href="<?= esc_url('mailto:' . $destino) ?>"><?= esc_html($destino) ?></a>.</p>
        <?php endif; ?>
    </form>

    <div class="flex flex-col items-start gap-5 rounded-md bg-white px-[clamp(20px,1.9vw,36px)] py-[clamp(26px,2.5vw,48px)] outline-0" data-hoja-exito tabindex="-1" hidden>
        <span class="grid size-11 place-items-center rounded-full bg-[#EBF4EE]" aria-hidden="true">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5L20 6.5" stroke="#0B8A3E" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
        </span>
        <p class="m-0 max-w-[720px] text-[clamp(17px,1.1vw,20px)] leading-normal text-pretty text-ink" role="status" data-hoja-mensaje></p>
        <button class="group mt-4 flex h-[52px] cursor-pointer items-center justify-center rounded border-0 bg-brand px-[clamp(24px,1.8vw,34px)] text-[clamp(16px,.95vw,18px)] font-medium tracking-[.02em] text-white uppercase transition-colors duration-[350ms] hover:bg-brand-hover" type="button" data-hoja-imprimir>
            <span class="block h-[1.15em] overflow-hidden leading-[1.15em]">
                <span class="flex flex-col transition-transform duration-[550ms] ease-in-out group-hover:-translate-y-1/2">
                    <span class="whitespace-nowrap">Imprimir / descargar copia</span>
                    <span class="whitespace-nowrap" aria-hidden="true">Imprimir / descargar copia</span>
                </span>
            </span>
        </button>
    </div>
</div>
