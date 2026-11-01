(() => {
  'use strict';
  const doc = document;
  const html = doc.documentElement;
  const urlScript = doc.currentScript && doc.currentScript.src ? doc.currentScript.src : new URL('recursos/scripts/sitio.js', doc.baseURI).toString();
  const reducir = window.matchMedia('(prefers-reduced-motion: reduce)');
  const escritorio = window.matchMedia('(min-width: 1180px)');
  const puntero = window.matchMedia('(hover: hover) and (pointer: fine)');

  const animado = () => html.classList.contains('anim') && !reducir.matches;
  const reiniciar = (el, clase) => {
    el.classList.remove(clase);
    void el.offsetWidth;
    el.classList.add(clase);
  };

  const alCambiar = (consulta, fn) => {
    if (typeof consulta.addEventListener === 'function') consulta.addEventListener('change', fn);
    else if (typeof consulta.addListener === 'function') consulta.addListener(fn);
  };

  const navegacion = () => {
    const cabecera = doc.querySelector('[data-cabecera]');
    const nav = doc.querySelector('[data-navegacion]');
    const boton = doc.querySelector('[data-menu-boton]');
    if (!cabecera || !nav) return;
    const items = Array.from(nav.querySelectorAll('[data-submenu]'));
    const textoBoton = boton ? boton.querySelector('.menu-boton-texto') : null;

    const cerrar = (item, enfocar) => {
      const b = item.querySelector('button');
      item.classList.remove('abierto');
      delete item.dataset.porPuntero;
      b.setAttribute('aria-expanded', 'false');
      if (enfocar) b.focus();
    };
    const abrir = (item) => {
      items.forEach((otro) => { if (otro !== item) cerrar(otro); });
      item.classList.add('abierto');
      item.querySelector('button').setAttribute('aria-expanded', 'true');
    };
    const cerrarTodos = () => items.forEach((item) => cerrar(item));
    items.forEach((item) => {
      item.querySelectorAll('.submenu li, .submenu .submenu-grupo').forEach((el, i) => el.style.setProperty('--i', String(Math.min(i, 12))));
    });
    nav.querySelectorAll('.nav-lista > .nav-item').forEach((el, i) => el.style.setProperty('--i', String(i)));

    items.forEach((item) => {
      const b = item.querySelector('button');
      let espera = 0;
      b.addEventListener('click', () => {
        if (item.dataset.porPuntero === '1') { delete item.dataset.porPuntero; return; }
        if (item.classList.contains('abierto')) cerrar(item); else abrir(item);
      });
      item.addEventListener('mouseenter', () => {
        if (!escritorio.matches || !puntero.matches) return;
        window.clearTimeout(espera);
        if (!item.classList.contains('abierto')) { abrir(item); item.dataset.porPuntero = '1'; }
      });
      item.addEventListener('mouseleave', () => {
        if (!escritorio.matches || !puntero.matches) return;
        espera = window.setTimeout(() => cerrar(item), 200);
      });
      item.addEventListener('focusout', (e) => {
        if (escritorio.matches && !item.contains(e.relatedTarget)) cerrar(item);
      });
      item.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && item.classList.contains('abierto')) {
          e.stopPropagation();
          cerrar(item, true);
        }
      });
    });

    const fondo = () => Array.from(doc.body.children).filter((el) => el !== cabecera && !el.matches('script, dialog'));
    const menu = (abierto) => {
      if (!boton) return;
      boton.setAttribute('aria-expanded', String(abierto));
      if (textoBoton) textoBoton.textContent = abierto ? 'Cerrar' : 'Menú';
      boton.setAttribute('aria-label', abierto ? 'Cerrar el menú' : 'Abrir el menú');
      if (abierto) {
        const barra = cabecera.querySelector('.barra');
        const borde = barra ? barra.getBoundingClientRect().bottom : 0;
        nav.style.setProperty('--nav-top', Math.max(0, Math.round(borde)) + 'px');
      }
      nav.classList.toggle('abierta', abierto);
      html.classList.toggle('menu-abierto', abierto);
      fondo().forEach((el) => { if (abierto) el.setAttribute('inert', ''); else el.removeAttribute('inert'); });
    };
    if (boton) {
      boton.setAttribute('aria-label', 'Abrir el menú');
      boton.addEventListener('click', () => menu(boton.getAttribute('aria-expanded') !== 'true'));
    }
    nav.addEventListener('click', (e) => {
      if (e.target.closest('a') && !escritorio.matches) menu(false);
    });
    doc.addEventListener('keydown', (e) => {
      if (e.key !== 'Escape') return;
      if (nav.classList.contains('abierta')) { menu(false); if (boton) boton.focus(); }
      else cerrarTodos();
    });
    doc.addEventListener('click', (e) => {
      if (escritorio.matches && !e.target.closest('[data-submenu]')) cerrarTodos();
    });
    alCambiar(escritorio, () => { menu(false); cerrarTodos(); });
  };

  const desplazamiento = () => {
    const cabecera = doc.querySelector('[data-cabecera]');
    const flotante = doc.querySelector('[data-flotante]');
    const progreso = doc.createElement('div');
    progreso.className = 'progreso';
    progreso.setAttribute('aria-hidden', 'true');
    doc.body.appendChild(progreso);
    let pendiente = false;
    const actualizar = () => {
      pendiente = false;
      const y = window.scrollY || window.pageYOffset;
      const maximo = html.scrollHeight - window.innerHeight;
      progreso.style.transform = 'scaleX(' + (maximo > 0 ? Math.min(1, y / maximo) : 0) + ')';
      if (cabecera) cabecera.classList.toggle('con-sombra', y > 40);
      if (flotante) flotante.classList.toggle('es-visible', y > 640);
    };
    window.addEventListener('scroll', () => {
      if (pendiente) return;
      pendiente = true;
      window.requestAnimationFrame(actualizar);
    }, { passive: true });
    actualizar();
  };

  const menuSeccion = () => {
    const actual = doc.querySelector('.menu-seccion a[aria-current="page"]');
    if (!actual) return;
    const lista = actual.closest('ul');
    if (lista && lista.scrollWidth > lista.clientWidth) {
      lista.scrollLeft = Math.max(0, actual.offsetLeft - 16);
    }
  };

  const curiosidades = () => {
    doc.querySelectorAll('[data-dato]').forEach((caja) => {
      const lista = caja.querySelector('[data-dato-lista]');
      const contador = caja.querySelector('[data-dato-contador]');
      const anterior = caja.querySelector('[data-dato-anterior]');
      const siguiente = caja.querySelector('[data-dato-siguiente]');
      if (!lista || !anterior || !siguiente) return;
      const textos = Array.from(lista.querySelectorAll('li')).map((li) => li.textContent.trim());
      if (textos.length < 2) return;
      const salida = doc.createElement('p');
      salida.className = 'dato-texto';
      salida.setAttribute('aria-live', 'polite');
      lista.after(salida);
      lista.hidden = true;
      let indice = 0;
      const mostrar = (n, animar, sentido) => {
        indice = (n + textos.length) % textos.length;
        salida.style.setProperty('--desde-x', (sentido < 0 ? -16 : 16) + 'px');
        salida.textContent = textos[indice];
        if (contador) contador.textContent = (indice + 1) + ' de ' + textos.length;
        if (animar && !reducir.matches) reiniciar(salida, 'es-nuevo');
      };
      anterior.addEventListener('click', () => mostrar(indice - 1, true, -1));
      siguiente.addEventListener('click', () => mostrar(indice + 1, true, 1));
      mostrar(0, false);
    });
  };

  const perfiles = () => {
    const raiz = doc.querySelector('[data-perfiles]');
    if (!raiz) return;
    const lista = raiz.querySelector('[data-perfiles-pestanas]');
    const pestanas = Array.from(raiz.querySelectorAll('[data-perfil]'));
    const paneles = Array.from(raiz.querySelectorAll('[data-perfil-panel]'));
    if (!lista || !pestanas.length || pestanas.length !== paneles.length) return;
    const CLAVE = 'mac_perfil_v1';
    lista.setAttribute('role', 'tablist');
    lista.setAttribute('aria-label', 'Accesos según tu perfil');
    pestanas.forEach((boton, i) => {
      const panel = paneles[i];
      boton.id = 'pestana-' + boton.getAttribute('data-perfil');
      boton.setAttribute('role', 'tab');
      boton.setAttribute('aria-controls', panel.id);
      panel.setAttribute('role', 'tabpanel');
      panel.setAttribute('aria-labelledby', boton.id);
    });
    const indicador = doc.createElement('span');
    indicador.className = 'perfiles-indicador';
    indicador.setAttribute('aria-hidden', 'true');
    lista.prepend(indicador);
    lista.classList.add('con-indicador');
    const ubicar = () => {
      const activa = pestanas.find((b) => b.getAttribute('aria-selected') === 'true');
      if (!activa) return;
      indicador.style.width = activa.offsetWidth + 'px';
      indicador.style.height = activa.offsetHeight + 'px';
      indicador.style.transform = 'translate(' + activa.offsetLeft + 'px, ' + activa.offsetTop + 'px)';
    };
    const indiceDe = (clave) => pestanas.findIndex((b) => b.getAttribute('data-perfil') === clave);
    const desdeHash = () => {
      const coincide = /^#perfil-([a-z]+)$/.exec(window.location.hash || '');
      return coincide ? indiceDe(coincide[1]) : -1;
    };
    const elegir = (indice, enfocar, guardar) => {
      pestanas.forEach((boton, i) => {
        const activa = i === indice;
        boton.setAttribute('aria-selected', String(activa));
        boton.tabIndex = activa ? 0 : -1;
        paneles[i].hidden = !activa;
      });
      ubicar();
      if (enfocar) pestanas[indice].focus();
      if (guardar) {
        try { window.localStorage.setItem(CLAVE, pestanas[indice].getAttribute('data-perfil')); } catch (error) { }
      }
    };
    paneles.forEach((panel) => {
      panel.querySelectorAll('.perfil-enlaces > li').forEach((li, i) => li.style.setProperty('--i', String(i)));
    });
    let inicial = desdeHash();
    const porHash = inicial >= 0;
    if (!porHash) {
      try { inicial = indiceDe(window.localStorage.getItem(CLAVE) || ''); } catch (error) { inicial = -1; }
    }
    elegir(inicial < 0 ? 0 : inicial, false, false);
    raiz.classList.add('esta-listo');
    window.requestAnimationFrame(() => { ubicar(); lista.classList.add('indicador-listo'); });
    if (typeof window.ResizeObserver === 'function') {
      const observador = new window.ResizeObserver(ubicar);
      pestanas.forEach((boton) => observador.observe(boton));
    } else {
      window.addEventListener('resize', ubicar);
    }
    if (doc.fonts && doc.fonts.ready) doc.fonts.ready.then(ubicar);
    if (porHash) window.requestAnimationFrame(() => raiz.scrollIntoView({ block: 'start' }));
    pestanas.forEach((boton, i) => {
      boton.addEventListener('click', () => elegir(i, false, true));
      boton.addEventListener('keydown', (e) => {
        let destino = -1;
        if (e.key === 'ArrowRight' || e.key === 'ArrowDown') destino = (i + 1) % pestanas.length;
        else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') destino = (i - 1 + pestanas.length) % pestanas.length;
        else if (e.key === 'Home') destino = 0;
        else if (e.key === 'End') destino = pestanas.length - 1;
        if (destino < 0) return;
        e.preventDefault();
        elegir(destino, true, true);
      });
    });
    window.addEventListener('hashchange', () => {
      const indice = desdeHash();
      if (indice < 0) return;
      elegir(indice, false, true);
      raiz.scrollIntoView({ block: 'start', behavior: reducir.matches ? 'auto' : 'smooth' });
    });
  };

  const visor = () => {
    const dialogo = doc.querySelector('[data-visor]');
    const enlaces = doc.querySelectorAll('[data-zoom]');
    if (!dialogo || !enlaces.length || typeof dialogo.showModal !== 'function') return;
    const imagen = dialogo.querySelector('[data-visor-imagen]');
    const abrirAparte = dialogo.querySelector('[data-visor-enlace]');
    const cerrar = dialogo.querySelector('[data-visor-cerrar]');
    enlaces.forEach((enlace) => {
      enlace.addEventListener('click', (e) => {
        e.preventDefault();
        const miniatura = enlace.querySelector('img');
        imagen.classList.remove('img-lista');
        imagen.classList.add('img-cargando');
        imagen.src = enlace.getAttribute('href');
        imagen.alt = miniatura ? miniatura.alt : '';
        abrirAparte.href = enlace.getAttribute('href');
        dialogo.showModal();
        if (cerrar) cerrar.focus();
      });
    });
    if (cerrar) cerrar.addEventListener('click', () => dialogo.close());
    dialogo.addEventListener('click', (e) => { if (e.target === dialogo) dialogo.close(); });
    const listo = () => {
      imagen.classList.remove('img-cargando');
      if (animado() && imagen.naturalWidth > 0) reiniciar(imagen, 'img-lista');
    };
    imagen.addEventListener('load', listo);
    imagen.addEventListener('error', listo);
    dialogo.addEventListener('close', () => {
      window.setTimeout(() => { if (!dialogo.open) imagen.removeAttribute('src'); }, 350);
    });
  };

  const registros = () => {
    doc.querySelectorAll('[data-registro]').forEach((registro) => {
      const caja = registro.querySelector('[data-registro-buscar]');
      const resumen = registro.querySelector('[data-registro-resumen]');
      const filtros = Array.from(registro.querySelectorAll('[data-filtro]'));
      const items = Array.from(registro.querySelectorAll('.registro-item'));
      const grupos = Array.from(registro.querySelectorAll('.registro-grupo'));
      const archivo = registro.querySelector('.registro-archivo');
      if (!caja && !filtros.length) return;
      const normalizar = (texto) => (texto || '').toLowerCase().normalize('NFD').replace(/[̀-ͯ]/g, '');
      const textos = items.map((item) => normalizar(item.textContent));
      let categoria = 'todas';
      const aplicar = () => {
        const consulta = normalizar(caja ? caja.value.trim() : '');
        let visibles = 0;
        let enArchivo = 0;
        const nuevos = [];
        items.forEach((item, i) => {
          const mostrar = (categoria === 'todas' || item.getAttribute('data-categoria') === categoria) && (consulta === '' || textos[i].indexOf(consulta) !== -1);
          if (mostrar && item.hidden) nuevos.push(item);
          item.hidden = !mostrar;
          if (mostrar) {
            visibles += 1;
            if (archivo && archivo.contains(item)) enArchivo += 1;
          }
        });
        grupos.forEach((grupo) => { grupo.hidden = !grupo.querySelector('.registro-item:not([hidden])'); });
        if (nuevos.length && animado()) {
          nuevos.forEach((item) => item.classList.remove('es-filtrado'));
          void registro.offsetWidth;
          nuevos.forEach((item, n) => {
            item.classList.add('es-visible', 'es-filtrado');
            item.style.setProperty('--i', String(Math.min(n, 8)));
          });
        }
        const filtrando = consulta !== '' || categoria !== 'todas';
        if (archivo && filtrando && enArchivo > 0) archivo.open = true;
        if (!resumen) return;
        const previo = resumen.textContent;
        if (!filtrando) resumen.textContent = '';
        else if (visibles === 0) resumen.textContent = 'Ningún documento coincide. Prueba con otra palabra o elige «Todos».';
        else resumen.textContent = visibles === 1 ? '1 documento coincide con tu búsqueda.' : visibles + ' documentos coinciden con tu búsqueda.';
        if (resumen.textContent !== previo && animado()) reiniciar(resumen, 'es-nuevo');
      };
      if (caja) caja.addEventListener('input', aplicar);
      filtros.forEach((boton) => {
        boton.addEventListener('click', () => {
          categoria = boton.getAttribute('data-filtro') || 'todas';
          filtros.forEach((otro) => otro.setAttribute('aria-pressed', otro === boton ? 'true' : 'false'));
          aplicar();
        });
      });
    });
  };

  const formularios = () => {
    const correo = 'informes@iestp-mac.edu.pe';
    doc.querySelectorAll('form[data-formulario]').forEach((form) => {
      const estado = form.querySelector('[data-form-estado]');
      const enviar = form.querySelector('button[type="submit"]');
      const textoEnviar = enviar ? enviar.textContent : '';
      const mostrar = (tipo, mensaje, alternativa) => {
        if (!estado) return;
        estado.className = 'form-estado' + (tipo ? ' es-' + tipo : '');
        estado.textContent = mensaje;
        if (animado()) reiniciar(estado, 'es-nuevo');
        if (alternativa) {
          estado.append(' ');
          const enlace = doc.createElement('a');
          enlace.href = 'mailto:' + correo + '?subject=' + encodeURIComponent(alternativa.asunto) + '&body=' + encodeURIComponent(alternativa.cuerpo);
          enlace.textContent = 'Escribir a ' + correo;
          estado.append(enlace);
        }
      };
      let sacudido = false;
      form.addEventListener('invalid', (e) => {
        if (sacudido || !animado()) return;
        sacudido = true;
        window.setTimeout(() => { sacudido = false; }, 0);
        const caja = e.target.closest('.campo, .form-consentimiento') || e.target;
        reiniciar(caja, 'sacude');
        caja.addEventListener('animationend', () => caja.classList.remove('sacude'), { once: true });
      }, true);
      form.addEventListener('submit', (e) => {
        e.preventDefault();
        if (!form.reportValidity()) return;
        const datos = new FormData(form);
        const alternativa = {
          asunto: 'Consulta institucional IESTP MAC',
          cuerpo: ['Nombre: ' + String(datos.get('nombre') || '').trim(), 'Correo electrónico: ' + String(datos.get('correo') || '').trim(), '', String(datos.get('mensaje') || '').trim()].join('\n'),
        };
        if (enviar) {
          enviar.disabled = true;
          enviar.classList.add('esta-enviando');
          enviar.textContent = 'Enviando…';
        }
        mostrar('', 'Enviando tu consulta…');
        fetch(form.action, { method: 'POST', body: datos, credentials: 'same-origin', headers: { Accept: 'text/html' } })
          .then((respuesta) => {
            if (respuesta.ok) {
              mostrar('exito', 'Consulta enviada. El instituto te responderá al correo que indicaste.');
              form.reset();
            } else if (respuesta.status === 503 && respuesta.headers.get('X-Formulario-Estado') === 'no-disponible') {
              mostrar('error', 'El envío no está disponible por el momento. Inténtalo más tarde o escríbenos directamente.', alternativa);
            } else if (respuesta.status === 503) {
              mostrar('error', 'El formulario está validado, pero el correo del servidor aún no está habilitado.', alternativa);
            } else if (respuesta.status === 403) {
              mostrar('error', 'La sesión del formulario venció. Recarga la página y envía la consulta otra vez.');
            } else if (respuesta.status === 429) {
              mostrar('error', 'Alcanzaste el límite de envíos de esta sesión. Espera unos minutos e inténtalo de nuevo.');
            } else if (respuesta.status === 422) {
              mostrar('error', 'Revisa que el nombre, el correo, el mensaje y la autorización estén completos.');
            } else {
              mostrar('error', 'No se pudo enviar la consulta.', alternativa);
            }
          })
          .catch(() => mostrar('error', 'No hay conexión con el servidor.', alternativa))
          .finally(() => {
            if (!enviar) return;
            enviar.disabled = false;
            enviar.classList.remove('esta-enviando');
            enviar.textContent = textoEnviar;
          });
      });
    });
  };

  const privacidad = () => {
    const CLAVE = 'mac_privacy_preferences_v1';
    const VERSION = 1;
    const banda = doc.getElementById('privacy-banner');
    const dialogo = doc.getElementById('privacy-dialog');
    const casilla = doc.getElementById('privacy-external');
    let enMemoria = null;
    let cargado = false;

    const leer = () => {
      try {
        const crudo = window.localStorage.getItem(CLAVE);
        if (!crudo) return null;
        const guardado = JSON.parse(crudo);
        if (!guardado || guardado.version !== VERSION || typeof guardado.external !== 'boolean') return null;
        return guardado;
      } catch (error) { return null; }
    };
    const guardar = (externo) => {
      const valor = { version: VERSION, external: Boolean(externo), savedAt: new Date().toISOString() };
      enMemoria = valor;
      try { window.localStorage.setItem(CLAVE, JSON.stringify(valor)); } catch (error) { enMemoria = valor; }
      window.MAC_PRIVACY_CONSENT = { external: valor.external };
      return valor;
    };
    const cargarExterno = () => {
      if (cargado) return;
      cargado = true;
      doc.querySelectorAll('[data-consentimiento]').forEach((el) => { el.hidden = true; });
      const archivos = [];
      if (doc.querySelector('[data-fb], [data-fotos-fb]')) archivos.push('integraciones/facebook.js');
      if (doc.querySelector('[data-youtube-videos]')) archivos.push('integraciones/youtube.js');
      archivos.forEach((archivo) => {
        const script = doc.createElement('script');
        const destino = new URL(archivo, urlScript);
        destino.search = new URL(urlScript).search;
        script.src = destino.toString();
        script.async = true;
        script.addEventListener('error', () => {
          doc.querySelectorAll('[data-consentimiento]').forEach((el) => { el.hidden = false; });
        }, { once: true });
        doc.body.appendChild(script);
      });
    };
    const abrir = () => {
      if (!dialogo) return;
      const actual = enMemoria || leer();
      if (casilla) casilla.checked = Boolean(actual && actual.external);
      if (typeof dialogo.showModal === 'function') dialogo.showModal();
      else dialogo.setAttribute('open', '');
    };
    const cerrar = () => {
      if (!dialogo) return;
      if (typeof dialogo.close === 'function' && dialogo.open) dialogo.close();
      else dialogo.removeAttribute('open');
    };
    const ocultarBanda = () => {
      if (!banda || banda.hidden) return;
      if (!animado()) { banda.hidden = true; return; }
      banda.classList.add('saliendo');
      window.setTimeout(() => { banda.hidden = true; banda.classList.remove('saliendo'); }, 320);
    };
    const aplicar = (externo) => {
      const antes = enMemoria || leer();
      const ahora = guardar(externo);
      ocultarBanda();
      cerrar();
      if (ahora.external) cargarExterno();
      else if (antes && antes.external) window.location.reload();
    };

    doc.querySelectorAll('[data-consent-necessary]').forEach((b) => b.addEventListener('click', () => aplicar(false)));
    doc.querySelectorAll('[data-consent-external]').forEach((b) => b.addEventListener('click', () => {
      if (casilla) casilla.checked = true;
      aplicar(true);
    }));
    doc.querySelectorAll('[data-consent-save]').forEach((b) => b.addEventListener('click', () => aplicar(Boolean(casilla && casilla.checked))));
    doc.querySelectorAll('[data-open-privacy-settings]').forEach((b) => b.addEventListener('click', abrir));
    doc.querySelectorAll('[data-privacy-dialog-close]').forEach((b) => b.addEventListener('click', cerrar));
    if (dialogo) dialogo.addEventListener('click', (e) => { if (e.target === dialogo) cerrar(); });

    enMemoria = leer();
    window.MAC_PRIVACY_CONSENT = { external: Boolean(enMemoria && enMemoria.external) };
    if (enMemoria) {
      if (banda) banda.hidden = true;
      if (enMemoria.external) cargarExterno();
    } else if (banda) {
      banda.hidden = false;
    }
  };

  const prepararImagen = (img) => {
    if (!img || img.dataset.macImg === '1') return;
    img.dataset.macImg = '1';
    if (img.complete) return;
    img.classList.add('img-cargando');
    const listo = () => {
      if (!img.classList.contains('img-cargando')) return;
      img.classList.remove('img-cargando');
      if (animado() && img.naturalWidth > 0) img.classList.add('img-lista');
    };
    img.addEventListener('load', listo, { once: true });
    img.addEventListener('error', listo, { once: true });
  };
  const imagenes = () => {
    doc.querySelectorAll('main img').forEach(prepararImagen);
    window.macImagen = prepararImagen;
  };

  const ondas = () => {
    const SELECTOR = '.boton, .filtro, .perfiles-pestanas button, .dato-controles button, .flotante, .menu-boton, .nav-enlace-destacado';
    doc.addEventListener('pointerdown', (e) => {
      if (!animado() || e.button !== 0) return;
      const el = e.target instanceof Element ? e.target.closest(SELECTOR) : null;
      if (!el || el.disabled || el.classList.contains('esta-enviando')) return;
      const caja = el.getBoundingClientRect();
      const tam = Math.ceil(Math.hypot(caja.width, caja.height) * 2);
      const onda = doc.createElement('span');
      onda.className = 'onda';
      onda.setAttribute('aria-hidden', 'true');
      onda.style.width = tam + 'px';
      onda.style.height = tam + 'px';
      onda.style.left = Math.round(e.clientX - caja.left - tam / 2) + 'px';
      onda.style.top = Math.round(e.clientY - caja.top - tam / 2) + 'px';
      el.appendChild(onda);
      onda.addEventListener('animationend', () => onda.remove(), { once: true });
      window.setTimeout(() => onda.remove(), 1200);
    }, { passive: true });
  };

  const cargaPagina = () => {
    const barra = doc.createElement('div');
    barra.className = 'carga-barra';
    barra.setAttribute('aria-hidden', 'true');
    doc.body.appendChild(barra);
    let capa = null;
    let espera = 0;
    let seguro = 0;
    const repetir = (n, clase) => Array.from({ length: n }, () => '<span class="esqueleto ' + clase + '"></span>').join('');
    const plantilla = (portada) => portada
      ? '<div class="carga-muro"><div class="contenedor">' + repetir(2, 'esq-titulo') + repetir(1, 'esq-texto') + '</div></div>'
        + '<div class="contenedor carga-cuerpo">' + Array.from({ length: 3 }, () => '<div class="carga-contenido"><span class="esqueleto esq-bloque"></span>' + repetir(3, 'esq-linea') + '</div>').join('') + '</div>'
      : '<div class="carga-muro"><div class="contenedor">' + repetir(1, 'esq-migas') + repetir(1, 'esq-titulo') + repetir(1, 'esq-texto') + '</div></div>'
        + '<div class="contenedor carga-cuerpo"><div class="carga-lateral">' + repetir(5, '') + '</div><div class="carga-contenido"><span class="esqueleto esq-bloque"></span>' + repetir(8, 'esq-linea') + '</div></div>';
    const limpiar = () => {
      window.clearTimeout(espera);
      window.clearTimeout(seguro);
      html.classList.remove('navegando');
      if (capa) { capa.remove(); capa = null; }
      const principal = doc.getElementById('contenido');
      if (principal) principal.removeAttribute('aria-busy');
    };
    const mostrar = (destino) => {
      limpiar();
      html.classList.add('navegando');
      const portada = /(?:^|\/)(?:index\.php)?$/.test(destino.pathname);
      espera = window.setTimeout(() => {
        const cabecera = doc.querySelector('[data-cabecera]');
        const borde = cabecera ? Math.max(0, Math.round(cabecera.getBoundingClientRect().bottom)) : 0;
        capa = doc.createElement('div');
        capa.className = 'carga-pagina' + (portada ? ' carga-portada' : '');
        capa.setAttribute('aria-hidden', 'true');
        capa.style.setProperty('--carga-top', borde + 'px');
        capa.innerHTML = plantilla(portada);
        doc.body.appendChild(capa);
        const principal = doc.getElementById('contenido');
        if (principal) principal.setAttribute('aria-busy', 'true');
      }, 180);
      seguro = window.setTimeout(limpiar, 12000);
    };
    doc.addEventListener('click', (e) => {
      if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
      const enlace = e.target instanceof Element ? e.target.closest('a[href]') : null;
      if (!enlace || enlace.hasAttribute('download') || enlace.hasAttribute('data-sin-carga')) return;
      const objetivo = (enlace.getAttribute('target') || '').toLowerCase();
      if (objetivo && objetivo !== '_self') return;
      let destino;
      try { destino = new URL(enlace.href, doc.baseURI); } catch (error) { return; }
      if (destino.origin !== window.location.origin || !/^https?:$/.test(destino.protocol)) return;
      if (destino.pathname === window.location.pathname && destino.search === window.location.search) return;
      if (!/(?:\/|\.php|\.html?)$/i.test(destino.pathname)) return;
      mostrar(destino);
    });
    window.addEventListener('pageshow', limpiar);
  };

  const revelar = () => {
    if (!animado() || typeof window.IntersectionObserver !== 'function') return;
    const SELECTOR = [
      'main .seccion-cabeza', 'main .programa', 'main .noticia', 'main .publicacion', 'main .lateral',
      'main .modalidades > div', 'main .requisitos', 'main .banda-matricula', 'main .linea-tiempo > li',
      'main .dato', 'main .ficha', 'main .red', 'main .datos-contacto > li', 'main .formulario',
      '.pagina-contenido > h2', '.pagina-contenido > .foto', '.pagina-contenido > .figura-documento',
      '.pagina-contenido > .figuras-par > *', '.pagina-contenido > .aviso', '.pagina-contenido > .vacio',
      '.pagina-contenido > .con-recorte', '.pagina-contenido > .galeria > *', '.pagina-contenido > .columnas-dos > *',
      '.pagina-contenido > .ayuda', 'main .panel', 'main .registro-item', 'main .plana-direccion', 'main .plana-persona',
      'main .pasos > li', 'main .etapas > li', 'main .lista-enlaces > li', 'main .acordeon > details',
      'main .contacto-canal', 'main .definiciones > div', 'main .indice-tramites > li', 'main .fotos-sede > *',
    ].join(', ');
    const candidatos = Array.from(doc.querySelectorAll(SELECTOR)).filter((el) => !(el.parentElement && el.parentElement.closest(SELECTOR)));
    const alto = window.innerHeight || html.clientHeight;
    const fuera = candidatos.filter((el) => {
      const caja = el.getBoundingClientRect();
      return !(caja.bottom > 0 && caja.top < alto) || (caja.width === 0 && caja.height === 0);
    });
    const observador = new window.IntersectionObserver((entradas) => {
      entradas.filter((entrada) => entrada.isIntersecting).forEach((entrada, i) => {
        const el = entrada.target;
        observador.unobserve(el);
        el.style.setProperty('--retraso', (Math.min(i, 6) * 70) + 'ms');
        el.classList.add('es-visible');
        el.addEventListener('transitionend', () => el.style.removeProperty('--retraso'), { once: true });
      });
    }, { rootMargin: '0px 0px -6% 0px', threshold: 0 });
    fuera.forEach((el) => {
      el.classList.add('revelar');
      observador.observe(el);
    });
    window.addEventListener('beforeprint', () => fuera.forEach((el) => el.classList.add('es-visible')));
  };

  const iniciar = () => {
    [imagenes, navegacion, desplazamiento, menuSeccion, curiosidades, perfiles, visor, registros, formularios, ondas, cargaPagina, privacidad, revelar].forEach((fn) => {
      try { fn(); } catch (error) { if (window.console) window.console.error(error); }
    });
  };
  if (doc.readyState === 'loading') doc.addEventListener('DOMContentLoaded', iniciar);
  else iniciar();
})();
