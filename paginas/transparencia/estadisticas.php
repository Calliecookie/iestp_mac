<?php
$titulo = 'Estadísticas';
$activo = 'transparencia';
$pagina = 'estadisticas';
$raiz = '../../';
$lead = 'Indicadores de la comunidad educativa, metas de atención por programa de estudio y dotación de plazas según los documentos oficiales publicados por el instituto.';
$descripcion = 'Estadísticas de estudiantes, personal, infraestructura y plazas del IESTP Manuel Arévalo Cáceres con respaldo documental.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<h2>Comunidad educativa e infraestructura</h2>
<p>Datos de matrícula por turno, personal en funciones y ambientes físicos consignados en el diagnóstico institucional del Plan de Gestión del Riesgo de Desastres:</p>
<div class="columnas-dos">
  <div class="ficha">
    <h3 class="ficha-titulo">Población estudiantil y personal (2025)</h3>
    <dl>
      <div><dt>Total de estudiantes</dt><dd>568 estudiantes matriculados (244 hombres y 324 mujeres)</dd></div>
      <div><dt>Turno diurno</dt><dd>291 estudiantes (130 hombres y 161 mujeres)</dd></div>
      <div><dt>Turno nocturno</dt><dd>277 estudiantes (114 hombres y 163 mujeres)</dd></div>
      <div><dt>Personal docente</dt><dd>38 docentes (21 hombres y 17 mujeres)</dd></div>
      <div><dt>Personal directivo</dt><dd>2 directivos (1 hombre y 1 mujer)</dd></div>
      <div><dt>Personal administrativo</dt><dd>14 administrativos (3 hombres y 11 mujeres)</dd></div>
      <div><dt>Personal de servicio</dt><dd>7 trabajadores (4 hombres y 3 mujeres)</dd></div>
    </dl>
    <p class="ficha-fuente">Fuente: <?= mac_doc_enlace('recursos/documentos/transparencia/no-vigentes/plan-gestion-riesgo-desastres-2025.pdf#page=10', 'Plan de Gestión del Riesgo de Desastres 2025, Tabla 3 (páginas 10–11 y 42)') ?>, aprobado por R. D. N.º 200-2025-DG-IESTP «MAC».</p>
  </div>
  <div class="ficha">
    <h3 class="ficha-titulo">Infraestructura del local institucional</h3>
    <dl>
      <div><dt>Código modular</dt><dd>1065655</dd></div>
      <div><dt>Código de local</dt><dd>311276</dd></div>
      <div><dt>Pabellones</dt><dd>6 pabellones educativos y administrativos</dd></div>
      <div><dt>Aulas pedagógicas</dt><dd>18 aulas</dd></div>
      <div><dt>Laboratorios y talleres</dt><dd>Laboratorios de cómputo, enfermería, ciencias, control de calidad y talleres de panadería, pastelería y procesamiento de alimentos</dd></div>
      <div><dt>Servicios complementarios</dt><dd>Biblioteca, auditorio, tópico, losa deportiva, cafetín y áreas verdes</dd></div>
    </dl>
    <p class="ficha-fuente">Fuente: <?= mac_doc_enlace('recursos/documentos/transparencia/no-vigentes/plan-gestion-riesgo-desastres-2025.pdf#page=8', 'Plan de Gestión del Riesgo de Desastres 2025, Tablas 1 y 4 (páginas 8 y 11–12)') ?>.</p>
  </div>
</div>

<h2>Metas de atención por programa de estudio (2026)</h2>
<p>Población estudiantil y personal considerados en la programación de actividades y campañas de la Unidad de Bienestar y Empleabilidad para el año académico 2026:</p>
<dl class="definiciones">
  <div>
    <dt>Desarrollo de Sistemas de Información</dt>
    <dd>225 estudiantes considerados en la meta anual (176 en Desarrollo de Sistemas de Información y 49 en el plan de Computación e Informática).</dd>
  </div>
  <div>
    <dt>Enfermería Técnica</dt>
    <dd>198 estudiantes considerados en la meta anual del programa de estudios.</dd>
  </div>
  <div>
    <dt>Industria de Alimentos y Bebidas</dt>
    <dd>145 estudiantes considerados en la meta anual (57 en Industrias de Alimentos y Bebidas y 88 en el plan de Industrias Alimentarias).</dd>
  </div>
  <div>
    <dt>Total de comunidad atendida en campañas 2026</dt>
    <dd>568 estudiantes de los tres programas (turnos diurno y nocturno), 40 docentes y 19 trabajadores administrativos.</dd>
  </div>
</dl>
<p class="fuente">Fuente: <?= mac_doc_enlace('recursos/documentos/transparencia/vigentes/plan-trabajo-unidad-bienestar-empleabilidad-2026.pdf#page=17', 'Plan Anual de Trabajo de la Unidad de Bienestar y Empleabilidad 2026, Tabla 1 y sección XII (páginas 17–20 y 40–48)') ?>.</p>

<h2>Cuantificación de cargos y plazas estimadas (2026–2032)</h2>
<p>Distribución de plazas orgánicas previstas en el Manual de Perfil de Puestos 2026–2032 para el funcionamiento académico y administrativo del instituto:</p>
<dl class="definiciones">
  <div>
    <dt>Dirección General</dt>
    <dd>2 plazas: 1 Director General y 1 Secretaria de Dirección General.</dd>
  </div>
  <div>
    <dt>Unidad Académica</dt>
    <dd>36 plazas: 1 Jefe de Unidad Académica, 3 Coordinadores de Área Académica y 32 Docentes.</dd>
  </div>
  <div>
    <dt>Unidades de Investigación, Formación Continua y Bienestar</dt>
    <dd>3 plazas directivas: 1 Jefe de la Unidad de Investigación, 1 Jefe de la Unidad de Formación Continua y 1 Jefe de la Unidad de Bienestar y Empleabilidad.</dd>
  </div>
  <div>
    <dt>Área de Calidad y Secretaría Académica</dt>
    <dd>2 plazas: 1 Coordinador del Área de Calidad y 1 Secretario Académico.</dd>
  </div>
  <div>
    <dt>Área de Administración</dt>
    <dd>1 Jefe de Área de Administración, 2 Secretarias, 2 Técnicos Administrativos, 2 Oficinistas, 1 Programador de Sistemas PAD, 2 Auxiliares de Laboratorio, 2 Auxiliares de Biblioteca, 3 Asistentes de Taller, 6 Trabajadores de Servicio y 1 Chofer.</dd>
  </div>
</dl>
<p class="fuente">Fuente: <?= mac_doc_enlace('recursos/documentos/' . mac_dato('mpp') . '#page=8', 'Manual de Perfil de Puestos 2026–2032, sección 5 «Tabla de cargos y cuantificación» (páginas 8–9)') ?>, aprobado por R. D. N.º 313-2025-DG-IESTP «MAC».</p>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
