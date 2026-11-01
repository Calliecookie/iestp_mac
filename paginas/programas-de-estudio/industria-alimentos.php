<?php
$titulo = 'Industria de Alimentos y Bebidas';
$activo = 'programas';
$pagina = 'alimentos';
$raiz = '../../';
$lead = 'Programa de formación profesional técnica en procesos de elaboración, conservación y control de calidad de alimentos y bebidas.';
$descripcion = 'Programa de estudios de Industria de Alimentos y Bebidas del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<?= mac_ficha_programa('Coordinación de Área Académica de Industrias Alimentarias') ?>
<?= mac_aviso('Plan de estudios', 'La duración, los créditos, las unidades didácticas, el título y las competencias del programa se publicarán según la malla curricular aprobada. Mientras tanto, solicítalos a la coordinación del programa.') ?>
<h2>Clases y prácticas</h2>
<div class="ficha">
  <h3 class="ficha-titulo">En el taller de alimentos</h3>
  <p>La formación combina clases en aula con prácticas en el taller del instituto, donde los estudiantes trabajan con la indumentaria de higiene del programa: mandil, cofia, mascarilla y guantes.</p>
  <ul>
    <li>Preparación y corte de materias primas.</li>
    <li>Operación de equipos de proceso y conservación, como el autoclave.</li>
    <li>Trabajo en mesas de acero inoxidable y con equipos de refrigeración.</li>
    </ul>
<h2>Convenios para experiencias formativas</h2>
<p>El instituto firmó convenios específicos de cooperación educativa con empresas para las experiencias formativas en situaciones reales de trabajo de este programa y para publicar ofertas en la bolsa de trabajo.</p>
<?php mac_documentos_mostrar('industria-alimentos', $raiz, ['titulo' => 'Convenios vigentes']); ?>
<div class="acciones">
  <a class="boton" href="efsrt.php">Experiencias formativas (EFSRT)</a>
  <a class="boton boton-contorno" href="../admision-y-matricula/admision.php">Requisitos de admisión</a>
</div>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
