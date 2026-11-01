<?php
declare(strict_types=1);

ini_set('display_errors', '0');
ini_set('log_errors', '1');

$macDefaults = [
    'site_url' => 'https://iestp-mac.edu.pe',
    'environment' => 'production',
    'facebook_page_url' => 'https://www.facebook.com/iestpmanuelarevalocaceres/',
    'facebook_page_id' => '',
    'facebook_page_access_token' => '',
    'meta_graph_api_version' => 'v26.0',
    'youtube_channel_url' => 'https://www.youtube.com/@manuelarevalocaceres9047',
    'youtube_channel_id' => 'UCBA-mup6OyVOdByyVFDueQw',
    'contact_email_to' => 'informes@iestp-mac.edu.pe',
    'contact_email_from' => '',
    'app_secret' => '',
    'storage_path' => '',
];

$macLocalConfig = [];
$macLocalFile = __DIR__ . '/local.php';
if (is_file($macLocalFile)) {
    $loadedConfig = require $macLocalFile;
    if (is_array($loadedConfig)) {
        $macLocalConfig = $loadedConfig;
    }
}

$macConfig = array_merge($macDefaults, $macLocalConfig);
$macEnvironmentMap = [
    'site_url' => 'SITE_URL',
    'environment' => 'APP_ENV',
    'facebook_page_id' => 'FACEBOOK_PAGE_ID',
    'facebook_page_access_token' => 'FACEBOOK_PAGE_ACCESS_TOKEN',
    'meta_graph_api_version' => 'META_GRAPH_API_VERSION',
    'facebook_page_url' => 'FACEBOOK_PAGE_URL',
    'youtube_channel_url' => 'YOUTUBE_CHANNEL_URL',
    'youtube_channel_id' => 'YOUTUBE_CHANNEL_ID',
    'contact_email_to' => 'CONTACT_EMAIL_TO',
    'contact_email_from' => 'CONTACT_EMAIL_FROM',
    'app_secret' => 'APP_SECRET',
    'storage_path' => 'STORAGE_PATH',
];
foreach ($macEnvironmentMap as $configKey => $envName) {
    $value = getenv($envName);
    if ($value !== false && trim((string) $value) !== '') {
        $macConfig[$configKey] = trim((string) $value);
    }
}
$GLOBALS['MAC_CONFIG'] = $macConfig;

if (!function_exists('mac_config')) {
    function mac_config(string $key, mixed $default = null): mixed
    {
        return $GLOBALS['MAC_CONFIG'][$key] ?? $default;
    }
}

if (!function_exists('mac_base_url')) {
    function mac_base_url(): string
    {
        $configured = rtrim(trim((string) mac_config('site_url', 'https://iestp-mac.edu.pe')), '/');
        if ($configured !== '' && filter_var($configured, FILTER_VALIDATE_URL) && preg_match('~^https?://[a-zA-Z0-9.-]+(?::\d+)?$~', $configured)) {
            return $configured;
        }
        return 'https://iestp-mac.edu.pe';
    }
}

if (!function_exists('mac_es_entorno_pruebas')) {
    function mac_es_entorno_pruebas(): bool
    {
        $env = strtolower(trim((string) mac_config('environment', 'production')));
        if ($env !== '' && $env !== 'production' && $env !== 'prod' && $env !== 'produccion') {
            return true;
        }
        $host = strtolower(preg_replace('/:\d+$/', '', trim((string) ($_SERVER['HTTP_HOST'] ?? ''))));
        if ($host === '' || $host === 'localhost' || $host === '127.0.0.1' || $host === '::1') {
            return true;
        }
        return (bool) preg_match('/^(prueba|pruebas|test|testing|staging|dev|desarrollo)\.|(\.local|\.test|\.localhost)$/', $host);
    }
}

if (!function_exists('mac_json_response')) {
    function mac_json_response(int $status, array $data): never
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        header('X-Content-Type-Options: nosniff');
        header('Cache-Control: no-store, max-age=0');
        echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
        exit;
    }
}

if (!function_exists('mac_http_get')) {
    function mac_http_get(string $url, array $headers = [], int $timeout = 8): array
    {
        if (stripos($url, 'https://') !== 0) {
            return ['status' => 0, 'body' => ''];
        }
        $headers[] = 'Accept: application/json, application/atom+xml, application/xml, text/xml;q=0.9, */*;q=0.5';
        $headers[] = 'User-Agent: IESTP-MAC-Web/1.0 (+institutional website)';

        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_CONNECTTIMEOUT => min(5, $timeout),
                CURLOPT_TIMEOUT => $timeout,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
            ]);
            $body = curl_exec($ch);
            $status = (int) curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
            curl_close($ch);
            return ['status' => $body === false ? 0 : $status, 'body' => is_string($body) ? $body : ''];
        }

        if (!filter_var(ini_get('allow_url_fopen'), FILTER_VALIDATE_BOOLEAN)) {
            return ['status' => 0, 'body' => ''];
        }
        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'timeout' => $timeout,
                'ignore_errors' => true,
                'header' => implode("\r\n", $headers) . "\r\n",
            ],
            'ssl' => ['verify_peer' => true, 'verify_peer_name' => true],
        ]);
        $body = @file_get_contents($url, false, $context);
        $status = 0;
        foreach (($http_response_header ?? []) as $headerLine) {
            if (preg_match('/^HTTP\/\S+\s+(\d{3})/', $headerLine, $match)) {
                $status = (int) $match[1];
            }
        }
        return ['status' => $body === false ? $status : ($status ?: 200), 'body' => is_string($body) ? $body : ''];
    }
}

if (!function_exists('mac_storage_path')) {
    function mac_storage_path(string $subpath = ''): string
    {
        $custom = trim((string) mac_config('storage_path', ''));
        $base = $custom !== '' ? rtrim($custom, '/\\') : dirname(__DIR__) . '/almacenamiento';
        return $subpath !== '' ? $base . '/' . ltrim($subpath, '/\\') : $base;
    }
}

if (!function_exists('mac_cache_file')) {
    function mac_cache_file(string $key): string
    {
        $safeKey = preg_replace('/[^a-zA-Z0-9_-]/', '-', $key) ?: 'cache';
        return mac_storage_path('temporal/' . $safeKey . '.json');
    }
}

if (!function_exists('mac_cache_read')) {
    function mac_cache_read(string $key): ?array
    {
        $file = mac_cache_file($key);
        if (!is_file($file)) return null;
        $raw = @file_get_contents($file);
        if (!is_string($raw) || $raw === '') return null;
        $data = json_decode($raw, true);
        if (!is_array($data) || !isset($data['saved_at'], $data['payload']) || !is_array($data['payload'])) return null;
        return ['saved_at' => (int) $data['saved_at'], 'payload' => $data['payload']];
    }
}

if (!function_exists('mac_cache_write')) {
    function mac_cache_write(string $key, array $payload): bool
    {
        $dir = mac_storage_path('temporal');
        if (!is_dir($dir) && !@mkdir($dir, 0750, true) && !is_dir($dir)) return false;
        $raw = json_encode(['saved_at' => time(), 'payload' => $payload], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        if (!is_string($raw)) return false;
        $file = mac_cache_file($key);
        $temp = $file . '.' . bin2hex(random_bytes(4)) . '.tmp';
        $ok = false;
        if (@file_put_contents($temp, $raw, LOCK_EX) === strlen($raw)) {
            @chmod($temp, 0640);
            $ok = @rename($temp, $file);
        }
        if (is_file($temp)) @unlink($temp);
        return $ok;
    }
}

if (!function_exists('mac_start_session')) {
    function mac_start_session(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) return;
        ini_set('session.use_strict_mode', '1');
        ini_set('session.use_only_cookies', '1');
        session_name('MACSESSID');
        $esHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || (strtolower((string) ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '')) === 'https')
            || ((int) ($_SERVER['SERVER_PORT'] ?? 0) === 443);
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'secure' => $esHttps,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
        session_start();
    }
}

if (!function_exists('mac_csrf_token')) {
    function mac_csrf_token(): string
    {
        mac_start_session();
        if (!isset($_SESSION['mac_csrf_token']) || !is_string($_SESSION['mac_csrf_token'])) {
            $_SESSION['mac_csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['mac_csrf_token'];
    }
}

if (!function_exists('mac_csrf_is_valid')) {
    function mac_csrf_is_valid(mixed $candidate): bool
    {
        mac_start_session();
        return is_string($candidate)
            && isset($_SESSION['mac_csrf_token'])
            && is_string($_SESSION['mac_csrf_token'])
            && hash_equals($_SESSION['mac_csrf_token'], $candidate);
    }
}

if (!function_exists('mac_limpiar_temporal')) {
    function mac_limpiar_temporal(string $prefijo = 'rate-contact-', int $maxAgeSeconds = 600): void
    {
        $dir = mac_storage_path('temporal');
        if (!is_dir($dir)) return;
        $now = time();
        foreach (glob($dir . '/' . $prefijo . '*.json') ?: [] as $archivo) {
            $mtime = @filemtime($archivo);
            if ($mtime !== false && ($now - $mtime) > $maxAgeSeconds) {
                @unlink($archivo);
            }
        }
        foreach (glob($dir . '/*.tmp') ?: [] as $temporal) {
            $mtime = @filemtime($temporal);
            if ($mtime !== false && ($now - $mtime) > 120) {
                @unlink($temporal);
            }
        }
    }
}

if (!function_exists('mac_secreto_valido')) {
    function mac_secreto_valido(string $valor): bool
    {
        return (bool) preg_match('/^[\x21-\x7E]{32,512}$/', $valor);
    }
}

if (!function_exists('mac_secreto_leer')) {
    function mac_secreto_leer(string $archivo): ?string
    {
        if (!is_file($archivo) || !is_readable($archivo)) return null;
        $contenido = @file_get_contents($archivo, false, null, 0, 1024);
        if (!is_string($contenido)) return null;
        $contenido = trim($contenido);
        return mac_secreto_valido($contenido) ? $contenido : null;
    }
}

if (!function_exists('mac_secreto_permisos')) {
    function mac_secreto_permisos(string $archivo): void
    {
        if (DIRECTORY_SEPARATOR !== '/') return;
        $permisos = @fileperms($archivo);
        if ($permisos === false || ($permisos & 0077) === 0) return;
        if (!@chmod($archivo, 0600)) {
            error_log('IESTP MAC: el archivo del secreto privado tiene permisos abiertos y no se pudieron restringir a 0600.');
        }
        clearstatcache(true, $archivo);
    }
}

if (!function_exists('mac_secret_key')) {
    function mac_secret_key(): ?string
    {
        static $memoria = null;
        if ($memoria !== null) {
            return $memoria !== '' ? $memoria : null;
        }

        $configurado = trim((string) mac_config('app_secret', ''));
        if ($configurado !== '') {
            if (mac_secreto_valido($configurado)) {
                return $memoria = $configurado;
            }
            error_log('IESTP MAC: APP_SECRET no es válida (se requieren de 32 a 512 caracteres imprimibles); se usará el secreto persistente.');
        }

        $archivo = mac_storage_path('privado/secreto.key');
        $existente = mac_secreto_leer($archivo);
        if ($existente !== null) {
            mac_secreto_permisos($archivo);
            return $memoria = $existente;
        }

        $dir = dirname($archivo);
        if (!is_dir($dir) && !@mkdir($dir, 0700, true) && !is_dir($dir)) {
            error_log('IESTP MAC: no se pudo crear el directorio privado del secreto.');
            $memoria = '';
            return null;
        }

        $bloqueo = @fopen($dir . '/secreto.lock', 'cb');
        if ($bloqueo === false) {
            error_log('IESTP MAC: no se pudo abrir el archivo de bloqueo del secreto privado.');
            $memoria = '';
            return null;
        }
        @chmod($dir . '/secreto.lock', 0600);
        if (!flock($bloqueo, LOCK_EX)) {
            fclose($bloqueo);
            error_log('IESTP MAC: no se pudo bloquear la creación del secreto privado.');
            $memoria = '';
            return null;
        }

        $resultado = null;
        $temporal = '';
        try {
            clearstatcache(true, $archivo);
            $existente = mac_secreto_leer($archivo);
            if ($existente !== null) {
                mac_secreto_permisos($archivo);
                $resultado = $existente;
            } elseif (file_exists($archivo) || is_link($archivo)) {
                error_log('IESTP MAC: el archivo del secreto privado existe pero no se puede leer o no es válido; no se regenerará automáticamente.');
            } else {
                $nuevo = bin2hex(random_bytes(32));
                $temporal = $archivo . '.' . bin2hex(random_bytes(6)) . '.tmp';
                $manejador = @fopen($temporal, 'xb');
                $escrito = false;
                if ($manejador !== false) {
                    @chmod($temporal, 0600);
                    $escrito = fwrite($manejador, $nuevo) === strlen($nuevo) && fflush($manejador);
                    fclose($manejador);
                }
                if (!$escrito) {
                    error_log('IESTP MAC: no se pudo escribir el secreto privado.');
                } elseif (!@rename($temporal, $archivo)) {
                    error_log('IESTP MAC: no se pudo colocar el secreto privado en su ubicación definitiva.');
                } else {
                    clearstatcache(true, $archivo);
                    if (mac_secreto_leer($archivo) === $nuevo) {
                        mac_secreto_permisos($archivo);
                        $resultado = $nuevo;
                    } else {
                        error_log('IESTP MAC: la verificación de integridad del secreto privado falló después de crearlo.');
                    }
                }
            }
        } catch (\Throwable $error) {
            error_log('IESTP MAC: error al preparar el secreto privado (' . get_class($error) . ').');
        } finally {
            if ($temporal !== '' && is_file($temporal)) @unlink($temporal);
            flock($bloqueo, LOCK_UN);
            fclose($bloqueo);
        }

        $memoria = $resultado ?? '';
        return $resultado;
    }
}

if (!function_exists('mac_rate_limit_contact')) {
    function mac_rate_limit_contact(int $maxAttempts = 3, int $windowSeconds = 600): string
    {
        mac_start_session();
        if (session_status() !== PHP_SESSION_ACTIVE) {
            error_log('IESTP MAC: limitador de contacto no disponible, la sesión no está activa.');
            return 'no_disponible';
        }

        $ip = trim((string) ($_SERVER['REMOTE_ADDR'] ?? ''));
        if ($ip === '' || filter_var($ip, FILTER_VALIDATE_IP) === false) {
            error_log('IESTP MAC: limitador de contacto no disponible, no se pudo determinar la dirección de origen.');
            return 'no_disponible';
        }

        $secreto = mac_secret_key();
        if ($secreto === null) {
            error_log('IESTP MAC: limitador de contacto no disponible, no hay un secreto válido (APP_SECRET o almacenamiento privado).');
            return 'no_disponible';
        }

        $dir = mac_storage_path('temporal');
        if ((!is_dir($dir) && !@mkdir($dir, 0750, true) && !is_dir($dir)) || !is_writable($dir)) {
            error_log('IESTP MAC: limitador de contacto no disponible, el almacenamiento temporal no admite escritura.');
            return 'no_disponible';
        }
        mac_limpiar_temporal('rate-contact-', $windowSeconds);

        $now = time();
        $limite = $now - $windowSeconds;
        $archivo = $dir . '/rate-contact-' . substr(hash_hmac('sha256', $ip, $secreto . '|' . gmdate('Y-m-d')), 0, 16) . '.json';
        $fp = @fopen($archivo, 'c+b');
        if ($fp === false) {
            error_log('IESTP MAC: limitador de contacto no disponible, no se pudo abrir el registro de intentos.');
            return 'no_disponible';
        }
        if (!flock($fp, LOCK_EX)) {
            fclose($fp);
            error_log('IESTP MAC: limitador de contacto no disponible, no se pudo bloquear el registro de intentos.');
            return 'no_disponible';
        }

        try {
            $crudo = stream_get_contents($fp);
            $datos = is_string($crudo) && $crudo !== '' ? json_decode($crudo, true) : null;
            $registro = is_array($datos['payload']['attempts'] ?? null) ? $datos['payload']['attempts'] : [];
            $ipAttempts = array_values(array_filter($registro, static fn ($t) => is_int($t) && $t > $limite));

            $attempts = $_SESSION['mac_contact_attempts'] ?? [];
            if (!is_array($attempts)) $attempts = [];
            $attempts = array_values(array_filter($attempts, static fn ($t) => is_int($t) && $t > $limite));

            if (count($attempts) >= $maxAttempts || count($ipAttempts) >= ($maxAttempts * 2)) {
                $_SESSION['mac_contact_attempts'] = $attempts;
                return 'limitado';
            }

            $ipAttempts[] = $now;
            $nuevo = json_encode(['saved_at' => $now, 'payload' => ['attempts' => $ipAttempts]], JSON_UNESCAPED_SLASHES);
            $guardado = is_string($nuevo)
                && ftruncate($fp, 0)
                && rewind($fp)
                && fwrite($fp, $nuevo) === strlen($nuevo)
                && fflush($fp);
            if (!$guardado) {
                error_log('IESTP MAC: limitador de contacto no disponible, no se pudo registrar el intento.');
                return 'no_disponible';
            }
            @chmod($archivo, 0640);

            $attempts[] = $now;
            $_SESSION['mac_contact_attempts'] = $attempts;
            return 'permitido';
        } finally {
            flock($fp, LOCK_UN);
            fclose($fp);
        }
    }
}

require_once __DIR__ . '/sitio.php';
require_once __DIR__ . '/documentos.php';
