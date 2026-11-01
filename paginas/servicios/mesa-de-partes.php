<?php
$titulo = 'Mesa de partes';
$activo = 'servicios';
$pagina = 'mesa';
$raiz = '../../';
$lead = 'Canal para presentar solicitudes y trámites académicos y administrativos ante el instituto.';
$descripcion = 'Mesa de partes, Formato Único de Trámite e índice de trámites académicos del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
$tramites = [
    ['Admisión', 11], ['Matrícula', 16], ['Reserva de matrícula', 20], ['Convalidación', 23], ['Traslado interno y externo', 27], ['Licencia de estudios', 31],
    ['Reincorporación', 34], ['Certificados y constancias', 38], ['Grado de bachiller técnico', 43], ['Título profesional técnico', 48], ['Modalidades de titulación', 55], ['Rectificaciones', 60],
    ['Duplicados', 64], ['Formación continua y certificación', 68], ['Experiencias formativas (EFSRT)', 71], ['Otorgamiento de becas', 75], ['Evaluación', 79], ['Evaluación de idiomas', 85],
    ['Abandono o renuncia de vacante', 89], ['Retiro de la condición de estudiante', 92],
];
?>
<?= mac_aviso('Antes de pagar', 'Este portal no publica instrucciones de pago verificadas. Confirma con el instituto el canal de recepción de expedientes, la tasa vigente y el comprobante que corresponde.', 'alerta') ?>
<h2>Formato y documentos para tus trámites</h2>
<p>La mayoría de trámites académicos se inicia con una solicitud en el Formato Único de Trámite (FUT), que se presenta por Mesa de Partes junto con los requisitos de cada caso.</p>
<?php mac_documentos_mostrar('mesa-de-partes', $raiz, ['titulo' => 'Documentos vigentes']); ?>
<h2>Trámites regulados por el Manual de Procesos Académicos</h2>
<p>Cada trámite indica la página del Manual de Procesos Académicos 2026–2032 donde empieza, con sus requisitos, costos y plazos.</p>
<ul class="indice-tramites">
<?php foreach ($tramites as [$nombre, $pagina_pdf]): ?>
<?php if (mac_doc_disponible('recursos/documentos/' . mac_dato('mpa'))): ?>
  <li><a href="<?= mac_url('recursos/documentos/' . mac_dato('mpa')) ?>#page=<?= $pagina_pdf ?>" target="_blank" rel="noopener noreferrer"><?= mac_e($nombre) ?><span>Página <?= $pagina_pdf ?> del PDF<span class="sr"> (se abre en una pestaña nueva)</span></span></a></li>
<?php else: ?>
  <li><span class="indice-tramites-item"><?= mac_e($nombre) ?><span>Página <?= $pagina_pdf ?> del manual</span></span></li>
<?php endif; ?>
<?php endforeach; ?>
</ul>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
