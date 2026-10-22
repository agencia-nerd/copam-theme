// Cursor personalizado: un aro blanco (mezcla "difference") que sigue al puntero con inercia, crece sobre
// enlaces y botones, se encoge al presionar y suelta un destello verde al hacer clic.
// Solo con mouse (hover fino) y sin "reducir movimiento".

const VERDE = '#1FB45A';
const EASE_OUT = 'cubic-bezier(.22,1,.36,1)';

function capa(css) {
    const el = document.createElement('div');
    el.setAttribute('aria-hidden', 'true');
    el.style.cssText = `position:fixed;left:0;top:0;pointer-events:none;z-index:9999;${css}`;
    document.body.appendChild(el);
    return el;
}

export function iniciarCursor() {
    if (!matchMedia('(hover: hover) and (pointer: fine)').matches) return;
    if (matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const aro = capa('width:30px;height:30px;margin:-15px 0 0 -15px;border-radius:50%;border:1.5px solid #fff;box-sizing:border-box;mix-blend-mode:difference;will-change:transform;transform:translate3d(-100px,-100px,0) scale(0)');
    const efectos = capa('width:0;height:0');

    let x = -100;
    let y = -100;
    let cx = x;
    let cy = y;
    let escala = 0;
    let escalaMeta = 0;
    let presion = 1;
    let visto = false;

    const bucle = () => {
        cx += (x - cx) * 0.2;
        cy += (y - cy) * 0.2;
        escala += (escalaMeta * presion - escala) * 0.18;
        aro.style.transform = `translate3d(${cx.toFixed(2)}px,${cy.toFixed(2)}px,0) scale(${escala.toFixed(3)})`;
        requestAnimationFrame(bucle);
    };

    window.addEventListener(
        'mousemove',
        (e) => {
            x = e.clientX;
            y = e.clientY;
            if (!visto) {
                visto = true;
                cx = x;
                cy = y;
            }
            escalaMeta = e.target.closest?.('a,button,input,[role=button]') ? 1.2 : 1;
        },
        { passive: true },
    );
    document.addEventListener('mouseleave', () => (escalaMeta = 0));
    window.addEventListener('mouseup', () => (presion = 1));
    window.addEventListener('mousedown', (e) => {
        presion = 0.6;
        const anillo = document.createElement('div');
        anillo.style.cssText = `position:fixed;left:${e.clientX}px;top:${e.clientY}px;width:44px;height:44px;margin:-22px 0 0 -22px;border-radius:50%;border:1.5px solid ${VERDE};box-sizing:border-box;pointer-events:none`;
        efectos.appendChild(anillo);
        anillo.animate([{ transform: 'scale(.3)', opacity: 1 }, { transform: 'scale(1.2)', opacity: 1, offset: 0.55 }, { transform: 'scale(1.6)', opacity: 0 }], { duration: 750, easing: EASE_OUT, fill: 'forwards' });

        for (let i = 0; i < 7; i++) {
            const angulo = (i / 7) * Math.PI * 2 + Math.random() * 0.4;
            const radio = 26 + Math.random() * 14;
            const particula = document.createElement('div');
            particula.style.cssText = `position:fixed;left:${e.clientX}px;top:${e.clientY}px;width:3px;height:3px;margin:-1.5px 0 0 -1.5px;border-radius:50%;background:${VERDE};pointer-events:none`;
            efectos.appendChild(particula);
            particula.animate([{ transform: 'translate(0,0) scale(1)' }, { transform: `translate(${(Math.cos(angulo) * radio).toFixed(1)}px,${(Math.sin(angulo) * radio).toFixed(1)}px) scale(.4)`, opacity: 0 }], { duration: 700, easing: EASE_OUT, fill: 'forwards' });
        }
        setTimeout(() => {
            anillo.remove();
            efectos.querySelectorAll('div').forEach((n) => n.getAnimations().every((a) => a.playState === 'finished') && n.remove());
        }, 800);
    });

    requestAnimationFrame(bucle);
}
