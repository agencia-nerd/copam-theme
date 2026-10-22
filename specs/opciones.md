# Página: Ajustes del sitio

- **Resumen:** contenido que se repite en todas las páginas: el aviso de mantenimiento de la barra superior y los datos fijos del pie. Lo edita el cliente en una sola página de opciones.
- **Fuente:** `src/components/navbar.html`, `src/components/footer.html`
- **Plantilla:** `header.php`
- **Tipo:** global
- **Contenido:** ninguno
- **Secciones (en orden):** aviso, pie, correos
- **Skills usadas:** ninguna
- **Grupo ACF:** Ajustes del sitio
- **Ubicación:** página de opciones: Ajustes del sitio
- **Notas de página:**
  - el logo principal y el ícono del sitio van en Personalizar > Identidad del sitio; mientras tanto el logo es `assets/img/logo-copam.svg`, fijo en `header.php` y `footer.php` (el pie repite el mismo logo en grande y no necesita campo)
  - los menús son ubicaciones de Apariencia > Menús (`principal`, `pie`, `legal`; ver `_shared.md`); mientras tanto salen de `inc/sitio.php` con los enlaces del diseño apuntando a las páginas del tema
  - el buscador del header es un módulo JS (`src/js/modules/header.js`) que filtra el índice fijo de `inc/sitio.php`; se decide después de qué fuente busca de verdad
  - la cabecera (barra, menú por grupos, menú móvil y buscador) vive en `header.php`; el fondo de agua del pie es `src/js/modules/ocean.js`
  - valores sueltos de la cabecera y el pie sin token: fondo oscuro de la barra `rgba(20,24,26,.58)`, borde de subtítulos `#3E3E3E` (escritorio) y `#E6E6E6` (móvil), y las pastillas por tipo del buscador (Documento, Reglamento, Servicio, Comunicado, Página)
  - el aviso se muestra como franja bajo la barra en móvil y como aviso flotante abajo a la izquierda desde 760 px; su cierre se recuerda en `sessionStorage`
  - se ignora el `noindex` del diseño
  - efectos de todo el sitio, como módulos JS: precarga con el logo (`precarga.js`, solo la primera vez de la sesión), scroll suave con anclas animadas (`scroll.js`) y cursor personalizado (`cursor.js`); los tres se desactivan con `prefers-reduced-motion` y en pantallas táctiles según corresponda
  - la transición de cortina entre páginas no se implementó: el diseño define `navCurtain` en `copam-shared.js` pero ningún enlace la usa
  - los números de teléfono y el correo de `contacto` pueden leerse de aquí al aplicar (`opciones_pie_telefono`, `opciones_pie_correo`)
- **Estado:** aplicado

## Sección: aviso

- **Origen:** `src/components/navbar.html` líneas 84-85
- **Destino:** `template-parts/components/aviso-superior.php`
- **Grupo:** `opciones_aviso`
- **Skill:** ninguna
- **Comportamiento:** aviso corto de mantenimiento (punto de color, título y detalle) bajo la barra superior. Se muestra solo si está activo; el texto no desborda en móvil y se anuncia con `role="status"`.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `opciones_aviso_activo` | true_false | Activa o desactiva el aviso en todo el sitio | sí | no |
| `opciones_aviso_titulo` | text | Título del aviso. Recomendado: ~20 caracteres | Mantenimiento | sí |
| `opciones_aviso_detalle` | text | Fecha, horario y sistema afectado. Recomendado: ~60 caracteres | Sáb 27 set · 22:00–02:00 · Portal de clientes | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El aviso se oculta si no está activo

## Sección: pie

- **Origen:** `src/components/footer.html` líneas 10-45
- **Destino:** `footer.php`
- **Grupo:** `opciones_pie`
- **Skill:** wp-helper
- **Comportamiento:** descripción, teléfono y correo en la primera columna; las demás columnas de enlaces salen del menú `pie` y los tres enlaces legales del menú `legal`; línea inferior con el copyright. El logo viene de Identidad del sitio. El teléfono es un enlace `tel:` con los dígitos y el correo un `mailto:`, ambos por `copam_theme_link`.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `opciones_pie_descripcion` | text | Frase bajo la marca. Recomendado: ~60 caracteres | Terminal Portuario de Yurimaguas – Nueva Reforma. | no |
| `opciones_pie_telefono` | text | Número visible; el enlace `tel:` se arma con los dígitos | (01) 500-0450 | sí |
| `opciones_pie_correo` | email | Correo de atención al cliente | servicioclientes@copam.com.pe | sí |
| `opciones_pie_copyright` | text | Línea legal. Recomendado: ~80 caracteres | © 2026 Concesionaria Puerto Amazonas S.A. · RUC 20543480291 | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Teléfono y correo son enlaces `tel:` y `mailto:` reales
- [x] El logo del pie tiene `alt`

## Sección: correos

- **Origen:** `README.md` del diseño (destinos de los formularios) y los formularios de `contacto`, `transparencia`, `reclamos`, `libro-de-reclamaciones`, `canal-hostigamiento-sexual` y `deposito-temporal`
- **Destino:** `inc/acf/seed/opciones.php`
- **Grupo:** `opciones_correos`
- **Skill:** wp-form
- **Comportamiento:** los destinatarios los lee `wp-form` y no se imprimen en una vista, salvo donde la página muestre el correo bajo el formulario. Cada formulario del sitio envía a los correos de su propio repetidor, así el cliente cambia o añade destinatarios sin tocar código (se admite más de un correo por formulario). Las páginas con formulario no tienen campo de correo propio: leen el repetidor que les corresponde y, donde el diseño muestra el correo bajo el formulario, imprimen el primero. El del Canal de hostigamiento es confidencial y nunca se mezcla con otro.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `opciones_correos_contacto` | repeater | Destinatarios del formulario de Contacto. Añade una fila por correo | — | sí |
| `opciones_correos_contacto.correo` | email | Destinatarios del formulario de Contacto. Añade una fila por correo | comercial@copam.com.pe | sí |
| `opciones_correos_buzon` | repeater | Destinatarios del Buzón de sugerencias (página Contacto). Añade una fila por correo | — | sí |
| `opciones_correos_buzon.correo` | email | Destinatarios del Buzón de sugerencias (página Contacto) | comercial@copam.com.pe | sí |
| `opciones_correos_transparencia` | repeater | Destinatarios de la solicitud de acceso a la información. Añade una fila por correo | — | sí |
| `opciones_correos_transparencia.correo` | email | Destinatarios de la solicitud de acceso a la información | comercial@copam.com.pe | sí |
| `opciones_correos_reclamos` | repeater | Destinatarios del formulario de Reclamos. Por confirmar con el cliente. Añade una fila por correo | — | sí |
| `opciones_correos_reclamos.correo` | email | Destinatarios del formulario de Reclamos. Por confirmar con el cliente | comercial@copam.com.pe | sí |
| `opciones_correos_libro` | repeater | Destinatarios del Libro de Reclamaciones virtual. Por confirmar con el cliente. Añade una fila por correo | — | sí |
| `opciones_correos_libro.correo` | email | Destinatarios del Libro de Reclamaciones virtual. Por confirmar con el cliente | comercial@copam.com.pe | sí |
| `opciones_correos_deposito` | repeater | Destinatarios de quejas y reclamos del Depósito Temporal. Añade una fila por correo | — | sí |
| `opciones_correos_deposito.correo` | email | Destinatarios de quejas y reclamos del Depósito Temporal | comercial@copam.com.pe | sí |
| `opciones_correos_hostigamiento` | repeater | Destinatarios del Canal de hostigamiento sexual (Delegado). Confidencial: solo estos correos reciben el reporte. Añade una fila por correo | — | sí |
| `opciones_correos_hostigamiento.correo` | email | Destinatarios del Canal de hostigamiento sexual (Delegado). Confidencial: solo estos correos reciben el reporte | denuncia.hostigamiento.s@gmail.com | sí |
| `opciones_correos_operaciones` | repeater | Correo del área de Operaciones que se muestra en la tarjeta de Contacto. Añade una fila por correo | — | no |
| `opciones_correos_operaciones.correo` | email | Correo del área de Operaciones que se muestra en la tarjeta de Contacto | — (pendiente: el diseño trae `[PENDIENTE: correo de Operaciones]`) | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [ ] Cada repetidor admite una o más filas; el formulario envía a todas
- [ ] Ninguna página con formulario guarda su propio correo de destino
- [ ] El reporte del Canal de hostigamiento llega solo a los correos de `opciones_correos_hostigamiento`
- [ ] Un correo vacío o inválido no rompe el envío ni se muestra en la página
