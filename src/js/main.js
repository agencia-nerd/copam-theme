import { iniciarCarga } from './modules/pin-carga.js';
import { iniciarCursor } from './modules/cursor.js';
import { iniciarConectividad } from './modules/pin-conectividad.js';
import { iniciarConoce } from './modules/pin-conoce.js';
import { iniciarHeader } from './modules/header.js';
import { iniciarHero } from './modules/hero.js';
import { iniciarIndice } from './modules/indice.js';
import { iniciarOceano } from './modules/ocean.js';
import { iniciarParalaje } from './modules/parallax.js';
import { iniciarPila } from './modules/pila.js';
import { iniciarPrecarga } from './modules/precarga.js';
import { iniciarRevelado } from './modules/reveal.js';
import { iniciarScroll } from './modules/scroll.js';

// Cada módulo se activa solo si su marcado (data-*) está en la página.
iniciarPrecarga();
iniciarScroll();
iniciarCursor();
iniciarHeader();
iniciarHero();
iniciarRevelado();
iniciarConoce();
iniciarConectividad();
iniciarCarga();
iniciarParalaje();
iniciarPila();
iniciarIndice();
iniciarOceano();

if (document.querySelector('[data-accordion]')) {
    import('./modules/accordion.js').then(({ initAccordions }) => initAccordions()).catch(console.error);
}

if (document.querySelector('form[data-form]')) {
    import('./modules/form.js').then(({ initForms }) => initForms()).catch(console.error);
}

if (document.querySelector('[data-hoja-reclamacion]')) {
    import('./modules/hoja-reclamacion.js').then(({ iniciarHojaReclamacion }) => iniciarHojaReclamacion()).catch(console.error);
}

if (document.querySelector('[data-contacto-form]')) {
    import('./modules/contacto.js').then(({ iniciarContacto }) => iniciarContacto()).catch(console.error);
}

if (document.querySelector('form[data-buzon]')) {
    import('./modules/buzon.js').then(({ iniciarBuzon }) => iniciarBuzon()).catch(console.error);
}

if (document.querySelector('form[data-reporte]')) {
    import('./modules/reporte-hostigamiento.js').then(({ iniciarReporteHostigamiento }) => iniciarReporteHostigamiento()).catch(console.error);
}

if (document.querySelector('form[data-reclamos]')) {
    import('./modules/reclamos.js').then(({ iniciarReclamos }) => iniciarReclamos()).catch(console.error);
}
