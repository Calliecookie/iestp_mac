<?php
$titulo = 'Procesos de matrícula';
$activo = 'admision';
$pagina = 'matricula';
$raiz = '../../';
$lead = 'La matrícula acredita la condición de estudiante y se realiza en cada periodo académico, según el calendario aprobado por el instituto.';
$descripcion = 'Tipos de matrícula, requisitos, calendario académico y cronogramas de matrícula del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
$hoy = date('Y-m-d');
$calendario = [
    ['Inicio de campaña y proceso de admisión 2026', '12 de enero'],
    ['Inscripción para el proceso de admisión, modalidad ordinaria', '2 al 27 de marzo'],
    ['Inscripción para el proceso de admisión, modalidad exonerado', '2 al 25 de febrero'],
    ['Aplicación del examen de admisión por exoneración', '26 de febrero'],
    ['<strong>Aplicación del examen de admisión ordinario 2026</strong>', '<strong>19 de abril</strong>'],
    ['Presentación de expedientes de reincorporación a primer semestre por cambio de plan de estudios (Mesa de partes)', '19 de enero al 20 de febrero'],
    ['Presentación de expedientes de traslado externo', '19 de enero al 20 de febrero'],
    ['Presentación de expedientes de reincorporación por licencia o reserva de matrícula de III o V semestre', '19 de enero al 20 de febrero'],
    ['Solicitudes de cambio de turno (III y V)', '19 de enero al 20 de febrero'],
    ['Aplicación de evaluaciones extraordinarias', '9 de marzo al 18 de diciembre'],
    ['Inicio de sustentación de exámenes teórico-prácticos para titulación', 'Desde el 3 de marzo'],
    ['Capacitación, planeamiento y organización del periodo lectivo', '2 al 31 de marzo'],
    ['Proceso de matrícula III-V semestres', '9 de febrero al 20 de marzo'],
    ['Matrícula extemporánea III-V semestres, con mora', '23 al 31 de marzo'],
    ['Inicio del proceso de matrícula I semestre', '20 al 27 de abril'],
    ['Matrícula extemporánea I semestre, con mora', '28 al 30 de abril'],
    ['Presentación de expedientes de convalidación de U. D., periodo 2026-I (Mesa de partes)', '30 de marzo al 17 de abril'],
    ['Presentación de expedientes de licencia de estudios o reserva de matrícula (Mesa de partes)', '2 al 30 de abril'],
    ['<strong>Inicio de clases I-III-V semestres</strong>', '<strong>20 de abril</strong>'],
    ['Monitoreo y acompañamiento docente', '13 de abril al 30 de junio'],
    ['Examen de suficiencia de idioma inglés (primer grupo)', '20 de abril'],
    ['Examen de suficiencia de idioma inglés (segundo grupo)', '13 de setiembre'],
    ['Supervisión de registros auxiliares en áreas académicas', '25 de mayo al 5 de junio'],
    ['Fin del periodo de clases 2026-I', '21 de agosto'],
    ['Entrega de registro auxiliar y reporte en el sistema REGISTRA a JUA, I-III-V semestres', '24 al 26 de agosto'],
    ['Presentación de expedientes de reincorporación y cambio de turno para el periodo 2026-II (Mesa de partes)', '17 al 26 de agosto'],
    ['Inicio del proceso de matrícula II-IV-VI semestres', '24 al 28 de agosto'],
    ['Matrícula extemporánea II-IV-VI semestres, con mora', '31 de agosto al 4 de setiembre'],
    ['<strong>Inicio de clases II-IV-VI semestres</strong>', '<strong>31 de agosto</strong>'],
    ['Presentación de expedientes de convalidación de U. D., periodo 2026-II (Mesa de partes)', '24 al 28 de agosto'],
    ['Semana tecnológica por aniversario institucional', '1 al 9 de octubre'],
    ['Presentación de expedientes de licencia de estudios o reserva de matrícula (Mesa de partes)', '17 al 28 de agosto'],
    ['Monitoreo y acompañamiento docente', '24 de agosto al 4 de diciembre'],
    ['Supervisión de registros auxiliares en áreas académicas', '9 al 13 de noviembre'],
    ['Fin del periodo académico 2026-II (II-IV-VI semestres)', '31 de diciembre'],
    ['Finalización de sustentación de exámenes teórico-prácticos para titulación', '11 de diciembre'],
    ['Entrega de registro auxiliar y reporte en el sistema REGISTRA a JUA, II-IV-VI semestres', '22 al 28 de diciembre'],
    ['Ceremonia protocolar', '26 de diciembre'],
];
$solicitudes = [
    ['Reingresos (solo estudiantes con resolución directoral por reserva de matrícula o licencia de estudios)', 'S/ 180.00'],
    ['Repitencia de ciclo (previa aceptación de la solicitud)', 'S/ 180.00'],
    ['Cambio de turno (previa aceptación de la solicitud)', 'S/ 60.00 más matrícula de S/ 180.00'],
    ['Traslados internos (previa aceptación de la solicitud)', 'S/ 200.00'],
    ['Traslados externos desde institución privada (previa aceptación de la solicitud)', 'S/ 200.00'],
    ['Traslados externos desde institución pública (previa aceptación de la solicitud)', 'S/ 150.00'],
];
$cronogramas = [
    ['Cronograma de matrícula 2026-I', 'Inicio de clases: 30 de marzo de 2026', '2026-03-31', [
        ['Matrícula de ingresante', 'I', 'Al día siguiente del examen de admisión', 'S/ 180.00'],
        ['Matrícula regular', 'III-V', '9 de febrero al 20 de marzo de 2026', 'S/ 180.00'],
        ['Matrícula extemporánea', 'III-V', '23 al 31 de marzo de 2026', 'S/ 210.00'],
        ['Matrícula por repitencia de unidad didáctica', 'I-III-V', '9 de febrero al 20 de marzo de 2026', 'S/ 50.00'],
    ], 'I-III-V', '19 de enero al 20 de febrero de 2026'],
    ['Cronograma de matrícula 2026-II', 'Inicio de clases: 31 de agosto de 2026', '2026-09-04', [
        ['Matrícula regular', 'II-IV-VI', '24 al 28 de agosto de 2026', 'S/ 180.00'],
        ['Matrícula extemporánea', 'II-IV-VI', '31 de agosto al 4 de setiembre de 2026', 'S/ 210.00'],
        ['Matrícula por repitencia de unidad didáctica', 'II-IV-VI', '24 al 28 de agosto de 2026', 'S/ 50.00'],
    ], 'II-IV-VI', '17 al 26 de agosto de 2026'],
];
?>
<h2>Tipos de matrícula</h2>
<dl class="definiciones">
  <div><dt>Matrícula de ingresante</dt><dd>Para quienes ingresan por concurso de admisión, traslado, reserva de matrícula, reincorporación o convalidación.</dd></div>
  <div><dt>Ratificación de matrícula</dt><dd>Matrícula por unidades didácticas que se realiza cada periodo académico; es requisito para mantener la condición de estudiante.</dd></div>
  <div><dt>Unidad de repitencia</dt><dd>Matrícula de las unidades didácticas desaprobadas en periodos anteriores que necesitan subsanación.</dd></div>
</dl>
<h2>Requisitos</h2>
<div class="acordeon">
  <details open>
    <summary>Ingresantes al primer periodo académico</summary>
    <div class="acordeon-cuerpo"><ul class="lista-marcada"><li>Pago por derecho de matrícula.</li></ul></div>
  </details>
  <details>
    <summary>Ratificación, del segundo al sexto periodo</summary>
    <div class="acordeon-cuerpo"><ul class="lista-marcada"><li>Boleta de notas.</li><li>Haber aprobado como mínimo el 75 % de los créditos del periodo académico inmediato anterior.</li><li>Pago por derecho de matrícula.</li></ul></div>
  </details>
  <details>
    <summary>Reincorporación por licencia o repitencia</summary>
    <div class="acordeon-cuerpo"><ul class="lista-marcada"><li>Resolución directoral de reincorporación.</li><li>Boleta de notas.</li><li>Pago por derecho de matrícula.</li></ul></div>
  </details>
  <details>
    <summary>Unidad de repitencia, del tercer al sexto periodo</summary>
    <div class="acordeon-cuerpo"><ul class="lista-marcada"><li>Pago por derecho de matrícula de unidad de repitencia (subsanación).</li></ul></div>
  </details>
</div>
<p class="fuente">Fuente: <?= mac_mpa_enlace(16, 'Manual de Procesos Académicos 2026–2032, páginas 14 y 15') ?>, que incluye la tabla de costos de matrícula.</p>
<?= mac_aviso('Cómo se paga', 'Según el manual, el pago se realiza por depósito o transferencia a la cuenta bancaria institucional de la DRELM, y el comprobante se presenta al asistente administrativo del instituto. No se aceptan pagos en efectivo dentro de la institución. Confirma el monto y la cuenta antes de pagar.', 'alerta') ?>
<h2 id="calendario">Calendario académico-administrativo 2026</h2>
<p>Actividades y fechas del año académico 2026: admisión, matrícula, inicio y fin de clases, y trámites por Mesa de Partes.</p>
<?php if ($hoy > '2026-12-31'): ?><p class="sello sello-archivo">Corresponde a un año concluido</p><?php endif; ?>
<div class="tabla-marco" role="region" aria-labelledby="calendario" tabindex="0">
<table class="tabla">
  <thead><tr><th scope="col">N.º</th><th scope="col">Actividad</th><th scope="col">Fecha</th></tr></thead>
  <tbody>
<?php foreach ($calendario as $i => [$actividad, $fecha]): ?>
    <tr><td><?= $i + 1 ?></td><td><?= $actividad ?></td><td><?= $fecha ?></td></tr>
<?php endforeach; ?>
  </tbody>
</table>
</div>
<h2>Cronogramas de matrícula 2026</h2>
<p>Si encuentras fechas distintas entre los cronogramas y el calendario, confirma la fecha correcta con Secretaría Académica.</p>
<?php foreach ($cronogramas as [$nombre, $inicio, $fin, $filas, $ciclosSolicitud, $fechaSolicitud]): $concluido = $hoy > $fin; ?>
<h3 class="tabla-titulo"><?= mac_e($nombre) ?> <span class="sello<?= $concluido ? ' sello-archivo' : ' sello-vigente' ?>"><?= $concluido ? 'Periodo concluido' : 'Vigente' ?></span></h3>
<p><?= mac_e($inicio) ?>. Pago en la cuenta corriente institucional N.º 00000-289094 del Banco de la Nación.</p>
<div class="tabla-marco" role="region" aria-label="<?= mac_e($nombre) ?>" tabindex="0">
<table class="tabla">
  <thead><tr><th scope="col">Modalidad de matrícula</th><th scope="col">Ciclo</th><th scope="col">Fecha</th><th scope="col">Costo</th></tr></thead>
  <tbody>
<?php foreach ($filas as [$modalidad, $ciclo, $fecha, $costo]): ?>
    <tr><td><?= mac_e($modalidad) ?></td><td><?= mac_e($ciclo) ?></td><td><?= mac_e($fecha) ?></td><td><?= mac_e($costo) ?></td></tr>
<?php endforeach; ?>
<?php foreach ($solicitudes as [$solicitud, $costo]): ?>
    <tr><td>Solicitud de <?= mac_e(lcfirst($solicitud)) ?></td><td><?= mac_e($ciclosSolicitud) ?></td><td><?= mac_e($fechaSolicitud) ?></td><td><?= mac_e($costo) ?></td></tr>
<?php endforeach; ?>
  </tbody>
</table>
</div>
<?php endforeach; ?>
<h2>Plataforma de matrícula</h2>
<div class="panel">
  <p>El registro se realiza en la plataforma externa del instituto. Verifica que el periodo que muestra corresponda al ciclo en curso antes de iniciar el trámite.</p>
<?php if (mac_dato('matricula') !== ''): ?>
  <div class="acciones"><a class="boton" href="<?= mac_url(mac_dato('matricula')) ?>" target="_blank" rel="noopener noreferrer">Abrir la plataforma de matrícula<?= mac_externo() ?></a></div>
<?php else: ?>
  <div class="acciones"><a class="boton" href="registro-matricula.php">Ver los pasos del registro</a><a class="boton boton-contorno" href="../contacto/contacto.php">Consultar a Secretaría Académica</a></div>
<?php endif; ?>
</div>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
