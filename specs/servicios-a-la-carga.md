# Página: Servicios a la carga

- **Resumen:** Describe los servicios del terminal para la carga (embarque, descarga, transferencia y almacenamiento), sus unidades de cobro y los documentos oficiales. El visitante busca cotizar un servicio o resolver dudas antes de coordinar una operación.
- **Fuente:** `servicios-a-la-carga.html`
- **Plantilla:** `pages/template-servicios-a-la-carga.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, que-incluye, tarifas, documentos, faq, cta
- **Skills usadas:** wp-accordion (faq), wp-helper
- **Grupo ACF:** Servicios a la carga
- **Ubicación:** plantilla pages/template-servicios-a-la-carga.php
- **Padre:** servicios
- **Notas de página:**
  - `h1` "Servicios a la carga" en el hero
  - título SEO "Servicios a la carga · COPAM"
  - meta descripción del diseño "Concesionaria Puerto Amazonas S.A. · Terminal Portuario de Yurimaguas – Nueva Reforma." (genérica, se puede mejorar)
  - se ignora el `noindex` del diseño
  - Header, footer, aviso de mantenimiento y buscador son del sitio (no se repiten)
  - Los anclas internas `#que-incluye`, `#tarifas`, `#documentos` y `#faq` son los `id` de las secciones y alimentan "Accesos directos"
  - Los efectos de entrada (`data-rise`, `data-sr`), el parallax del hero y el efecto de pila al llegar al FAQ son comportamiento: se reescriben como módulos JS (`prefers-reduced-motion` respetado)
  - Los enlaces `contacto.html#formulario` y `tarifario.html` apuntan a las páginas del tema
- **Estado:** aplicado

## Sección: hero

- **Origen:** `servicios-a-la-carga.html` líneas 159-215
- **Destino:** `template-parts/pages/servicios-a-la-carga/hero.php`
- **Grupo:** `servicios_a_la_carga_hero`
- **Skill:** ninguna
- **Comportamiento:** migas con el componente `migas` (Inicio > Zona Clientes > Servicios a la carga; texto fijo, "Zona Clientes" sin enlace, último sin url). Imagen de fondo a ancho completo con `aspect-ratio` y `object-cover` y parallax suave al hacer scroll (imagen principal: `'loading' => 'eager'`). Título y bajada sobre el bloque; el botón usa el componente `boton` (variante primario) y lleva a `contacto.html#formulario`. A la derecha (escritorio) una tarjeta "Accesos directos" con 4 enlaces a las anclas de la página (flecha que se desplaza 2px y borde verde `--color-brand` al hover); en móvil la tarjeta va debajo del texto. Las anclas son fijas (`#que-incluye`, `#tarifas`, `#documentos`, `#faq`); solo el texto es editable. Valores sueltos: hover del botón `#07702F` (ya definido en el componente `boton`).
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_a_la_carga_hero_titulo` | text | Título principal de la página (`h1`). Se muestra en grande sobre la imagen. Recomendado: ~30 caracteres | Servicios a la carga | sí |
| `servicios_a_la_carga_hero_bajada` | textarea | Texto de apoyo bajo el título. Recomendado: ~230 caracteres | Embarque, descarga, transferencia y almacenamiento de carga general, contenedores y graneles en el Terminal Portuario de Yurimaguas – Nueva Reforma. | sí |
| `servicios_a_la_carga_hero_boton` | link | Botón principal: texto y destino | Solicitar cotización | sí |
| `servicios_a_la_carga_hero_imagen` | image | Imagen principal del hero. Se recorta para llenar el bloque. Recomendado: 2400 × 1350 px (16:9), mínimo 1200 px de ancho | — | sí |
| `servicios_a_la_carga_hero_accesos_titulo` | text | Título de la tarjeta de accesos directos. Recomendado: ~25 caracteres | Accesos directos | sí |
| `servicios_a_la_carga_hero_accesos` | repeater | Enlaces de la tarjeta. 4 ítems; cada uno lleva a una sección de la página (el destino es fijo) | — | sí |
| `servicios_a_la_carga_hero_accesos.texto` | text | Texto del enlace. Recomendado: ~35 caracteres | Qué incluye | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Imagen del hero con `loading="eager"` y `width`/`height` para no mover el layout
- [x] Migas con `<nav aria-label="Migas de pan">` y la página actual con `aria-current="page"`
- [x] El botón usa el componente `boton` y el enlace pasa por `copam_theme_link`
- [x] Los 4 accesos directos llevan a los `id` existentes y funcionan con teclado; el scroll compensa la altura del header
- [x] El parallax y las animaciones de entrada respetan `prefers-reduced-motion`

## Sección: que-incluye

- **Origen:** `servicios-a-la-carga.html` líneas 217-233
- **Destino:** `template-parts/pages/servicios-a-la-carga/que-incluye.php`
- **Grupo:** `servicios_a_la_carga_que_incluye`
- **Skill:** ninguna
- **Comportamiento:** `<section id="que-incluye">` con el componente `encabezado-seccion` (solo `titulo`, sin etiqueta ni bajada; línea que se dibuja al lado). Cuadrícula de tarjetas (título `h3` + descripción): 4 columnas desde 1180 px, 2 desde 600 px, 1 en móvil. Sin alturas fijas. Las tarjetas entran con retraso escalonado.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_a_la_carga_que_incluye_titulo` | text | Título de la sección. Recomendado: ~20 caracteres | Qué incluye | sí |
| `servicios_a_la_carga_que_incluye_items` | repeater | Tarjetas de servicios incluidos. 4 ítems | — | sí |
| `servicios_a_la_carga_que_incluye_items.titulo` | text | Nombre del servicio. Recomendado: ~55 caracteres | Embarque, descarga y transferencia | sí |
| `servicios_a_la_carga_que_incluye_items.descripcion` | textarea | Detalle del servicio. Recomendado: ~180 caracteres | Movimiento de la carga entre la nave y el muelle, y su traslado dentro del terminal hacia las zonas de almacenamiento. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Usa `encabezado-seccion` (nivel 2) y las tarjetas son `h3`
- [x] Cuadrícula de 4, 2 y 1 columnas según el ancho, sin alturas fijas
- [x] La sección tiene `id="que-incluye"` y `scroll-margin-top` igual a la altura del header

## Sección: tarifas

- **Origen:** `servicios-a-la-carga.html` líneas 235-259
- **Destino:** `template-parts/pages/servicios-a-la-carga/tarifas.php`
- **Grupo:** `servicios_a_la_carga_tarifas`
- **Skill:** ninguna
- **Comportamiento:** `<section id="tarifas">` con `encabezado-seccion` (solo `titulo`). Tabla de dos columnas ("Tipo de carga" / "Unidad de cobro") con 8 filas separadas por líneas finas; usar `<table>` con `<th>` (la cabecera es fija). Debajo, una nota con un enlace en línea a la página Tarifario (`tarifario.html`, página del tema). Sin montos: solo unidades de cobro.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_a_la_carga_tarifas_titulo` | text | Título de la sección. Recomendado: ~15 caracteres | Tarifas | sí |
| `servicios_a_la_carga_tarifas_filas` | repeater | Filas de la tabla de unidades de cobro. 8 ítems | — | sí |
| `servicios_a_la_carga_tarifas_filas.tipo_carga` | text | Tipo de carga o contenedor. Recomendado: ~50 caracteres | Carga fraccionada | sí |
| `servicios_a_la_carga_tarifas_filas.unidad_cobro` | text | Unidad con la que se cobra. Recomendado: ~15 caracteres | Tonelada | sí |
| `servicios_a_la_carga_tarifas_nota` | wysiwyg | Nota bajo la tabla, con el enlace al Tarifario dentro del texto. Recomendado: ~300 caracteres | <p>Unidades de cobro del servicio estándar a la carga. Los montos se aplican según el Tarifario de Servicios Portuarios vigente, aprobado por OSITRAN; consulta el documento oficial en la página de <a href="/tarifario/">Tarifario</a>.</p> | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] La tabla es `<table>` con `<th scope="col">` en la cabecera y las 8 filas coinciden con el diseño
- [x] La nota se imprime con `wp_kses_post` y el enlace apunta a la página Tarifario del tema
- [x] La sección tiene `id="tarifas"` y `scroll-margin-top` igual a la altura del header

## Sección: documentos

- **Origen:** `servicios-a-la-carga.html` líneas 261-288
- **Destino:** `template-parts/pages/servicios-a-la-carga/documentos.php`, `template-parts/components/rejilla-documentos.php`, `template-parts/components/documento-card.php`
- **Grupo:** `servicios_a_la_carga_documentos`
- **Skill:** wp-helper
- **Comportamiento:** `<section id="documentos">` con `encabezado-seccion` (solo `titulo`). Cuadrícula de tarjetas-enlace: 4 columnas desde 1180 px, 2 desde 600 px, 1 en móvil, separadas por líneas finas. Cada tarjeta muestra etiqueta, título, fecha y un botón circular verde con flecha de esquina (hover `#07702F`, valor suelto del componente `boton`). Cada tarjeta abre el archivo en pestaña nueva con `copam_theme_link` (rel seguro, aviso `sr-only`). El diseño muestra además el tipo y peso del archivo (`PDF · 520 KB`) como `title`: se calcula del archivo, no es campo. Las tarjetas son un componente nuevo (ver aviso en el reporte).
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_a_la_carga_documentos_titulo` | text | Título de la sección. Recomendado: ~35 caracteres | Documentos relacionados | sí |
| `servicios_a_la_carga_documentos_items` | repeater | Tarjetas de documentos. 4 ítems | — | sí |
| `servicios_a_la_carga_documentos_items.etiqueta` | text | Categoría del documento, sobre el título. Recomendado: ~15 caracteres | Tarifario | sí |
| `servicios_a_la_carga_documentos_items.titulo` | text | Nombre del documento. Recomendado: ~75 caracteres | Tarifario de Servicios Portuarios | sí |
| `servicios_a_la_carga_documentos_items.fecha` | text | Vigencia o fecha de aprobación, como texto. Recomendado: ~45 caracteres | Vigente desde el 16-06-2026 | sí |
| `servicios_a_la_carga_documentos_items.archivo` | file | Archivo del documento (PDF); se abre en pestaña nueva | — | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Destinos reales; los enlaces a archivos pasan por `copam_theme_link` con `rel` seguro y aviso de pestaña nueva
- [x] La tarjeta es un componente con `$args` y la flecha respeta `prefers-reduced-motion`
- [x] La sección tiene `id="documentos"` y `scroll-margin-top` igual a la altura del header

## Sección: faq

- **Origen:** `servicios-a-la-carga.html` líneas 293-324
- **Destino:** `template-parts/pages/servicios-a-la-carga/faq.php`, `template-parts/components/faq-ayuda.php`, `template-parts/accordions/faq-ayuda.php`
- **Grupo:** `servicios_a_la_carga_faq`
- **Skill:** wp-accordion
- **Comportamiento:** usa el componente compartido `faq-ayuda` (etiqueta "Ayuda" con ícono, título, bajada y acordeón) sin marcado propio; `wp-accordion` define estructura, teclado y movimiento. El primer ítem sale abierto; el resto cerrado; ícono menos/más blanco sobre círculo verde. Sección con `id="faq"` y `scroll-margin-top` igual a la altura del header. En el diseño esta sección activa un efecto de pila sobre el bloque anterior (escala + desenfoque al llegar): se reescribe como módulo JS, opcional y con `prefers-reduced-motion`.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_a_la_carga_faq_titulo` | text | Título del bloque de ayuda. Recomendado: ~35 caracteres | Preguntas frecuentes | sí |
| `servicios_a_la_carga_faq_descripcion` | textarea | Bajada bajo el título. Recomendado: ~80 caracteres | Respuestas a las consultas más comunes sobre los servicios a la carga. | no |
| `servicios_a_la_carga_faq_items` | repeater | Preguntas y respuestas. 6 ítems | — | sí |
| `servicios_a_la_carga_faq_items.pregunta` | text | Pregunta. Recomendado: ~85 caracteres | ¿Qué tipos de carga atiende el terminal? | sí |
| `servicios_a_la_carga_faq_items.respuesta` | textarea | Respuesta. Recomendado: ~240 caracteres | Contenedores secos y refrigerados, carga fraccionada y de proyecto, carga rodante, y graneles sólidos y líquidos. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Pasa los criterios de `wp-accordion` (`<details>`/`<summary>`, teclado, `prefers-reduced-motion`)
- [x] Usa `faq-ayuda` con `titulo`, `descripcion` e `items`; sin marcado propio del acordeón
- [x] La sección tiene `id="faq"` y `scroll-margin-top` igual a la altura del header

## Sección: cta

- **Origen:** `servicios-a-la-carga.html` líneas 326-348
- **Destino:** `template-parts/pages/servicios-a-la-carga/cta.php`
- **Grupo:** `servicios_a_la_carga_cta`
- **Skill:** ninguna
- **Comportamiento:** dos columnas desde 1000 px (texto 886fr / imagen 1454fr) y una columna en móvil (imagen debajo, alto `56vw`). El bloque de texto lleva título, bajada y botón (componente `boton`; destino `contacto.html#formulario`); fondo y variante del botón por confirmar contra `styles.css` (clases `ubk`-`ubr`) al aplicar; la imagen tiene alto mínimo `max(380px, 22.9vw)` y se recorta con `object-cover` (`loading="lazy"`). No es el componente `bloque-acceso`: ese lleva descripción, nota y enlace de seguimiento. Se decide al aplicar si se comparte con otras páginas de servicios (la misma estructura "¿Necesitas cotizar...?" aparece en el diseño de servicios).
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_a_la_carga_cta_titulo` | text | Pregunta de cierre. Se muestra en grande junto a la imagen. Recomendado: ~90 caracteres | ¿Necesitas cotizar un servicio o coordinar una operación? | sí |
| `servicios_a_la_carga_cta_bajada` | text | Frase de apoyo bajo el título. Recomendado: ~110 caracteres | Te acompañamos desde la cotización hasta la operación en el terminal. | no |
| `servicios_a_la_carga_cta_boton` | link | Botón: texto y destino | Contáctanos | sí |
| `servicios_a_la_carga_cta_imagen` | image | Imagen junto al texto. Se recorta para llenar el bloque. Recomendado: 2400 × 880 px (≈2,7:1), mínimo 1200 px de ancho | — | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Imagen con `alt`, `width`/`height` y `loading="lazy"` (está bajo la primera pantalla)
- [x] El botón usa el componente `boton` y el enlace pasa por `copam_theme_link`
- [x] En móvil la imagen queda debajo del texto con alto `56vw`
