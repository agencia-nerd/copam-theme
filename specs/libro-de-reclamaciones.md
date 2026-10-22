# Página: Libro de Reclamaciones

- **Resumen:** Libro de Reclamaciones virtual de COPAM exigido por el Código de Protección y Defensa del Consumidor; el visitante llena la hoja de reclamación (reclamo o queja) y la envía a la empresa.
- **Fuente:** `libro-de-reclamaciones.html`
- **Plantilla:** `pages/template-libro-de-reclamaciones.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, formulario
- **Skills usadas:** wp-form (formulario)
- **Grupo ACF:** Libro de Reclamaciones
- **Ubicación:** plantilla pages/template-libro-de-reclamaciones.php
- **Notas de página:**
  - `h1` "Libro de Reclamaciones" en el hero
  - título SEO "Libro de Reclamaciones · COPAM"
  - meta descripción del diseño "Concesionaria Puerto Amazonas S.A. · Terminal Portuario de Yurimaguas – Nueva Reforma." (genérica, la misma de otras páginas
  - conviene una propia)
  - Se ignora el `noindex` del diseño
  - Migas "Inicio > Reclamos > Libro de Reclamaciones" (Reclamos enlaza a la página de reclamos del tema)
  - Los enlaces `reclamos.html`, `reclamos.html#formulario` y `privacidad.html` apuntan a las páginas del tema
  - Destinatario del formulario: `comercial@copam.com.pe` (pie del formulario del diseño
  - a confirmar con el cliente, porque un libro de reclamaciones suele ir a un correo de atención al usuario)
  - Los datos del proveedor (razón social, RUC, dirección) pueden venir de `opciones` si ya existen allí
  - aquí se dejan como campos propios hasta confirmarlo
  - Página hermana `reclamos` (procedimiento OSITRAN): es otro formulario con campos distintos (tipo Reclamo/Reconsideración/Apelación, poder de representación, adjuntos)
  - solo comparten los componentes `migas` y `boton` y el patrón de campos de identificación, sin campos ACF en común (la spec `reclamos` aún está vacía)
- **Estado:** pendiente

## Sección: hero

- **Origen:** `libro-de-reclamaciones.html` líneas 159-206
- **Destino:** `template-parts/pages/libro-de-reclamaciones/hero.php`
- **Grupo:** `libro_de_reclamaciones_hero`
- **Skill:** ninguna
- **Comportamiento:** migas con el componente `migas` (Inicio > Reclamos > Libro de Reclamaciones; los textos de las migas no son campos). `h1` con el título y la bajada debajo. Botón `boton` (variante primaria, texto deslizante) que baja al ancla `#formulario`; el texto es un campo `text` aparte y el destino es fijo. A la derecha (debajo en móvil) una tarjeta "Accesos directos" con `h2` y una lista de 3 enlaces con flecha de esquina que se desplaza al hover y cambia a verde (`#0B8A3E`); cada enlace pasa por `copam_theme_link` y puede usar `enlace-flecha`. Destinos del diseño: `#formulario` (Hoja de reclamación), la página de reclamos con `#formulario` (Formulario de reclamos OSITRAN) y la página de reclamos (Cómo reclamar). Sin imágenes.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `libro_de_reclamaciones_hero_titulo` | text | Título principal de la página (h1). Se muestra grande en la parte superior. Recomendado: ~35 caracteres | Libro de Reclamaciones | sí |
| `libro_de_reclamaciones_hero_bajada` | textarea | Texto legal bajo el título. Recomendado: ~230 caracteres | Conforme a lo establecido en el Código de Protección y Defensa del Consumidor, contamos con un Libro de Reclamaciones virtual a tu disposición. | sí |
| `libro_de_reclamaciones_hero_boton_texto` | text | Texto del botón que baja a la hoja de reclamación. Recomendado: ~40 caracteres | Llenar hoja de reclamación | sí |
| `libro_de_reclamaciones_hero_accesos_titulo` | text | Título de la tarjeta de accesos directos (h2). Recomendado: ~25 caracteres | Accesos directos | sí |
| `libro_de_reclamaciones_hero_accesos` | repeater | Enlaces de la tarjeta de accesos directos. Son 3 ítems | — | sí |
| `libro_de_reclamaciones_hero_accesos.enlace` | link | Texto y destino del acceso. Texto recomendado: ~45 caracteres | Hoja de reclamación | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Las migas usan `<nav aria-label="Migas de pan">` y el último ítem no es enlace
- [ ] El botón y el primer acceso llevan a `#formulario`; los otros dos, a la página de reclamos del tema
- [ ] Los accesos pasan por `copam_theme_link` y la flecha respeta `prefers-reduced-motion`

## Sección: formulario

- **Origen:** `libro-de-reclamaciones.html` líneas 208-362
- **Destino:** `template-parts/forms/libro-de-reclamaciones.php`, `template-parts/pages/libro-de-reclamaciones/formulario.php`
- **Grupo:** `libro_de_reclamaciones_formulario`
- **Skill:** wp-form
- **Comportamiento:** `id="formulario"`. Título (h2) con línea (`titulo-linea` o `encabezado-seccion`) y nota de campos obligatorios. Aviso con enlace al formulario de reclamos del procedimiento OSITRAN (página de reclamos, ancla `#formulario`; pasa por el helper de enlaces). El formulario lo construye `wp-form`; sin marcado propio. Estructura de la hoja, en 2 columnas desde 760 px y 1 en móvil, con separadores y subtítulos numerados. Fecha: solo lectura, fecha de hoy `dd-mm-aaaa`, la fija el servidor al enviar. 1. Datos del proveedor: solo lectura, texto fijo desde los campos de abajo (Razón social, RUC, Dirección a ancho completo). 2. Identificación del consumidor reclamante: Nombres y apellidos (texto, requerido, mínimo 3, solo letras; "Ingresa tu nombre completo", ancho completo); Tipo de documento (selector requerido, "Selecciona" deshabilitada; DNI, Carné de extranjería, Pasaporte, RUC; el diseño usa DNI por defecto en su lógica); Número de documento (texto requerido cuyas reglas cambian con el tipo: DNI 8 dígitos "Ej. 45678912", Carné de extranjería 6 a 12 alfanuméricos "Ej. 001234567", Pasaporte 6 a 12 alfanuméricos "Ej. AB1234567", RUC 11 dígitos "Ej. 20543480291"; PHP valida la misma regla según el tipo); Domicilio (requerido, "Dirección completa", ancho completo); Teléfono (tel, requerido, números + ( ) espacio y guion, de 7 a 20; "Ej. 987 654 321"); Correo electrónico (email, requerido, formato válido; "nombre@empresa.com"). Casilla "Soy menor de edad": al marcarla se despliega con transición (respeta `prefers-reduced-motion`) un bloque con Nombre del padre, madre o apoderado (requerido, mínimo 3, solo letras; "Nombre completo") y Número de documento del padre, madre o apoderado (requerido, 8 a 12 dígitos; "DNI o CE"); solo se exigen y validan con la casilla marcada. 3. Identificación del bien contratado: Tipo (radio requerido, Producto o Servicio, sin valor por defecto, error "Selecciona una opción."); Monto reclamado (S/) (opcional, números con hasta 2 decimales, coma o punto, máximo 12 caracteres; "Ej. 250.00"); Descripción (textarea requerido, mínimo 10, 2 filas; "Describe el producto o servicio contratado"). 4. Detalle de la reclamación y pedido del consumidor: Tipo (radio requerido: Reclamo con la ayuda "Disconformidad relacionada a los productos o servicios." o Queja con la ayuda "Disconformidad no relacionada a los productos o servicios, o malestar o descontento respecto a la atención al público."; sin valor por defecto); Detalle (textarea requerido, mínimo 10, 4 filas; "Describe lo ocurrido"); Pedido (textarea requerido, mínimo 10, 2 filas; "Indica qué solicitas"). Las opciones de radio son tarjetas con borde `#DADADA` y, al elegir, fondo `#F0F8F3` y borde `#0B8A3E`. 5. Observaciones y acciones adoptadas por el proveedor: solo un texto fijo (lo completa COPAM al responder; no es campo del formulario). Casilla requerida "Declaro que la información proporcionada es verdadera y acepto la Política de privacidad." con enlace a la página de privacidad del tema. Verificación anti-robot "No soy un robot": el diseño deja un marcador de reCAPTCHA o Cloudflare Turnstile; lo define el anti-spam de `wp-form` (a confirmar con el usuario cuál). Validación al salir del campo y al escribir, con mensajes bajo el campo (`role="alert"`) y colores `--color-danger`. Botón "Enviar hoja de reclamación". Destinatario: `comercial@copam.com.pe`; el pie del formulario lo muestra como enlace `mailto:` ("El formulario se envía a" + correo; el correo se imprime aparte y sale de la configuración del formulario). Por ser un documento legal se propone guardar cada envío (opción de `wp-form`) y numerarlo en el correo; el diseño no muestra ni pide número de reclamo (a confirmar). Éxito: el formulario se reemplaza por un aviso con ícono de verificación (`role="status"`) con el texto de `mensaje_exito`. Al pie, dos notas legales. Valores sueltos: hover del botón `#07702F`, fondo de opción activa `#F0F8F3`, borde inactivo `#DADADA`.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `libro_de_reclamaciones_formulario_titulo` | text | Título de la sección (h2). Recomendado: ~30 caracteres | Hoja de reclamación | sí |
| `libro_de_reclamaciones_formulario_nota_obligatorios` | text | Nota bajo el título sobre los campos con asterisco. Recomendado: ~55 caracteres | Los campos con * son obligatorios. | no |
| `libro_de_reclamaciones_formulario_aviso_ositran` | textarea | Aviso antes del formulario. Va antes del enlace, que se imprime aparte con el campo siguiente. Recomendado: ~230 caracteres | Si tu reclamo se refiere a la prestación de servicios portuarios (servicios a la nave, a la carga o al pasajero), también puedes presentarlo mediante el | no |
| `libro_de_reclamaciones_formulario_aviso_enlace` | link | Enlace del aviso hacia el formulario de reclamos de OSITRAN (página de reclamos, ancla `#formulario`). Texto recomendado: ~70 caracteres | Formulario de reclamos del procedimiento OSITRAN | no |
| `libro_de_reclamaciones_formulario_proveedor_razon_social` | text | Razón social que aparece como dato fijo del proveedor en la hoja. Recomendado: ~55 caracteres | Concesionaria Puerto Amazonas S.A. | sí |
| `libro_de_reclamaciones_formulario_proveedor_ruc` | text | RUC del proveedor que aparece en la hoja. Recomendado: ~15 caracteres | 20543480291 | sí |
| `libro_de_reclamaciones_formulario_proveedor_direccion` | text | Dirección del proveedor que aparece en la hoja. Recomendado: ~130 caracteres | Vía de Evitamiento Km 0.0, Caserío Santa Rosa, Yurimaguas, Alto Amazonas, Loreto | sí |
| `libro_de_reclamaciones_formulario_nota_observaciones` | text | Texto de la parte 5 de la hoja, que COPAM completa al responder. Recomendado: ~120 caracteres | Este espacio será completado por COPAM al dar respuesta a tu reclamo o queja. | no |
| `libro_de_reclamaciones_formulario_nota_envio` | text | Aviso bajo el formulario que indica a dónde se envía. Va antes del correo, que se imprime aparte. Recomendado: ~40 caracteres | El formulario se envía a | no |
| `libro_de_reclamaciones_formulario_mensaje_exito` | textarea | Mensaje que reemplaza el formulario cuando el envío fue correcto. Recomendado: ~230 caracteres | Tu hoja de reclamación fue enviada correctamente. COPAM dará respuesta a tu reclamo o queja en un plazo no mayor a quince (15) días hábiles. | sí |
| `libro_de_reclamaciones_formulario_nota_legal_indecopi` | textarea | Primera nota legal al pie de la sección. Recomendado: ~240 caracteres | La formulación del reclamo no impide acudir a otras vías de solución de controversias ni es requisito previo para interponer una denuncia ante el INDECOPI. | sí |
| `libro_de_reclamaciones_formulario_nota_legal_plazo` | textarea | Segunda nota legal al pie de la sección, con el plazo de respuesta. Recomendado: ~180 caracteres | El proveedor deberá dar respuesta al reclamo o queja en un plazo no mayor a quince (15) días hábiles improrrogables. | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Pasa los criterios de `wp-form` (`references/acceptance.md` de esa skill)
- [ ] Cada campo tiene `label`, validación igual en el front y en PHP, y el mensaje de error se anuncia con `role="alert"`
- [ ] Las reglas del número de documento cambian con el tipo en el front y se validan igual en PHP
- [ ] Los campos del apoderado solo se exigen con "Soy menor de edad" marcado
- [ ] Los radios de bien contratado y de tipo son grupos accesibles (`fieldset`/`legend` o `role="radiogroup"`) y navegables con teclado
- [ ] La sección tiene `id="formulario"` y el mensaje de éxito se anuncia con `role="status"`
