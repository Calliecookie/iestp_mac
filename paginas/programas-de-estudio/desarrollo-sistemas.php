<?php
$titulo = 'Desarrollo de Sistemas de Información';
$activo = 'programas';
$pagina = 'sistemas';
$raiz = '../../';
$lead = 'Programa de formación profesional técnica orientado a analizar necesidades y a construir soluciones digitales y sistemas de información.';
$descripcion = 'Programa de estudios de Desarrollo de Sistemas de Información del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<?= mac_ficha_programa('Coordinación de Área Académica de Desarrollo de Sistemas de Información') ?>
<?= mac_aviso('Plan de estudios', 'La duración, los créditos, las unidades didácticas, el título y las competencias del programa se publicarán según la malla curricular aprobada. Mientras tanto, solicítalos a la coordinación del programa.') ?>
<h2 id="horarios">Horarios de los laboratorios</h2>
<p>Distribución semanal de los laboratorios de cómputo del programa, por turno.</p>
<?php mac_documentos_mostrar('desarrollo-sistemas', $raiz, ['titulo' => 'Horarios publicados']); ?>
<div class="acciones">
  <a class="boton" href="../admision-y-matricula/admision.php">Requisitos de admisión</a>
  <a class="boton boton-contorno" href="efsrt.php">Experiencias formativas (EFSRT)</a>
</div>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
