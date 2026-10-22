# Página: Contacto

- **Resumen:** Reúne los canales de atención de COPAM por área, los datos de la empresa, un formulario de contacto y un buzón de sugerencias. El visitante elige el canal que corresponde o escribe directamente.
- **Fuente:** `contacto.html`
- **Plantilla:** `pages/template-contacto.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, canales, datos, formulario, buzon
- **Skills usadas:** wp-form (formulario, buzon), wp-helper
- **Grupo ACF:** Contacto
- **Ubicación:** plantilla pages/template-contacto.php
- **Notas de página:**
  - `h1` "Contacto" en el hero
  - título SEO "Contacto · COPAM"
  - meta descripción del diseño "Concesionaria Puerto Amazonas S.A. · Terminal Portuario de Yurimaguas – Nueva Reforma." (se ignora el `noindex`, es solo de la maqueta)
  - Anclas internas `#canales`, `#datos`, `#formulario`, `#buzon`: `#canales` existe (lo enlaza `comunicado.html`) y `scroll-margin-top` debe compensar el header fijo
  - Los títulos de las secciones 2 a 5 usan el componente `encabezado-seccion` (h2 sin etiqueta ni bajada, con línea animada) y los botones el componente `boton`
  - las migas usan `migas`
  - Elementos fuera de la página: header, footer, buscador y aviso de mantenimiento (sitio)
  - Pendientes del diseño: el correo de Operaciones aparece como `[PENDIENTE: correo de Operaciones]` y el reCAPTCHA/Turnstile como `[PENDIENTE: ...]`
  - ninguno de los dos textos se imprime tal cual, se resuelven al aplicar
- **Estado:** pendiente

## Sección: hero

- **Origen:** `contacto.html` líneas 158-209
- **Destino:** `template-parts/pages/contacto/hero.php`
- **Grupo:** `contacto_hero`
- **Skill:** ninguna
- **Comportamiento:** migas "Inicio > Contacto" con el componente `migas`. Imagen a todo el ancho con alto `max(310px, min(36vw, 100svh - 426px))`, `object-cover` con `object-position: 100% 58%`; es la imagen principal de la página (`'loading' => 'eager'`). En escritorio el texto va a la izquierda y la tarjeta "Accesos directos" (7 enlaces) a la derecha, sobre la imagen, ancho 33.3vw; en móvil la tarjeta pasa debajo del texto en una sola columna. El botón "Escríbenos" usa el componente `boton` y baja al formulario (`#formulario`). En "Accesos directos" cada fila lleva el texto y una flecha de esquina que se desliza al hover; los enlaces externos (Seguimiento de carga) abren en pestaña nueva con el helper de enlaces. Los enlaces internos apuntan a las páginas del tema (reclamos, libro de reclamaciones, tarifario, canal de hostigamiento sexual) o a las anclas `#formulario` y `#buzon`. Animaciones de entrada (clip de la imagen, subida del título, tarjeta desde abajo) se reescriben como módulo JS y respetan `prefers-reduced-motion`.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `contacto_hero_imagen` | image | Foto de portada de la página. Se recorta para llenar el bloque a todo el ancho. Recomendado: 3840 × 1380 px (≈ 2.8:1), mínimo 1920 px de ancho | — | sí |
| `contacto_hero_titulo` | text | Título principal de la página (h1). Se muestra en grande a la izquierda. Recomendado: ~15 caracteres | Contacto | sí |
| `contacto_hero_bajada` | textarea | Texto bajo el título que explica qué hacer en la página. Recomendado: ~180 caracteres | Cada consulta tiene un canal directo. Elige el área que corresponde o escríbenos mediante el formulario de contacto. | sí |
| `contacto_hero_boton` | link | Botón principal: texto y destino. Baja al formulario. | Escríbenos | no |
| `contacto_hero_accesos_titulo` | text | Título de la tarjeta lateral de accesos directos. Recomendado: ~25 caracteres | Accesos directos | sí |
| `contacto_hero_accesos` | repeater | Lista de enlaces de la tarjeta lateral. 7 enlaces. | — | sí |
| `contacto_hero_accesos.enlace` | link | Texto y destino del acceso directo. El texto es el primero de la lista: "Formulario de contacto". Los externos abren en pestaña nueva. Recomendado: ~35 caracteres | Formulario de contacto | sí |

Valores del repetidor (texto y destino en el diseño): Formulario de contacto (`#formulario`), Buzón de sugerencias (`#buzon`), Presentar un reclamo (reclamos, ancla `#formulario`), Libro de Reclamaciones virtual (reclamos, ancla `#formulario`; a confirmar si debe ir a `libro-de-reclamaciones`), Seguimiento de carga (externo `http://45.232.151.188:8081/consultacarga/`), Tarifario (tarifario), Canal de hostigamiento sexual (canal-hostigamiento-sexual).

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Imagen con `width`/`height` o `aspect-ratio` y `loading="eager"` por ser la principal
- [ ] Enlaces con destinos reales; los externos con `rel` seguro y aviso de pestaña nueva (helper de enlaces de `wp-helper`)
- [ ] Migas y botón usan los componentes `migas` y `boton`, sin duplicar su marcado
- [ ] La tarjeta de accesos directos se apila bajo el texto en móvil y es navegable con teclado

## Sección: canales

- **Origen:** `contacto.html` líneas 211-232
- **Destino:** `template-parts/pages/contacto/canales.php`
- **Grupo:** `contacto_canales`
- **Skill:** ninguna
- **Comportamiento:** sección con `id="canales"` (ancla que enlazan otras páginas, por ejemplo `comunicado.html`). Título con el componente `encabezado-seccion`. Tarjetas en rejilla de 3 columnas desde 1180 px, 2 desde 600 px y 1 en móvil, con aparición escalonada. Cada tarjeta: título, descripción (varias líneas: los saltos de línea se respetan) y un botón opcional del componente `boton` con flecha; la tarjeta sin botón no lo imprime. El botón "Enviar consulta" de Comercial baja al formulario y preselecciona el área "Comercial" en el selector (módulo JS por `data-`). El botón de Operaciones es un enlace `tel:`. Alto de tarjeta flexible, sin altura fija.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `contacto_canales_titulo` | text | Título de la sección (h2). Recomendado: ~30 caracteres | Canales de atención | sí |
| `contacto_canales_items` | repeater | Tarjetas de canales, una por área. 3 tarjetas. | — | sí |
| `contacto_canales_items.titulo` | text | Nombre del área. Se muestra como título de la tarjeta. Recomendado: ~25 caracteres | Atención al usuario | sí |
| `contacto_canales_items.descripcion` | textarea | Qué atiende el área y sus datos de contacto (correo, teléfono, dirección), una línea por dato. Recomendado: ~190 caracteres | Reclamos, reconsideraciones y consultas sobre el servicio.<br>servicioclientes@copam.com.pe · Tel. (01) 500-0450 | sí |
| `contacto_canales_items.boton` | link | Botón de la tarjeta: texto y destino. Si está vacío la tarjeta no muestra botón. Recomendado: ~25 caracteres | Ir a reclamos | no |

Valores de las otras dos tarjetas: Operaciones, "Coordinación de naves, embarque, descarga y contingencias. Atención operativa las 24 horas." + línea de correo y teléfono "(01) 500-0450" (correo pendiente en el diseño), botón "Llamar a operaciones" a `tel:015000450`. Comercial, "Cotizaciones, nuevos servicios y acuerdos comerciales, con un ejecutivo según el tipo de carga." + "comercial@copam.com.pe · Tel. (+511) 500-2670" + "Av. Javier Prado Este 4135, Piso 7, Santiago de Surco, Lima", botón "Enviar consulta" a `#formulario`. En la descripción de la primera tarjeta, `<br>` indica salto de línea.

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] La sección tiene `id="canales"` y el enlace `contacto#canales` de `comunicado` llega a ella sin quedar tapada por el header
- [ ] Destinos reales; el enlace `tel:` y los externos pasan por el helper de enlaces
- [ ] Título y botones usan `encabezado-seccion` y `boton`
- [ ] El botón "Enviar consulta" baja al formulario y deja el área "Comercial" seleccionada
- [ ] El JS vive en `src/js/modules/`, funciona con teclado y respeta `prefers-reduced-motion`

## Sección: datos

- **Origen:** `contacto.html` líneas 234-254
- **Destino:** `template-parts/pages/contacto/datos.php`
- **Grupo:** `contacto_datos`
- **Skill:** ninguna
- **Comportamiento:** `id="datos"`. Título con `encabezado-seccion`. Tabla de dos columnas (etiqueta gris a la izquierda, valor a la derecha; en móvil apiladas) con líneas separadoras entre filas. Una fila sin valor es un subtítulo de grupo ("Sedes", "Datos de la empresa"): fondo gris `#F6F6F6`, texto en negrita y color `#2B2B2B`. Marcado semántico de lista de definición o tabla con encabezados. Valores sueltos: `#F6F6F6`, `#7A7A7A` (etiqueta), tamaños `clamp(14px,.85vw,16px)` y `clamp(15px,.9vw,17px)`. Alto flexible.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `contacto_datos_titulo` | text | Título de la sección (h2). Recomendado: ~30 caracteres | Datos de contacto | sí |
| `contacto_datos_filas` | repeater | Filas de la tabla de datos. 8 filas; las que no tienen valor se muestran como subtítulo de grupo. | — | sí |
| `contacto_datos_filas.etiqueta` | text | Nombre del dato o del grupo. Recomendado: ~30 caracteres | Sedes | sí |
| `contacto_datos_filas.valor` | textarea | Valor del dato. Déjalo vacío para que la fila sea un subtítulo de grupo. Recomendado: ~170 caracteres | — | no |

Filas del diseño (etiqueta / valor): Sedes (grupo); Terminal portuario / "Vía de Evitamiento Km 0, Caserío Santa Rosa (río Huallaga), Yurimaguas, Loreto · Tel. (01) 500-0450"; Oficina Lima / "Av. Javier Prado Este 4135, Piso 7, Santiago de Surco, Lima · Tel. (+511) 500-2670"; Datos de la empresa (grupo); Razón social / "Concesionaria Puerto Amazonas S.A."; RUC / "20543480291"; Correo de atención / "servicioclientes@copam.com.pe"; Horario de atención / "Administrativo: Lun–Vie 08:00–17:00 h · Sáb 08:00–13:00 h · Operativo: 24 horas". La primera fila ("Sedes") es el valor actual del subcampo `etiqueta`.

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Las filas sin valor se ven como subtítulo de grupo y las demás como pares etiqueta/valor
- [ ] La sección tiene `id="datos"` y el título usa `encabezado-seccion`

## Sección: formulario

- **Origen:** `contacto.html` líneas 256-308
- **Destino:** `template-parts/forms/contacto.php`, `template-parts/pages/contacto/formulario.php`
- **Grupo:** `contacto_formulario`
- **Skill:** wp-form
- **Comportamiento:** `id="formulario"`. Título con `encabezado-seccion`. El formulario lo construye `wp-form`; sin marcado propio. Campos: Nombre y apellidos (texto, requerido, mínimo 3, solo letras; placeholder "Ingresa tu nombre completo"), Correo electrónico (email, requerido, formato válido; "nombre@empresa.com"), Teléfono (tel, requerido, solo números, + ( ) espacio y guion, de 7 a 20 caracteres; "Ej. 987 654 321"), Área (selector requerido con "Selecciona un área" deshabilitada y opciones Atención al usuario, Operaciones, Comercial; se puede preseleccionar desde la tarjeta Comercial de `canales`), Mensaje (textarea, requerido, mínimo 10, 5 filas; "Cuéntanos tu consulta"). Casilla requerida "Acepto la Política de privacidad y el tratamiento de mis datos personales." con enlace a la página de privacidad del tema. Verificación anti-robot "No soy un robot": el diseño deja un marcador de reCAPTCHA o Cloudflare Turnstile; lo define el anti-spam de `wp-form` (a confirmar con el usuario cuál). Campos en 2 columnas desde 760 px, 1 en móvil; Mensaje a ancho completo. Validación al salir del campo y al escribir, con mensajes bajo el campo (`role="alert"`) y colores `--color-danger`. Destinatario: `comercial@copam.com.pe` (README del diseño). Envío: el botón pasa a "Mensaje enviado" y el formulario confirma el envío; el diseño no trae un mensaje de éxito más largo, se propone "Gracias. Tu mensaje fue enviado; te responderemos pronto." (a confirmar). Valor suelto: hover del botón `#07702F`.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `contacto_formulario_titulo` | text | Título de la sección (h2). Recomendado: ~35 caracteres | Formulario de contacto | sí |
| `contacto_formulario_nota_envio` | text | Aviso bajo el formulario que indica a dónde se envía. Va antes del correo, que se imprime aparte. Recomendado: ~45 caracteres | El formulario se envía a | no |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Pasa los criterios de `wp-form` (`references/acceptance.md` de esa skill)
- [ ] Cada campo tiene `label`, validación igual en el front y en PHP, y el mensaje de error se anuncia con `role="alert"`
- [ ] El envío llega a los correos de `opciones_correos_contacto` (Ajustes del sitio) y muestra el estado "Mensaje enviado"
- [ ] El anti-spam elegido reemplaza al marcador `[PENDIENTE]` del diseño y este texto no se imprime
- [ ] La sección tiene `id="formulario"` y el título usa `encabezado-seccion`

## Sección: buzon

- **Origen:** `contacto.html` líneas 310-397
- **Destino:** `template-parts/forms/buzon-sugerencias.php`, `template-parts/pages/contacto/buzon.php`
- **Grupo:** `contacto_buzon`
- **Skill:** wp-form
- **Comportamiento:** `id="buzon"`. Título con `encabezado-seccion`. Dos columnas desde 1000 px (texto 0.9fr, formulario 1.6fr), una en móvil. Columna izquierda: subtítulo (h3), bajada, lista de 3 puntos con viñeta verde y un aviso con enlace "Presentar un reclamo" (flecha que se desplaza 4px al hover) que lleva a la página de reclamos, ancla `#formulario`; el enlace pasa por el helper. Columna derecha: formulario hecho por `wp-form`, sin marcado propio. Campos: "¿Quién envía la sugerencia?" (radio: Usuario o persona externa, por defecto; Trabajador de COPAM), "Área (opcional)" (texto, solo letras, mínimo 3; solo aparece si se elige Trabajador de COPAM, junto con la nota "Tu participación es parte de la consulta a los trabajadores de nuestro Sistema Integrado de Gestión."), "¿Qué quieres compartir?" (radio: Sugerencia por defecto, Consulta, Felicitación, Otro), Mensaje (textarea requerido, mínimo 10; el placeholder cambia con el tipo: "Escribe aquí tu sugerencia", "Escribe aquí tu consulta", "Escribe aquí tu felicitación", "Escribe aquí tu mensaje"), Nombre (opcional, "Tu nombre") y Correo electrónico (opcional, formato válido; "nombre@empresa.com") en 2 columnas desde 760 px, con la nota "Déjalo en blanco si prefieres enviarla de forma anónima.". Casilla requerida de privacidad (igual que el formulario de contacto) y anti-robot por `wp-form`. Botón "Enviar sugerencia". Éxito: "Gracias. Tu mensaje fue registrado y será revisado por el Coordinador del SIG." (`role="status"`). Destinatario: `comercial@copam.com.pe` (el diseño lo indica en el pie del formulario; a confirmar si el buzón debería ir a otro correo). Valores sueltos: fondo de opción activa `#F0F8F3`, borde inactivo `#DADADA`, hover del botón `#07702F`.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `contacto_buzon_titulo` | text | Título de la sección (h2). Recomendado: ~35 caracteres | Buzón de sugerencias | sí |
| `contacto_buzon_subtitulo` | text | Frase destacada sobre el formulario (h3). Recomendado: ~50 caracteres | Tu opinión nos ayuda a mejorar | sí |
| `contacto_buzon_bajada` | textarea | Texto que explica para qué sirve el buzón. Recomendado: ~170 caracteres | Comparte una sugerencia, una felicitación o una idea para mejorar nuestros servicios y la atención en el terminal. | sí |
| `contacto_buzon_puntos` | repeater | Lista de condiciones del buzón. 3 puntos. | — | sí |
| `contacto_buzon_puntos.texto` | text | Una condición del buzón, con viñeta verde. Recomendado: ~75 caracteres | Puedes enviarla de forma anónima. | sí |
| `contacto_buzon_aviso_titulo` | text | Título del aviso que deriva a reclamos. Recomendado: ~45 caracteres | ¿Tienes un problema con un servicio? | no |
| `contacto_buzon_aviso_texto` | textarea | Texto del aviso. Recomendado: ~140 caracteres | El buzón no reemplaza al reclamo. Si necesitas una respuesta formal en plazo, presenta un reclamo. | no |
| `contacto_buzon_aviso_enlace` | link | Enlace del aviso: texto y destino (página de reclamos). | Presentar un reclamo | no |
| `contacto_buzon_exito` | text | Mensaje que se muestra tras enviar la sugerencia. Recomendado: ~90 caracteres | Gracias. Tu mensaje fue registrado y será revisado por el Coordinador del SIG. | sí |

Valores del repetidor `contacto_buzon_puntos`: "Puedes enviarla de forma anónima.", "Si quieres una respuesta, déjanos tu correo.", "Las sugerencias las revisa el Coordinador del Sistema Integrado de Gestión.".

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Pasa los criterios de `wp-form` (`references/acceptance.md` de esa skill)
- [ ] Los grupos de opciones son `radio` reales con `fieldset`/`legend` o `role="radiogroup"` y se manejan con teclado
- [ ] El campo "Área (opcional)" solo aparece al elegir "Trabajador de COPAM"; el placeholder del mensaje cambia con el tipo
- [ ] Nombre y correo son opcionales; con ambos vacíos el envío es anónimo y se acepta
- [ ] El enlace "Presentar un reclamo" apunta a la página del tema y pasa por el helper de enlaces
- [ ] La sección tiene `id="buzon"` y el título usa `encabezado-seccion`
