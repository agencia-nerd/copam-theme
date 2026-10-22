# Página: Transparencia

- **Resumen:** Reúne los accesos a la información pública de la concesión de COPAM (tarifas, reglamentos, contrato, normativa, reclamos y comunicados) y permite pedir por formulario información adicional.
- **Fuente:** `transparencia.html`
- **Plantilla:** `pages/template-transparencia.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, informacion, solicitud
- **Skills usadas:** wp-form (solicitud), wp-helper
- **Grupo ACF:** Transparencia
- **Ubicación:** plantilla pages/template-transparencia.php
- **Notas de página:**
  - `h1` "Transparencia" en el hero
  - título SEO "Transparencia · COPAM"
  - meta descripción del diseño: "Concesionaria Puerto Amazonas S.A. · Terminal Portuario de Yurimaguas – Nueva Reforma." (es la genérica del sitio
  - se propone una propia, a confirmar)
  - El diseño trae `noindex, nofollow`: se ignora, es solo de la maqueta
  - Header, footer, menús, buscador y aviso de mantenimiento son del sitio (`opciones`) y no se repiten
  - Migas con el componente `migas`: Inicio > Reglamentos (sin enlace, es un grupo del menú) > Transparencia (actual)
  - Títulos de `informacion` y `solicitud` con `titulo-linea`
  - Todos los destinos son internos: los enlaces del diseño a `tarifario.html`, `operacion-del-terminal.html`, `normativa-ositran.html` (con y sin `#contrato`), `reclamos.html` y `comunicados.html` pasan a las páginas del tema
  - `#info` y `#solicitud` son anclas de esta página
  - Esta página no tiene PDF ni archivos descargables, así que no hay campos `file`
  - Valores sueltos: hover del verde `#07702F`
- **Estado:** pendiente

## Sección: hero

- **Origen:** `transparencia.html` líneas 158-205
- **Destino:** `template-parts/pages/transparencia/hero.php`
- **Grupo:** `transparencia_hero`
- **Skill:** ninguna
- **Comportamiento:** Componente `migas` (ver notas de página). Dos columnas desde el ancho de escritorio (texto a la izquierda, tarjeta de accesos a la derecha), una columna en móvil con la tarjeta debajo. `h1` con el título y la bajada debajo. Botón con el componente `boton` (variante primaria, hover `#07702F`) que lleva al ancla `#solicitud` (fija, no es campo; desplazamiento suave con JS); el texto es un campo. Tarjeta lateral "Accesos directos": `h2` y lista de 5 enlaces, cada uno con texto y flecha de esquina que se desplaza al hover y el texto pasa a `--color-brand`; separadores de línea entre filas. Los 5 destinos: ancla `#info`, ancla `#solicitud`, Tarifario, Operación del terminal y Normativa OSITRAN (`#contrato`). Entrada por recorte y desplazamiento (JS). No hay imagen.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `transparencia_hero_titulo` | text | Título principal de la página (h1). Se muestra en grande bajo las migas. Recomendado: ~20 caracteres | Transparencia | sí |
| `transparencia_hero_bajada` | textarea | Texto de presentación bajo el título. Recomendado: ~160 caracteres | Consulta la información que publicamos sobre la concesión y solicita el acceso a información adicional. | sí |
| `transparencia_hero_boton_texto` | text | Texto del botón principal. Lleva a la sección de solicitud. Recomendado: ~35 caracteres | Solicitar información | no |
| `transparencia_hero_accesos_titulo` | text | Título de la tarjeta lateral de accesos (h2). Recomendado: ~25 caracteres | Accesos directos | sí |
| `transparencia_hero_accesos` | repeater | Enlaces de la tarjeta lateral. 5 ítems; cada uno es una fila con texto y flecha. | — | sí |
| `transparencia_hero_accesos.texto` | text | Texto del enlace. Recomendado: ~35 caracteres | Información publicada | sí |
| `transparencia_hero_accesos.enlace` | link | Destino del enlace: ancla de esta página o página del tema | — | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`

## Sección: informacion

- **Origen:** `transparencia.html` líneas 207-227
- **Destino:** `template-parts/pages/transparencia/informacion.php`
- **Grupo:** `transparencia_informacion`
- **Skill:** ninguna
- **Comportamiento:** `id="info"` con margen de desplazamiento por el header fijo. Título con `titulo-linea`. Lista de 6 filas, cada una una fila completa clicable (`<a>`) con el título a la izquierda y a la derecha el texto del enlace con flecha de esquina (como `enlace-flecha`), separadas por líneas finas; líneas y textos entran al desplazarse (JS). Al hover de la fila el enlace pasa a `--color-brand` y la flecha se desplaza. En móvil título y enlace se apilan. Destinos del diseño: Tarifario, Operación del terminal, Normativa OSITRAN (`#contrato`), Normativa OSITRAN, Reclamos y Comunicados (páginas del tema, no PDF).
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `transparencia_informacion_titulo` | text | Título de la sección (h2, con línea). Recomendado: ~35 caracteres | Información publicada | sí |
| `transparencia_informacion_filas` | repeater | Filas de información publicada. 6 ítems. | — | sí |
| `transparencia_informacion_filas.titulo` | text | Nombre del documento o información. Recomendado: ~80 caracteres | Tarifario y Reglamento de Tarifas y Precios de COPAM | sí |
| `transparencia_informacion_filas.texto_enlace` | text | Texto del enlace de la fila. Recomendado: ~45 caracteres | Ver en Tarifario | sí |
| `transparencia_informacion_filas.enlace` | link | Página del tema a la que lleva la fila | — | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`

## Sección: solicitud

- **Origen:** `transparencia.html` líneas 229-281
- **Destino:** `template-parts/forms/solicitud-informacion.php`, `template-parts/pages/transparencia/solicitud.php`
- **Grupo:** `transparencia_solicitud`
- **Skill:** wp-form
- **Comportamiento:** `id="solicitud"` con margen de desplazamiento. Título con `titulo-linea`. El formulario lo construye `wp-form`; sin marcado propio. Campos: Nombre y apellidos (texto, requerido, mínimo 3, solo letras; "Ingresa tu nombre completo"), Documento de identidad (numérico, requerido, 8 a 11 dígitos; "DNI, CE o RUC"), Correo electrónico (email, requerido; "nombre@empresa.com"), Teléfono (tel, requerido, números, + ( ) espacio y guion, de 7 a 20; "Ej. 987 654 321"), Información solicitada (textarea, requerido, mínimo 10, 5 filas, ancho completo; "Describe con precisión la información que necesitas"). Casilla requerida "Acepto la Política de privacidad y el tratamiento de mis datos personales." con enlace a la página de privacidad del tema. Verificación "No soy un robot": el diseño deja un marcador de reCAPTCHA o Cloudflare Turnstile; lo define el anti-spam de `wp-form` (a confirmar con el usuario cuál). Campos en 2 columnas desde 760 px, 1 en móvil. Validación al salir del campo y al escribir, mensajes bajo el campo con `role="alert"` y `--color-danger`. Botón "Enviar solicitud" que pasa a "Solicitud enviada" tras el envío; el diseño no trae mensaje de éxito más largo (a definir con `wp-form`). Destinatario: `comercial@copam.com.pe`, impreso también bajo el formulario como enlace `mailto:` (la dirección es un campo). Valor suelto: hover del botón `#07702F`. El correo de destino no es campo de esta página: sale de `opciones_correos_transparencia.correo` en Ajustes del sitio (se admite más de uno).
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `transparencia_solicitud_titulo` | text | Título de la sección (h2, con línea). Recomendado: ~55 caracteres | Solicitud de acceso a la información | sí |
| `transparencia_solicitud_nota_envio` | text | Aviso bajo el formulario que indica a dónde se envía. Va antes del correo, que se imprime aparte. Recomendado: ~35 caracteres | La solicitud se envía a | no |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
