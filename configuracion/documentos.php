<?php
declare(strict_types=1);

if (!function_exists('mac_cargar_datos')) {
    function mac_cargar_datos(string $nombre): array
    {
        static $cache = [];
        $nombre = basename($nombre);
        if (isset($cache[$nombre])) return $cache[$nombre];
        $ruta = dirname(__DIR__) . '/recursos/datos/' . $nombre;
        if (!is_file($ruta)) return $cache[$nombre] = [];
        $crudo = file_get_contents($ruta);
        if (!is_string($crudo)) return $cache[$nombre] = [];
        $datos = json_decode($crudo, true);
        return $cache[$nombre] = is_array($datos) ? $datos : [];
    }
}

if (!function_exists('mac_fecha_larga')) {
    function mac_fecha_larga(?string $iso): string
    {
        if (!is_string($iso) || !preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $iso, $m)) return '';
        $meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
        $mes = $meses[((int) $m[2]) - 1] ?? '';
        if ($mes === '') return '';
        return ((int) $m[3]) . ' de ' . $mes . ' de ' . $m[1];
    }
}

if (!function_exists('mac_fecha_partes')) {
    function mac_fecha_partes(?string $iso): array
    {
        if (!is_string($iso) || !preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $iso, $m)) return [];
        $meses = ['ene.', 'feb.', 'mar.', 'abr.', 'may.', 'jun.', 'jul.', 'ago.', 'set.', 'oct.', 'nov.', 'dic.'];
        return ['dia' => (string) ((int) $m[3]), 'mes' => $meses[((int) $m[2]) - 1] ?? '', 'anio' => $m[1]];
    }
}

if (!function_exists('mac_tamano_legible')) {
    function mac_tamano_legible(string $ruta): string
    {
        $bytes = is_file($ruta) ? (int) filesize($ruta) : 0;
        if ($bytes <= 0) return '';
        if ($bytes >= 1048576) return number_format($bytes / 1048576, 1, ',', '') . ' MB';
        return number_format(max(1, $bytes / 1024), 0, ',', '') . ' KB';
    }
}

if (!function_exists('mac_cuenta_documentos')) {
    function mac_cuenta_documentos(int $n): string
    {
        return $n === 1 ? '1 documento' : $n . ' documentos';
    }
}

if (!function_exists('mac_documentos_de')) {
    function mac_documentos_de(string $pagina): array
    {
        $datos = mac_cargar_datos('documentos.json');
        $categorias = is_array($datos['categorias'] ?? null) ? $datos['categorias'] : [];
        $orden = is_array($datos['orden'] ?? null) ? $datos['orden'] : array_keys($categorias);
        $resultado = ['vigentes' => [], 'no_vigentes' => [], 'categorias' => $categorias, 'orden' => $orden];
        foreach (($datos['documentos'] ?? []) as $doc) {
            if (!is_array($doc)) continue;
            $destinos = is_array($doc['destinos'] ?? null) ? $doc['destinos'] : [];
            if ($pagina !== '*' && !in_array($pagina, $destinos, true)) continue;
            $archivo = (string) ($doc['archivo'] ?? '');
            if ($archivo === '' || str_contains($archivo, '..')) continue;
            $ruta = dirname(__DIR__) . '/recursos/documentos/' . $archivo;
            if (!is_file($ruta)) continue;
            $doc['ruta_absoluta'] = $ruta;
            $clave = ($doc['estado'] ?? '') === 'vigente' ? 'vigentes' : 'no_vigentes';
            $resultado[$clave][] = $doc;
        }
        return $resultado;
    }
}

if (!function_exists('mac_documentos_recientes')) {
    function mac_documentos_recientes(int $cantidad): array
    {
        $conjunto = mac_documentos_de('*');
        $lista = array_values(array_filter(array_merge($conjunto['vigentes'], $conjunto['no_vigentes']), static fn ($d) => is_string($d['fecha'] ?? null) && $d['fecha'] !== ''));
        usort($lista, static fn ($a, $b) => strcmp((string) $b['fecha'], (string) $a['fecha']));
        $vistos = [];
        $salida = [];
        foreach ($lista as $doc) {
            $clave = (string) ($doc['archivo'] ?? '');
            if (isset($vistos[$clave])) continue;
            $vistos[$clave] = true;
            $doc['categoria_nombre'] = (string) ($conjunto['categorias'][$doc['categoria'] ?? ''] ?? 'Documento');
            $salida[] = $doc;
            if (count($salida) >= $cantidad) break;
        }
        return $salida;
    }
}

if (!function_exists('mac_documentos_agrupar')) {
    function mac_documentos_agrupar(array $lista, array $orden): array
    {
        $grupos = [];
        foreach ($orden as $clave) {
            foreach ($lista as $doc) {
                if (($doc['categoria'] ?? '') === $clave) $grupos[$clave][] = $doc;
            }
        }
        foreach ($lista as $doc) {
            $clave = (string) ($doc['categoria'] ?? 'otros');
            if (!in_array($clave, $orden, true)) $grupos[$clave][] = $doc;
        }
        return $grupos;
    }
}

if (!function_exists('mac_documento_url')) {
    function mac_documento_url(array $doc): string
    {
        return mac_url('recursos/documentos/' . (string) ($doc['archivo'] ?? ''));
    }
}

if (!function_exists('mac_documento_item')) {
    function mac_documento_item(array $doc, string $nivel): string
    {
        $vigente = ($doc['estado'] ?? '') === 'vigente';
        $url = mac_documento_url($doc);
        $titulo = mac_e((string) ($doc['titulo'] ?? ''));
        $datos = '';
        if (!empty($doc['periodo'])) $datos .= '<div><dt>Periodo</dt><dd>' . mac_e((string) $doc['periodo']) . '</dd></div>';
        $fecha = mac_fecha_larga($doc['fecha'] ?? null);
        if ($fecha !== '') $datos .= '<div><dt>Fecha</dt><dd>' . mac_e($fecha) . '</dd></div>';
        if (!empty($doc['resolucion'])) $datos .= '<div><dt>Documento</dt><dd>' . mac_e((string) $doc['resolucion']) . '</dd></div>';
        $paginas = (int) ($doc['paginas'] ?? 0);
        $tamano = mac_tamano_legible((string) ($doc['ruta_absoluta'] ?? ''));
        $formato = trim('PDF' . ($paginas > 0 ? ', ' . $paginas . ($paginas === 1 ? ' página' : ' páginas') : '') . ($tamano !== '' ? ', ' . $tamano : ''));
        $html = '<li class="registro-item' . ($vigente ? '' : ' es-archivo') . '" data-categoria="' . mac_e((string) ($doc['categoria'] ?? '')) . '">';
        $html .= '<span class="registro-tipo" aria-hidden="true">' . mac_icono('documento') . 'PDF</span>';
        $html .= '<div class="registro-cuerpo">';
        $html .= '<p class="sello' . ($vigente ? ' sello-vigente' : ' sello-archivo') . '">' . ($vigente ? 'Vigente' : 'No vigente') . '</p>';
        $html .= '<' . $nivel . ' class="registro-titulo">' . $titulo . '</' . $nivel . '>';
        if (!empty($doc['descripcion'])) $html .= '<p class="registro-desc">' . mac_e((string) $doc['descripcion']) . '</p>';
        if ($datos !== '') $html .= '<dl class="registro-datos">' . $datos . '</dl>';
        if (!empty($doc['nota'])) $html .= '<p class="registro-nota">' . mac_icono('info') . '<span>' . mac_e((string) $doc['nota']) . '</span></p>';
        $html .= '</div>';
        $html .= '<div class="registro-acciones">';
        $html .= '<a class="boton boton-pequeno" href="' . $url . '" target="_blank" rel="noopener noreferrer">' . mac_icono('documento') . 'Ver documento<span class="sr">: ' . $titulo . ' (se abre en una pestaña nueva)</span></a>';
        $html .= '<a class="enlace-descarga" href="' . $url . '" download>' . mac_icono('descarga') . 'Descargar<span class="sr"> ' . $titulo . '</span></a>';
        $html .= '<span class="registro-formato">' . mac_e($formato) . '</span>';
        $html .= '</div></li>';
        return $html;
    }
}

if (!function_exists('mac_documentos_bloque')) {
    function mac_documentos_bloque(array $lista, array $categorias, array $orden, bool $conTitulos): string
    {
        $html = '';
        foreach (mac_documentos_agrupar($lista, $orden) as $clave => $docs) {
            $html .= '<div class="registro-grupo">';
            if ($conTitulos) $html .= '<h3 class="registro-grupo-titulo">' . mac_e((string) ($categorias[$clave] ?? 'Otros documentos')) . '</h3>';
            $html .= '<ul class="registro-lista">';
            foreach ($docs as $doc) $html .= mac_documento_item($doc, $conTitulos ? 'h4' : 'h3');
            $html .= '</ul></div>';
        }
        return $html;
    }
}

if (!function_exists('mac_documentos_mostrar')) {
    function mac_documentos_mostrar(string $pagina, string $raiz = '', array $opciones = []): void
    {
        $conjunto = mac_documentos_de($pagina);
        $vigentes = $conjunto['vigentes'];
        $archivados = $conjunto['no_vigentes'];
        $categorias = $conjunto['categorias'];
        $orden = $conjunto['orden'];
        $usadas = [];
        foreach (array_merge($vigentes, $archivados) as $doc) $usadas[(string) ($doc['categoria'] ?? '')] = true;
        $varias = count($usadas) > 1;
        $total = count($vigentes) + count($archivados);
        $tituloVigentes = (string) ($opciones['titulo'] ?? 'Documentos vigentes');
        $id = 'registro-' . preg_replace('/[^a-z0-9]+/', '-', $pagina === '*' ? 'todos' : $pagina);

        echo '<div class="registro" data-registro>';
        if ($total > 4 || $varias) {
            echo '<div class="registro-herramientas">';
            echo '<label class="campo-busqueda"><span class="campo-etiqueta">Buscar en estos documentos</span>';
            echo '<span class="campo-busqueda-caja">' . mac_icono('buscar') . '<input type="search" placeholder="Título, periodo o número de resolución" autocomplete="off" data-registro-buscar></span></label>';
            if ($varias) {
                echo '<div class="filtros" role="group" aria-label="Filtrar por tipo de documento">';
                echo '<button type="button" class="filtro" aria-pressed="true" data-filtro="todas">Todos</button>';
                foreach (array_merge($orden, array_diff(array_keys($usadas), $orden)) as $clave) {
                    if (!isset($usadas[$clave])) continue;
                    echo '<button type="button" class="filtro" aria-pressed="false" data-filtro="' . mac_e((string) $clave) . '">' . mac_e((string) ($categorias[$clave] ?? 'Otros documentos')) . '</button>';
                }
                echo '</div>';
            }
            echo '</div>';
            echo '<p class="registro-resumen" role="status" aria-live="polite" data-registro-resumen></p>';
        }

        echo '<section class="registro-bloque" aria-labelledby="' . $id . '-vigentes">';
        echo '<div class="registro-cabeza"><h2 class="titulo-bloque" id="' . $id . '-vigentes">' . mac_e($tituloVigentes) . '</h2><span class="registro-cuenta">' . mac_e(mac_cuenta_documentos(count($vigentes))) . '</span></div>';
        if (count($vigentes) > 0) {
            echo mac_documentos_bloque($vigentes, $categorias, $orden, $varias);
        } else {
            echo '<p class="registro-vacio">No hay documentos vigentes publicados en esta sección.</p>';
        }
        echo '</section>';

        if (count($archivados) > 0 || !empty($opciones['mostrar_archivo'])) {
            echo '<details class="registro-archivo"' . (count($vigentes) === 0 && count($archivados) > 0 ? ' open' : '') . '>';
            echo '<summary><span class="registro-archivo-titulo">Documentos no vigentes</span><span class="registro-cuenta">' . mac_e(mac_cuenta_documentos(count($archivados))) . '</span>' . mac_icono('chevron', 'icono registro-archivo-chevron') . '</summary>';
            echo '<div class="registro-archivo-cuerpo"><p class="registro-ayuda">Su periodo de aplicación ya concluyó. Se conservan para consulta.</p>';
            if (count($archivados) > 0) {
                echo mac_documentos_bloque($archivados, $categorias, $orden, $varias);
            } else {
                echo '<p class="registro-vacio">Todavía no hay documentos archivados en esta sección.</p>';
            }
            echo '</div></details>';
        }
        echo '</div>';
    }
}

if (!function_exists('mac_publicaciones_html')) {
    function mac_publicaciones_html(int $cantidad, string $nivel = 'h3'): string
    {
        $lista = mac_documentos_recientes($cantidad);
        if (!$lista) return '';
        $html = '<ol class="publicaciones-lista">';
        foreach ($lista as $i => $doc) {
            $f = mac_fecha_partes($doc['fecha'] ?? null);
            $titulo = mac_e((string) ($doc['titulo'] ?? ''));
            $html .= '<li class="publicacion">';
            $html .= '<p class="publicacion-fecha"><time datetime="' . mac_e((string) $doc['fecha']) . '"><span class="publicacion-dia">' . mac_e($f['dia'] ?? '') . '</span> <span class="publicacion-mes">' . mac_e(($f['mes'] ?? '') . ' ' . ($f['anio'] ?? '')) . '</span></time></p>';
            $html .= '<div class="publicacion-cuerpo">';
            $html .= '<' . $nivel . ' class="publicacion-titulo">' . $titulo . '</' . $nivel . '>';
            $html .= '<p class="publicacion-dato"><span class="publicacion-categoria">' . mac_e((string) $doc['categoria_nombre']) . '</span>' . (!empty($doc['resolucion']) ? '<span>' . mac_e((string) $doc['resolucion']) . '</span>' : '') . '</p>';
            $html .= '</div>';
            $html .= '<a class="boton boton-contorno boton-pequeno" href="' . mac_documento_url($doc) . '" target="_blank" rel="noopener noreferrer">' . mac_icono('documento') . 'Ver PDF<span class="sr">: ' . $titulo . ' (se abre en una pestaña nueva)</span></a>';
            $html .= '</li>';
        }
        return $html . '</ol>';
    }
}
