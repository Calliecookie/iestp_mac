<?php
declare(strict_types=1);

$GLOBALS['MAC_SITIO'] = [
    'nombre' => 'Instituto de Educación Superior Tecnológico Público Manuel Arévalo Cáceres',
    'nombre_corto' => 'IESTP Manuel Arévalo Cáceres',
    'telefono' => '(01) 485-0654',
    'telefono_enlace' => '+5114850654',
    'telefonos_atencion' => [
        ['(01) 485-0654', '+5114850654'],
        ['(01) 521-0733', '+5115210733'],
        ['(01) 522-3957', '+5115223957'],
    ],
    'correo' => 'informes@iestp-mac.edu.pe',
    'direccion' => 'Av. Los Alisos N.º 858, Urb. Carlos Cueto Fernandini',
    'distrito' => 'Los Olivos, Lima',
    'referencia' => 'Altura de la cuadra 43 de la Av. Las Palmeras',
    'horario' => 'Lunes a viernes, de 08:00 a. m. a 10:00 p. m.',
    'refrigerio' => 'Lunes a viernes, de 01:00 p. m. a 02:00 p. m.',
    'mapa' => 'https://www.google.com/maps/search/?api=1&query=IESTP+Manuel+Ar%C3%A9valo+C%C3%A1ceres%2C+Av.+Los+Alisos+858%2C+Los+Olivos%2C+Lima',
    'intranet' => 'https://iestp-mac.jedu.pe/',
    'digitalia' => 'https://www.digitaliapublishing.com/login',
    'drelm' => 'https://www.drelm.gob.pe/',
    'minedu' => 'https://www.gob.pe/minedu',
    'mpa' => 'normativa/vigentes/manual-procesos-academicos-2026-2032.pdf',
    'mpp' => 'normativa/vigentes/manual-perfil-puestos-2026-2032.pdf',
];

$GLOBALS['MAC_NAV'] = [
    'nosotros' => ['Institución', [
        ['historia', 'Nuestra historia', 'paginas/nosotros/historia.php'],
        ['mision', 'Misión, visión y valores', 'paginas/nosotros/mision-vision-valores.php'],
        ['plana', 'Plana jerárquica y organigrama', 'paginas/nosotros/plana-jerarquica.php'],
        ['docentes', 'Personal docente', 'paginas/nosotros/personal-docente.php'],
    ]],
    'programas' => ['Programas de estudio', [
        ['sistemas', 'Desarrollo de Sistemas de Información', 'paginas/programas-de-estudio/desarrollo-sistemas.php'],
        ['enfermeria', 'Enfermería Técnica', 'paginas/programas-de-estudio/enfermeria-tecnica.php'],
        ['alimentos', 'Industria de Alimentos y Bebidas', 'paginas/programas-de-estudio/industria-alimentos.php'],
        ['efsrt', 'Experiencias formativas (EFSRT)', 'paginas/programas-de-estudio/efsrt.php'],
    ]],
    'admision' => ['Admisión y matrícula', [
        ['admision', 'Admisión', 'paginas/admision-y-matricula/admision.php', false, 'Postular'],
        ['becas', 'Becas', 'paginas/admision-y-matricula/becas.php', false, 'Postular'],
        ['matricula', 'Procesos de matrícula', 'paginas/admision-y-matricula/matricula.php', false, 'Matricularme'],
        ['registro', 'Registro de matrícula', 'paginas/admision-y-matricula/registro-matricula.php', false, 'Matricularme'],
    ]],
    'servicios' => ['Servicios', [
        ['educacionales', 'Servicios educacionales', 'paginas/servicios/servicios-educacionales.php'],
        ['plataforma', 'Plataforma virtual', 'paginas/servicios/plataforma-virtual.php'],
        ['biblioteca', 'Biblioteca institucional', 'paginas/servicios/biblioteca-institucional.php'],
        ['digitalia', 'Biblioteca virtual Digitalia', 'https://www.digitaliapublishing.com/login', true],
        ['mesa', 'Mesa de partes', 'paginas/servicios/mesa-de-partes.php'],
        ['bolsa', 'Bolsa laboral', 'paginas/servicios/bolsa-laboral.php'],
        ['atencion', 'Atención y orientación ciudadana', 'paginas/servicios/libro-reclamaciones.php'],
        ['enlaces', 'Enlaces institucionales', 'paginas/otros/otros-enlaces.php'],
    ]],
    'transparencia' => ['Transparencia', [
        ['gestion', 'Documentos de gestión', 'paginas/transparencia/documentos-gestion.php'],
        ['tupa', 'TUPA y tasas', 'paginas/transparencia/tupa.php'],
        ['estadisticas', 'Estadísticas', 'paginas/transparencia/estadisticas.php'],
        ['licenciamiento', 'Licenciamiento', 'paginas/transparencia/licenciamiento.php'],
        ['inversiones', 'Inversiones', 'paginas/transparencia/inversiones.php'],
        ['convenios', 'Convenios', 'paginas/transparencia/convenios.php'],
        ['archivos', 'Archivos oficiales', 'paginas/otros/archivos-oficiales.php'],
    ]],
    'publicaciones' => ['Noticias', [
        ['noticias', 'Noticias', 'paginas/otros/noticias.php'],
        ['comunicados', 'Comunicados', 'paginas/otros/comunicados.php'],
        ['convocatoria', 'Convocatoria de personal', 'paginas/otros/convocatoria-personal.php'],
    ]],
    'contacto' => ['Contacto', [
        ['contacto', 'Contacto', 'paginas/contacto/contacto.php'],
    ]],
];

$GLOBALS['MAC_PERFILES'] = [
    'postular' => ['Quiero postular', [
        ['matricula', 'Requisitos por modalidad', 'Documentos que pide cada modalidad de admisión', 'paginas/admision-y-matricula/admision.php#requisitos', false],
        ['libro', 'Programas de estudio', 'Tres carreras profesionales técnicas', 'index.php#programas', false],
        ['usuarios', 'Becas', 'Descuentos que regula el Manual de Procesos Académicos', 'paginas/admision-y-matricula/becas.php', false],
        ['documento', 'Reglamento de admisión', 'Manual de Procesos Académicos, PDF', 'recursos/documentos/normativa/vigentes/manual-procesos-academicos-2026-2032.pdf#page=11', true],
        ['calendario', 'Calendario académico 2026', 'Fechas de admisión, matrícula y clases', 'paginas/admision-y-matricula/matricula.php#calendario', false],
        ['atencion', 'Escribir una consulta', 'Te respondemos al correo que indiques', 'paginas/contacto/contacto.php', false],
    ]],
    'estudiante' => ['Ya estudio aquí', [
        ['pantalla', 'Intranet', 'Plataforma académica del instituto', 'https://iestp-mac.jedu.pe/', true],
        ['matricula', 'Procesos de matrícula', 'Tipos de matrícula, requisitos y cronogramas', 'paginas/admision-y-matricula/matricula.php', false],
        ['calendario', 'Calendario académico 2026', 'Actividades y fechas del año académico', 'paginas/admision-y-matricula/matricula.php#calendario', false],
        ['reloj', 'Horarios de laboratorio', 'Turno diurno y turno noche', 'paginas/programas-de-estudio/desarrollo-sistemas.php#horarios', false],
        ['libro', 'Biblioteca virtual Digitalia', 'Libros electrónicos en español', 'https://www.digitaliapublishing.com/login', true],
        ['maletin', 'Experiencias formativas (EFSRT)', 'Requisitos, procedimiento y convenios', 'paginas/programas-de-estudio/efsrt.php', false],
    ]],
    'tramite' => ['Hacer un trámite', [
        ['bandeja', 'Mesa de partes', 'Solicitudes y trámites académicos', 'paginas/servicios/mesa-de-partes.php', false],
        ['documento', 'Formato Único de Trámite', 'FUT para iniciar tu solicitud, PDF', 'recursos/documentos/tramites/vigentes/formato-unico-de-tramite.pdf', true],
        ['institucion', 'TUPA y tasas', 'Procedimientos, costos referenciales y plazos', 'paginas/transparencia/tupa.php', false],
        ['atencion', 'Atención y orientación ciudadana', 'Canales de consulta y horarios', 'paginas/servicios/libro-reclamaciones.php', false],
        ['documento', 'Documentos de gestión', 'Planes, manuales y resoluciones vigentes', 'paginas/transparencia/documentos-gestion.php', false],
        ['buscar', 'Archivos oficiales', 'Busca cualquier documento publicado', 'paginas/otros/archivos-oficiales.php', false],
    ]],
    'empresas' => ['Empresas y egresados', [
        ['maletin', 'Bolsa laboral', 'Ofertas verificadas y planes de inserción laboral', 'paginas/servicios/bolsa-laboral.php', false],
        ['institucion', 'Convenios', 'Convenios firmados con empresas y universidades', 'paginas/transparencia/convenios.php', false],
        ['usuarios', 'Experiencias formativas (EFSRT)', 'Prácticas en situaciones reales de trabajo', 'paginas/programas-de-estudio/efsrt.php', false],
        ['documento', 'Seguimiento de egresados', 'Plan de Seguimiento de Egresados 2026–2032, PDF', 'recursos/documentos/transparencia/vigentes/plan-seguimiento-egresados-2026-2032.pdf', true],
        ['correo', 'Contactar al instituto', 'Escríbenos sobre convenios y prácticas', 'paginas/contacto/contacto.php', false],
    ]],
];

if (!function_exists('mac_dato')) {
    function mac_dato(string $clave): string
    {
        $valor = $GLOBALS['MAC_SITIO'][$clave] ?? '';
        return is_string($valor) ? $valor : '';
    }
}

if (!function_exists('mac_e')) {
    function mac_e(string $texto): string
    {
        return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('mac_url')) {
    function mac_url(string $ruta): string
    {
        if (preg_match('~^(https?:|mailto:|tel:|#)~', $ruta)) return mac_e($ruta);
        return mac_e(($GLOBALS['raiz'] ?? '') . $ruta);
    }
}

if (!function_exists('mac_recurso')) {
    function mac_recurso(string $ruta): string
    {
        $archivo = dirname(__DIR__) . '/' . $ruta;
        $version = is_file($archivo) ? (string) filemtime($archivo) : '1';
        return mac_url($ruta) . '?v=' . $version;
    }
}

if (!function_exists('mac_icono')) {
    function mac_icono(string $nombre, string $clase = 'icono'): string
    {
        static $trazos = [
            'telefono' => 'M5 4h3l2 5-2 1.5a12 12 0 0 0 5.5 5.5L15 14l5 2v3a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z',
            'correo' => 'M3 6.5A1.5 1.5 0 0 1 4.5 5h15A1.5 1.5 0 0 1 21 6.5v11a1.5 1.5 0 0 1-1.5 1.5h-15A1.5 1.5 0 0 1 3 17.5zM3.5 6.5l8.5 6.5 8.5-6.5',
            'ubicacion' => 'M12 21s7-6.2 7-11a7 7 0 0 0-14 0c0 4.8 7 11 7 11zM12 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z',
            'reloj' => 'M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18zM12 7v5l3 2',
            'documento' => 'M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8zM14 3v5h5M9 13h6M9 17h6',
            'descarga' => 'M12 4v11M7 10l5 5 5-5M5 20h14',
            'externo' => 'M14 4h6v6M20 4l-9 9M18 14v4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4',
            'chevron' => 'M6 9l6 6 6-6',
            'izquierda' => 'M15 6l-6 6 6 6',
            'derecha' => 'M9 6l6 6-6 6',
            'cerrar' => 'M6 6l12 12M18 6L6 18',
            'buscar' => 'M11 18a7 7 0 1 0 0-14 7 7 0 0 0 0 14zM20 20l-4-4',
            'bandeja' => 'M4 13l2.5-7.5A2 2 0 0 1 8.4 4h7.2a2 2 0 0 1 1.9 1.5L20 13M4 13v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5M4 13h4.5l1.5 3h4l1.5-3H20',
            'pantalla' => 'M3 5h18v11H3zM8 20h8M12 16v4',
            'matricula' => 'M9 3.5h6v3H9zM9 5H6.5A1.5 1.5 0 0 0 5 6.5v13A1.5 1.5 0 0 0 6.5 21h11a1.5 1.5 0 0 0 1.5-1.5v-13A1.5 1.5 0 0 0 17.5 5H15M9 14l2 2 4-4',
            'libro' => 'M4 5.5A1.5 1.5 0 0 1 5.5 4H10a2 2 0 0 1 2 2v14a2 2 0 0 0-2-2H4zM20 5.5A1.5 1.5 0 0 0 18.5 4H14a2 2 0 0 0-2 2v14a2 2 0 0 1 2-2h6z',
            'institucion' => 'M3 9l9-5 9 5M5 10v8M9.5 10v8M14.5 10v8M19 10v8M3 21h18M4 18h16',
            'atencion' => 'M4 5h16v11H9l-5 4zM8 9h8M8 12h5',
            'info' => 'M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18zM12 11v5M12 8h.01',
            'alerta' => 'M12 4l9 16H3zM12 10v4M12 17h.01',
            'check' => 'M5 12.5l4.5 4.5L19 7.5',
            'ampliar' => 'M15 4h5v5M9 20H4v-5M20 4l-6 6M4 20l6-6',
            'calendario' => 'M4 6h16v14H4zM4 10h16M8 3v4M16 3v4',
            'facebook' => 'M14 8h2.5V4.5H14A3.5 3.5 0 0 0 10.5 8v2.5H8V14h2.5v6.5H14V14h2.5l.5-3.5h-3V8.5a.5.5 0 0 1 .5-.5z',
            'youtube' => 'M3.5 8.2c.2-1.6 1.4-2.8 3-2.9C8.3 5.1 10.2 5 12 5s3.7.1 5.5.3c1.6.1 2.8 1.3 3 2.9.2 1.3.3 2.5.3 3.8s-.1 2.5-.3 3.8c-.2 1.6-1.4 2.8-3 2.9-1.8.2-3.7.3-5.5.3s-3.7-.1-5.5-.3c-1.6-.1-2.8-1.3-3-2.9-.2-1.3-.3-2.5-.3-3.8s.1-2.5.3-3.8zM10 9.2v5.6l4.8-2.8z',
            'usuarios' => 'M9 11a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zM3 20a6 6 0 0 1 12 0M16 4.5a3.5 3.5 0 0 1 0 6.5M21 20a6 6 0 0 0-3.5-5.5',
            'maletin' => 'M4 8h16v11H4zM9 8V6a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2M4 13h16',
            'alimentos' => 'M7 15h10v5H7zM7 15v-2.6A3.5 3.5 0 0 1 8.4 6a4 4 0 0 1 7.2 0A3.5 3.5 0 0 1 17 12.4V15M10 18h4',
            'salud' => 'M9 4h6v5h5v6h-5v5H9v-5H4V9h5z',
        ];
        $d = $trazos[$nombre] ?? $trazos['info'];
        return '<svg class="' . mac_e($clase) . '" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="' . $d . '"/></svg>';
    }
}

if (!function_exists('mac_externo')) {
    function mac_externo(): string
    {
        return mac_icono('externo', 'icono icono-externo') . '<span class="sr">(se abre en una pestaña nueva)</span>';
    }
}

if (!function_exists('mac_imagen')) {
    function mac_imagen(string $base, array $anchos, int $ancho, int $alto, string $alt, string $sizes = '100vw', array $extra = []): string
    {
        $raizDir = dirname(__DIR__) . '/';
        $srcset = [];
        foreach ($anchos as $w) {
            if (is_file($raizDir . $base . '-' . $w . '.webp')) {
                $srcset[] = mac_url($base . '-' . $w . '.webp') . ' ' . $w . 'w';
            }
        }
        $fuente = '';
        if ($srcset) {
            $fuente = '<source type="image/webp" srcset="' . implode(', ', $srcset) . '" sizes="' . mac_e($sizes) . '">';
        } elseif (is_file($raizDir . $base . '.webp')) {
            $fuente = '<source type="image/webp" srcset="' . mac_url($base . '.webp') . '">';
        }
        $carga = $extra['carga'] ?? 'lazy';
        $atributos = ' width="' . $ancho . '" height="' . $alto . '" alt="' . mac_e($alt) . '" decoding="async" loading="' . mac_e($carga) . '"';
        if (!empty($extra['prioridad'])) $atributos .= ' fetchpriority="high"';
        if (!empty($extra['clase'])) $atributos .= ' class="' . mac_e($extra['clase']) . '"';
        return '<picture>' . $fuente . '<img src="' . mac_url($base . '.jpg') . '"' . $atributos . '></picture>';
    }
}

if (!function_exists('mac_figura_zoom')) {
    function mac_figura_zoom(string $base, int $ancho, int $alto, string $alt, string $pie, string $id = ''): string
    {
        $extGrande = is_file(dirname(__DIR__) . '/' . $base . '.webp') ? '.webp' : '.jpg';
        $grande = mac_url($base . $extGrande);
        $html = '<figure class="figura-documento"' . ($id !== '' ? ' id="' . mac_e($id) . '"' : '') . '>';
        $html .= '<a class="figura-documento-marco" href="' . $grande . '" data-zoom aria-label="Ampliar imagen: ' . mac_e($alt) . '">';
        $html .= mac_imagen($base, [], $ancho, $alto, $alt);
        $html .= '<span class="figura-documento-ampliar">' . mac_icono('ampliar') . 'Ampliar</span></a>';
        $html .= '<figcaption>' . $pie . '</figcaption></figure>';
        return $html;
    }
}

if (!function_exists('mac_seccion_actual')) {
    function mac_seccion_actual(): array
    {
        $activo = (string) ($GLOBALS['activo'] ?? '');
        return $GLOBALS['MAC_NAV'][$activo] ?? ['', []];
    }
}

if (!function_exists('mac_pagina_abrir')) {
    function mac_pagina_abrir(): void
    {
        $titulo = (string) ($GLOBALS['titulo'] ?? '');
        $lead = (string) ($GLOBALS['lead'] ?? '');
        $pagina = (string) ($GLOBALS['pagina'] ?? '');
        [$seccion, $items] = mac_seccion_actual();
        $conMenu = count($items) > 1;
        echo '<main id="contenido" class="pagina" tabindex="-1">';
        echo '<header class="pagina-cabecera"><div class="contenedor">';
        echo '<nav class="migas" aria-label="Ruta de navegación"><ol><li><a href="' . mac_url('index.php') . '">Inicio</a></li>';
        if ($seccion !== '' && $conMenu && $seccion !== $titulo) echo '<li>' . mac_e($seccion) . '</li>';
        echo '<li aria-current="page">' . mac_e($titulo) . '</li></ol></nav>';
        echo '<h1 class="pagina-titulo">' . mac_e($titulo) . '</h1>';
        if ($lead !== '') echo '<p class="pagina-entrada">' . $lead . '</p>';
        echo '</div></header>';
        $banner = $GLOBALS['banner'] ?? null;
        if (is_array($banner) && isset($banner[0], $banner[1]) && is_file(dirname(__DIR__) . '/' . $banner[0] . '.jpg')) {
            echo '<div class="contenedor pagina-banner">' . mac_imagen((string) $banner[0], [960, 1600, 2560], 2000, 620, (string) $banner[1], '(max-width: 1279px) calc(100vw - 2rem), 76rem', ['carga' => 'eager', 'prioridad' => true]) . '</div>';
        }
        $ancho = !empty($GLOBALS['ancho_completo']);
        echo '<div class="contenedor pagina-cuerpo' . ($conMenu ? '' : ' pagina-cuerpo-simple') . ($ancho ? ' pagina-cuerpo-ancho' : '') . '">';
        if ($conMenu) {
            echo '<nav class="menu-seccion" aria-label="' . mac_e('En ' . $seccion) . '"><p class="menu-seccion-titulo">' . mac_e($seccion) . '</p><ul>';
            foreach ($items as $item) {
                $externo = !empty($item[3]);
                $actual = $item[0] === $pagina;
                echo '<li><a href="' . mac_url($item[2]) . '"' . ($actual ? ' aria-current="page"' : '') . ($externo ? ' target="_blank" rel="noopener noreferrer"' : '') . '>' . mac_e($item[1]) . ($externo ? mac_externo() : '') . '</a></li>';
            }
            echo '</ul></nav>';
        }
        echo '<div class="pagina-contenido">';
    }
}

if (!function_exists('mac_pagina_cerrar')) {
    function mac_pagina_cerrar(bool $ayuda = true): void
    {
        if ($ayuda) {
            echo '<aside class="ayuda" aria-label="Orientación">';
            echo '<p class="ayuda-titulo">¿Necesitas confirmar un dato o un plazo?</p>';
            echo '<p>Antes de iniciar un trámite o realizar un pago, confirma la información con el instituto.</p>';
            echo '<ul class="ayuda-canales">';
            echo '<li><a href="tel:' . mac_e(mac_dato('telefono_enlace')) . '">' . mac_icono('telefono') . mac_e(mac_dato('telefono')) . '</a></li>';
            echo '<li><a href="mailto:' . mac_e(mac_dato('correo')) . '">' . mac_icono('correo') . mac_e(mac_dato('correo')) . '</a></li>';
            echo '<li><a href="' . mac_url('paginas/contacto/contacto.php') . '">' . mac_icono('atencion') . 'Escribir una consulta</a></li>';
            echo '</ul></aside>';
        }
        echo '</div></div></main>';
    }
}

if (!function_exists('mac_aviso')) {
    function mac_aviso(string $titulo, string $texto, string $tipo = 'info'): string
    {
        $icono = $tipo === 'alerta' ? 'alerta' : 'info';
        return '<div class="aviso aviso-' . mac_e($tipo) . '" role="note">' . mac_icono($icono, 'icono aviso-icono') . '<div><p class="aviso-titulo">' . mac_e($titulo) . '</p><p>' . $texto . '</p></div></div>';
    }
}

if (!function_exists('mac_doc_disponible')) {
    function mac_doc_disponible(string $destino): bool
    {
        if (!str_starts_with($destino, 'recursos/documentos/')) return true;
        $ruta = (string) strtok($destino, '#');
        return !str_contains($ruta, '..') && is_file(dirname(__DIR__) . '/' . $ruta);
    }
}

if (!function_exists('mac_doc_enlace')) {
    function mac_doc_enlace(string $destino, string $texto): string
    {
        if (!mac_doc_disponible($destino)) return mac_e($texto);
        return '<a href="' . mac_url($destino) . '" target="_blank" rel="noopener noreferrer">' . mac_e($texto) . mac_externo() . '</a>';
    }
}

if (!function_exists('mac_vacio')) {
    function mac_vacio(string $titulo, string $texto, array $acciones = []): string
    {
        $html = '<section class="vacio" aria-label="' . mac_e($titulo) . '"><div class="vacio-marca" aria-hidden="true">' . mac_icono('documento') . '</div><div>';
        $html .= '<h2 class="vacio-titulo">' . mac_e($titulo) . '</h2><p>' . $texto . '</p>';
        if ($acciones) {
            $html .= '<div class="acciones">';
            $i = 0;
            foreach ($acciones as $accion) {
                if (!mac_doc_disponible((string) $accion[1])) continue;
                $externo = !empty($accion[2]);
                $html .= '<a class="boton' . ($i > 0 ? ' boton-contorno' : '') . '" href="' . mac_url($accion[1]) . '"' . ($externo ? ' target="_blank" rel="noopener noreferrer"' : '') . '>' . mac_e($accion[0]) . ($externo ? mac_externo() : '') . '</a>';
                $i++;
            }
            $html .= '</div>';
        }
        return $html . '</div></section>';
    }
}

if (!function_exists('mac_mpa_enlace')) {
    function mac_mpa_enlace(int $paginaPdf, string $texto): string
    {
        return mac_doc_enlace('recursos/documentos/' . mac_dato('mpa') . '#page=' . $paginaPdf, $texto);
    }
}

if (!function_exists('mac_curiosidades')) {
    function mac_curiosidades(): array
    {
        return [
            'Fue creado el 13 de agosto de 1986, mediante la R. M. N.º 508-86-ED.',
            'Es el único instituto público del distrito de Los Olivos.',
            'Funciona con tres carreras desde el segundo semestre de 1992.',
            'Su nombre rinde homenaje a Manuel Arévalo Cáceres, diputado por La Libertad en el Congreso Constituyente del Perú.',
            'Fue revalidado mediante la R. M. N.º 0688-2006-ED.',
            'Sus actividades académicas se rigen por módulos técnico-profesionales y módulos transversales.',
        ];
    }
}

if (!function_exists('mac_ficha_programa')) {
    function mac_ficha_programa(string $coordinacion): string
    {
        $html = '<div class="ficha"><h2 class="ficha-titulo">Datos del programa</h2><dl>';
        $html .= '<div><dt>Nivel formativo</dt><dd>Profesional técnico</dd></div>';
        $html .= '<div><dt>Modalidad</dt><dd>Presencial</dd></div>';
        $html .= '<div><dt>Horario del servicio educativo</dt><dd>Lunes a viernes. Turno mañana de 08:00 a 16:00 y turno noche de 16:00 a 22:00.</dd></div>';
        $html .= '<div><dt>Responsable académico</dt><dd>' . mac_e($coordinacion) . '</dd></div>';
        $html .= '</dl><p class="ficha-fuente">Fuentes: ' . mac_mpa_enlace(8, 'Manual de Procesos Académicos 2026–2032') . ' y organigrama institucional.</p></div>';
        return $html;
    }
}

if (!function_exists('mac_perfiles_html')) {
    function mac_perfiles_html(): string
    {
        $perfiles = $GLOBALS['MAC_PERFILES'] ?? [];
        if (!$perfiles) return '';
        $html = '<section class="zocalo" id="perfiles" aria-labelledby="perfiles-titulo" data-perfiles>';
        $html .= '<div class="contenedor">';
        $html .= '<div class="zocalo-cabeza"><h2 class="zocalo-titulo" id="perfiles-titulo">¿Qué necesitas hacer?</h2>';
        $html .= '<div class="perfiles-pestanas" data-perfiles-pestanas>';
        foreach ($perfiles as $clave => [$nombre]) {
            $html .= '<button type="button" data-perfil="' . mac_e((string) $clave) . '">' . mac_e($nombre) . '</button>';
        }
        $html .= '</div></div>';
        foreach ($perfiles as $clave => [$nombre, $enlaces]) {
            $html .= '<div class="perfil-panel" id="perfil-' . mac_e((string) $clave) . '" data-perfil-panel="' . mac_e((string) $clave) . '">';
            $html .= '<h3 class="perfil-titulo">' . mac_e($nombre) . '</h3><ul class="perfil-enlaces">';
            foreach ($enlaces as [$icono, $titulo, $detalle, $destino, $externo]) {
                if (!mac_doc_disponible($destino)) continue;
                $html .= '<li><a href="' . mac_url($destino) . '"' . ($externo ? ' target="_blank" rel="noopener noreferrer"' : '') . '>' . mac_icono($icono) . '<span class="perfil-nombre">' . mac_e($titulo) . ($externo ? mac_externo() : '') . '</span><span class="perfil-detalle">' . mac_e($detalle) . '</span></a></li>';
            }
            $html .= '</ul></div>';
        }
        return $html . '</div></section>';
    }
}

if (!function_exists('mac_ilustracion')) {
    function mac_ilustracion(string $icono, string $clase = ''): string
    {
        return '<div class="ilustracion' . ($clase !== '' ? ' ' . mac_e($clase) : '') . '" aria-hidden="true">' . mac_icono($icono, 'icono ilustracion-icono') . '</div>';
    }
}

if (!function_exists('mac_imagen_o_ilustracion')) {
    function mac_imagen_o_ilustracion(string $base, array $anchos, int $ancho, int $alto, string $alt, string $sizes, string $icono): string
    {
        if (is_file(dirname(__DIR__) . '/' . $base . '.jpg')) {
            return mac_imagen($base, $anchos, $ancho, $alto, $alt, $sizes);
        }
        return mac_ilustracion($icono);
    }
}

if (!function_exists('mac_recorte')) {
    function mac_recorte(string $base, string $alt, string $sizes, string $clase = ''): string
    {
        $raizDir = dirname(__DIR__) . '/';
        $medidas = is_file($raizDir . $base . '.png') ? @getimagesize($raizDir . $base . '.png') : false;
        if (!$medidas) {
            return '';
        }
        $variantes = [];
        foreach (glob($raizDir . $base . '-*.webp') ?: [] as $archivo) {
            if (preg_match('/-(\d+)\.webp$/', $archivo, $m)) {
                $variantes[(int) $m[1]] = mac_url($base . '-' . $m[1] . '.webp') . ' ' . $m[1] . 'w';
            }
        }
        ksort($variantes);
        $fuente = $variantes ? '<source type="image/webp" srcset="' . implode(', ', $variantes) . '" sizes="' . mac_e($sizes) . '">' : '';
        $attrClase = $clase !== '' ? ' class="' . mac_e($clase) . '"' : '';
        return '<picture>' . $fuente . '<img' . $attrClase . ' src="' . mac_url($base . '.png') . '" width="' . (int) $medidas[0] . '" height="' . (int) $medidas[1] . '" alt="' . mac_e($alt) . '" loading="lazy" decoding="async"></picture>';
    }
}

if (!function_exists('mac_noticias')) {
    function mac_noticias(int $cantidad = 0): array
    {
        $datos = function_exists('mac_cargar_datos') ? mac_cargar_datos('noticias.json') : [];
        $lista = [];
        foreach (($datos['noticias'] ?? []) as $noticia) {
            if (!is_array($noticia)) continue;
            $titulo = trim((string) ($noticia['titulo'] ?? ''));
            $fecha = (string) ($noticia['fecha'] ?? '');
            if ($titulo === '' || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) continue;
            $lista[] = $noticia;
        }
        usort($lista, static fn ($a, $b) => strcmp((string) $b['fecha'], (string) $a['fecha']));
        return $cantidad > 0 ? array_slice($lista, 0, $cantidad) : $lista;
    }
}

if (!function_exists('mac_noticias_html')) {
    function mac_noticias_html(int $cantidad = 0, string $nivel = 'h3'): string
    {
        $lista = mac_noticias($cantidad);
        if (!$lista) return '';
        $raizDir = dirname(__DIR__) . '/';
        $html = '<ul class="noticias">';
        foreach ($lista as $noticia) {
            $titulo = mac_e(trim((string) $noticia['titulo']));
            $enlace = trim((string) ($noticia['enlace'] ?? ''));
            $externo = (bool) preg_match('~^https://~', $enlace);
            $valido = $externo || ($enlace !== '' && !str_contains($enlace, '..') && !preg_match('~^[a-z]+:~i', $enlace));
            $html .= '<li class="noticia"><article>';
            $imagen = trim((string) ($noticia['imagen'] ?? ''));
            $rutaImagen = 'recursos/imagenes/noticias/' . basename($imagen);
            if ($imagen !== '' && is_file($raizDir . $rutaImagen)) {
                $medidas = @getimagesize($raizDir . $rutaImagen);
                $dim = is_array($medidas) ? ' width="' . (int) $medidas[0] . '" height="' . (int) $medidas[1] . '"' : '';
                $html .= '<img class="noticia-imagen" src="' . mac_url($rutaImagen) . '" alt="' . mac_e((string) ($noticia['imagen_alt'] ?? '')) . '"' . $dim . ' loading="lazy" decoding="async">';
            } else {
                $html .= mac_ilustracion('calendario', 'noticia-ilustracion');
            }
            $html .= '<p class="noticia-fecha"><time datetime="' . mac_e((string) $noticia['fecha']) . '">' . mac_e(mac_fecha_larga((string) $noticia['fecha'])) . '</time></p>';
            $html .= '<' . $nivel . ' class="noticia-titulo">';
            if ($valido) {
                $html .= '<a href="' . ($externo ? mac_e($enlace) : mac_url($enlace)) . '"' . ($externo ? ' target="_blank" rel="noopener noreferrer"' : '') . '>' . $titulo . ($externo ? mac_externo() : '') . '</a>';
            } else {
                $html .= $titulo;
            }
            $html .= '</' . $nivel . '>';
            if (!empty($noticia['resumen'])) $html .= '<p class="noticia-resumen">' . mac_e((string) $noticia['resumen']) . '</p>';
            if (!empty($noticia['fuente'])) $html .= '<p class="noticia-fuente">Fuente: ' . mac_e((string) $noticia['fuente']) . '</p>';
            $html .= '</article></li>';
        }
        return $html . '</ul>';
    }
}
