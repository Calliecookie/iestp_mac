<?php
$titulo = 'Nuestra historia';
$activo = 'nosotros';
$pagina = 'historia';
$raiz = '../../';
$lead = 'El Instituto de Educación Superior Tecnológico Público «Manuel Arévalo Cáceres» es el único instituto público del distrito de Los Olivos.';
$descripcion = 'Historia del IESTP Manuel Arévalo Cáceres, creado en 1986 en Los Olivos, Lima.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<p>Su nombre rinde homenaje a un ilustre peruano, político e insigne luchador social, diputado por el departamento de La Libertad en el Congreso Constituyente del Perú.</p>
<p>Hoy funciona en la Av. Los Alisos N.º 858, Urb. Carlos Cueto Fernandini. Sus actividades académicas se rigen por módulos técnico-profesionales y módulos transversales, que desarrollan competencias en el lugar de trabajo.</p>
<h2>Línea de tiempo</h2>
<ol class="linea-tiempo">
  <li><time datetime="1986-08-13">1986<small>13 de agosto</small></time><p>Creación del instituto mediante la R. M. N.º 508-86-ED, en homenaje a Manuel Arévalo Cáceres.</p></li>
  <li><time datetime="1992">1992</time><p>Desde el segundo semestre inicia su funcionamiento con tres carreras: Desarrollo de Sistemas de Información, Enfermería Técnica e Industrias Alimentarias.</p></li>
  <li><time datetime="2006">2006</time><p>Revalidación de la institución mediante la R. M. N.º 0688-2006-ED.</p></li>
  <li><time datetime="2009">2009</time><p>Industrias Alimentarias aplica el nuevo Diseño Curricular Básico (R. D. N.º 0417-2009-ED).</p></li>
  <li><time datetime="2010">2010</time><p>Computación e Informática aplica el nuevo Diseño Curricular Básico.</p></li>
  <li><time datetime="2011">2011</time><p>Enfermería Técnica aplica el nuevo Diseño Curricular Básico.</p></li>
  <li><time datetime="2025-12-31">2025<small>31 de diciembre</small></time><p>La R. D. N.º 313-2025-DG-IESTP «MAC» aprueba el Proyecto Educativo Institucional, el Manual de Procesos Académicos y el Manual de Perfil de Puestos para el periodo 2026–2032.</p></li>
</ol>
<h2>Nuestra sede</h2>
<p>El local institucional se ubica en la Av. Los Alisos N.º 858, a la altura de la cuadra 43 de la Av. Las Palmeras, en Los Olivos.</p>
<div class="acciones">
  <a class="boton" href="plana-jerarquica.php">Ver la plana jerárquica</a>
  <a class="boton boton-contorno" href="<?= mac_url(mac_dato('mapa')) ?>" target="_blank" rel="noopener noreferrer">Ver la ubicación en el mapa<?= mac_externo() ?></a>
</div>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
