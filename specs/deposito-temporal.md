# Página: Depósito Temporal

- **Resumen:** Explica qué carga atiende el depósito temporal autorizado por SUNAT, sus tarifas, documentos y procedimientos, y recibe quejas y reclamos. El visitante consulta tarifas y requisitos, descarga documentos, registra un reclamo o consulta el estado de su carga.
- **Fuente:** `deposito-temporal.html`
- **Plantilla:** `pages/template-deposito-temporal.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, atendemos, tarifas, documentos, quejas_reclamos, seguimiento, faq, cta
- **Skills usadas:** wp-accordion (documentos, faq), wp-form (quejas_reclamos), wp-helper
- **Grupo ACF:** Depósito Temporal
- **Ubicación:** plantilla pages/template-deposito-temporal.php
- **Notas de página:**
  - `h1` "Depósito Temporal" en el hero
  - Título SEO "Depósito Temporal · COPAM"
  - meta descripción del diseño genérica ("Concesionaria Puerto Amazonas S.A. · Terminal Portuario de Yurimaguas – Nueva Reforma."), conviene una propia
  - Se ignora el `noindex` del diseño
  - Header, footer, aviso de mantenimiento y buscador son del sitio
  - Anclas reales de la página (`id`): `atendemos`, `tarifas`, `documentos`, `quejas-y-reclamos`, `seguimiento`, `faq`
  - El menú "Depósito temporal" enlaza así: Depósito Temporal = la página
  - Tarifario del depósito = `#tarifas`
  - Autorización SUNAT y Procedimientos y formatos = `#documentos` (no hay ancla propia por grupo del acordeón, ver sección documentos)
  - Quejas y reclamos = `#quejas-y-reclamos`
  - Seguimiento de carga = `#seguimiento` (el pie del diseño lo marca con asterisco como externo hacia `http://45.232.151.188:8081/consultacarga/`
  - se decide al aplicar los menús)
  - El acceso "Canales de atención" del hero va a la página de contacto, ancla `#canales` (`contacto.html#canales` pasa a la página del tema)
  - Componentes compartidos: `migas`, `boton`, `encabezado-seccion`, `tarjeta-servicio`, `bloque-acceso`, `faq-ayuda`, `cta-cotizar`
  - El script trae además `relDocs` y `tarifas` que el HTML no pinta
  - se ignoran
- **Estado:** pendiente

## Sección: hero

- **Origen:** `deposito-temporal.html` líneas 159-211
- **Destino:** `template-parts/pages/deposito-temporal/hero.php`
- **Grupo:** `deposito_temporal_hero`
- **Skill:** ninguna
- **Comportamiento:** migas con el componente `migas` (Inicio > Depósito Temporal, el último sin enlace); imagen a todo el ancho con parallax y zoom al hacer scroll, `loading="eager"` (imagen principal); `h1` en dos líneas ("Depósito" / "Temporal"), bajada y botón "Seguimiento de carga" con el componente `boton` (variante primario) que abre el aplicativo externo en pestaña nueva; tarjeta lateral "Accesos directos" (`h2`) con 6 enlaces (5 anclas de esta página y 1 a la página de contacto), flecha de esquina que se desplaza al hover y color verde `--color-brand`; en escritorio la tarjeta va a la derecha y en móvil se apila bajo el texto. Mismo bloque que `servicios-especiales` (hero). Hover del botón `#07702F` (valor suelto). Sin alturas fijas.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `deposito_temporal_hero_titulo` | text | Título principal de la página (`h1`). Se muestra en grande sobre la imagen, partido en dos líneas por palabra. Recomendado: ~25 caracteres | Depósito Temporal | sí |
| `deposito_temporal_hero_bajada` | textarea | Resumen del servicio bajo el título. Recomendado: ~190 caracteres | Recepción, almacenamiento y retiro de mercancía bajo control aduanero de SUNAT, con requisitos y plazos de permanencia propios. | sí |
| `deposito_temporal_hero_boton` | link | Botón principal: texto y destino (aplicativo externo de seguimiento de carga, pestaña nueva) | Seguimiento de carga | sí |
| `deposito_temporal_hero_imagen` | image | Imagen del hero a todo el ancho; se recorta para llenar el bloque. Recomendado: 2880 × 1620 px (16:9, a confirmar en la etapa C), mínimo 1440 px de ancho | — | sí |
| `deposito_temporal_hero_accesos_titulo` | text | Título de la tarjeta lateral de enlaces. Recomendado: ~25 caracteres | Accesos directos | no |
| `deposito_temporal_hero_accesos` | repeater | Enlaces de la tarjeta lateral (6 en el diseño). Cada uno baja a una sección o lleva a otra página | — | no |
| `deposito_temporal_hero_accesos.enlace` | link | Texto y destino del acceso. Recomendado: ~35 caracteres | Tarifario del depósito | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Imagen con `width`/`height` o `aspect-ratio` y `loading="eager"` (primera pantalla); el `alt` viene del campo de imagen
- [ ] Imagen pasa por `copam_theme_image`; botón y accesos pasan por `copam_theme_link` (componente `boton` para el botón)
- [ ] Migas con el componente `migas` y `<nav aria-label="Migas de pan">`
- [ ] Los accesos llevan a `#tarifas`, `#documentos`, `#quejas-y-reclamos`, `#faq` y a la página de contacto con scroll suave, funcionan con teclado y respetan `prefers-reduced-motion`
- [ ] El botón externo abre en pestaña nueva con `rel` seguro y aviso para lectores de pantalla

## Sección: atendemos

- **Origen:** `deposito-temporal.html` líneas 213-234; textos en el script (`dtCards`, línea 947)
- **Destino:** `template-parts/pages/deposito-temporal/atendemos.php`, `template-parts/components/tarjeta-servicio.php`
- **Grupo:** `deposito_temporal_atendemos`
- **Skill:** ninguna
- **Comportamiento:** `id="atendemos"`; `h2` con línea (componente `encabezado-seccion`, sin etiqueta ni bajada); 3 tarjetas con el componente `tarjeta-servicio` (`h3` y descripción) en rejilla de 3 columnas desde 1180 px, 2 desde 600 px y 1 en móvil, con aparición escalonada; cada tarjeta lleva un botón "Ver tarifa" (componente `boton`, hover `#07702F` valor suelto) que baja a `#tarifas`. `tarjeta-servicio` hoy no define botón: se le suma un argumento opcional `boton` (array Link) al aplicar. Sin alturas fijas.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `deposito_temporal_atendemos_titulo` | text | Título de la sección (`h2`). Recomendado: ~45 caracteres | Qué atendemos en el depósito | sí |
| `deposito_temporal_atendemos_items` | repeater | Tipos de carga que atiende el depósito, una tarjeta por ítem (3 en el diseño) | — | sí |
| `deposito_temporal_atendemos_items.titulo` | text | Nombre del tipo de carga (`h3`). Recomendado: ~30 caracteres | Contenedores secos | sí |
| `deposito_temporal_atendemos_items.descripcion` | textarea | Qué incluye el servicio y tiempos de atención. Recomendado: ~240 caracteres | Trámites operativos y administrativos, y almacenamiento a partir del cuarto día de permanencia. Tiempo promedio de atención: 3 h · máximo: 8 h. | sí |
| `deposito_temporal_atendemos_items.boton` | link | Botón de la tarjeta: texto y destino (ancla `#tarifas`). Recomendado: ~15 caracteres | Ver tarifa | no |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Los ítems se recorren con un bucle (no hay una tarjeta por ítem escrita a mano) y la rejilla admite más o menos ítems
- [ ] El botón de cada tarjeta se oculta si su campo está vacío y baja a `#tarifas`
- [ ] El `id="atendemos"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: tarifas

- **Origen:** `deposito-temporal.html` líneas 236-259; filas en el script (`dtHead`, `dtRows`, líneas 951-953)
- **Destino:** `template-parts/pages/deposito-temporal/tarifas.php`
- **Grupo:** `deposito_temporal_tarifas`
- **Skill:** ninguna
- **Comportamiento:** `id="tarifas"`; `h2` con línea (componente `encabezado-seccion`); tabla de 4 columnas (Servicio, Unidad de cobro, Tarifa S/, IGV (18%)) con fila de cabecera, filas de grupo a todo el ancho (fondo `#F6F6F6`, negrita: Contenedores, Carga fraccionada) y filas de tarifa con las dos últimas columnas alineadas a la derecha; separadores entre filas y animación de aparición; la unidad de cobro va en gris `#7A7A7A`. Debe ser una `<table>` real con `<th scope>`, no una rejilla de `div`; en móvil se mantiene la tabla con columnas más estrechas. Las cabeceras de columna son fijas en la plantilla. Los montos se escriben como texto (con decimales) y no se calculan. Nota al pie con el texto de vigencia.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `deposito_temporal_tarifas_titulo` | text | Título de la sección (`h2`). Recomendado: ~30 caracteres | Tarifas del depósito | sí |
| `deposito_temporal_tarifas_filas` | repeater | Filas de la tabla en orden (9 en el diseño: 2 de grupo y 7 de tarifa). Una fila de grupo solo usa el nombre | — | sí |
| `deposito_temporal_tarifas_filas.es_grupo` | true_false | Marca la fila como encabezado de grupo (ocupa todo el ancho y no lleva unidad ni montos) | Sí (primera fila) | no |
| `deposito_temporal_tarifas_filas.servicio` | text | Nombre del servicio o del grupo. Recomendado: ~80 caracteres | Contenedor seco · Trámites operativos y administrativos | sí |
| `deposito_temporal_tarifas_filas.unidad` | text | Unidad de cobro. Recomendado: ~25 caracteres | Contenedor | no |
| `deposito_temporal_tarifas_filas.tarifa` | text | Tarifa en soles, tal como se muestra. Recomendado: ~10 caracteres | 211.93 | no |
| `deposito_temporal_tarifas_filas.igv` | text | IGV (18%) en soles, tal como se muestra. Recomendado: ~10 caracteres | 38.15 | no |
| `deposito_temporal_tarifas_nota` | textarea | Nota al pie de la tabla con vigencia y condiciones. Recomendado: ~430 caracteres | Tarifas reguladas y fijadas por el Ositrán, vigentes desde el 23 de octubre de 2025, en soles (S/). Los tres primeros días de permanencia están incluidos en el servicio estándar. El documento oficial es el tarifario vigente desde el 23 de octubre de 2025. | no |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] La tabla es una `<table>` con `<caption>` oculta (`sr-only`), cabeceras `<th scope="col">` y filas de grupo con `colspan`
- [ ] Las filas se recorren con un bucle y admiten más o menos filas; una celda vacía en unidad o montos no rompe la tabla
- [ ] Las columnas de monto están alineadas a la derecha y se leen sin desbordar en móvil
- [ ] El `id="tarifas"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: documentos

- **Origen:** `deposito-temporal.html` líneas 261-313; contenido en el script (`dtDocs`, línea 954, y `acc()`, líneas 652-668)
- **Destino:** `template-parts/pages/deposito-temporal/documentos.php`, `template-parts/accordions/` (acordeón de `wp-accordion`)
- **Grupo:** `deposito_temporal_documentos`
- **Skill:** wp-accordion
- **Comportamiento:** `id="documentos"`; `h2` con línea (componente `encabezado-seccion`). Acordeón de 4 grupos (Tarifario del depósito, Autorización SUNAT, Procedimientos, Formatos y solicitudes) sobre `<details>`/`<summary>`; el primero abre por defecto; cada cabecera muestra el título del grupo, el contador "N documentos" (lo calcula la plantilla; con 1 dice "1 documento") y el ícono más/menos. Cada documento es una fila con título, subtítulo, insignia "Vigente" (si está marcada) y botón verde de descarga (texto por defecto "Descargar PDF"); un documento puede tener además un enlace secundario "Ver PDF" (caso del formato, que ofrece "Descargar Excel" y "Ver PDF"). Si un grupo no tiene documentos, muestra "Los documentos de esta sección se publicarán próximamente." y el contador dice el texto de estado del grupo. Todos los archivos se suben al sitio: son `file` (PDF y Excel), no `link`. Esta sección no lleva marcado propio: `wp-accordion` lo construye. Hover del botón `#07702F` (valor suelto). Los menús "Autorización SUNAT" y "Procedimientos y formatos" apuntan a `#documentos`; abrir el grupo exacto por hash es una decisión pendiente con `wp-accordion`.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `deposito_temporal_documentos_titulo` | text | Título de la sección (`h2`). Recomendado: ~20 caracteres | Documentos | sí |
| `deposito_temporal_documentos_grupos` | repeater | Grupos del acordeón (4 en el diseño). Cada uno agrupa documentos | — | sí |
| `deposito_temporal_documentos_grupos.titulo` | text | Nombre del grupo, texto que se toca para abrir. Recomendado: ~30 caracteres | Tarifario del depósito | sí |
| `deposito_temporal_documentos_grupos.estado_vacio` | text | Texto que reemplaza el contador cuando el grupo no tiene documentos. Recomendado: ~25 caracteres | Próximamente | no |
| `deposito_temporal_documentos_grupos.documentos` | repeater | Documentos del grupo (2 en el primero) | — | no |
| `deposito_temporal_documentos_grupos.documentos.titulo` | text | Nombre del documento. Recomendado: ~80 caracteres | Tarifario Depósito Temporal Fluvial | sí |
| `deposito_temporal_documentos_grupos.documentos.subtitulo` | text | Detalle, fecha o vigencia, tal como se muestra. Recomendado: ~160 caracteres | Vigente desde el 23-10-2025 | no |
| `deposito_temporal_documentos_grupos.documentos.vigente` | true_false | Muestra la insignia "Vigente" | Sí | no |
| `deposito_temporal_documentos_grupos.documentos.archivo` | file | Archivo principal para descargar (PDF o Excel; se sube a la biblioteca de medios) | — | sí |
| `deposito_temporal_documentos_grupos.documentos.boton_texto` | text | Texto del botón de descarga; si está vacío se usa "Descargar PDF". Recomendado: ~20 caracteres | Descargar PDF | no |
| `deposito_temporal_documentos_grupos.documentos.archivo_alterno` | file | Versión PDF opcional; si existe se muestra el enlace "Ver PDF" junto al botón | — | no |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Pasa los criterios de `wp-accordion` (`<details>`/`<summary>`, teclado, `prefers-reduced-motion`)
- [ ] Grupos y documentos se recorren con bucles; el contador se calcula del número de documentos
- [ ] Los archivos se descargan desde la biblioteca de medios con `rel` seguro; el enlace alterno solo aparece si hay archivo alterno
- [ ] Un grupo sin documentos muestra el mensaje de "próximamente" y no rompe el acordeón
- [ ] El `id="documentos"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: quejas_reclamos

- **Origen:** `deposito-temporal.html` líneas 315-471
- **Destino:** `template-parts/pages/deposito-temporal/quejas-reclamos.php`, `template-parts/forms/` (formulario de `wp-form`)
- **Grupo:** `deposito_temporal_quejas_reclamos`
- **Skill:** wp-form
- **Comportamiento:** `id="quejas-y-reclamos"`; `h2` con línea y párrafo de introducción. El formulario es la hoja de reclamación del Depósito Temporal y lo construye `wp-form` (sin marcado propio). Estructura: cabecera con "Hoja de reclamación N.°" (correlativa, se asigna al enviar) y "Fecha" del día; datos del proveedor en solo lectura (razón social, RUC, domicilio, código de identificación); "1. Identificación del consumidor reclamante": nombre, tipo de documento (DNI o Carné de extranjería), número, domicilio, teléfono, correo, casilla "Soy menor de edad" que muestra nombre y número de documento del padre o madre; "2. Identificación del bien contratado": tipo (selector de dos opciones), monto reclamado en S/ (opcional), descripción; "3. Detalle de la reclamación y pedido del consumidor": tipo (queja o reclamo), detalle, pedido; "4. Observaciones y acciones adoptadas por el proveedor", espacio informativo que COPAM completa al responder; casilla de aceptación con enlace a la política de privacidad, verificación anti-robot, botón "Enviar queja o reclamo" y botón "Imprimir / descargar copia". Destinatario `comercial@copam.com.pe`; el usuario recibe copia en el correo que registró. Notas legales bajo el formulario. Pendientes marcados en el diseño: código de identificación del establecimiento y anti-spam (reCAPTCHA o Turnstile, lo resuelve `wp-form`). Los campos del formulario los define `wp-form`; aquí solo se editan los textos fijos. El correo de destino no es campo de esta página: sale de `opciones_correos_deposito.correo` en Ajustes del sitio (se admite más de uno).
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `deposito_temporal_quejas_reclamos_titulo` | text | Título de la sección (`h2`). Recomendado: ~25 caracteres | Quejas y reclamos | sí |
| `deposito_temporal_quejas_reclamos_texto` | textarea | Introducción bajo el título. Recomendado: ~260 caracteres | Registra tu queja o reclamo sobre los servicios del Depósito Temporal, conforme al Código de Protección y Defensa del Consumidor. Los campos con * son obligatorios. | sí |
| `deposito_temporal_quejas_reclamos_razon_social` | text | Razón social del proveedor, solo lectura en la hoja. Recomendado: ~55 caracteres | Concesionaria Puerto Amazonas S.A. | sí |
| `deposito_temporal_quejas_reclamos_ruc` | text | RUC del proveedor. Recomendado: ~15 caracteres | 20543480291 | sí |
| `deposito_temporal_quejas_reclamos_domicilio` | text | Domicilio del establecimiento. Recomendado: ~120 caracteres | Vía de Evitamiento Km 0.0, Caserío Santa Rosa, Yurimaguas, Alto Amazonas, Loreto | sí |
| `deposito_temporal_quejas_reclamos_codigo` | text | Código de identificación del establecimiento, si aplica. Si está vacío se oculta la fila | [PENDIENTE: código de identificación del establecimiento, si aplica] | no |
| `deposito_temporal_quejas_reclamos_nota_indecopi` | textarea | Nota legal sobre otras vías de solución. Recomendado: ~230 caracteres | La formulación del reclamo no impide acudir a otras vías de solución de controversias ni es requisito previo para interponer una denuncia ante el INDECOPI. | no |
| `deposito_temporal_quejas_reclamos_nota_plazo` | textarea | Nota legal sobre el plazo de respuesta. Recomendado: ~190 caracteres | El proveedor debe dar respuesta al reclamo o queja en un plazo no mayor a quince (15) días hábiles, el cual es improrrogable. | no |
| `deposito_temporal_quejas_reclamos_nota_copia` | text | Aviso de la copia por correo. Recomendado: ~130 caracteres | Recibirás una copia de tu hoja de reclamación en el correo electrónico que registraste. | no |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Pasa los criterios de `wp-form` (nonce, anti-spam, validación en front y en PHP, doble envío, `wp_mail`)
- [ ] Cada campo tiene su `<label>`, los obligatorios se marcan con * y los errores se asocian al campo (`aria-describedby`)
- [ ] La casilla "Soy menor de edad" muestra u oculta los campos del padre o madre y estos se exigen solo si está marcada
- [ ] El enlace de privacidad apunta a la página del tema; el botón de imprimir/descargar copia funciona sin JS externo
- [ ] El `id="quejas-y-reclamos"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: seguimiento

- **Origen:** `deposito-temporal.html` líneas 473-478 (componente `bloque-acceso.dc.html`, variante `acceso`)
- **Destino:** `template-parts/pages/deposito-temporal/seguimiento.php`, `template-parts/components/bloque-acceso.php`
- **Grupo:** `deposito_temporal_seguimiento`
- **Skill:** ninguna
- **Comportamiento:** `id="seguimiento"`; usa el componente compartido `bloque-acceso` (`titulo`, `descripcion`, `boton`, `url`, `nota`, `imagen`, `alt`) en variante `fila`. El botón "Consultar mi carga" abre el aplicativo externo en pestaña nueva con `rel` seguro y aviso para lectores de pantalla; el diseño apunta a `http://45.232.151.188:8081/consultacarga/` (HTTP sin cifrar y por IP: conviene confirmar la URL definitiva; es la misma del botón del hero). Sin `nota` en el diseño. Imagen con `object-cover`, `loading="lazy"`, alto mínimo de 528 px en escritorio. Hover del botón `#07702F` (valor suelto).
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `deposito_temporal_seguimiento_titulo` | text | Título del bloque (`h2`). Recomendado: ~30 caracteres | Seguimiento de carga | sí |
| `deposito_temporal_seguimiento_descripcion` | textarea | Frase de apoyo bajo el título. Recomendado: ~90 caracteres | Consulta el estado de tu carga dentro del recinto portuario. | no |
| `deposito_temporal_seguimiento_boton` | link | Botón del bloque: texto y destino (aplicativo externo, pestaña nueva) | Consultar mi carga | sí |
| `deposito_temporal_seguimiento_imagen` | image | Imagen del bloque (almacenes y patio del depósito temporal); se recorta para llenar la columna. Recomendado: 1800 × 1056 px (a confirmar en la etapa C), mínimo 900 px de ancho | — | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Usa el componente `bloque-acceso` con `$args` y no repite su marcado
- [ ] Imagen con `loading="lazy"` y `alt` del campo de imagen; botón por `copam_theme_link` con `rel` seguro y aviso de pestaña nueva
- [ ] El `id="seguimiento"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: faq

- **Origen:** `deposito-temporal.html` líneas 480-511; preguntas en el script (`faqs`, línea 914)
- **Destino:** `template-parts/components/faq-ayuda.php`, `template-parts/accordions/` (acordeón de `wp-accordion`)
- **Grupo:** `deposito_temporal_faq`
- **Skill:** wp-accordion
- **Comportamiento:** usa el componente compartido `faq-ayuda` (`titulo`, `descripcion`, `items`) y `encabezado-seccion` con etiqueta "Ayuda". `id="faq"` como ancla. Acordeón con `<details>`/`<summary>`; la primera pregunta abre por defecto en el diseño; icono más/menos blanco sobre círculo verde. Esta sección no lleva marcado propio: `wp-accordion` lo construye. En el diseño la FAQ se desliza sobre la sección anterior (pila con escala y desenfoque, espacio `faqHold`); se resuelve en la etapa C. Mismo bloque que `servicios-especiales` (faq).
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `deposito_temporal_faq_etiqueta` | text | Etiqueta con ícono sobre el título. Recomendado: ~10 caracteres | Ayuda | no |
| `deposito_temporal_faq_titulo` | text | Título de la sección (`h2`). Recomendado: ~30 caracteres | Preguntas frecuentes | sí |
| `deposito_temporal_faq_descripcion` | textarea | Bajada bajo el título. Recomendado: ~100 caracteres | Respuestas a las consultas más comunes sobre el depósito temporal. | no |
| `deposito_temporal_faq_items` | repeater | Preguntas y respuestas (6 en el diseño) | — | sí |
| `deposito_temporal_faq_items.pregunta` | text | Pregunta; es el texto que se toca para abrir. Recomendado: ~75 caracteres | ¿Cuántos días de almacenamiento están incluidos? | sí |
| `deposito_temporal_faq_items.respuesta` | textarea | Respuesta, sin formato. Recomendado: ~380 caracteres | Los tres primeros días de permanencia están incluidos en el servicio estándar, según el Contrato de Concesión. A partir del cuarto día, el almacenamiento se activa a solicitud del usuario y se cobra según el tarifario vigente del depósito. | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Pasa los criterios de `wp-accordion`
- [ ] Usa el componente `faq-ayuda` y las preguntas se recorren con un bucle
- [ ] El `id="faq"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: cta

- **Origen:** `deposito-temporal.html` líneas 513-533
- **Destino:** `template-parts/pages/deposito-temporal/cta.php`
- **Grupo:** `deposito_temporal_cta`
- **Skill:** ninguna
- **Comportamiento:** usa el componente compartido `cta-cotizar` (`titulo`, `bajada`, `boton`, `imagen`). Bloque a dos columnas desde 1000 px y apilado en móvil; el título entra palabra por palabra; botón "Contáctanos" con `boton` hacia el formulario de contacto (`contacto.html#formulario` pasa a la página del tema); imagen con `object-cover`, `loading="lazy"`. El texto difiere del de las páginas de servicios (aquí habla de almacenar carga), por eso se pide como campo.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `deposito_temporal_cta_titulo` | text | Título del bloque (`h2`). Se muestra en grande junto a la imagen. Recomendado: ~45 caracteres | ¿Necesitas almacenar tu carga? | sí |
| `deposito_temporal_cta_bajada` | textarea | Frase de apoyo bajo el título. Recomendado: ~110 caracteres | Coordina con nuestro equipo el ingreso de tu carga al Depósito Temporal. | no |
| `deposito_temporal_cta_boton` | link | Botón del bloque: texto y destino (formulario de contacto) | Contáctanos | sí |
| `deposito_temporal_cta_imagen` | image | Imagen del bloque (camión con contenedor en la balanza de ingreso); se recorta para llenar la columna. Recomendado: 1800 × 760 px (aprox. 2.35:1, a confirmar en la etapa C), mínimo 900 px de ancho | — | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Usa el componente `cta-cotizar`; la imagen pasa por `copam_theme_image` y el botón por `copam_theme_link`
- [ ] Imagen con `loading="lazy"` y proporción fija
