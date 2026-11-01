<?php
$titulo = 'Becas';
$activo = 'admision';
$pagina = 'becas';
$raiz = '../../';
$lead = 'El Manual de Procesos Académicos 2026–2032 regula el otorgamiento de becas de descuento a estudiantes del instituto.';
$descripcion = 'Tipos de beca, requisitos y procedimiento de otorgamiento de becas del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<h2>Tipos de beca</h2>
<dl class="definiciones">
  <div><dt>Primer puesto</dt><dd>Quien ocupa el primer puesto de su programa de estudios en un periodo académico recibe una beca de descuento del 50 % en la matrícula del periodo siguiente.</dd></div>
  <div><dt>Disciplinas deportivas o artísticas</dt><dd>Para quienes representan al instituto en disciplinas deportivas o artísticas culturales, con rendimiento aprobatorio no menor de quince (15) en el periodo anterior: descuento del 10 % al 50 % en la ratificación de matrícula, previo informe de la Unidad de Bienestar y Empleabilidad.</dd></div>
  <div><dt>Situación socioeconómica precaria</dt><dd>Para estudiantes con rendimiento aprobatorio no menor de quince (15): descuento del 50 % en la ratificación de matrícula, previo informe de la Unidad de Bienestar y Empleabilidad.</dd></div>
  <div><dt>Programa Integral de Reparaciones</dt><dd>El manual también considera a los estudiantes del Programa Integral de Reparaciones.</dd></div>
</dl>
<h2>Requisitos</h2>
<ul class="lista-marcada">
  <li>Solicitud en el <a href="<?= mac_url('recursos/documentos/tramites/vigentes/formato-unico-de-tramite.pdf') ?>" target="_blank" rel="noopener noreferrer">Formato Único de Trámite (FUT)<?= mac_externo() ?></a>.</li>
  <li>Resolución de primeros puestos, cuando corresponda.</li>
  <li>Resolución de otorgamiento de beca por situación socioeconómica precaria o por participación en disciplinas deportivas o artísticas, cuando corresponda.</li>
</ul>
<h2>Procedimiento</h2>
<ol class="pasos">
  <li><p>La jefatura de la Unidad de Bienestar y Empleabilidad elabora un informe de otorgamiento de becas para quienes ocuparon los primeros puestos, quienes se encuentran en situación socioeconómica precaria y quienes forman parte del Programa Integral de Reparaciones.</p></li>
  <li><p>La Dirección General emite una resolución directoral de beca. Según el procedimiento del manual, en los casos de situación socioeconómica precaria o del Programa Integral de Reparaciones la beca puede ser de descuento del 100 % en cualquier trámite.</p></li>
  <li><p>Se entrega una copia de la resolución a cada estudiante para sus trámites.</p></li>
</ol>
<?= mac_aviso('Plazo', 'El otorgamiento de la beca por primer puesto tiene un plazo de siete días hábiles. Los porcentajes y condiciones de cada caso se confirman mediante resolución directoral.') ?>
<p class="fuente">Fuente: <?= mac_mpa_enlace(75, 'Manual de Procesos Académicos 2026–2032, páginas 73 a 75') ?>.</p>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
