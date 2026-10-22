# Compartido

Se define una sola vez y vale para todas las páginas.

- **Estado:** aprobado

## Alcance

Qué es cada página del diseño. Lo responde el usuario una sola vez; `analyze.mjs` solo propone candidatos (`dynamicCandidates`).

| Diseño | Qué es | Contenido |
|---|---|---|
| comunicados.html | blog | comunicado |
| comunicado.html | blog | comunicado |
| index, nosotros, sistema-integrado-de-gestion, compromiso-ambiental, normativa-ositran, transparencia, tarifario, operacion-del-terminal, deposito-temporal, servicios-a-la-nave, servicios-a-la-carga, servicios-al-pasajero, servicios-especiales, servicios-no-portuarios, contacto, canal-hostigamiento-sexual, reclamos, libro-de-reclamaciones (.html) | estática | ninguno |
| privacidad, terminos, cookies (.html) | estática | ninguno |

Notas: `comunicados.html` es el listado y `comunicado.html` el detalle de las entradas del blog. `bloque-acceso.dc.html` no es una página: es el componente `bloque-acceso`. Las tres páginas legales son estáticas. `reclamos`, `canal-hostigamiento-sexual` y `terminos` salieron como candidatas por bloques repetidos; el usuario confirmó que son estáticas. El diseño usa un motor propio (`x-dc`, `sc-if`, `sc-for`, `{{ }}`, React en `main.js`): se lee el HTML como diseño, se descarta el motor y la lógica (menú, buscador, acordeones, filtros) se reescribe como módulos JS.

`Qué es`: `estática`, `blog`, `catálogo` (tipo de contenido propio), `woocommerce` u `otro`. `Contenido`: `ninguno` o la fila de abajo que lo describe.

## Contenido dinámico

Una fila por tipo de contenido que se repite o se filtra (entradas, productos, proyectos). Solo se documenta: no se registra el tipo de contenido ni se escribe la consulta.

| Contenido | Origen | Taxonomías | Campos por elemento | Filtros | Plantillas | Acción |
|---|---|---|---|---|---|---|
| comunicado | post | `category` (nativa, no jerárquica en el diseño): Operativo, Noticias, Mantenimiento | Título, fecha, categoría, extracto y contenido (nativos de WordPress); sin campos extra confirmados | Pastillas por categoría ("Todos" + 3), buscador "Buscar comunicado", selector de año (2026, 2025), contador de resultados | `home.php` (listado), `single.php` (detalle), `category.php` | Cada tarjeta enlaza a su comunicado (mismo sitio); sin botón de acción. Estado vacío: "No hay comunicados que coincidan con tu búsqueda." |

- `Contenido`: nombre en singular, snake_case, sin tildes (`producto`, `proyecto`, `post`).
- `Origen`: `post` (entradas del blog), `cpt` (tipo de contenido propio, nuevo o ya existente) o `woo` (WooCommerce: solo se maqueta).
- `Taxonomías`: nombre, si es jerárquica y los términos de ejemplo del diseño (`categoria_producto` jerárquica: Sillas, Mesas).
- `Campos por elemento`: lo que cada elemento guarda (precio, galería, ficha). El detalle va en el spec del detalle.
- `Filtros`: los que muestra el diseño (categoría, marca, orden, buscador) o `ninguno`.
- `Plantillas`: archivo de listado, de detalle y de taxonomía (`archive-producto.php`, `single-producto.php`).
- `Acción`: qué hace el botón de cada elemento (WhatsApp con mensaje, formulario de consulta, contacto, carrito de Woo, ninguna) y de dónde sale el dato (campo global, campo del elemento).

## Sitio

Lo que se repite en todas las páginas (cabecera, menú, pie). Aquí solo se decide dónde vive cada cosa; los campos van en `specs/opciones.md`. Nada se crea en esta etapa.

- **Identidad del sitio** (Personalizar > Identidad del sitio, nativo de WordPress): logo principal, ícono del sitio, nombre y descripción. No son campos ACF.
- **Menús** (Apariencia > Menús): cada menú es una ubicación del tema, no un campo.
- **Todo lo demás que se repite** (logo alternativo, contacto, redes, copyright, textos fijos del pie, aviso superior): campos de la página de opciones "Ajustes del sitio", en `specs/opciones.md`.

### Menús

| Ubicación | Dónde se muestra | Enlaces del diseño |
|---|---|---|
| principal | `header.php` (barra y menú compacto móvil). Seis grupos con submenús; los textos que empiezan con `#` son subtítulos sin enlace | Nosotros (Nosotros, Sistema Integrado de Gestión, Compromiso Ambiental); Reglamentos (Reglamento de Tarifas y Precios, Contrato de concesión y adendas, Normativa OSITRAN aplicable, Transparencia); Zona clientes (Información: Comunicados y avisos, Tarifario, Operación del terminal; Servicios: a la nave, a la carga, al pasajero, ...); Reclamos (Cómo reclamar, Presentar reclamo, Derechos del usuario, Libro de Reclamaciones); Contacto (Contacto, Formulario de contacto, Buzón de sugerencias, Canal de hostigamiento sexual); Depósito temporal (Depósito Temporal, Autorización SUNAT, Tarifario del depósito, Procedimientos y formatos, Quejas y reclamos, Seguimiento de carga) |
| pie | `footer.php`: columnas de enlaces (`footLinks`) | Mismos grupos que el principal, en columnas |
| legal | `footer.php`, línea inferior | Política de privacidad, Términos y condiciones, Política de cookies |

Fuente exacta de los enlaces: `menus` y `footLinks` en `src/js/copam-shared.js`; se confirman al aplicar.

## Tokens

Van en `@theme` del CSS principal. Todo valor repetido del diseño se reemplaza por su token.

| Token | Valor | Uso | Origen |
|---|---|---|---|
| `--font-sans` | 'Funnel Display', system-ui, sans-serif | Tipografía única del sitio | `:root` styles.css:22 |
| `--ease-out` | cubic-bezier(.22,1,.36,1) | Transiciones de entrada | styles.css:23 |
| `--ease-in-out` | cubic-bezier(.77,0,.18,1) | Transiciones de menú/paneles | styles.css:24 |
| `--color-brand` | #0B8A3E | Verde principal (botones, pastillas activas) | `--color-primary` |
| `--color-brand-soft` | #D9EFE1 | Fondos suaves verdes | `--color-primary-soft` |
| `--color-brand-dark` | #0B6A33 | Hover del principal | `--color-primary-dark` |
| `--color-brand-hover` | #07702F | Hover de los botones verdes (se repite en 6 sitios de la portada, por eso es token) | hover del diseño |
| `--color-ink` | #2B2B2B | Texto base | `--color-text` |
| `--color-ink-muted` | #6B6B6B | Texto secundario | `--color-text-muted` |
| `--color-petrol` / `-dark` / `-deep` | #10303B / #0B2029 / #07161C | Fondos oscuros, footer | `--color-petrol*` |
| `--color-warning` | #F6C744 | Avisos, aviso de mantenimiento | `--color-warning` |
| `--color-danger` | #C62828 | Errores de formulario | `--color-danger` |
| `--color-line` | #DFDFDF | Bordes y separadores | `--color-line` |
| Puntos de quiebre | sm 600, md 900, lg 1000, xl 1180 px | Donde el diseño cambia de columnas (antes los calculaba `main.js`) | `copam-shared.js` |
| Escala de grises `--color-gris-<hex>` | #1A1A1A … #F2F2F2 (unos 30 valores en `:root`) | Textos y bordes neutros | `--gray-*`; en la etapa C se conservan solo los usados 2 o más veces, el resto queda como valor arbitrario y se reporta |

Pendiente de tu decisión al aprobar: los tamaños (`clamp()` por página) y espacios no se tokenizan salvo los repetidos; se decide en la etapa C con el conteo exacto. Valores sueltos del CSS (verdes #0b7a38, #0a7434, #00652f, #005a2a, #004d24) aparecen 1 a 2 veces: se reportan, no se tokenizan.

## Componentes compartidos

Cada componente vive en `template-parts/components/<nombre>.php` y recibe sus datos por `$args`.

### bloque-acceso

- **Origen:** `bloque-acceso.dc.html` (CTA "Seguimiento de carga" / acceso)
- **Destino:** `template-parts/components/bloque-acceso.php`
- **Argumentos:** `titulo` (string), `descripcion` (string), `boton` (string), `url` (string), `nota` (string), `imagen` (array), `alt` (string)
- **Se usa en:** páginas de servicios y depósito (a confirmar al armar cada spec)

### faq-ayuda

- **Origen:** bloque `section.ub7` ("Ayuda · Preguntas frecuentes"), repetido en 9 páginas: deposito-temporal, operacion-del-terminal, reclamos, servicios-a-la-carga, servicios-a-la-nave, servicios-al-pasajero, servicios-especiales, servicios-no-portuarios, tarifario
- **Destino:** acordeón por `wp-accordion` en `template-parts/accordions/`, envuelto en `template-parts/components/faq-ayuda.php`
- **Argumentos:** `titulo`, `descripcion`, `items` (array de pregunta/respuesta)
- **Se usa en:** las 9 páginas indicadas

### tarjeta-comunicado

- **Origen:** `comunicados.html:213-229` y `comunicado.html` ("Otros comunicados")
- **Destino:** `template-parts/components/comunicado-card.php`
- **Argumentos:** `titulo`, `fecha`, `categoria`, `url`
- **Se usa en:** `home.php` y `single.php`

Variante `fila` de `comunicado-card` (arg `variante`: `tarjeta` | `fila`): la portada muestra los últimos comunicados como fila con píldora, título, fecha y flecha. Los colores de las píldoras por categoría pertenecen al componente: Operativo `#E4F3EA`/`#0A7434`, Noticias `#E6ECF6`/`#2A4C80`, Mantenimiento `#FBE8E5`/`#A8362A` (valores sueltos, no tokens globales).

### encabezado-seccion

- **Origen:** etiqueta con ícono + `h2` + bajada, repetido en 6 secciones de `index.html` y en el resto de páginas
- **Destino:** `template-parts/components/encabezado-seccion.php`
- **Argumentos:** `etiqueta` (string), `titulo` (string, requerido), `bajada` (string), `nivel` (int, 2 por defecto)
- **Se usa en:** home y páginas internas

### boton

- **Origen:** botón con texto deslizante y flecha de esquina al hover (hero, reglamentos, servicios, comunicados y cta de la portada)
- **Destino:** `template-parts/components/boton.php`
- **Argumentos:** `texto` (string, requerido), `enlace` (array de campo ACF Link, se imprime con `copam_theme_link`), `variante` (`primario` | `secundario`)
- **Se usa en:** todas las páginas. Hover del verde: `--color-brand-hover`

### migas

- **Origen:** "Inicio > Zona Clientes > Comunicados" en `comunicados.html` y `comunicado.html`
- **Destino:** `template-parts/components/migas.php`
- **Argumentos:** `items` (array de `texto` y `url`; el último sin url)
- **Se usa en:** páginas internas; `<nav aria-label="Migas de pan">`

### titulo-linea

- **Origen:** `h2` con línea horizontal, repetido 5 veces en `nosotros.html`
- **Destino:** `template-parts/components/titulo-linea.php`
- **Argumentos:** `titulo` (string, requerido), `nivel` (int, 2 por defecto)
- **Se usa en:** páginas internas

### lista-datos

- **Origen:** lista etiqueta/valor de `nosotros.html` (concesión, sistema); se espera en `sistema-integrado-de-gestion`
- **Destino:** `template-parts/components/lista-datos.php`
- **Argumentos:** `filas` (array de `etiqueta` y `valor`)

### enlace-flecha

- **Origen:** enlace con flecha en `nosotros.html` (índice, sistema, operamos)
- **Destino:** `template-parts/components/enlace-flecha.php`
- **Argumentos:** `texto` (string), `enlace` (array de campo ACF Link, se imprime con `copam_theme_link`)

### documento-card

- **Origen:** tarjeta de PDF de `servicios-a-la-nave.html` (sección documentos); se espera en las demás páginas de servicios
- **Destino:** `template-parts/components/documento-card.php`
- **Argumentos:** `etiqueta` (string), `titulo` (string, requerido), `fecha` (string), `archivo` (campo ACF `file`; el componente arma el enlace de descarga)

Regla para todas las páginas: todo PDF o archivo descargable subido al sitio es un campo ACF de tipo `file`; `link` es para navegar y para documentos alojados fuera (por ejemplo los PDF del portal de OSITRAN), en cuyo caso `documento-card` recibe `archivo` como `link`. Se usa en: páginas de servicios, `normativa-ositran`, `transparencia`. Si un botón descarga un archivo, el texto del botón es un campo `text` aparte y `boton` recibe `texto` y `url` ya resueltos.

### documentos-por-anio

- **Origen:** acordeón de grupos con filas de documento (título, subtítulo, etiqueta "Vigente", botón "Descargar PDF") en `tarifario.html` (secciones `versiones` y `reta`); estructura parecida en `normativa-ositran.html` (sección `normativa`)
- **Destino:** `template-parts/components/documentos-por-anio.php`, dentro de un acordeón de `wp-accordion`
- **Argumentos:** `grupos` (array con `nombre` y `documentos`), `texto_boton` (string), `mensaje_vacio` (string)
- **Se usa en:** `tarifario`, `normativa-ositran`. Repeater dentro de repeater: si ACF Pro del proyecto lo complica, se aplana en el paso de ACF

### tarjeta-paso

- **Origen:** tarjeta de paso en `reclamos.html` (secciones `proceso`, `conforme`, `otros_canales`)
- **Destino:** `template-parts/components/tarjeta-paso.php`
- **Argumentos:** `etiqueta` (string), `titulo` (string, requerido), `texto` (string), `nota` (string), `enlace` (array Link)
- **Se usa en:** `reclamos`; candidata para `libro-de-reclamaciones` si usa el mismo patrón

### tarjeta-accesos

- **Origen:** tarjeta "Accesos directos" del hero, repetida en `contacto`, `transparencia`, `normativa-ositran`, `canal-hostigamiento-sexual`, `operacion-del-terminal` y las páginas de servicios
- **Destino:** `template-parts/components/tarjeta-accesos.php`
- **Argumentos:** `titulo` (string), `items` (array de `texto` y `enlace`; si el destino es un ancla de la misma página, el texto sale del título de la sección)
- **Se usa en:** el hero de las páginas indicadas

### indice-lateral

- **Origen:** aside "En esta página" de `nosotros.html`, `sistema-integrado-de-gestion.html` y `compromiso-ambiental.html`
- **Destino:** `template-parts/components/indice-lateral.php`
- **Argumentos:** `items` (array de `texto` y `ancla`; los textos salen de los títulos de sección, no son campos)
- **Se usa en:** `nosotros`, `sistema-integrado-de-gestion`, `compromiso-ambiental` y `terminos`; el resaltado del ítem activo es un módulo JS. En `terminos` los ítems salen de los `h2` del campo WYSIWYG y la plantilla añade un `id` a cada `h2`.

### texto-legal

- **Origen:** cuerpo de `privacidad.html`, `terminos.html` y `cookies.html`: `h2` con línea superior, párrafos de 15px, listas y enlaces
- **Destino:** clase `@layer components` en `src/css/input.css` (estilo de prosa), aplicada al campo WYSIWYG `<página>_contenido_texto`; no es un archivo de `template-parts`
- **Se usa en:** las tres páginas legales. Los títulos y cláusulas del diseño están en `[PENDIENTE]`: COPAM no entregó los textos ni la fecha de actualización

### tarjeta-servicio

- **Origen:** tarjetas "Qué incluye" e "Infraestructura" (`servicios-a-la-nave.html`, `servicios-al-pasajero.html`): `h3` y descripción
- **Destino:** `template-parts/components/tarjeta-servicio.php`
- **Argumentos:** `titulo` (string, requerido), `descripcion` (string), `nivel` (int, 3 por defecto), `boton` (array Link, opcional: "Ver tarifa" en `deposito-temporal`)
- **Se usa en:** páginas de servicios; el número de columnas lo decide el contenedor, no el componente

### cta-cotizar

- **Origen:** CTA "¿Necesitas cotizar un servicio o coordinar una operación?" (título, bajada, botón, imagen) de las páginas de servicios. No es `bloque-acceso` (ese es "Seguimiento de carga")
- **Destino:** `template-parts/components/cta-cotizar.php`
- **Argumentos:** `titulo`, `bajada`, `boton` (array Link), `imagen` (array, se imprime con `copam_theme_image`)

`bloque-acceso` suma el argumento `variante` (`fila` por defecto | `columna`, la variante `acceso-columna` del diseño).

Valores sueltos (no se tokenizan, se reportan): radio 4px, grises #EFEFEF, #8C8C8C, #D6D6D6, #7A7A7A, #8A8A8A.

Otros componentes (tarjeta de servicio, cabecera de página interna) se definen en las specs por página al detectarse 2 o más usos.

## Nomenclatura

- Un grupo de campos por página (`Grupo ACF`) con su regla de ubicación; cada sección es un campo de tipo `group` (`home_hero`) y sus subcampos se guardan como `<sección>_<campo>`.
- Campos ACF: `<página>_<sección>_<campo>` en snake_case y en español (`home_hero_titulo`), que es el nombre con el que ACF guarda el subcampo `titulo` del grupo `home_hero`.
- Repetidos (cards, ítems): un repeater `<página>_<sección>_<plural>` con subcampos sin prefijo (`home_servicios_items.titulo`).
- Página en español, sin tildes ni `ñ` en el nombre del campo.
- Sin límites impuestos: la descripción del campo trae una recomendación, no una validación.

## Criterios comunes

Valen para todas las secciones y páginas. Cada sección lo declara con una sola línea ("Cumple los criterios comunes") y solo lista los suyos. Se marcan `[x]` en la sección cuando se comprueban.

### Todas las secciones

- [ ] Un solo `h1` por página y los encabezados no saltan de nivel
- [ ] Sin estilos inline, `!important` ni manejadores `onclick=` en el HTML
- [ ] Controles correctos: acciones con `<button>`, navegación con `<a href>`, campos con `<label>`
- [ ] Imágenes con `alt` (vacío si son decorativas) y proporción fija (`aspect-ratio` + `object-cover`)
- [ ] Colores, tipografías, radios y sombras salen de los tokens de este archivo; los valores sueltos están listados en "Comportamiento"
- [ ] Mismo aspecto que el original en escritorio y en móvil (espaciados, tamaños y colores iguales)
- [ ] Toda la salida PHP escapada (`esc_html`, `esc_url`, `esc_attr`) y el archivo empieza con `defined('ABSPATH') || exit;`
- [ ] `php -l` sin errores en cada archivo creado y `pnpm build` sin errores

### Según lo que tenga la sección

- Imágenes: `width`/`height` o `aspect-ratio` para no mover el layout; `loading="lazy"` salvo las de la primera pantalla.
- Enlaces: destinos reales; los externos con `rel` seguro (helper de enlaces de `wp-helper`).
- Comportamiento con JS: el JS vive en `src/js/modules/`, se activa por `data-` o clase, funciona con teclado y respeta `prefers-reduced-motion`.
- Con skill (`wp-form`, `wp-modal`, `wp-accordion`, `wp-helper`): pasa los criterios de esa skill.
- Bloque repetido: un solo componente con `$args`, usado en todos los lugares donde se repetía.

### Cada página (una vez, al final)

- [ ] `check.mjs` sale con `0`
- [ ] Los enlaces internos apuntan a las páginas del tema, no a los `.html` del diseño
- [ ] `header.php` y `footer.php` no se repiten dentro de la plantilla de la página

## Nomenclatura

- Un grupo de campos por página (`Grupo ACF`) con su regla de ubicación; cada sección es un campo de tipo `group` (`home_hero`) y sus subcampos se guardan como `<sección>_<campo>`.
- Campos ACF: `<página>_<sección>_<campo>` en snake_case y en español (`home_hero_titulo`), que es el nombre con el que ACF guarda el subcampo `titulo` del grupo `home_hero`.
- Repetidos (cards, ítems): un repeater `<página>_<sección>_<plural>` con subcampos sin prefijo (`home_servicios_items.titulo`).
- Página en español, sin tildes ni `ñ` en el nombre del campo.
- Sin límites impuestos: la descripción del campo trae una recomendación, no una validación.
