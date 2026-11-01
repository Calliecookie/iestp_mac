<?php
$titulo = 'Inicio';
$activo = 'inicio';
$raiz = '';
require_once __DIR__ . '/configuracion/arranque.php';
$csrfToken = mac_csrf_token();
require __DIR__ . '/plantillas/cabecera.php';

$programas = [
    ['Desarrollo de Sistemas de Información', 'Aprende a analizar necesidades y a construir soluciones digitales y sistemas de información.', 'paginas/programas-de-estudio/desarrollo-sistemas.php', '', '', 'pantalla'],
    ['Enfermería Técnica', 'Desarrolla competencias para apoyar el cuidado integral y humanizado de las personas.', 'paginas/programas-de-estudio/enfermeria-tecnica.php', '', '', 'salud'],
    ['Industria de Alimentos y Bebidas', 'Aprende procesos de elaboración, conservación y control de calidad de alimentos.', 'paginas/programas-de-estudio/industria-alimentos.php', '', '', 'alimentos'],
];
$noticiasRecientes = mac_noticias_html(3);
$publicacionesRecientes = mac_publicaciones_html(4);
?>
<main id="contenido" tabindex="-1">
  <section class="portada" aria-labelledby="portada-titulo">
    <div class="contenedor portada-contenido">
      <div class="portada-texto">
        <h1 id="portada-titulo"><span class="portada-prefijo">Instituto de Educación Superior Tecnológico Público</span><span class="portada-nombre"><span>Manuel</span> <span>Arévalo</span> <span>Cáceres</span></span></h1>
        <p class="portada-entrada">El único instituto público de Los Olivos. Formamos profesionales técnicos en tres carreras, en turno mañana y turno noche.</p>
        <div class="acciones">
          <a class="boton" href="<?= mac_url('paginas/admision-y-matricula/admision.php') ?>">Cómo postular</a>
          <a class="boton boton-contorno" href="#programas">Ver los programas</a>
        </div>
      </div>
    </div>
  </section>

  <?= mac_perfiles_html() ?>

  <section class="seccion" id="programas" aria-labelledby="programas-titulo">
    <div class="contenedor">
      <div class="seccion-cabeza">
        <h2 class="seccion-titulo" id="programas-titulo">Programas de estudio</h2>
        <p class="seccion-intro">Tres carreras profesionales técnicas, presenciales, en turno mañana (08:00 a 16:00) y turno noche (16:00 a 22:00).</p>
      </div>
      <ul class="programas">
<?php foreach ($programas as $indice => [$nombre, $descripcion, $destino, $imagen, $alt, $icono]): ?>
        <li class="programa">
          <a href="<?= mac_url($destino) ?>">
            <span class="programa-foto"><?= mac_imagen_o_ilustracion($imagen, [600, 900], 1194, 1600, $alt, '(max-width: 679px) min(100vw, 26rem), (max-width: 1179px) 33vw, 25rem', $icono) ?></span>
            <h3 class="programa-placa"><?= mac_e($nombre) ?></h3>
            <span class="programa-desc"><?= mac_e($descripcion) ?></span>
            <span class="programa-ir">Conoce el programa</span>
          </a>
        </li>
<?php endforeach; ?>
      </ul>
    </div>
  </section>

  <section class="seccion banda" id="admision" aria-labelledby="admision-titulo">
    <div class="contenedor">
      <div class="seccion-cabeza">
        <h2 class="seccion-titulo" id="admision-titulo">Admisión</h2>
        <p class="seccion-intro">El Manual de Procesos Académicos 2026–2032 reconoce tres modalidades de admisión a los programas de estudio.</p>
      </div>
      <div class="banda-grid">
        <div>
          <dl class="modalidades">
            <div><dt>Ordinaria</dt><dd>Se realiza periódicamente mediante una evaluación para cubrir las vacantes según el orden de mérito.</dd></div>
            <div><dt>Por exoneración</dt><dd>Para deportistas calificados, estudiantes talentosos y quienes cumplen servicio militar voluntario, conforme a la normativa vigente.</dd></div>
            <div><dt>Ingreso extraordinario</dt><dd>Autorizado por el Minedu; se implementa para becas y programas conforme a la normativa vigente.</dd></div>
          </dl>
          <p class="banda-nota">Fuente: <?= mac_mpa_enlace(11, 'Manual de Procesos Académicos 2026–2032, página 9') ?>.</p>
        </div>
        <div class="requisitos">
          <h3 class="requisitos-titulo">Para postular necesitas</h3>
          <ul class="chequeo">
            <li><?= mac_icono('check') ?>Certificado de estudios secundarios</li>
            <li><?= mac_icono('check') ?>Copia de DNI</li>
            <li><?= mac_icono('check') ?>Pago por derecho de admisión según la modalidad</li>
          </ul>
          <p class="requisitos-nota">Algunas modalidades piden un documento adicional. Confirma fechas, vacantes y montos con el instituto antes de pagar.</p>
          <a class="boton" href="<?= mac_url('paginas/admision-y-matricula/admision.php') ?>#requisitos">Ver requisitos por modalidad</a>
        </div>
      </div>
      <div class="banda-matricula">
        <h3 class="banda-matricula-titulo">Si ya eres estudiante</h3>
        <ul>
          <li><a href="<?= mac_url('paginas/admision-y-matricula/matricula.php') ?>#calendario"><?= mac_icono('calendario') ?>Calendario académico 2026</a></li>
          <li><a href="<?= mac_url('paginas/admision-y-matricula/matricula.php') ?>"><?= mac_icono('matricula') ?>Procesos de matrícula</a></li>
          <li><a href="<?= mac_url('paginas/admision-y-matricula/registro-matricula.php') ?>"><?= mac_icono('pantalla') ?>Registro de matrícula</a></li>
          <li><a href="<?= mac_url('paginas/admision-y-matricula/becas.php') ?>"><?= mac_icono('usuarios') ?>Becas</a></li>
        </ul>
      </div>
    </div>
  </section>

<?php if ($noticiasRecientes !== ''): ?>
  <section class="seccion" id="noticias" aria-labelledby="noticias-titulo">
    <div class="contenedor">
      <div class="seccion-cabeza seccion-cabeza-fila">
        <h2 class="seccion-titulo" id="noticias-titulo">Noticias</h2>
        <a class="enlace" href="<?= mac_url('paginas/otros/noticias.php') ?>">Ver todas las noticias</a>
      </div>
      <?= $noticiasRecientes ?>
    </div>
  </section>
<?php endif; ?>

<?php if ($publicacionesRecientes !== ''): ?>
  <section class="seccion<?= $noticiasRecientes !== '' ? ' seccion-suave' : '' ?>" id="publicaciones" aria-labelledby="publicaciones-titulo">
    <div class="contenedor">
      <div class="seccion-cabeza seccion-cabeza-fila">
        <div>
          <h2 class="seccion-titulo" id="publicaciones-titulo">Comunicados y documentos oficiales</h2>
          <p class="seccion-intro">Resoluciones e instrumentos de gestión publicados en el portal de transparencia, del más reciente al más antiguo.</p>
        </div>
        <a class="enlace" href="<?= mac_url('paginas/otros/archivos-oficiales.php') ?>">Ver todos los documentos</a>
      </div>
      <div class="publicaciones-grid">
        <?= $publicacionesRecientes ?>
        <aside class="lateral" aria-labelledby="actividades-titulo">
          <h3 class="lateral-titulo" id="actividades-titulo">Actividades y noticias</h3>
<?php if ($noticiasRecientes !== ''): ?>
          <p>Las actividades del día a día y los comunicados breves se publican en la página oficial de Facebook del instituto.</p>
<?php else: ?>
          <p>Las actividades del día a día se publican en la página oficial de Facebook. Cuando el instituto publique noticias en este portal, aparecerán aquí.</p>
<?php endif; ?>
          <a class="boton boton-contorno" href="<?= mac_e((string) mac_config('facebook_page_url')) ?>" target="_blank" rel="noopener noreferrer"><?= mac_icono('facebook') ?>Ver en Facebook<?= mac_externo() ?></a>
        </aside>
      </div>
    </div>
  </section>
<?php endif; ?>

  <section class="seccion seccion-suave" id="trayectoria" aria-labelledby="trayectoria-titulo">
    <div class="contenedor">
      <div class="seccion-cabeza seccion-cabeza-fila">
        <div>
          <h2 class="seccion-titulo" id="trayectoria-titulo">En Los Olivos desde 1986</h2>
          <p class="seccion-intro">El instituto lleva el nombre de Manuel Arévalo Cáceres, luchador social y diputado por La Libertad en el Congreso Constituyente del Perú.</p>
        </div>
        <a class="enlace" href="<?= mac_url('paginas/nosotros/historia.php') ?>">Leer nuestra historia</a>
      </div>
      <div class="trayectoria-grid">
        <ol class="linea-tiempo">
          <li><time datetime="1986-08-13">1986<small>13 de agosto</small></time><p>Creación del instituto mediante la R. M. N.º 508-86-ED.</p></li>
          <li><time datetime="1992">1992</time><p>Desde el segundo semestre funciona con tres carreras: Desarrollo de Sistemas de Información, Enfermería Técnica e Industrias Alimentarias.</p></li>
          <li><time datetime="2006">2006</time><p>Revalidación de la institución mediante la R. M. N.º 0688-2006-ED.</p></li>
          <li><time datetime="2025-12-31">2025<small>31 de diciembre</small></time><p>La R. D. N.º 313-2025 aprueba el Proyecto Educativo Institucional, el Manual de Procesos Académicos y el Manual de Perfil de Puestos para el periodo 2026–2032.</p></li>
        </ol>
        <div class="trayectoria-lateral">
          <aside class="dato" aria-labelledby="dato-titulo" data-dato>
            <div class="dato-cabeza">
              <h3 class="dato-titulo" id="dato-titulo">¿Sabías que…?</h3>
              <span class="dato-contador" data-dato-contador></span>
            </div>
            <ol class="dato-lista" data-dato-lista>
<?php foreach (mac_curiosidades() as $curiosidad): ?>
              <li><?= mac_e($curiosidad) ?></li>
<?php endforeach; ?>
            </ol>
            <div class="dato-controles">
              <button type="button" data-dato-anterior aria-label="Dato anterior"><?= mac_icono('izquierda') ?></button>
              <button type="button" data-dato-siguiente aria-label="Dato siguiente"><?= mac_icono('derecha') ?></button>
            </div>
          </aside>
          <div class="ficha">
            <h3 class="ficha-titulo">Ficha institucional</h3>
            <dl>
              <div><dt>Tipo de gestión</dt><dd>Pública</dd></div>
              <div><dt>Nivel formativo</dt><dd>Profesional técnico</dd></div>
              <div><dt>Modalidad</dt><dd>Presencial</dd></div>
              <div><dt>Código modular</dt><dd>1065655</dd></div>
              <div><dt>Sede</dt><dd><?= mac_e(mac_dato('direccion')) ?>, Los Olivos</dd></div>
            </dl>
            <p class="ficha-fuente">Fuente: <?= mac_mpa_enlace(8, 'Manual de Procesos Académicos 2026–2032') ?>.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="seccion" id="redes" aria-labelledby="redes-titulo">
    <div class="contenedor">
      <div class="seccion-cabeza">
        <h2 class="seccion-titulo" id="redes-titulo">En nuestras redes</h2>
        <p class="seccion-intro">Actividades, comunicados y videos que el instituto publica en sus canales oficiales.</p>
      </div>
      <div class="redes-grid">
        <div class="red">
          <div class="red-cabeza">
            <h3 class="red-titulo"><?= mac_icono('facebook') ?>Facebook</h3>
            <a class="red-enlace" href="<?= mac_e((string) mac_config('facebook_page_url')) ?>" target="_blank" rel="noopener noreferrer">Abrir la página<?= mac_externo() ?></a>
          </div>
          <div class="consentimiento" data-consentimiento>
            <p>Las publicaciones se cargan desde Facebook solo si lo autorizas. Al mostrarlas, Facebook puede recibir datos técnicos de tu navegador.</p>
            <div class="acciones"><button type="button" class="boton" data-consent-external>Mostrar publicaciones</button><button type="button" class="boton-texto" data-open-privacy-settings>Más opciones</button></div>
          </div>
          <div class="fotos-fb" data-fotos-fb></div>
          <div class="fb-marco" data-fb data-fb-alto="620"></div>
        </div>
        <div class="red">
          <div class="red-cabeza">
            <h3 class="red-titulo"><?= mac_icono('youtube') ?>YouTube</h3>
            <a class="red-enlace" href="<?= mac_e((string) mac_config('youtube_channel_url')) ?>" target="_blank" rel="noopener noreferrer">Ver el canal<?= mac_externo() ?></a>
          </div>
          <div class="consentimiento" data-consentimiento>
            <p>Las miniaturas y los videos se cargan desde YouTube solo si lo autorizas. Al mostrarlos, YouTube puede recibir datos técnicos de tu navegador.</p>
            <div class="acciones"><button type="button" class="boton" data-consent-external>Mostrar videos</button><button type="button" class="boton-texto" data-open-privacy-settings>Más opciones</button></div>
          </div>
          <ul class="videos" data-youtube-videos data-cantidad="4" aria-label="Videos recientes del canal" hidden></ul>
          <div data-youtube-respaldo hidden>
            <div class="marco-video" data-youtube-marco></div>
            <p class="estado-red">No se pudo leer la lista de videos en este momento; se muestra el reproductor del canal.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="seccion seccion-suave" id="consulta" aria-labelledby="consulta-titulo">
    <div class="contenedor consulta-grid">
      <div>
        <h2 class="seccion-titulo" id="consulta-titulo">¿Tienes una consulta?</h2>
        <p class="seccion-intro consulta-intro">Escríbenos sobre los programas, la admisión o cualquier trámite. También puedes llamarnos o visitarnos.</p>
        <ul class="datos-contacto">
          <li><?= mac_icono('ubicacion') ?><div><span class="datos-contacto-etiqueta">Dirección</span><?= mac_e(mac_dato('direccion')) ?>, <?= mac_e(mac_dato('distrito')) ?>. <a href="<?= mac_url(mac_dato('mapa')) ?>" target="_blank" rel="noopener noreferrer">Ver en el mapa<?= mac_externo() ?></a></div></li>
          <li><?= mac_icono('telefono') ?><div><span class="datos-contacto-etiqueta">Teléfonos</span><?php foreach ($GLOBALS['MAC_SITIO']['telefonos_atencion'] as $i => [$numero, $enlace]): ?><?= $i > 0 ? ', ' : '' ?><a href="tel:<?= mac_e($enlace) ?>"><?= mac_e($numero) ?></a><?php endforeach; ?></div></li>
          <li><?= mac_icono('correo') ?><div><span class="datos-contacto-etiqueta">Correo electrónico</span><a href="mailto:<?= mac_e(mac_dato('correo')) ?>"><?= mac_e(mac_dato('correo')) ?></a></div></li>
          <li><?= mac_icono('reloj') ?><div><span class="datos-contacto-etiqueta">Horario de atención</span><?= mac_e(mac_dato('horario')) ?></div></li>
        </ul>
      </div>
      <form class="formulario" action="<?= mac_url('paginas/contacto/contacto-envio.php') ?>" method="post" data-formulario>
        <h3 class="formulario-titulo">Envía tu consulta</h3>
        <div class="form-trampa" aria-hidden="true"><label>No completar este campo<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
        <input type="hidden" name="origen" value="portada">
        <input type="hidden" name="csrf_token" value="<?= mac_e($csrfToken) ?>">
        <div class="formulario-fila">
          <div class="campo"><label for="inicio-nombre">Nombre y apellidos</label><input id="inicio-nombre" name="nombre" autocomplete="name" required maxlength="120"></div>
          <div class="campo"><label for="inicio-correo">Correo electrónico</label><input id="inicio-correo" name="correo" type="email" autocomplete="email" required maxlength="180" inputmode="email"></div>
        </div>
        <div class="campo"><label for="inicio-mensaje">¿En qué podemos ayudarte?</label><textarea id="inicio-mensaje" name="mensaje" rows="5" required maxlength="3000"></textarea></div>
        <label class="form-consentimiento"><input type="checkbox" name="acepta" value="1" required><span>Autorizo el uso de mis datos solo para responder esta consulta, según la <a href="<?= mac_url('paginas/privacidad/politica-de-privacidad.php') ?>">política de privacidad</a>.</span></label>
        <div class="form-pie"><button class="boton" type="submit">Enviar consulta</button><p class="form-nota">Te responderemos al correo que indiques.</p></div>
        <p class="form-estado" role="status" aria-live="polite" data-form-estado></p>
      </form>
    </div>
  </section>
</main>
<?php require __DIR__ . '/plantillas/pie.php'; ?>
