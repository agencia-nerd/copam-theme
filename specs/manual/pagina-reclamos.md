# Capítulo: Reclamos

- **Tipo:** página
- **Dónde:** Páginas › Reclamos
- **Páginas:** Reclamos
- **Grupo ACF:** group_e9fd3e090663c (Reclamos)
- **Estado:** pendiente

## Cómo llegar

1. En el menú de la izquierda entra a **Páginas**.
2. Busca **Reclamos** en la lista y haz clic en **Editar** (aparece al pasar el mouse sobre el nombre).
3. Baja: debajo del editor está cada sección, en el mismo orden que en la web.

> Los correos que reciben el formulario de reclamos se eligen en **Ajustes del sitio › Correos**, no en esta página.

## Sección: reclamos_hero · Cabecera

- **Resumen:** Lo primero que se ve: el título, un párrafo, el botón que baja al formulario y, a la derecha, la tarjeta de accesos directos a las secciones de la página. No lleva foto. La ruta de navegación (Inicio › Reclamos) se arma sola.
- **Web:** main > div:first-child > section:first-child

- **1** Título * — Título grande de la página. Si lo dejas vacío, se usa el nombre de la página.
- **2** Bajada * — Párrafo bajo el título que explica qué se puede presentar.
- **3** Botón * — Botón: su texto y a dónde lleva. Hoy baja al formulario de esta misma página.
- **4** Accesos título * — Título de la tarjeta de accesos directos.
- **5** Accesos * — Una fila por acceso directo de la tarjeta. La lista crece o se achica sola según las filas que tengas.
- **5.1** Enlace * — Botón: su texto y a dónde lleva. Suelen llevar a una sección de esta misma página, como el formulario o los derechos del usuario.

## Sección: reclamos_proceso · Proceso de atención

- **Resumen:** Los pasos del procedimiento de reclamo, en tarjetas sobre una franja gris. El número grande de cada paso (01, 02…) se pone solo según el orden de las filas.
- **Web:** #proceso

- **1** Título * — Título de la sección.
- **2** Pasos * — Una fila por paso, en orden. Las tarjetas se reparten solas en columnas y la numeración se ajusta si agregas, quitas o reordenas pasos.
- **2.1** Título * — Título del paso.
- **2.2** Descripción * — Explicación del paso, bajo su título. Para resaltar un plazo en verde, escríbelo entre virgulillas: `~15 días hábiles~`.

## Sección: reclamos_formulario · Formulario de reclamos

- **Resumen:** El formulario para presentar un reclamo, una reconsideración o una apelación. Los campos del formulario y el mensaje de envío correcto son fijos; aquí editas los textos que lo rodean. La solicitud llega a los correos elegidos en **Ajustes del sitio › Correos**.
- **Web:** #formulario

- **1** Título * — Título de la sección.
- **2** Nota obligatorios — Aviso pequeño bajo el título sobre los campos obligatorios. Si la dejas vacía, no se muestra.
- **3** Nota reclamo * — Nota que aparece bajo la elección del tipo de solicitud cuando el visitante elige **Reclamo**.
- **4** Nota reconsideracion * — Nota que aparece en el mismo lugar cuando el visitante elige **Reconsideración**.
- **5** Nota apelacion * — Nota que aparece en el mismo lugar cuando el visitante elige **Apelación**.
- **6** Procedimiento texto — Texto del enlace que abre la guía del procedimiento, bajo la nota del tipo. El enlace solo se muestra si tiene texto y archivo.
- **7** Procedimiento archivo — El archivo (PDF) de la guía del procedimiento. Se abre en una pestaña nueva. Para cambiarlo, quita el actual y sube el nuevo.
- **8** Plazo 1 — Primer párrafo bajo el formulario, sobre el plazo. Si lo dejas vacío, no se muestra.
- **9** Plazo 2 — Segundo párrafo bajo el formulario, sobre la presentación en físico o por correo. Si lo dejas vacío, no se muestra.
- **10** Diagrama texto — Texto del enlace que abre el diagrama del procedimiento, bajo los plazos. El enlace solo se muestra si tiene texto y archivo.
- **11** Diagrama archivo — El archivo (PDF) del diagrama del procedimiento. Se abre en una pestaña nueva. Para cambiarlo, quita el actual y sube el nuevo.
- **12** Nota envio — Frase al pie del formulario que va antes del correo de destino. El correo se pone solo: es el primero de la lista de reclamos en **Ajustes del sitio › Correos**. Si la dejas vacía, la línea no se muestra.

## Sección: reclamos_conforme · Si no estás conforme

- **Resumen:** Explica qué hacer si el visitante no está de acuerdo con la respuesta, con una tarjeta por instancia (reconsideración, apelación y queja ante OSITRAN). Si el botón de una tarjeta lleva al formulario, deja elegido el tipo de solicitud según el título de la tarjeta.
- **Web:** #conforme

- **1** Título * — Título de la sección.
- **2** Texto * — Párrafo bajo el título que explica los caminos posibles.
- **3** Nota — Frase corta bajo el párrafo. Si la dejas vacía, no se muestra.
- **4** Instancias * — Una fila por tarjeta. Las tarjetas se reparten solas en columnas.
- **4.1** Etiqueta * — Texto pequeño en mayúsculas sobre el título de la tarjeta.
- **4.2** Título * — Título de la tarjeta. Para que el botón deje elegido el tipo en el formulario, el título debe decir «Reconsideración» o «Apelación».
- **4.3** Descripción * — Explicación de la instancia. Para resaltar un plazo en verde, escríbelo entre virgulillas: `~15 días hábiles~`.
- **4.4** Botón * — Botón: su texto y a dónde lleva. Hoy, los dos primeros bajan al formulario y el tercero abre el portal de OSITRAN.

## Sección: reclamos_documentos · Documentos y formatos

- **Resumen:** Los documentos para descargar, ordenados en grupos que se abren y se cierran solos al hacer clic. Cada grupo muestra solo cuántos documentos tiene, y el primero aparece abierto.
- **Web:** #documentos

- **1** Título * — Título de la sección.
- **2** Texto botón * — Texto del botón de descarga. Es el mismo en todas las filas.
- **3** Grupos * — Una fila por grupo del desplegable. El contador de documentos de cada grupo se actualiza solo.
- **3.1** Nombre * — Nombre del grupo, en la cabecera del desplegable.
- **3.2** Documentos * — Una fila por documento dentro del grupo.
- **3.2.1** Título * — Nombre del documento.
- **3.2.2** Subtitulo — Línea bajo el nombre: resolución, versión o fecha. Si la dejas vacía, no se muestra.
- **3.2.3** Vigente — Activa o desactiva la etiqueta «Vigente» junto al documento.
- **3.2.4** Archivo * — El archivo (PDF) que se descarga con el botón. Para cambiarlo, quita el actual y sube el nuevo.

## Sección: reclamos_libro · Libro de Reclamaciones

- **Resumen:** Un bloque oscuro con título, texto y botón hacia la página del Libro de Reclamaciones, junto a una foto.
- **Web:** #libro

- **1** Título * — Título del bloque.
- **2** Descripción * — Texto bajo el título.
- **3** Botón * — Botón: su texto y a dónde lleva. Hoy lleva a la página Libro de Reclamaciones.
- **4** Imagen * — Foto junto al bloque. Se recorta sola para llenar el espacio. Recomendado: hasta 2000 px en el lado más largo, horizontal.

## Sección: reclamos_derechos · Derechos y deberes del usuario

- **Resumen:** Dos tarjetas sobre una franja gris: una con los derechos del usuario y otra con sus deberes. La lista de derechos se reparte sola en dos columnas cuando hay espacio.
- **Web:** #derechos

- **1** Título * — Título de la sección.
- **2** Bajada — Frase bajo el título con la norma en la que se basan. Si la dejas vacía, no se muestra.
- **3** Derechos etiqueta * — Texto pequeño en mayúsculas de la tarjeta de derechos.
- **4** Derechos título * — Título de la tarjeta de derechos.
- **5** Derechos items * — Una fila por derecho. La lista crece o se achica sola.
- **5.1** Texto * — Un derecho.
- **6** Deberes etiqueta * — Texto pequeño en mayúsculas de la tarjeta de deberes.
- **7** Deberes título * — Título de la tarjeta de deberes.
- **8** Deberes items * — Una fila por deber. La lista crece o se achica sola.
- **8.1** Texto * — Un deber.

## Sección: reclamos_otros_canales · Otros canales

- **Resumen:** Tarjetas con otras vías de atención (denuncias, reglamento de usuarios, sugerencias). Cada tarjeta lleva un botón: un enlace o, si no tiene enlace, la descarga de un PDF.
- **Web:** #otros-canales

- **1** Título * — Título de la sección.
- **2** Tarjetas * — Una fila por tarjeta. Las tarjetas se reparten solas en columnas.
- **2.1** Etiqueta * — Texto pequeño en mayúsculas sobre el título de la tarjeta.
- **2.2** Título * — Título de la tarjeta.
- **2.3** Descripción * — Explicación del canal. Para resaltar un plazo en verde, escríbelo entre virgulillas: `~15 días hábiles~`.
- **2.4** Nota — Frase pequeña bajo la descripción. Si la dejas vacía, no se muestra.
- **2.5** Enlace — Botón: su texto y a dónde lleva. Si lo llenas, la tarjeta usa este botón y no el del archivo.
- **2.6** Archivo — El archivo (PDF) que se abre con el botón cuando la tarjeta no tiene enlace. Para cambiarlo, quita el actual y sube el nuevo.
- **2.7** Texto archivo — Texto del botón que abre el archivo. Solo se usa si la tarjeta tiene archivo y no tiene enlace.

## Sección: reclamos_faq · Preguntas frecuentes

- **Resumen:** Las preguntas frecuentes en un desplegable que se abre y se cierra solo al hacer clic. La primera pregunta aparece abierta. La etiqueta «Ayuda» sobre el título es fija.
- **Web:** #faq

- **1** Título * — Título de la sección.
- **2** Bajada — Frase bajo el título. Si la dejas vacía, no se muestra.
- **3** Items * — Una fila por pregunta. El desplegable crece o se achica solo.
- **3.1** Pregunta * — La pregunta, en la cabecera de cada desplegable.
- **3.2** Respuesta * — La respuesta que se ve al abrir la pregunta.
