<?php
$titulo = 'Plana jerárquica';
$activo = 'nosotros';
$pagina = 'plana';
$raiz = '../../';
$lead = 'Organización del instituto: la Dirección General, las unidades y áreas que dependen de ella y las coordinaciones de los tres programas de estudio.';
$descripcion = 'Organización institucional del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
$unidades = [
    ['Jefatura de Unidad Académica', [
        'Coordinación de Área Académica de Desarrollo de Sistemas de Información',
        'Coordinación de Área Académica de Enfermería Técnica',
        'Coordinación de Área Académica de Industrias Alimentarias',
        'Docentes',
        'Asistentes de taller de los tres programas de estudio',
    ]],
    ['Secretaría Académica', []],
    ['Jefatura de Formación Continua', []],
    ['Jefatura de Unidad de Investigación', []],
    ['Área de Calidad', []],
    ['Jefatura de Unidad de Bienestar y Empleabilidad', [
        'Servicio de bienestar y consejería',
        'Seguimiento de egresados',
        'Servicio de empleabilidad',
        'Servicio de tópico',
    ]],
    ['Jefatura del Área de Administración', [
        'Secretaría de Dirección',
        'Secretaría de Unidad Académica',
        'Responsable de almacén',
        'Responsable de caja chica',
        'Programador de sistemas',
        'Auxiliares de laboratorio de los tres programas de estudio',
        'Auxiliares de biblioteca (turnos diurno y noche)',
        'Responsable de servicios académicos (turno noche)',
        'Responsable de personal',
        'Chofer',
        'Trabajador de servicio',
    ]],
];
?>
<?= mac_aviso('Autoridades', 'Para conocer quién ocupa actualmente cada cargo, consulta directamente con el instituto.') ?>
<h2>Organización institucional</h2>
<div class="organigrama">
  <div class="organigrama-cabeza">
    <p class="organigrama-direccion">Dirección General</p>
    <p class="organigrama-asesor">Consejo Asesor</p>
  </div>
  <ul class="organigrama-unidades">
<?php foreach ($unidades as [$unidad, $dependencias]): ?>
    <li>
      <p class="organigrama-unidad"><?= mac_e($unidad) ?></p>
<?php if ($dependencias): ?>
      <ul class="organigrama-dependencias">
<?php foreach ($dependencias as $dependencia): ?>
        <li><?= mac_e($dependencia) ?></li>
<?php endforeach; ?>
      </ul>
<?php endif; ?>
    </li>
<?php endforeach; ?>
  </ul>
</div>
<p class="fuente">Fuente: organigrama institucional publicado por el instituto.</p>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
