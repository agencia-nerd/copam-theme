# Copam — tema WordPress

Stack: WordPress (Local WP) + Vite + Tailwind + pnpm.

## Paquetes (pnpm)
- Usa solo `pnpm`. Nunca `npm`, `yarn` ni `npx`; para ejecutar un paquete usa `pnpm dlx`.
- No bajes `minimumReleaseAge` en `pnpm-workspace.yaml`.
- No apruebes `allowBuilds` sin revisar antes el paquete y avisarme.

## PHP
- Empieza el nombre de toda función, hook y constante con el prefijo `copam_theme_`. El text domain es `copam-theme`.
- En `functions.php` solo escribe `require_once` de archivos de `inc/`.
- Pon el código nuevo en un archivo nuevo de `inc/`, y agrégalo a `functions.php`.
- Empieza todo archivo de `inc/` con `defined('ABSPATH') || exit;`.
- Escapa toda salida con `esc_html`, `esc_url` o `esc_attr`.
- No crees `acf.php`, `acf-json/` ni field groups por iniciativa propia. Cómo se crean (admin, ACF JSON o código) lo define el pedido o la skill que lo haga; si no está definido, pregúntame.

## Páginas
- La portada es `front-page.php`: WordPress la usa sola para la página "Inicio" (fijada en Ajustes → Lectura). No tiene `Template Name` ni se elige en el admin. El tema crea "Inicio" al activarse (`inc/crear-inicio.php`).
- Crea cada otra página con diseño propio como `pages/template-<nombre>.php`, con `Template Name:` en la cabecera.
- Llama una sola vez a `get_header()` y a `get_footer()` en cada plantilla, y pon el contenido dentro de `<main id="main-content">`.
- Pon cada sección de una sola página en `template-parts/pages/<página>/<sección>.php` (la portada usa `home/`).
- Pon las piezas que se repiten en 2 o más páginas, o los bloques chicos (card, botón), en `template-parts/components/<nombre>.php`. Si una sección de página pasa a usarse en una segunda, muévela a `components/`.
- Incluye cada pieza con `get_template_part('template-parts/...', null, $args)` y lee `$args` dentro, escapando la salida. Los forms y modals tienen sus propias carpetas (`forms/`, `modals/`).

## Tailwind
- No agregues `@source`: Tailwind detecta las clases solo. Agrégalo únicamente si una ruta no se detecta.

## Comandos
- `pnpm dev`: inicia Vite con HMR (crea `hot` y lo borra al detenerse).
- `pnpm build`: genera `dist/` y `manifest.json`.

## Deploy
- No commitees `dist/` (está en `.gitignore`).
- Para publicar, detén el dev server, corre `pnpm build` y sube `dist/` más los PHP modificados.
- No subas al servidor `hot`, `node_modules/`, `src/` ni archivos de config (`package.json`, `pnpm-*`, `vite.config.ts`, `CLAUDE.md`).

<!-- wp-helper:start -->
## Helpers (wp-helper 1.1.0)
- Los helpers viven en `inc/helpers/` y se cargan con `require_once` desde `functions.php`. No edites los archivos del motor: se actualizan desde la skill wp-helper.
- Un helper propio de este proyecto va en `inc/helpers/<nombre>.php` con el prefijo `copam_theme_`, y también se carga desde `functions.php`.
- Toda imagen de un campo ACF pasa por `copam_theme_image($campo, [...])` (devuelve el `<img>` o `''`) o por `copam_theme_image_data($campo)` (`url`, `alt`, `width`, `height` o `null`). No uses `$campo['url']` ni `wp_get_attachment_image_url()` directo en las vistas. Usa `'loading' => 'eager'` en la imagen principal de la página.
- Un texto con partes de otro color se imprime con `copam_theme_highlight($texto)`; ya sale escapado. Los marcadores y sus clases están en `inc/helpers/text-styles.php`: para sumar un estilo corre `install.mjs --add-style` de la skill wp-helper, no lo edites a mano.
- Todo enlace de un campo ACF (Link o URL) pasa por `copam_theme_link($campo, [...])` (el `<a>` completo) o por `<a<?= copam_theme_link_attrs($campo, [...]) ?>>` cuando el diseño lleva íconos u otros hijos. No escribas `target="_blank"`, `rel` ni `$campo['url']` a mano: el helper pone `rel`, descarta enlaces vacíos o inseguros y avisa de la pestaña nueva (clase `sr-only`).
<!-- wp-helper:end -->

<!-- design-import:start -->
## Specs de diseño (design-import 1.4.0)
- Los specs viven en `specs/` (`_index.md`, `_shared.md` y un archivo por página). Son documentación del tema: no se suben al servidor.
- Aplica solo las páginas con estado `aprobado` en `specs/_index.md` y deja el estado en `aplicado` al terminar.
- Cada página es un grupo de campos ACF (`Grupo ACF` y `Ubicación` en su spec) y cada sección es un campo `group` (`home_hero`). Blog, catálogo y WooCommerce se describen en la tabla "Contenido dinámico" de `_shared.md`: no escribas consultas, filtros ni lógica de Woo hasta ese paso.
- Lo que se repite en todo el sitio (contacto, redes, textos del pie) está en `specs/opciones.md` y va en una página de opciones de ACF; el logo y el ícono son de Personalizar y los menús son menús de WordPress.
- Los campos ACF se nombran `<página>_<sección>_<campo>` en snake_case y en español. No pongas límites de caracteres ni de tamaño de imagen: la descripción del campo solo lo recomienda.
- El texto del diseño queda fijo en la plantilla y su campo está en el spec ("valor actual"): al pasarlo a ACF se reemplaza uno a uno.
<!-- design-import:end -->

<!-- wp-acf:start -->
## ACF administrable (wp-acf 1.3.0)
- Los campos, tipos de contenido, taxonomías y páginas de opciones viven en `acf-json/` y los genera `wp-acf` desde los specs (`generate.mjs`); no los edites a mano. Si algo se cambia desde el admin de ACF, el JSON queda distinto y se avisa como conflicto al regenerar.
- `inc/acf/runner.php` es el motor: no lo edites (se actualiza desde la skill). Sincroniza el JSON con la base, crea las páginas, carga el contenido inicial, los menús y el logo, al activar el tema y desde Herramientas > Cargar contenido inicial. Nunca pisa lo que ya se cargó.
- Los datos del proyecto son `inc/acf/paginas.php` (lo genera la skill), `inc/acf/sitio.php` (menús y logo) y `inc/acf/seed/<página>.php` (el texto, las imágenes y los enlaces que salieron de cada plantilla).
- Una plantilla conectada lee su grupo con `get_field('<página>_<sección>')` y los helpers de `wp-helper`; no deja el texto fijo ni textos de respaldo en el código. Las opciones del sitio se leen con `get_field('opciones_<área>', 'option')`.
- El puntero del mouse, la precarga y las animaciones no son campos: se quedan como JS.
- La lógica de contenido (consultas, filtros, buscador, paginación) y WooCommerce no son de esta skill.
<!-- wp-acf:end -->

<!-- wp-accordion:start -->
## Acordeones (wp-accordion 1.0.0)
- Cada acordeón es una vista en `template-parts/accordions/<id>.php` que se muestra con `get_template_part('template-parts/accordions/<id>')`. Ábrelo con `copam_theme_accordion_start($id, [...])`, un `copam_theme_accordion_item_start($titulo)` / `_item_end()` por ítem y `copam_theme_accordion_end()`; el contenido de cada ítem es libre. Con una lista (p. ej. un repeater de ACF) usa `copam_theme_accordion($id, $items)`.
- El diseño sale de Figma: clases por parte (`class`, `item_class`, `summary_class`, `title_class`, `icon_class`, `panel_class`), `icon` e `icon_position`. Lo que se repite en varios acordeones va una vez como variable `--accordion-*` en el CSS del proyecto.
- Es un `<details>` nativo: no pongas enlaces ni botones dentro del título, no ocultes el panel con `display: none` ni armes uno con `div` y `aria-expanded`. Para enlazar un ítem, dale `id` y usa `<a href="#id">`.
- No edites el motor (`inc/accordions.php`, `src/js/modules/accordion.js`, `src/css/accordion.css`): se actualiza desde la skill wp-accordion.
<!-- wp-accordion:end -->
