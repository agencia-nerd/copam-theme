# Página: Servicios especiales

- **Resumen:** Presenta los servicios complementarios del terminal (almacenamiento desde el día 4, consolidación, pesaje, energía reefer, equipos y otros) y dónde ver su tarifa. El visitante revisa qué incluye, descarga el tarifario y pide una cotización.
- **Fuente:** `servicios-especiales.html`
- **Plantilla:** `pages/template-servicios-especiales.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, que_incluye, tarifas, documentos, faq, cta
- **Skills usadas:** wp-accordion (faq), wp-helper
- **Grupo ACF:** Servicios especiales
- **Ubicación:** plantilla pages/template-servicios-especiales.php
- **Notas de página:**
  - `h1` "Servicios especiales" en el hero
  - Título SEO "Servicios especiales · COPAM"
  - meta descripción del diseño "Concesionaria Puerto Amazonas S.A. · Terminal Portuario de Yurimaguas – Nueva Reforma." (genérica, igual en otras páginas
  - conviene una propia)
  - Se ignora el `noindex` del diseño
  - Header, footer, aviso de mantenimiento y buscador son del sitio
  - Los enlaces `contacto.html#formulario` y `tarifario.html` pasan a las páginas del tema
  - Componentes compartidos: `migas`, `encabezado-seccion`, `boton`, `enlace-flecha`, `documento-card`, `faq-ayuda`, `cta-cotizar`
  - Sin la tabla de tarifas de `servicios-a-la-nave`: aquí se descarga el tarifario
- **Estado:** pendiente

## Sección: hero

- **Origen:** `servicios-especiales.html` líneas 159-213
- **Destino:** `template-parts/pages/servicios-especiales/hero.php`
- **Grupo:** `servicios_especiales_hero`
- **Skill:** ninguna
- **Comportamiento:** migas con el componente `migas` (Inicio > Zona Clientes > Servicios especiales, el último sin enlace); imagen a todo el ancho con parallax y zoom al hacer scroll, `loading="eager"` (imagen principal); `h1` en dos líneas, bajada y botón "Solicitar cotización" con el componente `boton` (variante primario) que lleva al formulario de contacto; tarjeta lateral "Accesos directos" (`h2`) con 4 enlaces ancla a las secciones de la página, flecha de esquina que se desplaza al hover y borde verde `--color-brand`; en escritorio la tarjeta va a la derecha en una columna de 33.3vw y en móvil se apila bajo el texto. Mismo bloque que `servicios-a-la-nave` (hero). Hover del botón `#07702F` (valor suelto). Sin alturas fijas.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_especiales_hero_titulo` | text | Título principal de la página (`h1`). Se muestra en grande sobre la imagen. Recomendado: ~30 caracteres | Servicios especiales | sí |
| `servicios_especiales_hero_bajada` | textarea | Resumen de los servicios bajo el título. Recomendado: ~200 caracteres | Almacenamiento prolongado, consolidación, pesaje, energía reefer, provisión de equipos y otros servicios del tarifario vigente. | sí |
| `servicios_especiales_hero_boton` | link | Botón principal: texto y destino (formulario de contacto) | Solicitar cotización | sí |
| `servicios_especiales_hero_imagen` | image | Imagen del hero a todo el ancho; se recorta para llenar el bloque. Recomendado: 2880 × 1620 px (16:9, a confirmar en la etapa C), mínimo 1440 px de ancho | — | sí |
| `servicios_especiales_hero_accesos_titulo` | text | Título de la tarjeta lateral de enlaces. Recomendado: ~25 caracteres | Accesos directos | no |
| `servicios_especiales_hero_accesos` | repeater | Enlaces de la tarjeta lateral (4 en el diseño). Cada uno baja a una sección de la página | — | no |
| `servicios_especiales_hero_accesos.enlace` | link | Texto y ancla del acceso. Recomendado: ~35 caracteres | Qué incluye | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Imagen con `width`/`height` o `aspect-ratio` y `loading="eager"` (primera pantalla); el `alt` viene del campo de imagen
- [ ] Imagen pasa por `copam_theme_image`; botón y accesos pasan por `copam_theme_link` (componente `boton` para el botón)
- [ ] Migas con el componente `migas` y `<nav aria-label="Migas de pan">`
- [ ] Los 4 accesos llevan a `#que-incluye`, `#tarifas`, `#documentos` y `#faq` con scroll suave, funcionan con teclado y respetan `prefers-reduced-motion`

## Sección: que_incluye

- **Origen:** `servicios-especiales.html` líneas 215-232
- **Destino:** `template-parts/pages/servicios-especiales/que-incluye.php`
- **Grupo:** `servicios_especiales_que_incluye`
- **Skill:** ninguna
- **Comportamiento:** `id="que-incluye"` como ancla; encabezado `h2` con línea que se dibuja (componente `encabezado-seccion`, sin etiqueta ni bajada); tarjetas en rejilla de 4 columnas desde 1180 px, 2 desde 600 px y 1 en móvil, con aparición escalonada y separadores; sin alturas fijas. Al final, enlace con flecha a la página Tarifario con el componente `enlace-flecha` (enlace interno del tema, no `tarifario.html`).
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_especiales_que_incluye_titulo` | text | Título de la sección (`h2`). Recomendado: ~20 caracteres | Qué incluye | sí |
| `servicios_especiales_que_incluye_items` | repeater | Servicios especiales incluidos, una tarjeta por ítem (11 en el diseño) | — | sí |
| `servicios_especiales_que_incluye_items.titulo` | text | Nombre del servicio (`h3`). Recomendado: ~45 caracteres | Almacenamiento desde el día 4 | sí |
| `servicios_especiales_que_incluye_items.descripcion` | textarea | Explicación breve del servicio. Recomendado: ~110 caracteres | Contenedores llenos y vacíos, carga fraccionada, refrigerada y rodante. | sí |
| `servicios_especiales_que_incluye_enlace` | link | Enlace con flecha bajo las tarjetas, hacia la página Tarifario. Recomendado: ~65 caracteres | Montos y condiciones en el Tarifario vigente | no |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Los ítems se recorren con un bucle (no hay una tarjeta por ítem escrita a mano) y la rejilla admite más o menos ítems
- [ ] El enlace usa el componente `enlace-flecha` y apunta a la página Tarifario del tema, no a `tarifario.html`
- [ ] El `id="que-incluye"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: tarifas

- **Origen:** `servicios-especiales.html` líneas 234-256
- **Destino:** `template-parts/pages/servicios-especiales/tarifas.php`
- **Grupo:** `servicios_especiales_tarifas`
- **Skill:** ninguna
- **Comportamiento:** `id="tarifas"`; `h2` con línea (componente `encabezado-seccion`); párrafo, botón verde "Descargar tarifario vigente" con el componente `boton` (abre el PDF en pestaña nueva; el diseño lo muestra con `title` "PDF · 410 KB", que el tema puede calcular del archivo) y enlace con flecha "Ver versiones anteriores" (componente `enlace-flecha`) hacia la página Tarifario, ancla `#versiones`. Sin tabla de montos: el script del diseño define seis filas de tarifas (Carga fraccionada, Carga rodante, Carga sólida a granel, Carga líquida a granel, Contenedor de 20 pies, Contenedor de 40 pies; unidad Tonelada o Contenedor) pero el HTML no las muestra, por eso no se piden campos. Botón y enlace en fila en escritorio y apilados en móvil.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_especiales_tarifas_titulo` | text | Título de la sección (`h2`). Recomendado: ~30 caracteres | Tarifas y precios | sí |
| `servicios_especiales_tarifas_texto` | textarea | Párrafo que explica dónde están las tarifas. Recomendado: ~300 caracteres | Las tarifas y los precios de estos servicios figuran en el Tarifario de Servicios Portuarios vigente, aprobado por OSITRAN. Descarga el documento oficial para consultar el detalle de cada prestación. | sí |
| `servicios_especiales_tarifas_archivo` | file | Tarifario vigente en PDF, para descargar (se sube a la biblioteca de medios) | — | sí |
| `servicios_especiales_tarifas_boton_texto` | text | Texto del botón de descarga. Recomendado: ~45 caracteres | Descargar tarifario vigente | sí |
| `servicios_especiales_tarifas_versiones` | link | Enlace a las versiones anteriores del tarifario (página Tarifario, ancla `#versiones`). Recomendado: ~40 caracteres | Ver versiones anteriores | no |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] El botón de descarga abre el PDF con `rel` seguro y aviso de pestaña nueva; el enlace de versiones apunta a la página Tarifario del tema
- [ ] El `id="tarifas"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: documentos

- **Origen:** `servicios-especiales.html` líneas 258-285
- **Destino:** `template-parts/pages/servicios-especiales/documentos.php`, `template-parts/components/documento-card.php`
- **Grupo:** `servicios_especiales_documentos`
- **Skill:** ninguna
- **Comportamiento:** `id="documentos"`; `h2` con línea; tarjetas con el componente `documento-card` en rejilla de 3 columnas desde 1180 px, 2 desde 600 px y 1 en móvil; cada tarjeta es un enlace a un PDF en pestaña nueva con etiqueta, título, fecha y botón circular verde con flecha de esquina (hover `#07702F`, valor suelto); separadores entre filas y columnas. Mismo bloque que `servicios-a-la-nave` (documentos), aquí con 3 columnas en vez de 4. El script del diseño trae además un listado `relDocs` (1 documento) que el HTML no usa; se ignora.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_especiales_documentos_titulo` | text | Título de la sección (`h2`). Recomendado: ~35 caracteres | Documentos relacionados | sí |
| `servicios_especiales_documentos_items` | repeater | Documentos relacionados, una tarjeta por documento (2 en el diseño) | — | sí |
| `servicios_especiales_documentos_items.etiqueta` | text | Tipo de documento, sobre el título. Recomendado: ~15 caracteres | Reglamento | no |
| `servicios_especiales_documentos_items.titulo` | text | Nombre del documento (`h3`). Recomendado: ~75 caracteres | Reglamento de Tarifas y Precios de COPAM · V 5.3 | sí |
| `servicios_especiales_documentos_items.fecha` | text | Vigencia o fecha de aprobación, tal como se muestra. Recomendado: ~45 caracteres | Vigente desde junio de 2026 | no |
| `servicios_especiales_documentos_items.archivo` | file | PDF del documento (se sube a la biblioteca de medios) | — | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Los enlaces a PDF pasan por `copam_theme_link`, con `rel` seguro y aviso de pestaña nueva
- [ ] La tarjeta es el componente `documento-card` con `$args` y la rejilla admite más o menos tarjetas
- [ ] El hover y el foco con teclado muestran el mismo cambio (botón y flecha) y respetan `prefers-reduced-motion`
- [ ] El `id="documentos"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: faq

- **Origen:** `servicios-especiales.html` líneas 289-321
- **Destino:** `template-parts/components/faq-ayuda.php`, `template-parts/accordions/` (acordeón de `wp-accordion`)
- **Grupo:** `servicios_especiales_faq`
- **Skill:** wp-accordion
- **Comportamiento:** usa el componente compartido `faq-ayuda` (`titulo`, `descripcion`, `items`) y `encabezado-seccion` con etiqueta "Ayuda". `id="faq"` como ancla. Acordeón con `<details>`/`<summary>`; la primera pregunta abre por defecto en el diseño; icono más/menos blanco sobre círculo verde. Esta sección no lleva marcado propio: `wp-accordion` lo construye. En el diseño la FAQ se desliza sobre la sección anterior (pila con escala y desenfoque, espacio `faqHold`); se resuelve en la etapa C. Mismo bloque que `servicios-a-la-nave` (faq).
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_especiales_faq_etiqueta` | text | Etiqueta con ícono sobre el título. Recomendado: ~10 caracteres | Ayuda | no |
| `servicios_especiales_faq_titulo` | text | Título de la sección (`h2`). Recomendado: ~30 caracteres | Preguntas frecuentes | sí |
| `servicios_especiales_faq_descripcion` | textarea | Bajada bajo el título. Recomendado: ~110 caracteres | Respuestas a las consultas más comunes sobre los servicios especiales. | no |
| `servicios_especiales_faq_items` | repeater | Preguntas y respuestas (5 en el diseño) | — | sí |
| `servicios_especiales_faq_items.pregunta` | text | Pregunta; es el texto que se toca para abrir. Recomendado: ~60 caracteres | ¿Qué se considera un servicio especial? | sí |
| `servicios_especiales_faq_items.respuesta` | textarea | Respuesta, sin formato. Recomendado: ~330 caracteres | Los servicios complementarios al servicio estándar previstos en el tarifario vigente, como almacenamiento desde el día 4, recargos por carga peligrosa o sobredimensionada, pesaje adicional y provisión de equipamiento. | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Pasa los criterios de `wp-accordion` (`references/acceptance.md` de la skill)
- [ ] Usa el componente `faq-ayuda` y no redefine su marcado
- [ ] El `id="faq"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: cta

- **Origen:** `servicios-especiales.html` líneas 323-345
- **Destino:** `template-parts/pages/servicios-especiales/cta.php`
- **Grupo:** `servicios_especiales_cta`
- **Skill:** ninguna
- **Comportamiento:** usa el componente compartido `cta-cotizar` (`titulo`, `bajada`, `boton`, `imagen`). Bloque a dos columnas (texto 886fr, imagen 1454fr) desde 1000 px y apilado en móvil; el título entra palabra por palabra; botón "Contáctanos" con `boton` hacia el formulario de contacto; imagen con `object-cover`, alto mínimo `max(380px, 22.9vw)` en escritorio y `56vw` en móvil, `loading="lazy"`. Mismo texto y botón que en las otras páginas de servicios; solo cambia la imagen.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_especiales_cta_titulo` | text | Título del bloque (`h2`). Se muestra en grande junto a la imagen. Recomendado: ~90 caracteres | ¿Necesitas cotizar un servicio o coordinar una operación? | sí |
| `servicios_especiales_cta_bajada` | textarea | Frase de apoyo bajo el título. Recomendado: ~110 caracteres | Te acompañamos desde la cotización hasta la operación en el terminal. | no |
| `servicios_especiales_cta_boton` | link | Botón del bloque: texto y destino (formulario de contacto) | Contáctanos | sí |
| `servicios_especiales_cta_imagen` | image | Imagen del bloque (grúa izando maquinaria sobredimensionada); se recorta para llenar la columna. Recomendado: 1800 × 760 px (aprox. 2.35:1), mínimo 900 px de ancho | — | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Imagen con `width`/`height` o `aspect-ratio` y `loading="lazy"`; pasa por `copam_theme_image`
- [ ] El bloque usa el componente `cta-cotizar` y su botón `boton` con `copam_theme_link`
- [ ] El bloque se apila en móvil sin alturas fijas que corten el texto
