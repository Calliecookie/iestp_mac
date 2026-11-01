<?php
$titulo = 'TUPA y tasas';
$activo = 'transparencia';
$pagina = 'tupa';
$raiz = '../../';
$lead = 'El Texto Único de Procedimientos Administrativos (TUPA) reúne procedimientos, requisitos, tasas y plazos, que deben coincidir con el instrumento oficialmente aprobado.';
$descripcion = 'TUPA, tasas, costos y plazos de trámites académicos del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
$procedimientos = [
    ['Matrícula (ingresantes, ratificación, reincorporación y repitencia)', 'Costo según tasa vigente (S/ 160,00 en el tarifario referencial; repitencia por créditos). Plazo de atención: hasta 5 días hábiles.', 16],
    ['Reserva de matrícula y licencia de estudios', 'Derecho de trámite según tarifario institucional (S/ 20,00 referencial). Plazo de atención: hasta 7 días hábiles con emisión de Resolución Directoral.', 20],
    ['Convalidación de estudios (interna o externa)', 'Solicitud con sílabos y certificado original de estudios. Plazo de atención: entre 7 y 10 días hábiles.', 23],
    ['Traslado interno y traslado externo', 'Sujeto a vacante en el programa de destino. Plazo de atención: hasta 10 días hábiles.', 27],
    ['Reincorporación de estudios', 'Sujeta a vacante y plan de estudios vigente (S/ 20,00 por trámite más matrícula). Plazo de atención: hasta 7 días hábiles.', 34],
    ['Certificados y constancias de estudios', 'Constancias (S/ 25,00 referencial, hasta 5 días hábiles) y certificados oficiales o modulares (hasta 10 días hábiles).', 38],
    ['Grado de bachiller técnico', 'Requiere concluir el plan de estudios, EFSRT e idioma extranjero/originario (S/ 155,00 referencial). Plazo: hasta 30 días hábiles.', 43],
    ['Título profesional técnico y modalidades de titulación', 'Carpeta de titulación y sustentación por trabajo de aplicación profesional o examen de suficiencia. Plazo total del proceso: hasta 45 días hábiles.', 48],
    ['Rectificación de nombres o apellidos y duplicados', 'Rectificación administrativa (S/ 30,00 referencial, hasta 10 días hábiles) y duplicado de diplomas o certificados (hasta 15 a 30 días hábiles).', 60],
    ['Evaluación extraordinaria, subsanación y evaluación de idiomas', 'Evaluaciones académicas y de suficiencia de idioma según programación y tasas del tarifario vigente.', 79],
];
?>
<?= mac_aviso('El TUPA aprobado aún no está publicado en este portal', 'Mientras tanto, el Manual de Procesos Académicos 2026–2032 detalla los requisitos, costos referenciales y plazos de cada trámite académico, e incluye como anexo la relación de tasas del ejercicio 2025. Antes de realizar cualquier abono, confirma la tasa vigente y el número de cuenta con el Área de Administración.', 'alerta') ?>
<?php mac_documentos_mostrar('tupa', $raiz, ['titulo' => 'Documentos de referencia']); ?>

<h2>Resumen de procedimientos, costos referenciales y plazos</h2>
<p>Los siguientes procedimientos, montos referenciales y plazos máximos en días hábiles provienen del Manual de Procesos Académicos 2026–2032:</p>
<dl class="definiciones">
<?php foreach ($procedimientos as [$nombre, $detalle, $paginaPdf]): ?>
  <div>
    <dt><?= mac_e($nombre) ?></dt>
    <dd><?= mac_e($detalle) ?> <?= mac_mpa_enlace($paginaPdf, 'Ver página ' . $paginaPdf . ' del manual') ?>.</dd>
  </div>
<?php endforeach; ?>
</dl>
<p class="fuente">Consulta el índice completo de los 19 procedimientos académicos y descarga el Formato Único de Trámite (FUT) en <a href="../servicios/mesa-de-partes.php">Mesa de partes</a>.</p>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
