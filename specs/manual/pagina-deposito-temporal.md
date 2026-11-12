# Capítulo: Depósito Temporal

- **Tipo:** página
- **Dónde:** Páginas › Depósito Temporal
- **Páginas:** Depósito Temporal
- **Grupo ACF:** group_8caa8c2e8f2c6 (Depósito Temporal)
- **Estado:** pendiente

## Cómo llegar

1. En el menú de la izquierda entra a **Páginas**.
2. Busca **Depósito Temporal** en la lista y haz clic en **Editar** (aparece al pasar el mouse sobre el nombre).
3. Baja: debajo del editor está cada sección, en el mismo orden que en la web.

## Sección: deposito_temporal_hero · Cabecera de la página

- **Resumen:** Lo primero que se ve: una foto grande, el título de la página, un texto corto, un botón y la tarjeta «Accesos directos» con enlaces a las partes de la página. Las migas de arriba (Inicio › Depósito Temporal) se arman solas.
- **Web:** main > div:first-child > section:first-child

- **1** Título * — Título grande de la página. Si lo dejas vacío, se usa el nombre de la página.
- **2** Bajada * — Texto corto bajo el título que resume el servicio.
- **3** Botón * — Botón: su texto y a dónde lleva. Hoy lleva al aplicativo de seguimiento de carga.
- **4** Imagen * — Foto de fondo, a todo el ancho; se recorta sola para llenar el espacio. Recomendado: hasta 2000 px en el lado más largo, horizontal.
- **5** Accesos título — Título de la tarjeta de enlaces. Si lo dejas vacío, no se muestra.
- **6** Accesos — Enlaces de la tarjeta «Accesos directos». Una fila por enlace; la tarjeta crece o se achica sola. Si no hay ninguno, la tarjeta no se muestra.
- **6.1** Enlace * — Botón: su texto y a dónde lleva. Puede bajar a una parte de esta página (por ejemplo, `#tarifas`) o llevar a otra página.

## Sección: deposito_temporal_atendemos · Qué atendemos

- **Resumen:** Tarjetas con los tipos de carga que atiende el depósito. Cada tarjeta tiene un título, una descripción y, si quieres, un botón. Las columnas se acomodan solas según la cantidad de tarjetas y el tamaño de la pantalla.
- **Web:** #atendemos

- **1** Título * — Título de la sección.
- **2** Items * — Tarjetas de la sección. Una fila por tarjeta; agrega, quita u ordena filas.
- **2.1** Título * — Nombre del tipo de carga. Si lo dejas vacío, la tarjeta no se muestra.
- **2.2** Descripción * — Qué incluye el servicio y sus tiempos de atención. Usa Enter para pasar a otra línea.
- **2.3** Botón — Botón: su texto y a dónde lleva. Hoy dice «Ver tarifa» y baja a la tabla de tarifas. Si lo dejas vacío, la tarjeta no lleva botón.

## Sección: deposito_temporal_tarifas · Tarifas

- **Resumen:** Tabla con los servicios del depósito, su unidad de cobro, la tarifa y el IGV, con una nota debajo. Los nombres de las columnas son fijos. Los montos no se calculan: se muestran tal como los escribes.
- **Web:** #tarifas

- **1** Título * — Título de la sección.
- **2** Filas * — Filas de la tabla, en el orden en que se ven. Una fila por servicio o por grupo; la tabla crece o se achica sola.
- **2.1** Es grupo — Activa o desactiva la fila de grupo. Una fila de grupo se ve como un subtítulo en negrita sobre fondo gris, a todo el ancho, y solo usa el nombre del servicio.
- **2.2** Servicio * — Nombre del servicio o del grupo. Si lo dejas vacío, la fila no se muestra.
- **2.3** Unidad — Unidad de cobro (por ejemplo, «Contenedor»). Déjala vacía en las filas de grupo.
- **2.4** Tarifa — Tarifa en soles, tal como se mostrará (por ejemplo, `211.93`). Déjala vacía en las filas de grupo.
- **2.5** Igv — IGV en soles, tal como se mostrará (por ejemplo, `38.15`). Déjalo vacío en las filas de grupo.
- **3** Nota — Texto bajo la tabla con la vigencia y las condiciones. Si la dejas vacía, no se muestra.

## Sección: deposito_temporal_documentos · Documentos

- **Resumen:** Lista de documentos agrupados en un acordeón: cada grupo se abre y se cierra solo al tocar su nombre, y el primero sale abierto. Junto a cada grupo se ve cuántos documentos tiene; ese número se cuenta solo.
- **Web:** #documentos

- **1** Título * — Título de la sección.
- **2** Grupos * — Grupos del acordeón (por ejemplo, «Tarifario del depósito» o «Autorización SUNAT»). Una fila por grupo; agrega, quita u ordena filas.
- **2.1** Título * — Nombre del grupo: es el texto que se toca para abrirlo. Si lo dejas vacío, el grupo no se muestra.
- **2.2** Estado vacio — Texto que se ve en lugar del número de documentos cuando el grupo todavía no tiene ninguno (por ejemplo, «Próximamente»). En ese caso, al abrir el grupo se lee «Los documentos de esta sección se publicarán próximamente.»
- **2.3** Documentos — Documentos del grupo. Una fila por documento; el número del grupo se actualiza solo.
- **2.3.1** Título * — Nombre del documento. Si lo dejas vacío, el documento no se muestra.
- **2.3.2** Subtitulo — Detalle bajo el nombre, como la fecha o la vigencia, tal como se mostrará. Opcional.
- **2.3.3** Vigente — Activa o desactiva la etiqueta amarilla «Vigente» junto al documento.
- **2.3.4** Archivo * — El archivo que se descarga (PDF o Excel). Se abre en una pestaña nueva. Para cambiarlo, quita el actual y sube el nuevo.
- **2.3.5** Botón texto — Texto del botón verde de descarga. Si lo dejas vacío, dice «Descargar PDF».
- **2.3.6** Archivo alterno — Una versión en PDF del mismo documento, opcional (útil si el archivo principal es un Excel). Si la subes, junto al botón aparece el enlace «Ver PDF». Para cambiarla, quita la actual y sube la nueva.

## Sección: deposito_temporal_quejas_reclamos · Quejas y reclamos

- **Resumen:** Título, un texto de introducción y la hoja de reclamación que llena el visitante, con unas notas legales debajo. Las preguntas del formulario son fijas; aquí editas los textos y los datos de la empresa que se ven en la hoja. El número de hoja y la fecha se ponen solos al enviar, y el visitante recibe una copia en su correo. Los correos que reciben cada hoja se cambian en **Ajustes del sitio › Correos**, en el bloque **Deposito**.
- **Web:** #quejas-y-reclamos

- **1** Título * — Título de la sección.
- **2** Texto * — Introducción bajo el título. Si la dejas vacía, no se muestra.
- **3** Razón social * — Nombre legal de la empresa. Se ve en «Datos del proveedor» de la hoja y en el correo de cada reclamo.
- **4** Ruc * — RUC de la empresa. Se ve en la hoja y en el correo de cada reclamo.
- **5** Domicilio * — Dirección del establecimiento. Se ve en la hoja y en el correo de cada reclamo.
- **6** Código — Código de identificación del establecimiento, si lo tiene. Si lo dejas vacío, esa línea no se muestra en la hoja ni en el correo.
- **7** Nota indecopi — Nota legal bajo el formulario sobre otras vías de solución. Si la dejas vacía, no se muestra.
- **8** Nota plazo — Nota legal bajo el formulario sobre el plazo de respuesta. Si la dejas vacía, no se muestra.
- **9** Nota copia — Aviso bajo el formulario de que el visitante recibe una copia en su correo. Si lo dejas vacío, no se muestra.

## Sección: deposito_temporal_seguimiento · Seguimiento de carga

- **Resumen:** Bloque oscuro con un título, una frase y un botón que lleva al aplicativo de seguimiento de carga, junto a una foto.
- **Web:** #seguimiento

- **1** Título * — Título del bloque. Si lo dejas vacío, el bloque no se muestra.
- **2** Descripción — Frase bajo el título. Conviene que sea corta: en la web se ven dos líneas. Si la dejas vacía, no se muestra.
- **3** Botón * — Botón: su texto y a dónde lleva. Hoy lleva al aplicativo de seguimiento de carga.
- **4** Imagen * — Foto junto al bloque; se recorta sola para llenar el espacio. Recomendado: hasta 2000 px en el lado más largo, horizontal.

## Sección: deposito_temporal_faq · Preguntas frecuentes

- **Resumen:** Preguntas y respuestas en un acordeón: cada pregunta se abre y se cierra sola al tocarla, y la primera sale abierta.
- **Web:** #faq

- **1** Etiqueta — Texto pequeño con un ícono sobre el título (hoy dice «Ayuda»). Si lo dejas vacío, no se muestra.
- **2** Título * — Título de la sección.
- **3** Descripción — Frase bajo el título. Si la dejas vacía, no se muestra.
- **4** Items * — Preguntas del acordeón. Una fila por pregunta; agrega, quita u ordena filas.
- **4.1** Pregunta * — La pregunta: es el texto que se toca para abrir la respuesta. Si la dejas vacía, la pregunta no se muestra.
- **4.2** Respuesta * — La respuesta, en texto simple.

## Sección: deposito_temporal_cta · Bloque de contacto final

- **Resumen:** Cierre de la página: un bloque oscuro con una pregunta grande, una frase y un botón para contactar, junto a una foto.
- **Web:** #faq ~ section

- **1** Título * — Pregunta o frase grande del bloque. Si lo dejas vacío, el bloque no se muestra.
- **2** Bajada — Frase bajo el título. Si la dejas vacía, no se muestra.
- **3** Botón * — Botón: su texto y a dónde lleva. Hoy lleva al formulario de la página de contacto.
- **4** Imagen * — Foto junto al bloque; se recorta sola para llenar el espacio. Recomendado: hasta 2000 px en el lado más largo, horizontal.
