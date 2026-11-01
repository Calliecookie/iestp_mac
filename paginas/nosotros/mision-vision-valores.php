<?php
$titulo = 'Misión, visión y valores';
$activo = 'nosotros';
$pagina = 'mision';
$raiz = '../../';
$lead = 'La misión, la visión y los valores institucionales forman parte del Proyecto Educativo Institucional 2026–2032 y orientan la gestión académica y administrativa del instituto.';
$descripcion = 'Misión, visión y valores oficiales del IESTP Manuel Arévalo Cáceres según el PEI 2026–2032.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<h2>Identidad institucional (PEI 2026–2032)</h2>
<p>De acuerdo con la sección de identidad institucional del Proyecto Educativo Institucional 2026–2032, recogida en el Manual de Perfil de Puestos 2026–2032 aprobado mediante la Resolución Directoral N.º 313-2025-DG-IESTP «MAC», el instituto define así su misión y su visión:</p>
<div class="columnas-dos">
  <div class="panel">
    <h3 class="panel-titulo">Misión</h3>
    <p>«Somos una institución de Educación Superior Tecnológica Pública que forma profesionales técnicos competentes, con enfoque en la investigación, la innovación y la empleabilidad, comprometidos con la sociedad y el medio ambiente.»</p>
  </div>
  <div class="panel">
    <h3 class="panel-titulo">Visión al 2032</h3>
    <p>«Al 2032, ser un referente en la formación de profesionales técnicos con excelencia académica, emprendimiento e innovación, contribuyendo al desarrollo productivo y social del país.»</p>
  </div>
</div>
<p class="fuente">Fuente: <?= mac_doc_enlace('recursos/documentos/' . mac_dato('mpp') . '#page=7', 'Manual de Perfil de Puestos 2026–2032, página 7') ?> (aprobado por R. D. N.º 313-2025-DG-IESTP «MAC»).</p>

<h2>Valores institucionales</h2>
<p>El Proyecto Educativo Institucional 2026–2032 establece los siguientes valores para la comunidad educativa del IESTP Manuel Arévalo Cáceres:</p>
<ul class="etapas">
  <li>Honestidad</li>
  <li>Responsabilidad</li>
  <li>Respeto y equidad</li>
  <li>Calidad</li>
  <li>Innovación</li>
</ul>

<h2>Desarrollo en los planes de trabajo 2026</h2>
<p>En concordancia con el PEI 2026–2032, el Plan de Trabajo de Secretaría Académica 2026 precisa el alcance territorial y formativo de la identidad institucional en Lima Norte:</p>
<dl class="definiciones">
  <div>
    <dt>Misión institucional</dt>
    <dd>«Somos un IES público licenciado, que forma profesionales técnicos competentes, éticos e innovadores, mediante una formación por competencias articulada al sector productivo, con enfoque de inclusión y sostenibilidad para aportar al desarrollo socioeconómico de Lima Norte, la región y el país.»</dd>
  </div>
  <div>
    <dt>Visión institucional</dt>
    <dd>«Ser el IES de referencia de Lima Norte, reconocido por su excelencia académica, formación técnica integral e inclusiva, innovación y emprendimiento, con alta pertinencia y aporte al desarrollo sostenible de la comunidad, la región y el país.»</dd>
  </div>
</dl>
<p class="fuente">Fuente: <?= mac_doc_enlace('recursos/documentos/transparencia/vigentes/plan-trabajo-secretaria-academica-2026.pdf#page=4', 'Plan de Trabajo de Secretaría Académica 2026, página 4') ?>. Puedes consultar todos los instrumentos vigentes en <a href="../transparencia/documentos-gestion.php">Documentos de gestión</a>.</p>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
