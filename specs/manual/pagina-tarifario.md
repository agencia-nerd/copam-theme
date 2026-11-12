# Capítulo: Tarifario

- **Tipo:** página
- **Dónde:** Páginas › Tarifario
- **Páginas:** Tarifario
- **Grupo ACF:** group_c154a136147db (Tarifario)
- **Estado:** pendiente

## Cómo llegar

1. En el menú de la izquierda entra a **Páginas**.
2. Busca **Tarifario** en la lista y haz clic en **Editar** (aparece al pasar el mouse sobre el nombre).
3. Baja: debajo del editor está cada sección, en el mismo orden que en la web.
4. Cuando termines, pulsa **Actualizar** para guardar los cambios.

## Sección: tarifario_hero · Portada de la página

- **Resumen:** Lo primero que se ve: el título grande, un texto de presentación, el botón para descargar el tarifario vigente y, a la derecha (debajo en el celular), la tarjeta de accesos directos.
- **Web:** main > div:first-child > section:first-child

- **1** Título * — Título grande de la página. Si lo dejas vacío, se usa el nombre de la página.
- **2** Bajada * — Texto de presentación bajo el título.
- **3** Archivo * — El archivo (PDF) del tarifario vigente, que descarga el botón. Para cambiarlo, quita el actual y sube el nuevo. Sin archivo, el botón no se muestra.
- **4** Botón texto * — Texto del botón de descarga (por ejemplo, «Descargar tarifario»).
- **5** Accesos título — Título de la tarjeta de accesos directos. Si lo dejas vacío, la tarjeta se muestra sin título.
- **6** Accesos — Una fila por acceso directo. La tarjeta crece o se achica sola. Si no hay ninguna fila, la tarjeta no se muestra.
- **6.1** Enlace * — Acceso: su texto y a dónde lleva. Para bajar a una sección de esta página usa su ancla, por ejemplo `#reta` o `#faq`. Si es de otro sitio, marca **Abrir en una pestaña nueva**.

## Sección: tarifario_versiones · Versiones del tarifario

- **Resumen:** Lista desplegable por año con los tarifarios de cada versión. Se abre y se cierra sola al tocarla; el primer año empieza abierto. Junto a cada año se cuenta solo cuántos documentos tiene. Cada documento tiene su botón de descarga.
- **Web:** #versiones

- **1** Título * — Título de la sección.
- **2** Anios * — Una fila por año. Ponlos del más reciente al más antiguo: el primero es el que empieza abierto. El contador se adapta solo.
- **2.1** Año * — Nombre del grupo, normalmente el año.
- **2.2** Documentos — Una fila por documento del año. El contador del año cambia solo.
- **2.2.1** Título * — Nombre del documento.
- **2.2.2** Subtitulo — Vigencia u otro dato, bajo el título. Si lo dejas vacío, no se muestra.
- **2.2.3** Vigente — Activa o desactiva la etiqueta **Vigente** junto al documento.
- **2.2.4** Archivo * — El archivo (PDF) que descarga el botón. Para cambiarlo, quita el actual y sube el nuevo.
- **3** Botón texto — Texto del botón de cada documento. Si lo dejas vacío, dice «Descargar PDF».
- **4** Vacio — Mensaje que se ve al abrir un año sin documentos. Si lo dejas vacío, el año se abre sin mensaje.

## Sección: tarifario_reta · Reglamento de Tarifas y Precios

- **Resumen:** Lista desplegable con las versiones del Reglamento de Tarifas y Precios de COPAM. Se abre y se cierra sola al tocarla; el primer grupo empieza abierto. Junto a cada grupo se cuenta solo cuántos documentos tiene.
- **Web:** #reta

- **1** Título * — Título de la sección.
- **2** Grupos * — Una fila por grupo (un año o «Anterior»). El primero es el que empieza abierto. El contador se adapta solo.
- **2.1** Nombre * — Nombre del grupo. No tiene que ser un año.
- **2.2** Documentos — Una fila por documento del grupo. El contador del grupo cambia solo.
- **2.2.1** Título * — Nombre del documento.
- **2.2.2** Subtitulo — Estado o vigencia, bajo el título. Si lo dejas vacío, no se muestra.
- **2.2.3** Vigente — Activa o desactiva la etiqueta **Vigente** junto al documento.
- **2.2.4** Archivo * — El archivo (PDF) que descarga el botón. Para cambiarlo, quita el actual y sube el nuevo.
- **3** Botón texto — Texto del botón de cada documento. Si lo dejas vacío, dice «Descargar PDF».
- **4** Vacio — Mensaje que se ve al abrir un grupo sin documentos. Si lo dejas vacío, el grupo se abre sin mensaje.

## Sección: tarifario_documentos · Documentos relacionados

- **Resumen:** Tarjetas con otros documentos en PDF. Toda la tarjeta abre el PDF en una pestaña nueva. La rejilla se ordena sola según cuántas tarjetas haya.
- **Web:** #documentos

- **1** Título * — Título de la sección.
- **2** Items * — Una fila por tarjeta. La rejilla se acomoda sola.
- **2.1** Etiqueta — Texto pequeño sobre el título de la tarjeta (por ejemplo, «Tarifario»). Si la dejas vacía, no se muestra.
- **2.2** Título * — Nombre del documento.
- **2.3** Fecha — Vigencia o fecha de aprobación, tal como quieres que se lea. Si la dejas vacía, no se muestra.
- **2.4** Archivo * — El archivo (PDF) que abre la tarjeta. Para cambiarlo, quita el actual y sube el nuevo. Sin archivo, la tarjeta no se muestra.

## Sección: tarifario_faq · Preguntas frecuentes

- **Resumen:** Preguntas y respuestas sobre las tarifas. Cada pregunta se abre y se cierra sola al tocarla; la primera empieza abierta.
- **Web:** #faq

- **1** Etiqueta — Texto pequeño con ícono sobre el título (por ejemplo, «Ayuda»). Si la dejas vacía, no se muestra.
- **2** Título * — Título de la sección.
- **3** Descripción — Frase bajo el título. Si la dejas vacía, no se muestra.
- **4** Items * — Una fila por pregunta. La lista se acomoda sola.
- **4.1** Pregunta * — La pregunta: es el texto que se toca para abrir la respuesta.
- **4.2** Respuesta * — La respuesta, en texto simple.

## Sección: tarifario_cta · Bloque de cotización

- **Resumen:** Bloque de cierre: un recuadro oscuro con título, una frase y un botón, junto a una foto. En el celular la foto va debajo.
- **Web:** #faq ~ section

- **1** Título * — Título grande del bloque. Si lo dejas vacío, el bloque completo no se muestra.
- **2** Bajada — Frase bajo el título. Si la dejas vacía, no se muestra.
- **3** Botón * — Botón: su texto y a dónde lleva. Hoy lleva al formulario de contacto.
- **4** Imagen * — Foto junto al recuadro. Se recorta sola para llenar su espacio. Recomendado: hasta 2000 px en el lado más largo, horizontal.
