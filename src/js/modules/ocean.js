// Fondo de agua del pie: un shader WebGL con olas y reflejos. Solo se dibuja mientras está a la vista
// y, con movimiento reducido, se pinta un solo fotograma. Sin WebGL el pie queda con su degradado.

const FRAGMENTO = `#ifdef GL_FRAGMENT_PRECISION_HIGH
precision highp float;
#else
precision mediump float;
#endif
uniform vec2 r;uniform float t;
float h(vec2 p){p=mod(p,289.);vec3 q=fract(vec3(p.xyx)*.1031);q+=dot(q,q.yzx+33.33);return fract((q.x+q.y)*q.z);}
float n(vec2 p){vec2 i=floor(p),f=fract(p);f=f*f*(3.-2.*f);return mix(mix(h(i),h(i+vec2(1.,0.)),f.x),mix(h(i+vec2(0.,1.)),h(i+1.),f.x),f.y);}
float fbm(vec2 p){float v=0.,a=.5;for(int i=0;i<4;i++){v+=a*n(p);p=mat2(1.6,1.2,-1.2,1.6)*p;a*=.5;}return v;}
float H(vec2 p,float T){
  float w=sin(dot(p,vec2(.8,.6))*1.2+T*.9)*.42;
  w+=sin(dot(p,vec2(-.55,.84))*2.3+T*1.3)*.2;
  w+=sin(dot(p,vec2(.25,-.97))*3.9+T*1.8)*.09;
  w+=fbm(p*1.4+vec2(T*.3,T*.2))*.55;
  w+=fbm(p*4.2+vec2(-T*.5,T*.4))*.2;
  return w;
}
void main(){
  vec2 uv=gl_FragCoord.xy/r;
  float y=1.-uv.y;
  float z=1./(.18+y*.82);
  vec2 p=vec2((uv.x-.5)*(r.x/r.y)*z*1.2,z*3.2);
  float T=t*.85,e=.012*z;
  float hx=H(p+vec2(e,0.),T)-H(p-vec2(e,0.),T);
  float hy=H(p+vec2(0.,e),T)-H(p-vec2(0.,e),T);
  vec3 N=normalize(vec3(-hx/(2.*e)*.6,1.,-hy/(2.*e)*.6));
  vec3 V=normalize(vec3(0.,.42,-1.));
  vec3 R=reflect(-V,N);
  float fr=.04+.96*pow(1.-max(dot(N,V),0.),5.);
  vec3 deep=vec3(.05,.15,.19);
  vec3 sky=mix(vec3(.12,.3,.36),vec3(.42,.62,.68),clamp(R.y*1.4,0.,1.));
  vec3 col=mix(deep,sky,clamp(fr*2.4,0.,1.));
  vec3 L=normalize(vec3(-.25,.55,-.8));
  float sp=(pow(max(dot(R,L),0.),60.)*1.4+pow(max(dot(R,L),0.),8.)*.18)*(1.-y*.4);
  col+=vec3(.95,.98,1.)*sp*1.6;
  col=mix(col,vec3(.12,.27,.32),smoothstep(.15,.0,y)*.55);
  col*=.86+.14*smoothstep(1.3,.2,length((uv-.5)*vec2(1.,1.3)));
  gl_FragColor=vec4(col,1.);
}`;
const VERTICE = 'attribute vec2 a;void main(){gl_Position=vec4(a,0.,1.);}';

function compilar(gl, tipo, fuente) {
    const sombreador = gl.createShader(tipo);
    gl.shaderSource(sombreador, fuente);
    gl.compileShader(sombreador);
    return sombreador;
}

function crearOceano(contenedor) {
    const lienzo = document.createElement('canvas');
    const gl = lienzo.getContext('webgl', { antialias: false, alpha: false, preserveDrawingBuffer: true, powerPreference: 'low-power' });
    if (!gl) return;

    const programa = gl.createProgram();
    gl.attachShader(programa, compilar(gl, gl.VERTEX_SHADER, VERTICE));
    gl.attachShader(programa, compilar(gl, gl.FRAGMENT_SHADER, FRAGMENTO));
    gl.linkProgram(programa);
    if (!gl.getProgramParameter(programa, gl.LINK_STATUS)) return;

    contenedor.appendChild(lienzo);
    lienzo.className = 'block size-full';
    gl.useProgram(programa);
    gl.bindBuffer(gl.ARRAY_BUFFER, gl.createBuffer());
    gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1, -1, 3, -1, -1, 3]), gl.STATIC_DRAW);
    const posicion = gl.getAttribLocation(programa, 'a');
    gl.enableVertexAttribArray(posicion);
    gl.vertexAttribPointer(posicion, 2, gl.FLOAT, false, 0, 0);
    const uResolucion = gl.getUniformLocation(programa, 'r');
    const uTiempo = gl.getUniformLocation(programa, 't');

    const reducido = matchMedia('(prefers-reduced-motion: reduce)').matches;
    const inicio = performance.now() - 40000;
    let visible = false;
    let corriendo = false;

    const ajustar = () => {
        const densidad = Math.min(window.devicePixelRatio || 1, 1.5) * (innerWidth < 760 ? 0.75 : 1);
        const ancho = Math.max(1, Math.round(contenedor.clientWidth * densidad));
        const alto = Math.max(1, Math.round(contenedor.clientHeight * densidad));
        if (lienzo.width !== ancho || lienzo.height !== alto) {
            lienzo.width = ancho;
            lienzo.height = alto;
            gl.viewport(0, 0, ancho, alto);
        }
    };
    const dibujar = () => {
        gl.uniform2f(uResolucion, lienzo.width, lienzo.height);
        gl.uniform1f(uTiempo, (performance.now() - inicio) / 1000);
        gl.drawArrays(gl.TRIANGLES, 0, 3);
    };
    const bucle = () => {
        if (reducido || corriendo) return;
        corriendo = true;
        const fotograma = () => {
            if (!visible || !contenedor.isConnected) {
                corriendo = false;
                return;
            }
            dibujar();
            requestAnimationFrame(fotograma);
        };
        requestAnimationFrame(fotograma);
    };

    ajustar();
    new ResizeObserver(() => {
        ajustar();
        dibujar();
    }).observe(contenedor);
    new IntersectionObserver(
        (entradas) => {
            visible = entradas[0].isIntersecting;
            if (visible) bucle();
        },
        { rootMargin: '200px' },
    ).observe(contenedor);
    dibujar();
}

export function iniciarOceano() {
    document.querySelectorAll('[data-ocean]').forEach(crearOceano);
}
