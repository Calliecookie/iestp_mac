<footer class="pie">
  <div class="pie-zocalo" aria-hidden="true"></div>
  <div class="contenedor pie-in">
    <div class="pie-marca">
      <img class="pie-logo" src="<?= mac_recurso('recursos/imagenes/identidad/logo-mac-96.png') ?>" srcset="<?= mac_recurso('recursos/imagenes/identidad/logo-mac-192.png') ?> 2x" width="84" height="96" alt="Emblema del IESTP Manuel Arévalo Cáceres" loading="lazy" decoding="async">
      <div>
        <p class="pie-nombre">Manuel Arévalo Cáceres</p>
        <p>Instituto de Educación Superior Tecnológico Público creado el 13 de agosto de 1986 mediante la R. M. N.º 508-86-ED.</p>
      </div>
    </div>
    <nav class="pie-columna" aria-labelledby="pie-programas">
      <h2 class="pie-titulo" id="pie-programas">Programas de estudio</h2>
      <ul>
<?php foreach ($GLOBALS['MAC_NAV']['programas'][1] as $macItem): ?>
        <li><a href="<?= mac_url($macItem[2]) ?>"><?= mac_e($macItem[1]) ?></a></li>
<?php endforeach; ?>
      </ul>
    </nav>
    <nav class="pie-columna" aria-labelledby="pie-tramites">
      <h2 class="pie-titulo" id="pie-tramites">Trámites e información</h2>
      <ul>
        <li><a href="<?= mac_url('paginas/admision-y-matricula/admision.php') ?>">Admisión</a></li>
        <li><a href="<?= mac_url('paginas/servicios/mesa-de-partes.php') ?>">Mesa de partes</a></li>
        <li><a href="<?= mac_url('paginas/transparencia/documentos-gestion.php') ?>">Documentos de gestión</a></li>
        <li><a href="<?= mac_url('paginas/transparencia/tupa.php') ?>">TUPA y tasas</a></li>
        <li><a href="<?= mac_url('paginas/otros/archivos-oficiales.php') ?>">Archivos oficiales</a></li>
        <li><a href="<?= mac_url('paginas/servicios/libro-reclamaciones.php') ?>">Atención y orientación ciudadana</a></li>
      </ul>
    </nav>
    <nav class="pie-columna" aria-labelledby="pie-enlaces">
      <h2 class="pie-titulo" id="pie-enlaces">Enlaces de interés</h2>
      <ul>
        <li><a href="<?= mac_url(mac_dato('minedu')) ?>" target="_blank" rel="noopener noreferrer">Ministerio de Educación<?= mac_externo() ?></a></li>
        <li><a href="<?= mac_url(mac_dato('drelm')) ?>" target="_blank" rel="noopener noreferrer">DRELM<?= mac_externo() ?></a></li>
        <li><a href="<?= mac_url(mac_dato('intranet')) ?>" target="_blank" rel="noopener noreferrer">Intranet<?= mac_externo() ?></a></li>
        <li><a href="<?= mac_url('paginas/otros/otros-enlaces.php') ?>">Enlaces institucionales</a></li>
      </ul>
    </nav>
    <div class="pie-columna">
      <h2 class="pie-titulo">Atención</h2>
      <address>
        <p><?= mac_e(mac_dato('direccion')) ?>, <?= mac_e(mac_dato('distrito')) ?></p>
        <p><a href="tel:<?= mac_e(mac_dato('telefono_enlace')) ?>"><?= mac_e(mac_dato('telefono')) ?></a></p>
        <p><a href="mailto:<?= mac_e(mac_dato('correo')) ?>"><?= mac_e(mac_dato('correo')) ?></a></p>
        <p><?= mac_e(mac_dato('horario')) ?></p>
      </address>
      <ul class="pie-redes">
        <li><a href="<?= mac_e((string) mac_config('facebook_page_url')) ?>" target="_blank" rel="noopener noreferrer"><?= mac_icono('facebook') ?>Facebook<span class="sr">(se abre en una pestaña nueva)</span></a></li>
        <li><a href="<?= mac_e((string) mac_config('youtube_channel_url')) ?>" target="_blank" rel="noopener noreferrer"><?= mac_icono('youtube') ?>YouTube<span class="sr">(se abre en una pestaña nueva)</span></a></li>
      </ul>
    </div>
    <div class="pie-legal">
      <p>© <?= date('Y') ?> IESTP Manuel Arévalo Cáceres, Los Olivos, Lima.</p>
      <ul>
        <li><a href="<?= mac_url('paginas/privacidad/politica-de-privacidad.php') ?>">Política de privacidad</a></li>
        <li><button type="button" class="pie-boton" data-open-privacy-settings>Preferencias de privacidad</button></li>
      </ul>
    </div>
  </div>
</footer>
<?php if (($GLOBALS['activo'] ?? '') !== 'contacto'): ?>
<a class="flotante" href="<?= mac_url('paginas/contacto/contacto.php') ?>" data-flotante><?= mac_icono('atencion') ?><span>Consulta</span></a>
<?php endif; ?>
<section id="privacy-banner" class="privacidad-banda" aria-label="Preferencias de privacidad" hidden>
  <div class="privacidad-banda-texto">
    <p class="privacidad-banda-titulo">Contenido de Facebook y YouTube</p>
    <p>Solo mostramos publicaciones y videos de terceros si lo autorizas. Tu elección se guarda en este navegador. <a href="<?= mac_url('paginas/privacidad/politica-de-privacidad.php') ?>">Política de privacidad</a></p>
  </div>
  <div class="privacidad-acciones">
    <button type="button" class="boton boton-contorno" data-consent-necessary>Solo necesarias</button>
    <button type="button" class="boton" data-consent-external>Permitir contenido externo</button>
    <button type="button" class="boton-texto" data-open-privacy-settings>Configurar</button>
  </div>
</section>
<dialog id="privacy-dialog" class="dialogo" aria-labelledby="privacy-dialog-title" aria-describedby="privacy-dialog-description">
  <div class="dialogo-panel">
    <button type="button" class="dialogo-cerrar" data-privacy-dialog-close aria-label="Cerrar preferencias"><?= mac_icono('cerrar') ?></button>
    <h2 id="privacy-dialog-title">Preferencias de privacidad</h2>
    <p id="privacy-dialog-description">Si habilitas el contenido externo, Facebook y YouTube pueden recibir datos técnicos de tu navegador y aplicar sus propias cookies. Puedes cambiar esta preferencia en cualquier momento desde el pie de página.</p>
    <div class="opcion">
      <div><p class="opcion-titulo">Almacenamiento necesario</p><p>Recuerda tu elección de privacidad y protege el envío de formularios.</p></div>
      <span class="opcion-estado">Siempre activo</span>
    </div>
    <label class="opcion opcion-interruptor" for="privacy-external">
      <span><span class="opcion-titulo">Contenido externo de Facebook y YouTube</span><span class="opcion-detalle">Carga publicaciones, fotografías y miniaturas desde esos servicios solo cuando lo autorizas.</span></span>
      <input id="privacy-external" type="checkbox">
    </label>
    <div class="acciones">
      <button type="button" class="boton" data-consent-save>Guardar preferencias</button>
      <button type="button" class="boton boton-contorno" data-consent-necessary>Rechazar opcionales</button>
    </div>
  </div>
</dialog>
<dialog class="visor" id="visor" aria-label="Imagen ampliada" data-visor>
  <button type="button" class="dialogo-cerrar" data-visor-cerrar aria-label="Cerrar imagen"><?= mac_icono('cerrar') ?></button>
  <img alt="" data-visor-imagen>
  <a class="visor-enlace" href="#" target="_blank" rel="noopener noreferrer" data-visor-enlace>Abrir la imagen en una pestaña nueva</a>
</dialog>
</body>
</html>
