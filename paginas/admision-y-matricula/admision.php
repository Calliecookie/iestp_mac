<?php
$titulo = 'Admisión';
$activo = 'admision';
$pagina = 'admision';
$raiz = '../../';
$lead = 'Modalidades y requisitos de admisión establecidos en el Manual de Procesos Académicos 2026–2032.';
$descripcion = 'Modalidades y requisitos de admisión del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
$pago = 'Pago por derecho de admisión que corresponde a la modalidad.';
$requisitos = [
    'Modalidad ordinaria' => [
        '' => ['Certificado de estudios secundarios.', 'Copia de DNI.', 'Pago por derecho de admisión.'],
    ],
    'Modalidad por exoneración' => [
        'Primer puesto de educación secundaria' => ['Acta de sesión de adjudicación del primer puesto refrendada por la UGEL.', 'Certificado de estudios secundarios.', 'Copia de DNI.', $pago],
        'Deportista calificado' => ['Constancia emitida por el IPD.', 'Certificado de estudios secundarios.', 'Copia de DNI.', $pago],
        'Servicio militar voluntario' => ['Constancia de servicio militar.', 'Certificado de estudios secundarios.', 'Copia de DNI.', $pago],
    ],
    'Modalidad de ingreso extraordinario' => [
        'Discapacidad (Ley N.º 29973)' => ['Certificado de discapacidad emitido por el Minsa.', 'Certificado de estudios secundarios.', 'Copia de DNI.', $pago],
        'Plan Integral de Reparaciones (Ley N.º 28592)' => ['Oficio de la CVR.', 'Certificado de estudios secundarios.', 'Copia de DNI.', $pago],
        'Reinserción por embarazo (Ley N.º 29600)' => ['Constancia de reinserción.', 'Certificado de estudios secundarios.', 'Copia de DNI.', $pago],
        'Persona adulta mayor de 60 años o más (Ley N.º 30490)' => ['Certificado de estudios secundarios.', 'Copia de DNI.', $pago],
        'Personas con discapacidad de las Fuerzas Armadas y la Policía Nacional (Ley N.º 29643)' => ['Constancia de discapacidad en servicio.', 'Certificado de estudios secundarios.', 'Copia de DNI.', $pago],
    ],
    'Exonerados por títulos o grados universitarios o superiores' => [
        '' => ['Copia legalizada del título o grado.', 'Certificado de estudios secundarios.', 'Copia de DNI.', $pago],
    ],
];
?>
<?= mac_aviso('Antes de pagar o entregar documentos', 'Confirma con el instituto las fechas, las vacantes y los montos de la convocatoria en curso.', 'alerta') ?>
<h2>Modalidades de admisión</h2>
<dl class="definiciones">
  <div><dt>Ordinaria</dt><dd>Se realiza periódicamente mediante una evaluación que considera condiciones de calidad, para cubrir el número de vacantes según el orden de mérito.</dd></div>
  <div><dt>Por exoneración</dt><dd>Contempla la admisión de deportistas calificados, estudiantes talentosos y quienes cumplen servicio militar voluntario, de conformidad con la normativa vigente.</dd></div>
  <div><dt>Ingreso extraordinario</dt><dd>Lo autoriza el Minedu y se implementa para becas y programas conforme a la normativa vigente.</dd></div>
</dl>
<h2 id="requisitos">Requisitos por modalidad</h2>
<div class="acordeon">
<?php $primero = true; foreach ($requisitos as $modalidad => $grupos): ?>
  <details<?= $primero ? ' open' : '' ?>>
    <summary><?= mac_e($modalidad) ?></summary>
    <div class="acordeon-cuerpo">
<?php foreach ($grupos as $grupo => $lista): ?>
<?php if ($grupo !== ''): ?>
      <h3 class="acordeon-subtitulo"><?= mac_e($grupo) ?></h3>
<?php endif; ?>
      <ul class="lista-marcada">
<?php foreach ($lista as $item): ?>
        <li><?= mac_e($item) ?></li>
<?php endforeach; ?>
      </ul>
<?php endforeach; ?>
    </div>
  </details>
<?php $primero = false; endforeach; ?>
</div>
<p class="fuente">Fuente: <?= mac_mpa_enlace(11, 'Manual de Procesos Académicos 2026–2032, páginas 9 a 11') ?>. Los derechos de admisión de cada modalidad figuran en la <?= mac_mpa_enlace(13, 'tabla de costos de la página 11') ?>.</p>
<h2>Prospecto de admisión</h2>
<?= mac_vacio('El prospecto de admisión aún no está alojado en este portal', 'Los requisitos, modalidades, etapas y tasas referenciales del proceso de admisión están detallados en el Manual de Procesos Académicos 2026–2032 del instituto. Para confirmar el cronograma y el prospecto de la convocatoria en curso, comunícate con el instituto.', [
    ['Ver proceso de admisión en el MPA (PDF)', 'recursos/documentos/' . mac_dato('mpa') . '#page=11', true],
    ['Consultar al instituto', 'paginas/contacto/contacto.php'],
]) ?>
<h2>Programas a los que puedes postular</h2>
<ul class="lista-enlaces">
<?php foreach (array_slice($GLOBALS['MAC_NAV']['programas'][1], 0, 3) as $programa): ?>
  <li><span class="lista-enlaces-nombre"><?= mac_e($programa[1]) ?></span><a class="boton boton-contorno boton-pequeno" href="<?= mac_url($programa[2]) ?>">Ver el programa<span class="sr"> <?= mac_e($programa[1]) ?></span></a></li>
<?php endforeach; ?>
</ul>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
