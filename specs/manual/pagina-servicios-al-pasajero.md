# Capítulo: Servicios al pasajero

- **Tipo:** página
- **Dónde:** Páginas › Servicios al pasajero
- **Páginas:** Servicios al pasajero
- **Grupo ACF:** group_d3d843b9e874b (Servicios al pasajero)
- **Estado:** pendiente

## Cómo llegar

1. En el menú de la izquierda entra a **Páginas**.
2. Busca **Servicios al pasajero** en la lista y haz clic en **Editar** (aparece al pasar el mouse sobre el nombre). En el listado aparece debajo de **Servicios**, con una raya delante, porque es una página que cuelga de ella.
3. Baja: debajo del editor está cada sección, en el mismo orden que en la web.

## Sección: servicios_al_pasajero_hero · Encabezado

- **Resumen:** Lo primero que se ve: una foto grande a todo el ancho, el título de la página, un texto corto, un botón y, a un lado, una tarjeta de accesos directos que bajan a cada sección de la página. Las migas de arriba (Inicio › Zona Clientes › …) se arman solas.
- **Web:** main > div:first-child > section:first-child

- **1** Título * — Título grande de la página. Si lo dejas vacío, se usa el nombre de la página.
- **2** Bajada * — Texto corto bajo el título que resume el servicio.
- **3** Botón * — Botón: su texto y a dónde lleva. Hoy dice «Solicitar cotización» y lleva al formulario de la página Contacto.
- **4** Imagen * — Foto a todo el ancho, bajo las migas. Se recorta sola para llenar el espacio. Recomendado: hasta 2000 px en el lado más largo, horizontal.
- **5** Accesos título — Título de la tarjeta de accesos directos. Si lo dejas vacío, la tarjeta se muestra sin título.
- **6** Accesos — Una fila por acceso directo. La tarjeta crece o se achica sola. Si no dejas ninguno, la tarjeta no se muestra.
- **6.1** Enlace * — Un acceso: su texto y a dónde lleva. Hoy cada uno baja a una sección de esta página, por ejemplo `#tarifas` o `#faq`.

## Sección: servicios_al_pasajero_que_incluye · Qué incluye

- **Resumen:** Tarjetas con lo que incluye el servicio al pasajero, en dos columnas en computadora y una en el celular. Debajo puede ir una nota corta.
- **Web:** #que-incluye

- **1** Título * — Título de la sección.
- **2** Items * — Una fila por tarjeta. Las columnas se acomodan solas a la cantidad de tarjetas.
- **2.1** Título * — Nombre de lo que incluye el servicio. Una fila sin título no se muestra.
- **2.2** Descripción * — Explicación breve bajo el nombre.
- **3** Nota — Texto pequeño bajo las tarjetas. Si lo dejas vacío, no se muestra.

## Sección: servicios_al_pasajero_infraestructura · Infraestructura para pasajeros

- **Resumen:** Tarjetas con las instalaciones que usa el pasajero en el terminal, con el mismo diseño que «Qué incluye».
- **Web:** #infraestructura

- **1** Título * — Título de la sección.
- **2** Items * — Una fila por tarjeta. Las columnas se acomodan solas a la cantidad de tarjetas.
- **2.1** Título * — Nombre de la instalación. Una fila sin título no se muestra.
- **2.2** Descripción * — Explicación breve de la instalación.

## Sección: servicios_al_pasajero_tarifas · Tarifas

- **Resumen:** Una tabla de dos columnas con cada servicio cobrado y su unidad de cobro (sin montos). Debajo, una nota que puede llevar enlaces, como el de la página Tarifario.
- **Web:** #tarifas

- **1** Título * — Título de la sección.
- **2** Columna prestacion * — Encabezado de la primera columna de la tabla. Hoy dice «Prestación».
- **3** Columna unidad * — Encabezado de la segunda columna de la tabla. Hoy dice «Unidad de cobro».
- **4** Filas * — Una fila por servicio cobrado. La tabla crece o se achica sola.
- **4.1** Prestacion * — Nombre del servicio cobrado, en la primera columna. Una fila sin este texto no se muestra.
- **4.2** Unidad * — Cómo se cobra ese servicio, en la segunda columna. Por ejemplo, «Pasajero embarcado o desembarcado».
- **5** Nota — Texto bajo la tabla. Es un editor de texto: puedes poner enlaces con su botón de enlace. Si lo dejas vacío, no se muestra.

## Sección: servicios_al_pasajero_documentos · Documentos relacionados

- **Resumen:** Tarjetas con los documentos del servicio. Cada tarjeta abre su PDF en una pestaña nueva. Se ordenan en tres columnas en computadora, dos en tablet y una en el celular.
- **Web:** #documentos

- **1** Título * — Título de la sección.
- **2** Items * — Una fila por documento. Las tarjetas se acomodan solas en columnas.
- **2.1** Etiqueta — Texto pequeño sobre el nombre, con el tipo de documento (por ejemplo «Tarifario»). Si lo dejas vacío, no se muestra.
- **2.2** Título * — Nombre del documento.
- **2.3** Fecha — Vigencia o fecha del documento, tal como quieres que se lea (por ejemplo «Vigente desde el 16-06-2026»). Si la dejas vacía, no se muestra.
- **2.4** Archivo * — El archivo (PDF) que se abre al tocar la tarjeta. Para cambiarlo, quita el actual y sube el nuevo. Sin archivo, la tarjeta no se muestra.

## Sección: servicios_al_pasajero_faq · Preguntas frecuentes

- **Resumen:** Lista de preguntas con su respuesta. Cada pregunta se abre y se cierra sola al tocarla; la primera empieza abierta.
- **Web:** #faq

- **1** Etiqueta — Texto pequeño con un ícono sobre el título. Hoy dice «Ayuda». Si lo dejas vacío, no se muestra.
- **2** Título * — Título de la sección.
- **3** Descripción — Frase bajo el título. Si la dejas vacía, no se muestra.
- **4** Items * — Una fila por pregunta. La lista crece o se achica sola.
- **4.1** Pregunta * — La pregunta: es el texto que se toca para abrir la respuesta. Una fila sin pregunta no se muestra.
- **4.2** Respuesta * — La respuesta, en texto simple.

## Sección: servicios_al_pasajero_cta · Bloque final de contacto

- **Resumen:** Cierre de la página: un recuadro oscuro con un título, una frase y un botón, junto a una foto. En el celular la foto pasa debajo del texto.
- **Web:** #faq ~ section

- **1** Título * — Título grande del recuadro. Si lo dejas vacío, el bloque completo no se muestra.
- **2** Bajada — Frase bajo el título. Si la dejas vacía, no se muestra.
- **3** Botón * — Botón: su texto y a dónde lleva. Hoy dice «Contáctanos» y lleva al formulario de la página Contacto.
- **4** Imagen * — Foto junto al recuadro. Se recorta sola para llenar el espacio. Recomendado: hasta 2000 px en el lado más largo, horizontal.
