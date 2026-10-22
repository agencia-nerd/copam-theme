# Página: Servicios a la nave

- **Resumen:** Explica el servicio de amarre, desamarre y uso de amarradero para las naves que recalan en el terminal, con su tarifa y documentos. El visitante revisa qué incluye, consulta documentos y pide una cotización.
- **Fuente:** `servicios-a-la-nave.html`
- **Plantilla:** `pages/template-servicios-a-la-nave.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, que_incluye, tarifas, documentos, faq, cta
- **Skills usadas:** wp-accordion (faq), wp-helper
- **Grupo ACF:** Servicios a la nave
- **Ubicación:** plantilla pages/template-servicios-a-la-nave.php
- **Notas de página:**
  - `h1` "Servicios a la nave" en el hero
  - Título SEO "Servicios a la nave · COPAM"
  - meta descripción del diseño "Concesionaria Puerto Amazonas S.A. · Terminal Portuario de Yurimaguas – Nueva Reforma." (genérica, igual en otras páginas
  - conviene una propia)
  - Se ignora el `noindex` del diseño
  - Header, footer, aviso de mantenimiento y buscador son del sitio, no de la página
  - Los enlaces `contacto.html#formulario` y `tarifario.html` pasan a las páginas del tema
  - Efectos del diseño (entrada con máscara, parallax de la imagen del hero, pila hero/FAQ con escala y desenfoque, líneas que se dibujan) son comportamiento visual: se reescriben como módulos JS en la etapa C y respetan `prefers-reduced-motion`
  - Las secciones 2 a 4 usan el mismo encabezado (h2 con línea)
  - es el componente `encabezado-seccion` sin etiqueta ni bajada
  - Las migas ("Inicio > Zona Clientes > Servicios a la nave") usan el componente `migas` y no llevan campos
- **Estado:** pendiente

## Sección: hero

- **Origen:** `servicios-a-la-nave.html` líneas 159-215
- **Destino:** `template-parts/pages/servicios-a-la-nave/hero.php`
- **Grupo:** `servicios_a_la_nave_hero`
- **Skill:** ninguna
- **Comportamiento:** migas con el componente `migas`; imagen a todo el ancho con parallax y zoom al hacer scroll, `loading="eager"` (imagen principal); título `h1`, bajada y botón "Solicitar cotización" con el componente `boton` (variante primario) que lleva al formulario de contacto; tarjeta lateral "Accesos directos" (`h2`) con 4 enlaces ancla a las secciones de la página, flecha que se desplaza 2 px al hover y borde verde `--color-brand`; en escritorio la tarjeta va a la derecha en una columna de 33.3vw y en móvil debajo del texto. Valores sueltos: hover del botón `#07702F` (ya en el componente `boton`). Los destinos de los accesos son anclas fijas (`#que-incluye`, `#tarifas`, `#documentos`, `#faq`).
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_a_la_nave_hero_titulo` | text | Título principal de la página (`h1`). Se muestra en grande sobre la imagen. Recomendado: ~30 caracteres | Servicios a la nave | sí |
| `servicios_a_la_nave_hero_bajada` | textarea | Resumen del servicio bajo el título. Recomendado: ~190 caracteres | Amarre y desamarre y uso de amarradero para las naves que recalan en el Terminal Portuario de Yurimaguas – Nueva Reforma. | sí |
| `servicios_a_la_nave_hero_boton` | link | Botón principal: texto y destino (formulario de contacto) | Solicitar cotización | sí |
| `servicios_a_la_nave_hero_imagen` | image | Imagen del hero a todo el ancho; se recorta para llenar el bloque. Recomendado: 2880 × 1620 px (16:9, a confirmar en la etapa C), mínimo 1440 px de ancho | — | sí |
| `servicios_a_la_nave_hero_accesos_titulo` | text | Título de la tarjeta lateral de enlaces. Recomendado: ~25 caracteres | Accesos directos | no |
| `servicios_a_la_nave_hero_accesos` | repeater | Enlaces de la tarjeta lateral (4 en el diseño). Cada uno baja a una sección de la página | — | no |
| `servicios_a_la_nave_hero_accesos.enlace` | link | Texto y ancla del acceso. Recomendado: ~30 caracteres | Qué incluye | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Imagen con `width`/`height` o `aspect-ratio` y `loading="eager"` (primera pantalla); el `alt` viene del campo de imagen
- [ ] Imagen pasa por `copam_theme_image`; botón y accesos pasan por `copam_theme_link` (componente `boton` para el botón)
- [ ] Migas con el componente `migas` y `<nav aria-label="Migas de pan">`
- [ ] Los 4 accesos llevan a las secciones `#que-incluye`, `#tarifas`, `#documentos` y `#faq` con scroll suave, funcionan con teclado y respetan `prefers-reduced-motion`

## Sección: que_incluye

- **Origen:** `servicios-a-la-nave.html` líneas 217-233
- **Destino:** `template-parts/pages/servicios-a-la-nave/que-incluye.php`
- **Grupo:** `servicios_a_la_nave_que_incluye`
- **Skill:** ninguna
- **Comportamiento:** `id="que-incluye"` como ancla; encabezado h2 con línea que se dibuja (componente `encabezado-seccion`, sin etiqueta ni bajada); tarjetas en rejilla de 2 columnas desde 600 px y 1 en móvil, con aparición escalonada; sin alturas fijas.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_a_la_nave_que_incluye_titulo` | text | Título de la sección (`h2`). Recomendado: ~20 caracteres | Qué incluye | sí |
| `servicios_a_la_nave_que_incluye_items` | repeater | Prestaciones incluidas, una tarjeta por ítem (2 en el diseño) | — | sí |
| `servicios_a_la_nave_que_incluye_items.titulo` | text | Nombre de la prestación (`h3`). Recomendado: ~30 caracteres | Amarre y desamarre | sí |
| `servicios_a_la_nave_que_incluye_items.descripcion` | textarea | Explicación breve de la prestación. Recomendado: ~120 caracteres | Fijación y liberación de las amarras de la nave durante el atraque y el zarpe. | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Los ítems se recorren con un bucle (no hay una tarjeta por ítem escrita a mano) y la rejilla admite más o menos ítems
- [ ] El `id="que-incluye"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: tarifas

- **Origen:** `servicios-a-la-nave.html` líneas 235-259
- **Destino:** `template-parts/pages/servicios-a-la-nave/tarifas.php`
- **Grupo:** `servicios_a_la_nave_tarifas`
- **Skill:** ninguna
- **Comportamiento:** `id="tarifas"`; tabla de dos columnas (Prestación, Unidad de cobro) con líneas que se dibujan entre filas (1 fila en el diseño, debe admitir más); sin montos en el diseño, solo la unidad de cobro. Debajo, nota con un enlace a la página Tarifario (enlace interno del tema). Semántica: usar `<table>` con `<th scope>` o lista de definición, no `div`s sueltos (decisión de marcado en la etapa C).
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_a_la_nave_tarifas_titulo` | text | Título de la sección (`h2`). Recomendado: ~15 caracteres | Tarifas | sí |
| `servicios_a_la_nave_tarifas_columna_prestacion` | text | Encabezado de la primera columna. Recomendado: ~15 caracteres | Prestación | sí |
| `servicios_a_la_nave_tarifas_columna_unidad` | text | Encabezado de la segunda columna. Recomendado: ~25 caracteres | Unidad de cobro | sí |
| `servicios_a_la_nave_tarifas_filas` | repeater | Filas de la tabla (1 en el diseño) | — | sí |
| `servicios_a_la_nave_tarifas_filas.prestacion` | text | Nombre del servicio cobrado. Recomendado: ~55 caracteres | Servicio a la nave (uso de amarradero) | sí |
| `servicios_a_la_nave_tarifas_filas.unidad` | text | Unidad con la que se cobra. Recomendado: ~20 caracteres | Eslora-hora | sí |
| `servicios_a_la_nave_tarifas_nota` | wysiwyg | Nota bajo la tabla, con un enlace a la página Tarifario. Recomendado: ~260 caracteres | Los montos se aplican según el Tarifario de Servicios Portuarios vigente, aprobado por OSITRAN. Consulta el documento oficial en la página de Tarifario. | no |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] La tabla tiene encabezados de columna asociados (`<th>`) y se lee bien con lector de pantalla
- [ ] El enlace "Tarifario" apunta a la página del tema, no a `tarifario.html`
- [ ] El `id="tarifas"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: documentos

- **Origen:** `servicios-a-la-nave.html` líneas 261-288
- **Destino:** `template-parts/pages/servicios-a-la-nave/documentos.php`, `template-parts/components/documento-card.php`
- **Grupo:** `servicios_a_la_nave_documentos`
- **Skill:** ninguna
- **Comportamiento:** `id="documentos"`; tarjetas en rejilla de 4 columnas desde 1180 px, 2 desde 600 px y 1 en móvil; cada tarjeta es un enlace que abre el PDF en pestaña nueva (`copam_theme_link` pone `rel` y el aviso `sr-only`) con etiqueta, título, fecha y botón circular verde con flecha de esquina; al hover el botón pasa a `#07702F` (valor suelto) y la flecha sale por una esquina y entra otra; separadores entre filas y columnas. El diseño muestra además "PDF · tamaño" como `title`; el tamaño sale del archivo (a confirmar). La tarjeta de documento se repite (4 aquí) y también en otras páginas de servicios: se propone el componente `documento-card` con `$args` `etiqueta`, `titulo`, `fecha`, `enlace`.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_a_la_nave_documentos_titulo` | text | Título de la sección (`h2`). Recomendado: ~35 caracteres | Documentos relacionados | sí |
| `servicios_a_la_nave_documentos_items` | repeater | Documentos relacionados, una tarjeta por documento (4 en el diseño) | — | sí |
| `servicios_a_la_nave_documentos_items.etiqueta` | text | Tipo de documento, sobre el título. Recomendado: ~15 caracteres | Tarifario | no |
| `servicios_a_la_nave_documentos_items.titulo` | text | Nombre del documento (`h3`). Recomendado: ~70 caracteres | Tarifario de Servicios Portuarios | sí |
| `servicios_a_la_nave_documentos_items.fecha` | text | Vigencia o fecha de aprobación, tal como se muestra. Recomendado: ~40 caracteres | Vigente desde el 16-06-2026 | no |
| `servicios_a_la_nave_documentos_items.archivo` | file | Archivo PDF subido a la biblioteca de medios | — | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Los enlaces a PDF pasan por `copam_theme_link`, con `rel` seguro y aviso de pestaña nueva
- [ ] La tarjeta es un componente con `$args` y la rejilla admite más o menos tarjetas
- [ ] El hover y el foco con teclado muestran el mismo cambio (botón y flecha) y respetan `prefers-reduced-motion`
- [ ] El `id="documentos"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: faq

- **Origen:** `servicios-a-la-nave.html` líneas 293-324
- **Destino:** `template-parts/components/faq-ayuda.php`, `template-parts/accordions/` (acordeón de `wp-accordion`)
- **Grupo:** `servicios_a_la_nave_faq`
- **Skill:** wp-accordion
- **Comportamiento:** usa el componente compartido `faq-ayuda` (`titulo`, `descripcion`, `items`) y el encabezado `encabezado-seccion` con etiqueta "Ayuda". `id="faq"` como ancla. Acordeón con `<details>`/`<summary>`; la primera pregunta abre por defecto en el diseño; icono más/menos blanco sobre círculo verde. Esta sección no lleva marcado propio: `wp-accordion` lo construye. En el diseño la FAQ se desliza sobre el hero (pila con escala y desenfoque); se resuelve en la etapa C.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_a_la_nave_faq_etiqueta` | text | Etiqueta con ícono sobre el título. Recomendado: ~15 caracteres | Ayuda | no |
| `servicios_a_la_nave_faq_titulo` | text | Título de la sección (`h2`). Recomendado: ~30 caracteres | Preguntas frecuentes | sí |
| `servicios_a_la_nave_faq_descripcion` | textarea | Bajada bajo el título. Recomendado: ~100 caracteres | Respuestas a las consultas más comunes sobre los servicios a la nave. | no |
| `servicios_a_la_nave_faq_items` | repeater | Preguntas y respuestas (5 en el diseño) | — | sí |
| `servicios_a_la_nave_faq_items.pregunta` | text | Pregunta; es el texto que se toca para abrir. Recomendado: ~70 caracteres | ¿Qué incluye el servicio a la nave? | sí |
| `servicios_a_la_nave_faq_items.respuesta` | textarea | Respuesta, sin formato. Recomendado: ~190 caracteres | Incluye el amarre y desamarre y el uso de amarradero de las naves que recalan en el terminal. | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Pasa los criterios de `wp-accordion` (`references/acceptance.md` de la skill)
- [ ] Usa el componente `faq-ayuda` y no redefine su marcado
- [ ] El `id="faq"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: cta

- **Origen:** `servicios-a-la-nave.html` líneas 326-348
- **Destino:** `template-parts/pages/servicios-a-la-nave/cta.php`
- **Grupo:** `servicios_a_la_nave_cta`
- **Skill:** ninguna
- **Comportamiento:** bloque a dos columnas (texto 886fr, imagen 1454fr) desde 1000 px y apilado en móvil; el título entra palabra por palabra; botón "Contáctanos" con el componente `boton` que lleva al formulario de contacto; la imagen se recorta con `object-cover`, alto mínimo `max(380px, 22.9vw)` en escritorio y `56vw` en móvil, `loading="lazy"`. No es el componente `bloque-acceso` (aquel es "Seguimiento de carga", con nota y botón propio): este CTA de cotización se repite en las páginas de servicios, ver aviso de componente compartido en el informe.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_a_la_nave_cta_titulo` | text | Título del bloque (`h2`). Se muestra en grande junto a la imagen. Recomendado: ~90 caracteres | ¿Necesitas cotizar un servicio o coordinar una operación? | sí |
| `servicios_a_la_nave_cta_bajada` | textarea | Frase de apoyo bajo el título. Recomendado: ~110 caracteres | Te acompañamos desde la cotización hasta la operación en el terminal. | no |
| `servicios_a_la_nave_cta_boton` | link | Botón del bloque: texto y destino (formulario de contacto) | Contáctanos | sí |
| `servicios_a_la_nave_cta_imagen` | image | Imagen del bloque; se recorta para llenar la columna. Recomendado: 1800 × 760 px (aprox. 2.35:1), mínimo 900 px de ancho | — | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Imagen con `width`/`height` o `aspect-ratio` y `loading="lazy"`; pasa por `copam_theme_image`
- [ ] El botón usa el componente `boton` y `copam_theme_link`
- [ ] El bloque se apila en móvil sin alturas fijas que corten el texto
