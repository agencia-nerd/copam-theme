# Capítulo: Servicios a la carga

- **Tipo:** página
- **Dónde:** Páginas › Servicios a la carga
- **Páginas:** Servicios a la carga
- **Grupo ACF:** group_6ed9299b497ac (Servicios a la carga)
- **Estado:** pendiente

## Cómo llegar

1. En el menú de la izquierda entra a **Páginas**.
2. Busca **Servicios a la carga** en la lista y haz clic en **Editar** (aparece al pasar el mouse sobre el nombre). En la lista aparece debajo de la página **Servicios**, porque es una de sus páginas hijas.
3. Baja: debajo del editor está cada sección, en el mismo orden que en la web.

> La página **Servicios** no tiene contenido propio: quien entra a ella pasa solo a su primera página hija, que hoy es Servicios a la nave.

## Sección: servicios_a_la_carga_hero · Cabecera de la página

- **Resumen:** Lo primero que se ve: una foto grande, el título de la página, un texto corto, un botón y la tarjeta «Accesos directos» con enlaces a las partes de la página. Las migas de arriba (Inicio › Zona Clientes › Servicios a la carga) se arman solas.
- **Web:** main > div:first-child > section:first-child

- **1** Título * — Título grande de la página. Si lo dejas vacío, se usa el nombre de la página.
- **2** Bajada * — Texto corto bajo el título que resume el servicio.
- **3** Botón * — Botón: su texto y a dónde lleva. Hoy dice «Solicitar cotización» y lleva al formulario de la página de contacto.
- **4** Imagen * — Foto de fondo, a todo el ancho; se recorta sola para llenar el espacio. Recomendado: hasta 2000 px en el lado más largo, horizontal.
- **5** Accesos título * — Título de la tarjeta de enlaces (hoy «Accesos directos»).
- **6** Accesos * — Enlaces de la tarjeta «Accesos directos». Una fila por enlace; la tarjeta crece o se achica sola.
- **6.1** Enlace * — Botón: su texto y a dónde lleva. Hoy cada uno baja a una parte de esta página (por ejemplo, `#tarifas` o `#faq`); también puede llevar a otra página.

## Sección: servicios_a_la_carga_que_incluye · Qué incluye

- **Resumen:** Tarjetas con los servicios a la carga, cada una con un título y una descripción. Las columnas se acomodan solas según la cantidad de tarjetas y el tamaño de la pantalla.
- **Web:** #que-incluye

- **1** Título * — Título de la sección.
- **2** Items * — Tarjetas de la sección. Una fila por tarjeta; agrega, quita u ordena filas.
- **2.1** Título * — Nombre del servicio. Si lo dejas vacío, la tarjeta no se muestra.
- **2.2** Descripción * — Explicación breve bajo el nombre.

## Sección: servicios_a_la_carga_tarifas · Tarifas

- **Resumen:** Tabla de dos columnas con cada tipo de carga y su unidad de cobro, y una nota debajo con un enlace a la página Tarifario. Los nombres de las columnas («Tipo de carga» y «Unidad de cobro») son fijos.
- **Web:** #tarifas

- **1** Título * — Título de la sección.
- **2** Filas * — Filas de la tabla. Una fila por tipo de carga; la tabla crece o se achica sola.
- **2.1** Tipo carga * — Tipo de carga o de contenedor (por ejemplo, «Carga fraccionada»). Si lo dejas vacío, la fila no se muestra.
- **2.2** Unidad cobro * — Unidad con la que se cobra (por ejemplo, «Tonelada»).
- **3** Nota — Texto bajo la tabla. Se escribe en un editor, así que puedes poner enlaces: hoy enlaza a la página Tarifario. Si la dejas vacía, no se muestra.

## Sección: servicios_a_la_carga_documentos · Documentos relacionados

- **Resumen:** Tarjetas de documentos: cada tarjeta abre su archivo en una pestaña nueva. Al pasar el mouse se ven el tipo y el peso del archivo, que se calculan solos.
- **Web:** #documentos

- **1** Título * — Título de la sección.
- **2** Items * — Documentos de la sección. Una fila por tarjeta; las columnas se acomodan solas.
- **2.1** Etiqueta * — Tipo de documento, en una etiqueta sobre el nombre (por ejemplo, «Tarifario»).
- **2.2** Título * — Nombre del documento.
- **2.3** Fecha * — Vigencia o fecha de aprobación, tal como se mostrará (por ejemplo, «Vigente desde el 16-06-2026»).
- **2.4** Archivo * — El archivo (PDF). Sin archivo, la tarjeta no se muestra. Para cambiarlo, quita el actual y sube el nuevo.

## Sección: servicios_a_la_carga_faq · Preguntas frecuentes

- **Resumen:** Preguntas y respuestas en un acordeón: cada pregunta se abre y se cierra sola al tocarla, y la primera sale abierta. La etiqueta «Ayuda» sobre el título es fija.
- **Web:** #faq

- **1** Título * — Título de la sección.
- **2** Descripción — Frase bajo el título. Si la dejas vacía, no se muestra.
- **3** Items * — Preguntas del acordeón. Una fila por pregunta; agrega, quita u ordena filas.
- **3.1** Pregunta * — La pregunta: es el texto que se toca para abrir la respuesta. Si la dejas vacía, la pregunta no se muestra.
- **3.2** Respuesta * — La respuesta, en texto simple.

## Sección: servicios_a_la_carga_cta · Bloque de contacto final

- **Resumen:** Cierre de la página: un bloque oscuro con una pregunta grande, una frase y un botón para contactar, junto a una foto.
- **Web:** #faq ~ section

- **1** Título * — Pregunta o frase grande del bloque. Si lo dejas vacío, el bloque no se muestra.
- **2** Bajada — Frase bajo el título. Si la dejas vacía, no se muestra.
- **3** Botón * — Botón: su texto y a dónde lleva. Hoy dice «Contáctanos» y lleva al formulario de la página de contacto.
- **4** Imagen * — Foto junto al bloque; se recorta sola para llenar el espacio. Recomendado: hasta 2000 px en el lado más largo, horizontal.
