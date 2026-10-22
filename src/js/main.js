import { iniciarCarga } from './modules/pin-carga.js';
import { iniciarCursor } from './modules/cursor.js';
import { iniciarConectividad } from './modules/pin-conectividad.js';
import { iniciarConoce } from './modules/pin-conoce.js';
import { iniciarHeader } from './modules/header.js';
import { iniciarHero } from './modules/hero.js';
import { iniciarIndice } from './modules/indice.js';
import { iniciarOceano } from './modules/ocean.js';
import { iniciarParalaje } from './modules/parallax.js';
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
iniciarIndice();
iniciarOceano();

if (document.querySelector('[data-accordion]')) {
    import('./modules/accordion.js').then(({ initAccordions }) => initAccordions()).catch(console.error);
}
