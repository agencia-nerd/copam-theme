# Página: Operación del terminal

- **Resumen:** Reúne el Reglamento de Operaciones (REOP), el horario de atención y la infraestructura del terminal; el visitante descarga la versión vigente o anteriores del REOP, consulta capacidades y equipos y contacta a Operaciones.
- **Fuente:** `operacion-del-terminal.html`
- **Plantilla:** `pages/template-operacion-del-terminal.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, informacion, infraestructura, versiones, faq, cta
- **Skills usadas:** wp-accordion (versiones, faq), wp-helper
- **Grupo ACF:** Operación del terminal
- **Ubicación:** plantilla pages/template-operacion-del-terminal.php
- **Notas de página:**
  - `h1` "Operaciones" en el hero
  - Título SEO "Operación del terminal · COPAM"
  - meta descripción del diseño "Concesionaria Puerto Amazonas S.A. · Terminal Portuario de Yurimaguas – Nueva Reforma." (genérica, conviene una propia)
  - se ignora el `noindex` del diseño
  - Header, footer, menús, buscador y aviso de mantenimiento son del sitio (`opciones`)
  - Anclas de la página: `informacion`, `infraestructura`, `versiones`, `faq`
  - Los enlaces `contacto.html#canales`, `contacto.html#formulario` y `tarifario.html` pasan a las páginas del tema
  - Todo PDF es un campo `file`: el REOP vigente aparece en tres sitios (hero, tarjeta de información y versión 2026) con campos separados
  - conviene subirlo una sola vez a la biblioteca y elegir el mismo archivo
  - Componentes compartidos: `migas`, `boton`, `titulo-linea`, `documento-card`, `faq-ayuda`, `cta-cotizar`
  - En el diseño el bloque de FAQ se desliza sobre las secciones anteriores (pila con escala y desenfoque, espacio `faqHold`)
  - se resuelve en la etapa C
  - Animaciones del diseño (`data-rise`, `data-clip`, `data-sr`, parallax) se reescriben en un módulo JS que respeta `prefers-reduced-motion`
- **Estado:** pendiente

## Sección: hero

- **Origen:** `operacion-del-terminal.html` líneas 159-212
- **Destino:** `template-parts/pages/operacion-del-terminal/hero.php`
- **Grupo:** `operacion_del_terminal_hero`
- **Skill:** ninguna
- **Comportamiento:** componente `migas` con Inicio (portada) > Zona Clientes (sin enlace) > Operación del terminal (actual, `aria-current="page"`); son fijas, no campos. Imagen a todo el ancho con parallax y zoom al desplazarse (JS), `loading="eager"` (imagen principal). `h1` "Operaciones" con la bajada y el botón "Descargar REOP" con el componente `boton` (variante primario) que descarga el PDF: el texto del botón es un campo `text` y la URL sale del campo `file`; si no hay archivo el botón se oculta. Tarjeta lateral "Accesos directos" (`h2`) con 5 enlaces: 4 anclas de la página y uno a Tarifario; flecha de esquina y color `--color-brand` al hover; en escritorio va a la derecha en columna de 33.3vw y en móvil se apila bajo el texto. Mismo bloque que el hero de `servicios-especiales`. Hover del botón `#07702F` (valor suelto). Sin alturas fijas.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `operacion_del_terminal_hero_titulo` | text | Título principal de la página (`h1`). Se muestra en grande sobre la imagen. Recomendado: ~20 caracteres | Operaciones | sí |
| `operacion_del_terminal_hero_bajada` | textarea | Resumen de la página bajo el título. Recomendado: ~240 caracteres | Reglamento de Operaciones, horario de atención e infraestructura disponible para la atención de naves, carga y unidades de transporte en el terminal. | sí |
| `operacion_del_terminal_hero_boton_texto` | text | Texto del botón de descarga del REOP. Recomendado: ~20 caracteres | Descargar REOP | no |
| `operacion_del_terminal_hero_boton_archivo` | file | PDF que descarga el botón (REOP vigente). Si está vacío, el botón se oculta | — | no |
| `operacion_del_terminal_hero_imagen` | image | Imagen del hero a todo el ancho (grúa celosía en el muelle junto a una nave fluvial cargada con madera). Se recorta para llenar el bloque. Recomendado: 2880 × 1620 px (16:9, a confirmar en la etapa C), mínimo 1440 px de ancho | — | sí |
| `operacion_del_terminal_hero_accesos_titulo` | text | Título de la tarjeta lateral de enlaces. Recomendado: ~25 caracteres | Accesos directos | no |
| `operacion_del_terminal_hero_accesos` | repeater | Enlaces de la tarjeta lateral (5 en el diseño). Cuatro bajan a secciones de la página y uno va a Tarifario | — | no |
| `operacion_del_terminal_hero_accesos.enlace` | link | Texto y destino del acceso. Recomendado: ~40 caracteres | Versiones del REOP | sí |

Alt de la imagen en el diseño: "Grúa celosía en el muelle del terminal junto a una nave fluvial cargada con madera en el río Huallaga". Accesos actuales: Versiones del REOP (`#versiones`), Horario de atención (`#informacion`), Infraestructura y equipamiento (`#infraestructura`), Tarifario (página Tarifario), Preguntas frecuentes (`#faq`).

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Imagen del hero con `loading="eager"`
- [ ] Migas con el componente `migas` dentro de `<nav aria-label="Ruta de navegación">`
- [ ] El botón de descarga usa `boton` con el archivo del campo `file`; se oculta si está vacío
- [ ] Los accesos son `<a href>` con anclas que existen en la página

## Sección: informacion

- **Origen:** `operacion-del-terminal.html` líneas 214-235
- **Destino:** `template-parts/pages/operacion-del-terminal/informacion.php`
- **Grupo:** `operacion_del_terminal_informacion`
- **Skill:** ninguna
- **Comportamiento:** `section id="informacion"`; `titulo-linea` y debajo rejilla de tarjetas (3 columnas desde 1180 px, 2 desde 600 px, 1 en móvil) sobre una banda de fondo. Cada tarjeta: `h3`, descripción y, si existe, un botón (`boton`). El botón de la primera tarjeta descarga un PDF (campo `file` + texto aparte), el de la segunda va a los canales de la página Contacto y el de la tercera baja a `#infraestructura`. Si la tarjeta no tiene archivo ni enlace, el botón no se muestra; si hay archivo, tiene prioridad sobre el enlace. Entrada escalonada de las tarjetas (JS). Hover del botón `#07702F` (valor suelto).
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `operacion_del_terminal_informacion_titulo` | text | Título de la sección (`h2`). Recomendado: ~30 caracteres | Información operativa | sí |
| `operacion_del_terminal_informacion_tarjetas` | repeater | Tarjetas de información (3 en el diseño) | — | sí |
| `operacion_del_terminal_informacion_tarjetas.titulo` | text | Título de la tarjeta (`h3`). Recomendado: ~30 caracteres | Reglamento de Operaciones | sí |
| `operacion_del_terminal_informacion_tarjetas.descripcion` | textarea | Texto de la tarjeta. Recomendado: ~230 caracteres | Código REIN-TPY-001, aprobado mediante Resolución de Gerencia General N.° 0344-2026-APN/GG del 15-06-2026. | sí |
| `operacion_del_terminal_informacion_tarjetas.archivo` | file | PDF que descarga el botón de la tarjeta. Opcional; si se sube, el botón descarga este archivo y usa el texto de `boton_texto` | — | no |
| `operacion_del_terminal_informacion_tarjetas.boton_texto` | text | Texto del botón cuando descarga un archivo. Recomendado: ~20 caracteres | Descargar REOP | no |
| `operacion_del_terminal_informacion_tarjetas.boton` | link | Botón de navegación de la tarjeta (se usa si no hay archivo): texto y destino. Recomendado: ~25 caracteres | Contactar operaciones | no |

Tarjetas actuales: (1) Reglamento de Operaciones, con archivo y texto "Descargar REOP"; (2) Horario de atención, "Atención operativa las 24 horas, de forma continua. Atención documental de lunes a viernes de 08:00 a 17:00 h y sábados de 08:00 a 13:00 h, excepto feriados.", botón "Contactar operaciones" a Contacto (canales); (3) Infraestructura, "Muelle marginal de 120 × 47 m, patio de contenedores y equipamiento de maniobra propio.", botón "Ver infraestructura" a `#infraestructura`.

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Usa `titulo-linea` y `boton` sin duplicar su marcado
- [ ] Cada tarjeta es un `<article>` con `h3`; el botón solo aparece si hay archivo o enlace
- [ ] La rejilla cambia de 3 a 2 y a 1 columnas en 1180 px y 600 px

## Sección: infraestructura

- **Origen:** `operacion-del-terminal.html` líneas 237-259 (datos en el `<script>`, línea 747)
- **Destino:** `template-parts/pages/operacion-del-terminal/infraestructura.php`
- **Grupo:** `operacion_del_terminal_infraestructura`
- **Skill:** ninguna
- **Comportamiento:** `section id="infraestructura"`; `titulo-linea` y una tabla de dos columnas (Elemento / Capacidad, la segunda alineada a la derecha) con filas separadas por líneas finas. Hay filas de grupo (fondo #F6F6F6, texto en negrita a todo el ancho: "Infraestructura", "Equipamiento") y filas de dato (elemento + capacidad; la capacidad en gris #7A7A7A). Se marca como `<table>` real con `<th>` en la cabecera. Texto `clamp(14px, .85vw, 16px)`. Revelado por filas (JS). Valores sueltos: #F6F6F6, #7A7A7A.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `operacion_del_terminal_infraestructura_titulo` | text | Título de la sección (`h2`). Recomendado: ~45 caracteres | Infraestructura y equipamiento | sí |
| `operacion_del_terminal_infraestructura_columna_elemento` | text | Encabezado de la primera columna. Recomendado: ~15 caracteres | Elemento | sí |
| `operacion_del_terminal_infraestructura_columna_capacidad` | text | Encabezado de la segunda columna. Recomendado: ~15 caracteres | Capacidad | sí |
| `operacion_del_terminal_infraestructura_grupos` | repeater | Grupos de la tabla, cada uno con su fila de título y sus filas de dato (2 en el diseño) | — | sí |
| `operacion_del_terminal_infraestructura_grupos.nombre` | text | Nombre del grupo; es la fila gris que encabeza sus datos. Recomendado: ~25 caracteres | Infraestructura | sí |
| `operacion_del_terminal_infraestructura_grupos.filas` | repeater | Filas de dato del grupo (5 en el primero, 3 en el segundo) | — | sí |
| `operacion_del_terminal_infraestructura_grupos.filas.elemento` | text | Nombre del elemento. Recomendado: ~30 caracteres | Muelle marginal | sí |
| `operacion_del_terminal_infraestructura_grupos.filas.capacidad` | text | Capacidad o medida, con su unidad. Recomendado: ~15 caracteres | 120 m × 47 m | sí |

Filas actuales: Infraestructura (Muelle marginal 120 m × 47 m; Almacén techado 6,092 m²; Patio de contenedores 10,000 m²; Cámara de frío 600 m²; Tomas reefer 72) y Equipamiento (Grúa celosía 130 t; Grúa camión 55 t; Reach stacker 45 t).

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Usa `titulo-linea` sin duplicar su marcado
- [ ] La tabla es una `<table>` con `<th scope>` en cabecera y filas de grupo; grupos y filas salen de los repeaters
- [ ] Sin alturas fijas: el texto largo se ajusta sin romper la tabla

## Sección: versiones

- **Origen:** `operacion-del-terminal.html` líneas 261-310 (datos en el `<script>`, línea 748)
- **Destino:** `template-parts/accordions/` (acordeón de `wp-accordion`), `template-parts/pages/operacion-del-terminal/versiones.php`
- **Grupo:** `operacion_del_terminal_versiones`
- **Skill:** wp-accordion
- **Comportamiento:** `section id="versiones"`; `titulo-linea` y un acordeón con un ítem por año (2026, 2024, 2020): el año como cabecera, a la derecha el conteo ("1 documento" / "N documentos", calculado, no es campo) y un ícono más/menos; el primer año abre por defecto en el diseño. Dentro, cada documento muestra título, subtítulo (resolución y fecha), una pastilla "Vigente" si corresponde y un botón "Descargar PDF" que descarga el archivo (campo `file`; puede usar `documento-card`). Si un año no tiene documentos muestra el mensaje de "próximamente". Esta sección no lleva marcado propio: `wp-accordion` lo construye. Hover del botón `#07702F` (valor suelto).
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `operacion_del_terminal_versiones_titulo` | text | Título de la sección (`h2`). Recomendado: ~70 caracteres | Versiones del Reglamento de Operaciones (REOP) | sí |
| `operacion_del_terminal_versiones_boton_texto` | text | Texto del botón de descarga de cada documento. Recomendado: ~15 caracteres | Descargar PDF | no |
| `operacion_del_terminal_versiones_vigente_texto` | text | Texto de la pastilla de versión vigente. Recomendado: ~10 caracteres | Vigente | no |
| `operacion_del_terminal_versiones_vacio` | text | Mensaje cuando un año no tiene documentos. Recomendado: ~80 caracteres | Los documentos de esta sección se publicarán próximamente. | no |
| `operacion_del_terminal_versiones_anios` | repeater | Un ítem del acordeón por año (3 en el diseño) | — | sí |
| `operacion_del_terminal_versiones_anios.anio` | text | Año que titula el ítem. Recomendado: 4 caracteres | 2026 | sí |
| `operacion_del_terminal_versiones_anios.documentos` | repeater | Documentos del año (1 por año en el diseño) | — | no |
| `operacion_del_terminal_versiones_anios.documentos.titulo` | text | Nombre del documento. Recomendado: ~90 caracteres | Reglamento de Operaciones del TPY-NR · Código REIN-TPY-001 | sí |
| `operacion_del_terminal_versiones_anios.documentos.subtitulo` | text | Resolución que lo aprueba y fecha. Recomendado: ~70 caracteres | Res. N.° 0344-2026-APN/GG · 15-06-2026 | no |
| `operacion_del_terminal_versiones_anios.documentos.vigente` | true_false | Marca el documento como versión vigente (muestra la pastilla) | — | no |
| `operacion_del_terminal_versiones_anios.documentos.archivo` | file | PDF del documento; lo descarga el botón. Si está vacío, el botón se oculta | — | sí |

Años actuales: 2026 (vigente, "Reglamento de Operaciones del TPY-NR · Código REIN-TPY-001", "Res. N.° 0344-2026-APN/GG · 15-06-2026"); 2024 ("Reglamento de Operaciones del TPY-NR · V 2024", "Res. de Gerencia General N.° 0271-2024-APN-GG (24-04-2024)"); 2020 ("Reglamento de Operaciones del TPY-NR · V 2020", "Res. de Gerencia General N.° 0323-2020-APN-GG").

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Pasa los criterios de `wp-accordion` (`<details>`/`<summary>`, teclado, `prefers-reduced-motion`)
- [ ] Usa `titulo-linea` sin duplicar su marcado
- [ ] Los PDF salen de campos `file`; el botón de descarga avisa si abre en pestaña nueva
- [ ] El conteo de documentos se calcula con los ítems del repeater

## Sección: faq

- **Origen:** `operacion-del-terminal.html` líneas 315-346 (datos en el `<script>`, línea 709)
- **Destino:** `template-parts/components/faq-ayuda.php`, `template-parts/accordions/` (acordeón de `wp-accordion`)
- **Grupo:** `operacion_del_terminal_faq`
- **Skill:** wp-accordion
- **Comportamiento:** usa el componente compartido `faq-ayuda` (`titulo`, `descripcion`, `items`) y `encabezado-seccion` con etiqueta "Ayuda". `id="faq"` como ancla. Acordeón con `<details>`/`<summary>`; la primera pregunta abre por defecto en el diseño; ícono más/menos. Esta sección no lleva marcado propio: `wp-accordion` lo construye. En el diseño la FAQ se desliza sobre la sección anterior (pila con escala y desenfoque, espacio `faqHold`); se resuelve en la etapa C. Mismo bloque que `servicios-especiales` (faq).
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `operacion_del_terminal_faq_etiqueta` | text | Etiqueta con ícono sobre el título. Recomendado: ~10 caracteres | Ayuda | no |
| `operacion_del_terminal_faq_titulo` | text | Título de la sección (`h2`). Recomendado: ~30 caracteres | Preguntas frecuentes | sí |
| `operacion_del_terminal_faq_descripcion` | textarea | Bajada bajo el título. Recomendado: ~100 caracteres | Respuestas a las consultas más comunes sobre la operación del terminal. | no |
| `operacion_del_terminal_faq_items` | repeater | Preguntas y respuestas (5 en el diseño) | — | sí |
| `operacion_del_terminal_faq_items.pregunta` | text | Pregunta; es el texto que se toca para abrir. Recomendado: ~60 caracteres | ¿Qué es el Reglamento de Operaciones (REOP)? | sí |
| `operacion_del_terminal_faq_items.respuesta` | textarea | Respuesta, sin formato. Recomendado: ~320 caracteres | Es el reglamento aprobado por la Autoridad Portuaria Nacional que regula los procedimientos operativos, los estándares de seguridad y las condiciones de uso del terminal. La versión vigente, con código REIN-TPY-001, fue aprobada el 15-06-2026. | sí |

Preguntas actuales: (1) ¿Qué es el Reglamento de Operaciones (REOP)?; (2) ¿Cuál es el horario de atención de Operaciones?; (3) ¿Qué necesito para ingresar al terminal?; (4) ¿Cómo coordino el arribo de una nave?; (5) ¿Dónde encuentro las versiones anteriores del REOP?

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Pasa los criterios de `wp-accordion` (`<details>`/`<summary>`, teclado, `prefers-reduced-motion`)
- [ ] Usa `faq-ayuda` y `encabezado-seccion` sin duplicar su marcado

## Sección: cta

- **Origen:** `operacion-del-terminal.html` líneas 348-366
- **Destino:** `template-parts/pages/operacion-del-terminal/cta.php`
- **Grupo:** `operacion_del_terminal_cta`
- **Skill:** ninguna
- **Comportamiento:** usa el componente compartido `cta-cotizar` (`titulo`, `bajada`, `boton`, `imagen`). Dos columnas (texto 886fr, imagen 1454fr) desde 1000 px y apilado en móvil; el título entra palabra por palabra; botón "Contáctanos" con `boton` hacia el formulario de contacto; imagen con `object-cover`, alto mínimo `max(380px, 22.9vw)` en escritorio y `56vw` en móvil, `loading="lazy"`. Misma estructura que el cta de las páginas de servicios; aquí cambian el título, la bajada y la imagen.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `operacion_del_terminal_cta_titulo` | text | Título del bloque (`h2`). Se muestra en grande junto a la imagen. Recomendado: ~55 caracteres | ¿Necesitas coordinar una operación? | sí |
| `operacion_del_terminal_cta_bajada` | textarea | Frase de apoyo bajo el título. Recomendado: ~110 caracteres | La atención operativa del terminal funciona las 24 horas, de forma continua. | no |
| `operacion_del_terminal_cta_boton` | link | Botón del bloque: texto y destino (formulario de contacto) | Contáctanos | sí |
| `operacion_del_terminal_cta_imagen` | image | Imagen del bloque (montacargas trasladando tubos en el patio); se recorta para llenar la columna. Recomendado: 1800 × 760 px (aprox. 2.35:1), mínimo 900 px de ancho | — | sí |

Alt de la imagen en el diseño: "Montacargas trasladando tubos en el patio del terminal".

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Imagen con `loading="lazy"` y alto mínimo `max(380px, 22.9vw)` en escritorio / `56vw` en móvil
- [ ] Usa `cta-cotizar` y `boton` sin duplicar su marcado
- [ ] El botón apunta al formulario de la página Contacto del tema
