<?php
$titulo = 'Enfermería Técnica';
$activo = 'programas';
$pagina = 'enfermeria';
$raiz = '../../';
$lead = 'Programa de formación profesional técnica en salud que desarrolla competencias para apoyar el cuidado integral y humanizado de las personas.';
$descripcion = 'Programa de estudios de Enfermería Técnica del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<?= mac_ficha_programa('Coordinación de Área Académica de Enfermería Técnica') ?>
<?= mac_aviso('Plan de estudios', 'La duración, los créditos, las unidades didácticas, el título y las competencias del programa se publicarán según la malla curricular aprobada. Mientras tanto, solicítalos a la coordinación del programa.') ?>
<h2>Prácticas del programa</h2>
<p>Las experiencias formativas en situaciones reales de trabajo complementan las competencias de cada módulo. Revisa los requisitos y el procedimiento para realizarlas.</p>
<div class="acciones">
  <a class="boton" href="efsrt.php">Experiencias formativas (EFSRT)</a>
  <a class="boton boton-contorno" href="../admision-y-matricula/admision.php">Requisitos de admisión</a>
</div>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
