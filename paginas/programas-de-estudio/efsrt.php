<?php
$titulo = 'Experiencias formativas en situaciones reales de trabajo';
$activo = 'programas';
$pagina = 'efsrt';
$raiz = '../../';
$lead = 'Las EFSRT son un conjunto de actividades que permiten ampliar conocimientos, habilidades y actitudes en la dinámica laboral, para insertarse más rápido en el mercado de trabajo.';
$descripcion = 'Requisitos, procedimiento y convenios de las experiencias formativas en situaciones reales de trabajo (EFSRT) del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<p>Esta consolidación de aptitudes se desarrolla en cada módulo formativo y complementa las competencias específicas y de empleabilidad vinculadas con cada programa de estudios.</p>
<h2>Requisitos</h2>
<ul class="lista-marcada">
  <li>Solicitud en el <a href="<?= mac_url('recursos/documentos/tramites/vigentes/formato-unico-de-tramite.pdf') ?>" target="_blank" rel="noopener noreferrer">Formato Único de Trámite (FUT)<?= mac_externo() ?></a>.</li>
  <li>Ficha de aceptación de EFSRT.</li>
  <li>Pago por derecho de EFSRT.</li>
</ul>
<h2>Procedimiento</h2>
<ol class="pasos">
  <li><p>Realizas el pago por derecho de EFSRT y el asistente administrativo te entrega el comprobante.</p></li>
  <li><p>Presentas los requisitos por Mesa de Partes del instituto.</p></li>
  <li><p>Mesa de Partes deriva tu solicitud a la Dirección General, que emite una carta de presentación.</p></li>
  <li><p>Al terminar, entregas tu folder a la Coordinación de Área Académica: hoja de evaluación, ficha de supervisión y monitoreo, ficha de aceptación, constancia de EFSRT y copia de DNI.</p></li>
  <li><p>La coordinación elabora la hoja resumen y el acta de evaluación, y envía la calificación final a Secretaría Académica.</p></li>
  <li><p>Secretaría Académica registra las calificaciones y archiva las actas de notas de EFSRT.</p></li>
</ol>
<?= mac_aviso('Si no apruebas la EFSRT', 'Debes realizarla nuevamente en el siguiente periodo académico. El plazo del trámite es de tres días hábiles.') ?>
<p class="fuente">Fuente: <?= mac_mpa_enlace(71, 'Manual de Procesos Académicos 2026–2032, páginas 69 a 71') ?>. Los derechos de pago figuran en la tabla de costos del mismo capítulo.</p>
<h2>Convenios</h2>
<p>Convenios firmados por el instituto con empresas y universidades. La vigencia se indica según la fecha de firma y el plazo que fija cada convenio; para confirmar vacantes o renovaciones, consulta con el instituto.</p>
<?php mac_documentos_mostrar('efsrt', $raiz, ['titulo' => 'Convenios vigentes']); ?>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
