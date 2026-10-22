# Página: Servicios no portuarios

- **Resumen:** Explica los servicios no portuarios del terminal (uso de áreas, servicios complementarios y facilidades a terceros), con su tarifario y documentos. El visitante revisa qué incluye, descarga el tarifario vigente y pide una cotización.
- **Fuente:** `servicios-no-portuarios.html`
- **Plantilla:** `pages/template-servicios-no-portuarios.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, que_incluye, tarifas, documentos, faq, cta
- **Skills usadas:** wp-accordion (faq), wp-helper
- **Grupo ACF:** Servicios no portuarios
- **Ubicación:** plantilla pages/template-servicios-no-portuarios.php
- **Padre:** servicios
- **Notas de página:**
  - `h1` "No portuarios" en el hero (el diseño parte el título en dos líneas "No" / "portuarios"
  - las migas y el título SEO dicen "Servicios no portuarios")
  - Título SEO "Servicios no portuarios · COPAM"
  - meta descripción del diseño "Concesionaria Puerto Amazonas S.A. · Terminal Portuario de Yurimaguas – Nueva Reforma." (genérica, igual en otras páginas
  - conviene una propia)
  - Se ignora el `noindex` del diseño
  - Header, footer, aviso de mantenimiento y buscador son del sitio, no de la página
  - Los enlaces `contacto.html#formulario` y `tarifario.html#versiones` pasan a las páginas del tema
  - Mismo esquema que `servicios-a-la-nave` y `servicios-a-la-carga`: hero con accesos, secciones con encabezado h2 con línea (componente `encabezado-seccion` sin etiqueta ni bajada), FAQ y CTA
  - Diferencia con la nave: "Tarifas y precios" no es una tabla sino un texto con botón de descarga del tarifario y un enlace a versiones anteriores (el script del diseño define una lista `tarifas` de 6 filas que la página no dibuja
  - se omite)
  - Efectos del diseño (entrada con máscara, parallax del hero, pila hero/FAQ con escala y desenfoque, líneas que se dibujan) son comportamiento visual: módulos JS en la etapa C con `prefers-reduced-motion`
  - Las migas ("Inicio > Zona Clientes > Servicios no portuarios") usan el componente `migas` y no llevan campos
- **Estado:** descartado

## Sección: hero

- **Origen:** `servicios-no-portuarios.html` líneas 159-213
- **Destino:** `template-parts/pages/servicios-no-portuarios/hero.php`
- **Grupo:** `servicios_no_portuarios_hero`
- **Skill:** ninguna
- **Comportamiento:** migas con el componente `migas`; imagen a todo el ancho con parallax y zoom al hacer scroll, `loading="eager"` (imagen principal); `h1`, bajada y botón "Solicitar cotización" con el componente `boton` (variante primario) que lleva al formulario de contacto; tarjeta lateral "Accesos directos" (`h2`) con 4 enlaces ancla a las secciones de la página, flecha que se desplaza 2 px al hover y borde verde `--color-brand`; en escritorio la tarjeta va a la derecha en una columna de 33.3vw y en móvil debajo del texto. Mismo bloque que el hero de `servicios-a-la-nave`. Valores sueltos: hover del botón `#07702F` (ya en el componente `boton`). Los destinos son anclas fijas (`#que-incluye`, `#tarifas`, `#documentos`, `#faq`).
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_no_portuarios_hero_titulo` | text | Título principal de la página (`h1`). Se muestra en grande sobre la imagen. Recomendado: ~20 caracteres | No portuarios | sí |
| `servicios_no_portuarios_hero_bajada` | textarea | Resumen del servicio bajo el título. Recomendado: ~230 caracteres | Uso de áreas, servicios complementarios y facilidades prestadas a terceros dentro del recinto del Terminal Portuario de Yurimaguas – Nueva Reforma. | sí |
| `servicios_no_portuarios_hero_boton` | link | Botón principal: texto y destino (formulario de contacto) | Solicitar cotización | sí |
| `servicios_no_portuarios_hero_imagen` | image | Imagen del hero a todo el ancho (superficie del río Huallaga); se recorta para llenar el bloque. Recomendado: 2880 × 1620 px (16:9, a confirmar en la etapa C), mínimo 1440 px de ancho | — | sí |
| `servicios_no_portuarios_hero_accesos_titulo` | text | Título de la tarjeta lateral de enlaces. Recomendado: ~25 caracteres | Accesos directos | no |
| `servicios_no_portuarios_hero_accesos` | repeater | Enlaces de la tarjeta lateral (4 en el diseño). Cada uno baja a una sección de la página | — | no |
| `servicios_no_portuarios_hero_accesos.enlace` | link | Texto y ancla del acceso. Recomendado: ~35 caracteres | Qué incluye | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Imagen con `width`/`height` o `aspect-ratio` y `loading="eager"` (primera pantalla); el `alt` viene del campo de imagen
- [x] Imagen pasa por `copam_theme_image`; botón y accesos pasan por `copam_theme_link` (componente `boton` para el botón)
- [x] Migas con el componente `migas` y `<nav aria-label="Migas de pan">`
- [x] Los 4 accesos llevan a las secciones `#que-incluye`, `#tarifas`, `#documentos` y `#faq` con scroll suave, funcionan con teclado y respetan `prefers-reduced-motion`

## Sección: que_incluye

- **Origen:** `servicios-no-portuarios.html` líneas 215-231
- **Destino:** `template-parts/pages/servicios-no-portuarios/que-incluye.php`
- **Grupo:** `servicios_no_portuarios_que_incluye`
- **Skill:** ninguna
- **Comportamiento:** `id="que-incluye"` como ancla; encabezado h2 con línea que se dibuja (componente `encabezado-seccion`, sin etiqueta ni bajada); tarjetas en rejilla de 3 columnas desde 1180 px, 2 desde 600 px y 1 en móvil, con aparición escalonada; sin alturas fijas. Mismo bloque que `que_incluye` de `servicios-a-la-nave` (allí 2 columnas; aquí 3 en escritorio).
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_no_portuarios_que_incluye_titulo` | text | Título de la sección (`h2`). Recomendado: ~20 caracteres | Qué incluye | sí |
| `servicios_no_portuarios_que_incluye_items` | repeater | Prestaciones incluidas, una tarjeta por ítem (3 en el diseño) | — | sí |
| `servicios_no_portuarios_que_incluye_items.titulo` | text | Nombre de la prestación (`h3`). Recomendado: ~40 caracteres | Uso de áreas | sí |
| `servicios_no_portuarios_que_incluye_items.descripcion` | textarea | Explicación breve de la prestación. Recomendado: ~110 caracteres | Uso de espacios dentro del recinto portuario por parte de terceros. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Los ítems se recorren con un bucle (no hay una tarjeta por ítem escrita a mano) y la rejilla admite más o menos ítems
- [x] El `id="que-incluye"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: tarifas

- **Origen:** `servicios-no-portuarios.html` líneas 233-255
- **Destino:** `template-parts/pages/servicios-no-portuarios/tarifas.php`
- **Grupo:** `servicios_no_portuarios_tarifas`
- **Skill:** ninguna
- **Comportamiento:** `id="tarifas"`; encabezado h2 con línea (componente `encabezado-seccion`). Debajo, un párrafo, el botón "Descargar tarifario vigente" (componente `boton`, variante primario) que descarga el PDF en pestaña nueva (`copam_theme_link` pone `rel` y el aviso `sr-only`), y el enlace con flecha "Ver versiones anteriores" (componente `enlace-flecha`) que lleva a la página Tarifario, ancla `#versiones` (enlace interno del tema). El diseño muestra el tamaño del PDF como `title` ("PDF · 410 KB"); el tamaño sale del archivo (a confirmar). El botón es una descarga: el archivo es un campo `file` y el texto va en un campo aparte (a confirmar en la etapa C si `boton` acepta un archivo además de un Link). Hover del botón `#07702F` (valor suelto, ya en `boton`).
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_no_portuarios_tarifas_titulo` | text | Título de la sección (`h2`). Recomendado: ~30 caracteres | Tarifas y precios | sí |
| `servicios_no_portuarios_tarifas_texto` | textarea | Párrafo bajo el título que explica dónde están las tarifas. Recomendado: ~300 caracteres | Las tarifas y los precios de estos servicios figuran en el Tarifario de Servicios Portuarios vigente, aprobado por OSITRAN. Descarga el documento oficial para consultar el detalle de cada prestación. | sí |
| `servicios_no_portuarios_tarifas_boton_texto` | text | Texto del botón de descarga. Recomendado: ~45 caracteres | Descargar tarifario vigente | sí |
| `servicios_no_portuarios_tarifas_tarifario` | file | PDF del tarifario vigente que descarga el botón. Se sube a la biblioteca de medios | — | sí |
| `servicios_no_portuarios_tarifas_versiones` | link | Enlace con flecha a las versiones anteriores (página Tarifario, ancla de versiones). Texto recomendado: ~40 caracteres | Ver versiones anteriores | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El botón de descarga pasa por `copam_theme_link` con `rel` seguro y aviso de pestaña nueva; el enlace de versiones apunta a la página Tarifario del tema, no a `tarifario.html`
- [x] El botón usa el componente `boton` y el enlace usa `enlace-flecha`; el hover y el foco con teclado muestran el mismo cambio y respetan `prefers-reduced-motion`
- [x] El `id="tarifas"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: documentos

- **Origen:** `servicios-no-portuarios.html` líneas 257-284
- **Destino:** `template-parts/pages/servicios-no-portuarios/documentos.php`, `template-parts/components/rejilla-documentos.php`, `template-parts/components/documento-card.php`
- **Grupo:** `servicios_no_portuarios_documentos`
- **Skill:** ninguna
- **Comportamiento:** `id="documentos"`; encabezado h2 con línea; tarjetas en rejilla de 3 columnas desde 1180 px, 2 desde 600 px y 1 en móvil (en `servicios-a-la-nave` son 4 columnas); cada tarjeta es un enlace que abre el PDF en pestaña nueva (`copam_theme_link` pone `rel` y el aviso `sr-only`) con etiqueta, título, fecha y botón circular verde con flecha de esquina; al hover el botón pasa a `#07702F` (valor suelto) y la flecha sale por una esquina y entra otra; separadores entre filas y columnas. El diseño muestra "PDF · tamaño" como `title`; el tamaño sale del archivo (a confirmar). Usa el componente compartido `documento-card` (`etiqueta`, `titulo`, `fecha`, `archivo`); el número de columnas lo decide la sección, no el componente.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_no_portuarios_documentos_titulo` | text | Título de la sección (`h2`). Recomendado: ~35 caracteres | Documentos relacionados | sí |
| `servicios_no_portuarios_documentos_items` | repeater | Documentos relacionados, una tarjeta por documento (2 en el diseño) | — | sí |
| `servicios_no_portuarios_documentos_items.etiqueta` | text | Tipo de documento, sobre el título. Recomendado: ~15 caracteres | Reglamento | no |
| `servicios_no_portuarios_documentos_items.titulo` | text | Nombre del documento (`h3`). Recomendado: ~75 caracteres | Reglamento de Tarifas y Precios de COPAM · V 5.3 | sí |
| `servicios_no_portuarios_documentos_items.fecha` | text | Vigencia o fecha de aprobación, tal como se muestra. Recomendado: ~45 caracteres | Vigente desde junio de 2026 | no |
| `servicios_no_portuarios_documentos_items.archivo` | file | PDF del documento (se sube a la biblioteca de medios); la tarjeta lo abre en pestaña nueva | — | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Los enlaces a PDF pasan por `copam_theme_link`, con `rel` seguro y aviso de pestaña nueva
- [x] La tarjeta usa el componente `documento-card` con `$args` y la rejilla admite más o menos tarjetas
- [x] El hover y el foco con teclado muestran el mismo cambio (botón y flecha) y respetan `prefers-reduced-motion`
- [x] El `id="documentos"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: faq

- **Origen:** `servicios-no-portuarios.html` líneas 289-320
- **Destino:** `template-parts/pages/servicios-no-portuarios/faq.php`, `template-parts/components/faq-ayuda.php`, `template-parts/accordions/faq-ayuda.php`
- **Grupo:** `servicios_no_portuarios_faq`
- **Skill:** wp-accordion
- **Comportamiento:** usa el componente compartido `faq-ayuda` (`titulo`, `descripcion`, `items`) y el encabezado `encabezado-seccion` con etiqueta "Ayuda". `id="faq"` como ancla. Acordeón con `<details>`/`<summary>`; la primera pregunta abre por defecto en el diseño; icono más/menos blanco sobre círculo verde. Esta sección no lleva marcado propio: `wp-accordion` lo construye. En el diseño la FAQ se desliza sobre el hero (pila con escala y desenfoque); se resuelve en la etapa C.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_no_portuarios_faq_etiqueta` | text | Etiqueta con ícono sobre el título. Recomendado: ~10 caracteres | Ayuda | no |
| `servicios_no_portuarios_faq_titulo` | text | Título de la sección (`h2`). Recomendado: ~30 caracteres | Preguntas frecuentes | sí |
| `servicios_no_portuarios_faq_descripcion` | textarea | Bajada bajo el título. Recomendado: ~110 caracteres | Respuestas a las consultas más comunes sobre los servicios no portuarios. | no |
| `servicios_no_portuarios_faq_items` | repeater | Preguntas y respuestas (4 en el diseño) | — | sí |
| `servicios_no_portuarios_faq_items.pregunta` | text | Pregunta; es el texto que se toca para abrir. Recomendado: ~60 caracteres | ¿Qué son los servicios no portuarios? | sí |
| `servicios_no_portuarios_faq_items.respuesta` | textarea | Respuesta, sin formato. Recomendado: ~190 caracteres | Son el uso de áreas, los servicios complementarios y las facilidades que el terminal presta a terceros dentro de su recinto. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Pasa los criterios de `wp-accordion` (`references/acceptance.md` de la skill)
- [x] Usa el componente `faq-ayuda` y no redefine su marcado
- [x] El `id="faq"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: cta

- **Origen:** `servicios-no-portuarios.html` líneas 322-344
- **Destino:** `template-parts/pages/servicios-no-portuarios/cta.php`, `template-parts/components/cta-cotizar.php`
- **Grupo:** `servicios_no_portuarios_cta`
- **Skill:** ninguna
- **Comportamiento:** usa el componente compartido `cta-cotizar` (`titulo`, `bajada`, `boton`, `imagen`). Bloque a dos columnas (texto 886fr, imagen 1454fr) desde 1000 px y apilado en móvil; el título entra palabra por palabra; botón "Contáctanos" con el componente `boton` que lleva al formulario de contacto; la imagen se recorta con `object-cover`, alto mínimo `max(380px, 22.9vw)` en escritorio y `56vw` en móvil, `loading="lazy"`. Mismo texto que el CTA de `servicios-a-la-nave`; cambia la imagen. No es `bloque-acceso`.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_no_portuarios_cta_titulo` | text | Título del bloque (`h2`). Se muestra en grande junto a la imagen. Recomendado: ~90 caracteres | ¿Necesitas cotizar un servicio o coordinar una operación? | sí |
| `servicios_no_portuarios_cta_bajada` | textarea | Frase de apoyo bajo el título. Recomendado: ~110 caracteres | Te acompañamos desde la cotización hasta la operación en el terminal. | no |
| `servicios_no_portuarios_cta_boton` | link | Botón del bloque: texto y destino (formulario de contacto) | Contáctanos | sí |
| `servicios_no_portuarios_cta_imagen` | image | Imagen del bloque (camión con carga pesada en la balanza de ingreso); se recorta para llenar la columna. Recomendado: 1800 × 760 px (aprox. 2.35:1), mínimo 900 px de ancho | — | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Imagen con `width`/`height` o `aspect-ratio` y `loading="lazy"`; pasa por `copam_theme_image`
- [x] El botón usa el componente `boton` y `copam_theme_link`; el bloque usa `cta-cotizar` sin redefinirlo
- [x] El bloque se apila en móvil sin alturas fijas que corten el texto
