(() => {
  'use strict';
  const doc = document;
  const raizSitio = doc.currentScript && doc.currentScript.src ? new URL('../../../', doc.currentScript.src).toString() : doc.baseURI;
  const meta = doc.querySelector('meta[name="facebook-page-url"]');
  const PAGINA = meta && meta.content ? meta.content : 'https://www.facebook.com/iestpmanuelarevalocaceres/';

  const montar = (contenedor) => {
    if (contenedor.querySelector('iframe')) return;
    const ancho = Math.round(Math.max(240, Math.min(500, contenedor.clientWidth || 420)));
    const alto = Math.round(Math.max(360, Math.min(800, parseInt(contenedor.getAttribute('data-fb-alto'), 10) || 560)));
    const marco = doc.createElement('iframe');
    marco.src = 'https://www.facebook.com/plugins/page.php?href=' + encodeURIComponent(PAGINA)
      + '&tabs=timeline&width=' + ancho + '&height=' + alto
      + '&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=false&lazy=true';
    marco.title = 'Publicaciones de la página oficial de Facebook del IESTP Manuel Arévalo Cáceres';
    marco.width = String(ancho);
    marco.height = String(alto);
    marco.loading = 'lazy';
    marco.setAttribute('allow', 'encrypted-media; picture-in-picture; web-share');
    marco.setAttribute('referrerpolicy', 'strict-origin-when-cross-origin');
    marco.style.height = alto + 'px';
    contenedor.dataset.fbAncho = String(ancho);
    contenedor.classList.add('esta-cargado', 'esta-cargando');
    const listo = () => contenedor.classList.remove('esta-cargando');
    marco.addEventListener('load', listo, { once: true });
    window.setTimeout(listo, 10000);
    contenedor.appendChild(marco);
  };

  const contenedores = Array.from(doc.querySelectorAll('[data-fb]'));
  contenedores.forEach(montar);
  let espera = 0;
  window.addEventListener('resize', () => {
    window.clearTimeout(espera);
    espera = window.setTimeout(() => {
      contenedores.forEach((contenedor) => {
        const nuevo = Math.round(Math.max(240, Math.min(500, contenedor.clientWidth || 420)));
        const actual = parseInt(contenedor.dataset.fbAncho, 10) || nuevo;
        if (Math.abs(nuevo - actual) < 40) return;
        const marco = contenedor.querySelector('iframe');
        if (marco) marco.remove();
        montar(contenedor);
      });
    }, 350);
  });

  const rejilla = doc.querySelector('[data-fotos-fb]');
  if (!rejilla) return;
  fetch(new URL('redes-sociales/fotos-facebook.php', raizSitio).toString(), { headers: { Accept: 'application/json' }, cache: 'no-store' })
    .then((r) => r.json())
    .then((datos) => {
      if (!datos || datos.configured !== true || !Array.isArray(datos.photos)) return;
      datos.photos.slice(0, 6).forEach((foto, i) => {
        if (!foto || typeof foto.url !== 'string' || foto.url.indexOf('https://') !== 0) return;
        const enlace = doc.createElement('a');
        enlace.className = 'foto-fb es-nuevo';
        enlace.style.setProperty('--i', String(i));
        enlace.href = typeof foto.link === 'string' && foto.link.indexOf('https://') === 0 ? foto.link : PAGINA;
        enlace.target = '_blank';
        enlace.rel = 'noopener noreferrer';
        const titulo = (foto.title || 'Fotografía publicada en Facebook').trim();
        enlace.setAttribute('aria-label', titulo + ' (se abre Facebook en una pestaña nueva)');
        const imagen = doc.createElement('img');
        imagen.src = foto.url;
        imagen.alt = '';
        imagen.loading = 'lazy';
        imagen.decoding = 'async';
        imagen.addEventListener('error', () => enlace.remove(), { once: true });
        if (typeof window.macImagen === 'function') window.macImagen(imagen);
        enlace.appendChild(imagen);
        rejilla.appendChild(enlace);
      });
    })
    .catch(() => {});
})();
