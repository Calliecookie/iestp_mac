<?php
require_once dirname(__DIR__) . '/configuracion/arranque.php';
$titulo = (string) ($titulo ?? 'Inicio');
$activo = (string) ($activo ?? '');
$raiz = (string) ($raiz ?? '');
$pagina = (string) ($pagina ?? '');
$GLOBALS['titulo'] = $titulo;
$GLOBALS['activo'] = $activo;
$GLOBALS['raiz'] = $raiz;
$GLOBALS['pagina'] = $pagina;
$GLOBALS['lead'] = (string) ($lead ?? '');
$GLOBALS['ancho_completo'] = !empty($anchoCompleto);
$macDescripcion = (string) ($descripcion ?? 'Instituto de Educación Superior Tecnológico Público Manuel Arévalo Cáceres, en Los Olivos, Lima. Programas de Desarrollo de Sistemas de Información, Enfermería Técnica e Industria de Alimentos y Bebidas.');
$macTituloCompleto = $activo === 'inicio' ? 'IESTP Manuel Arévalo Cáceres | Instituto tecnológico público en Los Olivos' : $titulo . ' | IESTP Manuel Arévalo Cáceres';
$macCanonicalPath = (string) (parse_url((string) ($_SERVER['SCRIPT_NAME'] ?? '/'), PHP_URL_PATH) ?: '/');
$macCanonicalPath = preg_replace('~(?:^|/)index\.php$~', '/', $macCanonicalPath) ?: '/';
$macBaseUrl = mac_base_url();
$macCanonicalUrl = $macBaseUrl . (str_starts_with($macCanonicalPath, '/') ? $macCanonicalPath : '/' . $macCanonicalPath);
$macNoIndex = !empty($macNoIndex) || mac_es_entorno_pruebas();
if ($macNoIndex && !headers_sent()) {
    header('X-Robots-Tag: noindex, nofollow');
}
$macSameAs = array_values(array_filter([
    filter_var((string) mac_config('facebook_page_url', ''), FILTER_VALIDATE_URL) ? (string) mac_config('facebook_page_url', '') : null,
    filter_var((string) mac_config('youtube_channel_url', ''), FILTER_VALIDATE_URL) ? (string) mac_config('youtube_channel_url', '') : null,
]));
$macOrgData = [
    '@type' => 'EducationalOrganization',
    '@id' => $macBaseUrl . '/#institucion',
    'name' => mac_dato('nombre'),
    'alternateName' => mac_dato('nombre_corto'),
    'url' => $macBaseUrl . '/',
    'logo' => $macBaseUrl . '/recursos/imagenes/identidad/logo-mac.png',
    'email' => mac_dato('correo'),
    'telephone' => '+51-1-485-0654',
    'contactPoint' => [
        [
            '@type' => 'ContactPoint',
            'telephone' => '+51-1-485-0654',
            'contactType' => 'customer service',
            'areaServed' => 'PE',
            'availableLanguage' => ['es'],
        ],
        [
            '@type' => 'ContactPoint',
            'telephone' => '+51-1-521-0733',
            'contactType' => 'customer service',
            'areaServed' => 'PE',
            'availableLanguage' => ['es'],
        ],
        [
            '@type' => 'ContactPoint',
            'telephone' => '+51-1-522-3957',
            'contactType' => 'customer service',
            'areaServed' => 'PE',
            'availableLanguage' => ['es'],
        ],
    ],
    'foundingDate' => '1986-08-13',
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => 'Av. Los Alisos N.º 858, Urb. Carlos Cueto Fernandini',
        'addressLocality' => 'Los Olivos',
        'addressRegion' => 'Lima',
        'addressCountry' => 'PE',
    ],
    'openingHoursSpecification' => [[
        '@type' => 'OpeningHoursSpecification',
        'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
        'opens' => '08:00',
        'closes' => '22:00',
    ]],
    'sameAs' => $macSameAs,
];
if ($activo !== '' && $activo !== 'inicio' && empty($macNoIndex)) {
    [$macSeccionNombre, $macSeccionItems] = mac_seccion_actual();
    $macBreadcrumbs = [
        [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Inicio',
            'item' => $macBaseUrl . '/',
        ],
    ];
    $macPos = 2;
    if ($macSeccionNombre !== '' && count($macSeccionItems) > 1 && $macSeccionNombre !== $titulo) {
        $macBreadcrumbs[] = [
            '@type' => 'ListItem',
            'position' => $macPos++,
            'name' => $macSeccionNombre,
        ];
    }
    $macBreadcrumbs[] = [
        '@type' => 'ListItem',
        'position' => $macPos,
        'name' => $titulo,
        'item' => $macCanonicalUrl,
    ];
    $macStructuredData = [
        '@context' => 'https://schema.org',
        '@graph' => [
            $macOrgData,
            [
                '@type' => 'BreadcrumbList',
                'itemListElement' => $macBreadcrumbs,
            ],
        ],
    ];
} else {
    $macStructuredData = array_merge(['@context' => 'https://schema.org'], $macOrgData);
}
?>
<!doctype html>
<html lang="es-PE">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= mac_e($macTituloCompleto) ?></title>
    <meta name="description" content="<?= mac_e($macDescripcion) ?>">
<?php if (!empty($macNoIndex)): ?>
    <meta name="robots" content="noindex, nofollow">
<?php endif; ?>
    <meta name="theme-color" content="#0b2e26">
    <meta name="color-scheme" content="light">
    <meta name="facebook-page-url" content="<?= mac_e((string) mac_config('facebook_page_url')) ?>">
    <meta name="youtube-channel-id" content="<?= mac_e((string) mac_config('youtube_channel_id')) ?>">
    <link rel="canonical" href="<?= mac_e($macCanonicalUrl) ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="es_PE">
    <meta property="og:site_name" content="IESTP Manuel Arévalo Cáceres">
    <meta property="og:title" content="<?= mac_e($macTituloCompleto) ?>">
    <meta property="og:description" content="<?= mac_e($macDescripcion) ?>">
    <meta property="og:url" content="<?= mac_e($macCanonicalUrl) ?>">
    <meta property="og:image" content="<?= mac_e($macBaseUrl . '/recursos/imagenes/identidad/logo-mac.png') ?>">
    <meta property="og:image:width" content="898">
    <meta property="og:image:height" content="1024">
    <meta property="og:image:alt" content="Logo del IESTP Manuel Arévalo Cáceres">
    <meta name="twitter:card" content="summary">
    <link rel="icon" href="<?= mac_recurso('recursos/imagenes/identidad/favicon-32.png') ?>" type="image/png" sizes="32x32">
    <link rel="icon" href="<?= mac_recurso('recursos/imagenes/identidad/favicon-192.png') ?>" type="image/png" sizes="192x192">
    <link rel="shortcut icon" href="<?= mac_recurso('recursos/imagenes/identidad/favicon.ico') ?>">
    <link rel="apple-touch-icon" href="<?= mac_recurso('recursos/imagenes/identidad/icono-apple-180.png') ?>">
    <link rel="preload" href="<?= mac_url('recursos/fuentes/rotulo_negrita.woff2') ?>" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?= mac_url('recursos/fuentes/texto_regular.woff2') ?>" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="<?= mac_recurso('recursos/estilos/sitio.css') ?>">
    <script>(function(h){h.classList.add('js');try{if(window.matchMedia('(prefers-reduced-motion: no-preference)').matches)h.classList.add('anim');if(!('CSSViewTransitionRule' in window))h.classList.add('sin-vt');}catch(e){}})(document.documentElement);</script>
    <script src="<?= mac_recurso('recursos/scripts/sitio.js') ?>" defer></script>
    <script type="application/ld+json"><?= json_encode($macStructuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?></script>
  </head>
  <body class="<?= $activo === 'inicio' ? 'es-portada' : 'es-interior' ?>">
    <a class="saltar" href="#contenido">Saltar al contenido principal</a>
    <header class="cabecera" data-cabecera>
      <div class="franja">
        <div class="contenedor franja-in">
          <p class="franja-texto">Instituto de Educación Superior Tecnológico Público</p>
          <ul class="franja-enlaces">
            <li><a href="tel:<?= mac_e(mac_dato('telefono_enlace')) ?>"><?= mac_icono('telefono') ?><?= mac_e(mac_dato('telefono')) ?></a></li>
            <li class="franja-correo"><a href="mailto:<?= mac_e(mac_dato('correo')) ?>"><?= mac_icono('correo') ?><?= mac_e(mac_dato('correo')) ?></a></li>
            <li><a href="<?= mac_url('paginas/servicios/mesa-de-partes.php') ?>"><?= mac_icono('bandeja') ?>Mesa de partes</a></li>
            <li><a href="<?= mac_url(mac_dato('intranet')) ?>" target="_blank" rel="noopener noreferrer"><?= mac_icono('pantalla') ?>Intranet<?= mac_externo() ?></a></li>
          </ul>
        </div>
      </div>
      <div class="barra">
        <div class="contenedor barra-in">
          <a class="marca" href="<?= mac_url('index.php') ?>"<?= $activo === 'inicio' ? ' aria-current="page"' : '' ?>>
            <img class="marca-logo" src="<?= mac_recurso('recursos/imagenes/identidad/logo-mac-96.png') ?>" srcset="<?= mac_recurso('recursos/imagenes/identidad/logo-mac-192.png') ?> 2x" width="84" height="96" alt="">
            <span class="marca-texto"><span class="marca-sigla">IESTP</span><span class="marca-nombre">Manuel Arévalo Cáceres</span><span class="sr">, ir a la página de inicio</span></span>
          </a>
          <button class="menu-boton" type="button" aria-expanded="false" aria-controls="navegacion" data-menu-boton>
            <span class="menu-boton-icono" aria-hidden="true"><i></i><i></i><i></i></span><span class="menu-boton-texto">Menú</span>
          </button>
          <nav class="navegacion" id="navegacion" aria-label="Navegación principal" data-navegacion>
            <div class="nav-perfiles">
              <p class="nav-perfiles-titulo">¿Qué necesitas hacer?</p>
              <ul>
<?php foreach ($GLOBALS['MAC_PERFILES'] as $macClave => [$macEtiqueta]): ?>
                <li><a href="<?= mac_url('index.php') ?>#perfil-<?= mac_e((string) $macClave) ?>"><?= mac_e($macEtiqueta) ?></a></li>
<?php endforeach; ?>
              </ul>
            </div>
            <ul class="nav-lista">
              <li class="nav-item nav-item-inicio"><a class="nav-enlace" href="<?= mac_url('index.php') ?>"<?= $activo === 'inicio' ? ' aria-current="page"' : '' ?>>Inicio</a></li>
<?php foreach ($GLOBALS['MAC_NAV'] as $macClave => [$macEtiqueta, $macItems]): ?>
<?php if (count($macItems) === 1): ?>
              <li class="nav-item"><a class="nav-enlace nav-enlace-destacado<?= $activo === $macClave ? ' es-activo' : '' ?>" href="<?= mac_url($macItems[0][2]) ?>"<?= $activo === $macClave ? ' aria-current="page"' : '' ?>><?= mac_e($macEtiqueta) ?></a></li>
<?php else: ?>
              <li class="nav-item" data-submenu>
                <button class="nav-enlace<?= $activo === $macClave ? ' es-activo' : '' ?>" type="button" aria-expanded="false" aria-controls="sub-<?= mac_e($macClave) ?>"><?= mac_e($macEtiqueta) ?><?= mac_icono('chevron', 'icono nav-chevron') ?></button>
                <div class="submenu" id="sub-<?= mac_e($macClave) ?>">
<?php $macGrupo = null; foreach ($macItems as $macIndice => $macItem): $macExterno = !empty($macItem[3]); $macActual = $activo === $macClave && $pagina === $macItem[0]; $macGrupoItem = (string) ($macItem[4] ?? ''); ?>
<?php if ($macIndice === 0 || $macGrupoItem !== $macGrupo): ?>
<?php if ($macIndice > 0): ?>
                  </ul>
<?php endif; ?>
<?php if ($macGrupoItem !== ''): ?>
                  <p class="submenu-grupo"><?= mac_e($macGrupoItem) ?></p>
<?php endif; ?>
                  <ul>
<?php $macGrupo = $macGrupoItem; endif; ?>
                    <li><a href="<?= mac_url($macItem[2]) ?>"<?= $macActual ? ' aria-current="page"' : '' ?><?= $macExterno ? ' target="_blank" rel="noopener noreferrer"' : '' ?>><?= mac_e($macItem[1]) ?><?= $macExterno ? mac_externo() : '' ?></a></li>
<?php endforeach; ?>
                  </ul>
                </div>
              </li>
<?php endif; ?>
<?php endforeach; ?>
            </ul>
            <div class="nav-pie">
              <a href="tel:<?= mac_e(mac_dato('telefono_enlace')) ?>"><?= mac_icono('telefono') ?><?= mac_e(mac_dato('telefono')) ?></a>
              <a href="mailto:<?= mac_e(mac_dato('correo')) ?>"><?= mac_icono('correo') ?><?= mac_e(mac_dato('correo')) ?></a>
            </div>
          </nav>
        </div>
      </div>
    </header>
