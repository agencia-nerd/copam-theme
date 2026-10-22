# Página: Sistema Integrado de Gestión

- **Resumen:** Explica el Sistema Integrado de Gestión de COPAM (calidad, ambiente y seguridad y salud en el trabajo, certificado por AENOR); el visitante revisa el alcance, consulta y descarga los certificados ISO y la política del SIG, y salta entre secciones con el índice lateral.
- **Fuente:** `sistema-integrado-de-gestion.html`
- **Plantilla:** `pages/template-sistema-integrado-de-gestion.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, indice, sistema, certificaciones, politica, documentos, acceso
- **Skills usadas:** wp-accordion (documentos), wp-helper
- **Grupo ACF:** Sistema Integrado de Gestión
- **Ubicación:** plantilla pages/template-sistema-integrado-de-gestion.php
- **Notas de página:**
  - `h1` "Sistema Integrado de Gestión" en el hero (el diseño lo parte en dos líneas: "Sistema Integrado" / "de Gestión")
  - título SEO "Sistema Integrado de Gestión · COPAM"
  - meta descripción del diseño: "Sistema Integrado de Gestión de COPAM: ISO 9001, ISO 14001 e ISO 45001 certificados por AENOR." (el diseño trae `noindex, nofollow`: se ignora, es solo de la maqueta)
  - Header, footer, menús, buscador y aviso de mantenimiento son del sitio (`opciones`) y no se repiten aquí
  - Las secciones `indice` a `acceso` van dentro de una rejilla de dos columnas (índice lateral de `clamp(220px, 17vw, 320px)` a la izquierda, contenido a la derecha) que arma la plantilla
  - por debajo de 1000 px el índice se oculta
  - El índice se genera con los títulos de `sistema`, `certificaciones`, `politica` y `documentos` (ids con esos mismos nombres) y resalta el activo al desplazarse (JS, mismo módulo que `nosotros`)
  - Las 4 secciones de contenido usan el componente `titulo-linea`
  - los enlaces con flecha usan `enlace-flecha`
  - las migas usan `migas`
  - el cierre usa `bloque-acceso` en variante columna
  - Los PDF de `src/assets/docs/` se suben a la biblioteca de medios y se asignan con campos `file`
  - el tamaño del PDF que muestra el diseño en el `title` ("PDF · 250 KB") se calcula del archivo
  - Las animaciones del diseño (`data-rise`, `data-clip`, `data-sr`, parallax del hero) se reescriben en un módulo JS que respeta `prefers-reduced-motion`
- **Estado:** aplicado

## Sección: hero

- **Origen:** `sistema-integrado-de-gestion.html` líneas 158-182
- **Destino:** `template-parts/pages/sistema-integrado-de-gestion/hero.php`
- **Grupo:** `sistema_integrado_de_gestion_hero`
- **Skill:** ninguna
- **Comportamiento:** componente `migas` con "Inicio" (portada, ícono de casa) > "Nosotros" (enlace a la página Nosotros) > "Sistema Integrado de Gestión" (actual, `aria-current="page"`); son fijas, no campos. `h1` centrado con el título y la bajada centrada debajo. Imagen a todo el ancho (con el margen lateral de la página) de alto `clamp(310px, min(43vw, 100svh - 280px), 820px)`, `object-cover` con `object-position` 50% 45%, radio 4px y fondo gris #EFEFEF mientras carga; es la imagen principal: `'loading' => 'eager'`. Entrada por recorte y parallax suave al desplazarse (JS). Valores sueltos: radio 4px, gris #EFEFEF.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `sistema_integrado_de_gestion_hero_titulo` | text | Título principal de la página (h1). Se muestra en grande y centrado bajo las migas; si es largo se parte en dos líneas. Recomendado: ~45 caracteres | Sistema Integrado de Gestión | sí |
| `sistema_integrado_de_gestion_hero_bajada` | textarea | Texto de presentación bajo el título. Recomendado: ~330 caracteres | Gestionamos la operación y conservación del Terminal Portuario de Yurimaguas – Nueva Reforma bajo un sistema que integra calidad, gestión ambiental y seguridad y salud en el trabajo, certificado por AENOR. | sí |
| `sistema_integrado_de_gestion_hero_imagen` | image | Imagen panorámica del hero (izaje de carga de proyecto con grúa celosía). Se recorta para llenar el bloque (proporción variable, unos 2,1:1 en escritorio ancho). Recomendado: 2400 × 1100 px, mínimo 1280 px de ancho | — | sí |

Alt de la imagen en el diseño: "Izaje de carga de proyecto con grúa celosía, supervisado por personal con equipo de seguridad".

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Imagen del hero con `loading="eager"`
- [x] Migas dentro de `<nav aria-label="Ruta de navegación">` con enlaces a la portada y a Nosotros del tema

## Sección: indice

- **Origen:** `sistema-integrado-de-gestion.html` líneas 184-198 (lista en el `<script>`, línea 712)
- **Destino:** `template-parts/pages/sistema-integrado-de-gestion/indice.php`
- **Grupo:** `sistema_integrado_de_gestion_indice`
- **Skill:** ninguna
- **Comportamiento:** aside pegajoso en la columna izquierda, solo desde 1000 px. Los enlaces (Nuestro sistema, Certificaciones, Política del SIG, Documentos) salen de los títulos de las cuatro secciones y apuntan a sus ids con desplazamiento suave; el activo va en `--color-ink` con barra `--color-brand`, los demás en gris #8C8C8C con barra #D6D6D6 (valores sueltos). Al final, componente `enlace-flecha` a Compromiso Ambiental; se oculta si el campo está vacío.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `sistema_integrado_de_gestion_indice_titulo` | text | Rótulo sobre la lista de enlaces del índice lateral. Recomendado: ~25 caracteres | En esta página | sí |
| `sistema_integrado_de_gestion_indice_enlace` | link | Enlace con flecha al pie del índice: texto y destino (Compromiso Ambiental) | Compromiso Ambiental | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El índice es un `<nav>` con enlaces `<a href="#id">` y cada id existe en su sección
- [x] El enlace activo se marca con `aria-current` y el JS respeta `prefers-reduced-motion`
- [x] El enlace con flecha usa el componente `enlace-flecha` y apunta a la página del tema

## Sección: sistema

- **Origen:** `sistema-integrado-de-gestion.html` líneas 200-216
- **Destino:** `template-parts/pages/sistema-integrado-de-gestion/sistema.php`
- **Grupo:** `sistema_integrado_de_gestion_sistema`
- **Skill:** ninguna
- **Comportamiento:** `section id="sistema"`; `titulo-linea` (h2 con línea) y un párrafo. Debajo, dos tarjetas con fondo gris #F8F8F8 y radio 6px (valores sueltos): "Alcance de la certificación" (rótulo, párrafo del alcance y dirección en texto más pequeño) y "Consulta y participación" (rótulo, párrafo y `enlace-flecha` al Buzón de sugerencias, página Contacto, ancla `#buzon`). La plantilla oculta cada parte opcional si su campo está vacío. Entrada por recorte en JS.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `sistema_integrado_de_gestion_sistema_titulo` | text | Título de la sección (h2); también es el texto del índice lateral. Recomendado: ~25 caracteres | Nuestro sistema | sí |
| `sistema_integrado_de_gestion_sistema_texto` | textarea | Párrafo que explica las tres normas y la certificación. Recomendado: ~420 caracteres | Nuestro Sistema Integrado de Gestión reúne en un solo marco los requisitos de tres normas internacionales: ISO 9001 (calidad), ISO 14001 (gestión ambiental) e ISO 45001 (seguridad y salud en el trabajo). Está certificado por AENOR y reconocido por la red internacional IQNet. | sí |
| `sistema_integrado_de_gestion_sistema_alcance_etiqueta` | text | Rótulo de la primera tarjeta. Recomendado: ~45 caracteres | Alcance de la certificación | no |
| `sistema_integrado_de_gestion_sistema_alcance_texto` | textarea | Qué cubre la certificación. Se muestra en la primera tarjeta. Recomendado: ~350 caracteres | Gestión de la operación portuaria: servicio a la nave, a la carga y a los pasajeros (embarque y desembarque de personas), y conservación del terminal portuario: mantenimiento rutinario, periódico y reparación por emergencia. | no |
| `sistema_integrado_de_gestion_sistema_alcance_direccion` | text | Dirección del terminal, en letra pequeña al pie de la tarjeta. Recomendado: ~130 caracteres | Vía de Evitamiento Km 0.0, Caserío Santa Rosa, Yurimaguas, Alto Amazonas, Loreto. | no |
| `sistema_integrado_de_gestion_sistema_consulta_etiqueta` | text | Rótulo de la segunda tarjeta. Recomendado: ~40 caracteres | Consulta y participación | no |
| `sistema_integrado_de_gestion_sistema_consulta_texto` | textarea | Invitación a enviar sugerencias y consultas. Se muestra en la segunda tarjeta. Recomendado: ~180 caracteres | Usuarios, proveedores y trabajadores pueden enviarnos sugerencias y consultas sobre nuestro sistema de gestión. | no |
| `sistema_integrado_de_gestion_sistema_consulta_enlace` | link | Enlace con flecha de la segunda tarjeta: texto y destino (Buzón de sugerencias) | Ir al Buzón de sugerencias | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Usa `titulo-linea` y `enlace-flecha` sin duplicar su marcado
- [x] El enlace al Buzón usa el helper de enlaces y apunta a la página Contacto del tema (ancla `#buzon`)

## Sección: certificaciones

- **Origen:** `sistema-integrado-de-gestion.html` líneas 217-248
- **Destino:** `template-parts/pages/sistema-integrado-de-gestion/certificaciones.php`
- **Grupo:** `sistema_integrado_de_gestion_certificaciones`
- **Skill:** ninguna
- **Comportamiento:** `section id="certificaciones"`; `titulo-linea` y una banda con 3 tarjetas blancas (radio 4px, rejilla de 3 columnas desde 1180 px, 2 desde 600 px, 1 en móvil). Cada tarjeta: h3 con la norma, nombre del sistema, dos líneas con los códigos del certificado AENOR e IQNet, tres fechas (primera emisión, última emisión, vigente hasta, esta última resaltada) y una fila de enlaces a PDF que abren en pestaña nueva con ícono de flecha de esquina (helper de enlaces; tamaño del PDF en el `title`). Los rótulos "Primera emisión", "Última emisión" y "Vigente hasta" son fijos; las fechas se muestran como dd-mm-aaaa. 3 tarjetas en el diseño; el editor puede sumar o quitar. Entrada por recorte escalonada en JS.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `sistema_integrado_de_gestion_certificaciones_titulo` | text | Título de la sección (h2); también es el texto del índice lateral. Recomendado: ~25 caracteres | Certificaciones | sí |
| `sistema_integrado_de_gestion_certificaciones_items` | repeater | Una tarjeta por norma certificada. 3 tarjetas en el diseño | — | sí |
| `sistema_integrado_de_gestion_certificaciones_items.norma` | text | Norma, en grande (h3). Recomendado: ~15 caracteres | ISO 9001 | sí |
| `sistema_integrado_de_gestion_certificaciones_items.nombre` | text | Nombre del sistema que cubre la norma. Recomendado: ~50 caracteres | Gestión de la calidad | sí |
| `sistema_integrado_de_gestion_certificaciones_items.certificado_aenor` | text | Código del certificado AENOR, con su prefijo. Recomendado: ~45 caracteres | Certificado AENOR ER-0730/2018 | sí |
| `sistema_integrado_de_gestion_certificaciones_items.certificado_iqnet` | text | Código del certificado IQNet, con su prefijo. Recomendado: ~30 caracteres | IQNet ES-0730/2018 | no |
| `sistema_integrado_de_gestion_certificaciones_items.primera_emision` | date_picker | Fecha de la primera emisión. Formato de salida dd-mm-aaaa | 10-12-2018 | sí |
| `sistema_integrado_de_gestion_certificaciones_items.ultima_emision` | date_picker | Fecha de la última emisión. Formato de salida dd-mm-aaaa | 28-12-2024 | sí |
| `sistema_integrado_de_gestion_certificaciones_items.vigente_hasta` | date_picker | Fecha de vencimiento; se resalta en verde. Formato de salida dd-mm-aaaa | 10-12-2027 | sí |
| `sistema_integrado_de_gestion_certificaciones_items.enlaces` | repeater | Enlaces a los PDF del certificado. 3 por tarjeta en el diseño | — | no |
| `sistema_integrado_de_gestion_certificaciones_items.enlaces.texto` | text | Texto del enlace. Recomendado: ~25 caracteres | Certificado (PDF) | sí |
| `sistema_integrado_de_gestion_certificaciones_items.enlaces.archivo` | file | PDF del certificado (se sube a la biblioteca de medios) | — | sí |

Tarjetas actuales (norma · nombre · AENOR · IQNet · primera · última · vigente · enlaces texto: archivo):
- ISO 9001 · Gestión de la calidad · Certificado AENOR ER-0730/2018 · IQNet ES-0730/2018 · 10-12-2018 · 28-12-2024 · 10-12-2027 · Certificado (PDF): `certificado-iso-9001.pdf`; English: `certificado-iso-9001-en.pdf`; IQNet: `iqnet-iso-9001.pdf`
- ISO 14001 · Gestión ambiental · Certificado AENOR GA-2018/0324 · IQNet ES-2018/0324 · 10-12-2018 · 28-12-2024 · 10-12-2027 · Certificado (PDF): `certificado-iso-14001.pdf`; English: `certificado-iso-14001-en.pdf`; IQNet: `iqnet-iso-14001.pdf`
- ISO 45001 · Seguridad y salud en el trabajo · Certificado AENOR SST-0165/2018 · IQNet ES-SST-0165/2018 · 25-11-2021 · 28-12-2024 · 10-12-2027 · Certificado (PDF): `certificado-iso-45001.pdf`; English: `certificado-iso-45001-en.pdf`; IQNet: `iqnet-iso-45001.pdf`

(Los PDF están en `src/assets/docs/`.)

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Los enlaces a PDF usan el helper de enlaces (pestaña nueva con `rel` seguro y aviso `sr-only`)
- [x] Las tarjetas se imprimen con un bucle del repeater y la rejilla pasa de 3 a 2 y 1 columnas igual que el diseño
- [x] Las fechas salen en formato dd-mm-aaaa

## Sección: politica

- **Origen:** `sistema-integrado-de-gestion.html` líneas 249-280
- **Destino:** `template-parts/pages/sistema-integrado-de-gestion/politica.php`
- **Grupo:** `sistema_integrado_de_gestion_politica`
- **Skill:** ninguna
- **Comportamiento:** `section id="politica"`; `titulo-linea`, un párrafo introductorio y una banda con 4 tarjetas blancas (radio 4px, 2 columnas desde 760 px, 1 en móvil). Cada tarjeta lleva un h3 y una lista de compromisos con viñeta verde (`--color-brand`, círculo decorativo `aria-hidden`). Al pie, una fila con la línea de aprobación (texto) y el botón verde "Descargar política (PDF)" con flecha de esquina, que abre el PDF en pestaña nueva (botón del componente `boton`, helper de enlaces). La plantilla oculta la fila si faltan texto y archivo. Entrada por recorte en JS.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `sistema_integrado_de_gestion_politica_titulo` | text | Título de la sección (h2); también es el texto del índice lateral. Recomendado: ~25 caracteres | Política del SIG | sí |
| `sistema_integrado_de_gestion_politica_intro` | textarea | Frase que introduce los compromisos. Recomendado: ~230 caracteres | COPAM S.A., empresa concesionaria que administra la operación y conservación del terminal portuario de Yurimaguas – Nueva Reforma, se compromete a: | sí |
| `sistema_integrado_de_gestion_politica_bloques` | repeater | Una tarjeta por eje de la política. 4 tarjetas en el diseño | — | sí |
| `sistema_integrado_de_gestion_politica_bloques.titulo` | text | Título de la tarjeta (h3). Recomendado: ~50 caracteres | Calidad y servicio | sí |
| `sistema_integrado_de_gestion_politica_bloques.compromisos` | repeater | Lista de compromisos de la tarjeta, uno por viñeta. De 2 a 4 en el diseño | — | sí |
| `sistema_integrado_de_gestion_politica_bloques.compromisos.texto` | textarea | Texto del compromiso. Recomendado: ~290 caracteres | Satisfacer las expectativas de nuestros usuarios con una cultura de calidad basada en valores, principios, seguridad, rentabilidad, capacidad y el compromiso de todo el equipo. | sí |
| `sistema_integrado_de_gestion_politica_aprobacion` | text | Línea de aprobación bajo las tarjetas (quién y cuándo). Recomendado: ~140 caracteres | Aprobada por la Gerencia General · Ing. Carmen Benítez Hernández · 21 de octubre de 2025 | no |
| `sistema_integrado_de_gestion_politica_boton_texto` | text | Texto del botón de descarga. Recomendado: ~40 caracteres | Descargar política (PDF) | no |
| `sistema_integrado_de_gestion_politica_archivo` | file | PDF de la política vigente (se sube a la biblioteca de medios) | — | no |

Tarjetas actuales (título: compromisos):
- Calidad y servicio (2): Satisfacer las expectativas de nuestros usuarios con una cultura de calidad basada en valores, principios, seguridad, rentabilidad, capacidad y el compromiso de todo el equipo. / Brindar la mejor atención a nuestros usuarios mediante la oportuna planificación de los servicios y un eficiente control operativo.
- Seguridad y salud en el trabajo (4): Proteger la integridad física y la salud de trabajadores, usuarios, proveedores y visitantes, con una cultura de prevención. / Identificar los peligros, evaluar los riesgos y establecer medidas de control; eliminar los peligros y reducir los riesgos. / Proporcionar condiciones y recursos para un trabajo seguro y saludable. / Promover la consulta y participación de los trabajadores y sus representantes.
- Ambiente y clima (2): Conservar el ambiente mediante el buen uso de nuestros recursos y la prevención de la contaminación, contando con un IGA aprobado. / Contribuir a la mitigación (reducción de emisiones) y la adaptación (resiliencia ante los impactos climáticos) del terminal ante el cambio climático.
- Mejora y cumplimiento (2): Promover la mejora continua del sistema integrado de gestión, con comunicación permanente entre áreas y colaboradores. / Cumplir los requisitos legales, normativos y regulatorios aplicables, en el marco del Contrato de Concesión.

Archivo actual: `politica-sig-2025.pdf` (en `src/assets/docs/`).

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Los compromisos son una lista `<ul>/<li>`; la viñeta es decorativa
- [x] El botón de descarga usa `boton` + helper de enlaces (pestaña nueva con `rel` seguro y aviso `sr-only`)

## Sección: documentos

- **Origen:** `sistema-integrado-de-gestion.html` líneas 281-330 (datos en el `<script>`, línea 711)
- **Destino:** `template-parts/pages/sistema-integrado-de-gestion/documentos.php`, `template-parts/accordions/documentos-sig.php`
- **Grupo:** `sistema_integrado_de_gestion_documentos`
- **Skill:** wp-accordion
- **Comportamiento:** `section id="documentos"`; `titulo-linea` y debajo un acordeón sobre `<details>`/`<summary>` con un panel por grupo (Política, ISO 9001, ISO 14001, ISO 45001), separados por líneas finas. Cada cabecera muestra el nombre del grupo y, a la derecha, "N documento(s)" (calculado del número de filas) y un botón circular verde que alterna entre "+" y "−". El primer grupo abre por defecto. Cada fila interna (fondo gris #F8F8F8, borde superior fino) lleva título, subtítulo, una etiqueta "Vigente" verde si corresponde y el botón verde "Descargar PDF" (texto fijo, con deslizamiento al hover; abre el PDF en pestaña nueva, tamaño en el `title`). Un grupo sin filas muestra el mensaje de vacío en lugar de la lista y, en la cabecera, el texto de estado en lugar del conteo. El acordeón, la animación de alto, el teclado y `prefers-reduced-motion` los resuelve `wp-accordion`; no hay marcado propio. Valor suelto: hover del botón #07702F.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `sistema_integrado_de_gestion_documentos_titulo` | text | Título de la sección (h2); también es el texto del índice lateral. Recomendado: ~15 caracteres | Documentos | sí |
| `sistema_integrado_de_gestion_documentos_grupos` | repeater | Un panel del acordeón por grupo de documentos. 4 grupos en el diseño | — | sí |
| `sistema_integrado_de_gestion_documentos_grupos.nombre` | text | Nombre del grupo, en la cabecera del panel. Recomendado: ~15 caracteres | Política | sí |
| `sistema_integrado_de_gestion_documentos_grupos.estado_vacio` | text | Texto de la cabecera cuando el grupo aún no tiene documentos (reemplaza al conteo). Recomendado: ~25 caracteres | — | no |
| `sistema_integrado_de_gestion_documentos_grupos.documentos` | repeater | Documentos descargables del grupo. De 1 a 3 en el diseño | — | no |
| `sistema_integrado_de_gestion_documentos_grupos.documentos.titulo` | text | Nombre del documento. Recomendado: ~45 caracteres | Política del Sistema Integrado de Gestión | sí |
| `sistema_integrado_de_gestion_documentos_grupos.documentos.subtitulo` | text | Dato breve bajo el nombre (año o código de certificado). Recomendado: ~25 caracteres | 2025 | no |
| `sistema_integrado_de_gestion_documentos_grupos.documentos.vigente` | true_false | Muestra la etiqueta "Vigente" junto al documento | Sí (solo la política) | no |
| `sistema_integrado_de_gestion_documentos_grupos.documentos.archivo` | file | PDF del documento (se sube a la biblioteca de medios) | — | sí |
| `sistema_integrado_de_gestion_documentos_mensaje_vacio` | text | Mensaje que se muestra dentro de un grupo sin documentos. Recomendado: ~90 caracteres | Los documentos de esta sección se publicarán próximamente. | no |

Grupos actuales (nombre: documentos título · subtítulo · archivo):
- Política: Política del Sistema Integrado de Gestión · 2025 · vigente · `politica-sig-2025.pdf`
- ISO 9001: Certificado AENOR (español) · ER-0730/2018 · `certificado-iso-9001.pdf`; Certificate AENOR (English) · ER-0730/2018 · `certificado-iso-9001-en.pdf`; Certificado IQNet · ES-0730/2018 · `iqnet-iso-9001.pdf`
- ISO 14001: Certificado AENOR (español) · GA-2018/0324 · `certificado-iso-14001.pdf`; Certificate AENOR (English) · GA-2018/0324 · `certificado-iso-14001-en.pdf`; Certificado IQNet · ES-2018/0324 · `iqnet-iso-14001.pdf`
- ISO 45001: Certificado AENOR (español) · SST-0165/2018 · `certificado-iso-45001.pdf`; Certificate AENOR (English) · SST-0165/2018 · `certificado-iso-45001-en.pdf`; Certificado IQNet · ES-SST-0165/2018 · `iqnet-iso-45001.pdf`

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Pasa los criterios de `wp-accordion` (`<details>`/`<summary>`, teclado, `prefers-reduced-motion`)
- [x] El conteo "N documento(s)" se calcula de las filas y concuerda con el diseño ("1 documento", "3 documentos")
- [x] Los botones "Descargar PDF" usan el helper de enlaces (pestaña nueva con `rel` seguro y aviso `sr-only`)

## Sección: acceso

- **Origen:** `sistema-integrado-de-gestion.html` línea 331 (`bloque-acceso`, variante `acceso-columna`)
- **Destino:** `template-parts/pages/sistema-integrado-de-gestion/acceso.php`
- **Grupo:** `sistema_integrado_de_gestion_acceso`
- **Skill:** ninguna
- **Comportamiento:** componente compartido `bloque-acceso` con `variante` `columna` (ya definida en `_shared.md`), al pie de la columna de contenido, imagen de unos 320px de alto. Se pasan `titulo`, `descripcion`, `boton` + `url` (del campo link), `imagen` y `alt`; `nota` va vacío. Mismos textos que el bloque de `nosotros`, pero con campos propios de esta página.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `sistema_integrado_de_gestion_acceso_titulo` | text | Título del bloque de acceso al pie de la página. Recomendado: ~30 caracteres | Compromiso Ambiental | sí |
| `sistema_integrado_de_gestion_acceso_descripcion` | textarea | Frase breve bajo el título. Recomendado: ~90 caracteres | Política ambiental e instrumentos de gestión del terminal. | no |
| `sistema_integrado_de_gestion_acceso_boton` | link | Botón del bloque: texto y destino (Compromiso Ambiental) | Ver compromiso ambiental | sí |
| `sistema_integrado_de_gestion_acceso_imagen` | image | Imagen del bloque (vista aérea del terminal rodeado de bosque amazónico). Se recorta para llenar el bloque. Recomendado: 2720 × 640 px, mínimo 1360 px de ancho | — | no |

Alt de la imagen en el diseño: "Vista aérea del terminal rodeado de bosque amazónico".

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Usa el componente `bloque-acceso` sin duplicar su marcado
