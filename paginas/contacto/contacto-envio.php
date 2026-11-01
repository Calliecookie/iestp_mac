<?php
declare(strict_types=1);
require_once dirname(__DIR__, 2) . '/configuracion/arranque.php';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    mac_start_session();
}

header('X-Content-Type-Options: nosniff');

function mb_strlen_safe(string $text): int
{
    return function_exists('mb_strlen') ? mb_strlen($text, 'UTF-8') : strlen($text);
}

$status = 'info';
$title = 'Formulario de consulta';
$message = 'Para enviar una consulta, completa el formulario de la página de contacto.';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $name = trim((string) ($_POST['nombre'] ?? ''));
    $email = trim((string) ($_POST['correo'] ?? ''));
    $body = trim((string) ($_POST['mensaje'] ?? ''));
    $origin = trim((string) ($_POST['origen'] ?? 'formulario web'));
    $consent = (string) ($_POST['acepta'] ?? '') === '1';
    $csrfValid = mac_csrf_is_valid($_POST['csrf_token'] ?? null);
    $honeypot = trim((string) ($_POST['website'] ?? ''));

    if ($honeypot !== '') {
        $status = 'success';
        $title = 'Consulta recibida';
        $message = 'Gracias. Si corresponde, nos comunicaremos contigo por los datos proporcionados.';
    } elseif (!$csrfValid) {
        http_response_code(403);
        $status = 'error';
        $title = 'La sesión del formulario venció';
        $message = 'Por seguridad, vuelve al formulario institucional y envía tu consulta nuevamente.';
    } elseif ($name === '' || mb_strlen_safe($name) > 120 || !filter_var($email, FILTER_VALIDATE_EMAIL)
        || mb_strlen_safe($email) > 180 || $body === ''
        || mb_strlen_safe($body) > 3000 || !$consent) {
        http_response_code(422);
        $status = 'error';
        $title = 'Revisa los datos enviados';
        $message = 'No se pudo procesar la consulta. Comprueba que el nombre, correo, mensaje y autorización estén completos y tengan un formato válido.';
    } else {
        $to = trim((string) mac_config('contact_email_to', ''));
        $from = trim((string) mac_config('contact_email_from', ''));
        if ($from === '' && $to !== '') {
            $from = $to;
        }
        $safeFrom = preg_replace('/[\r\n]+/', '', $from) ?: '';
        $safeReplyTo = preg_replace('/[\r\n]+/', '', $email) ?: '';

        if ($to === '' || $safeFrom === '' || !filter_var($to, FILTER_VALIDATE_EMAIL) || !filter_var($safeFrom, FILTER_VALIDATE_EMAIL)) {
            http_response_code(503);
            $status = 'config';
            $title = 'El envío por correo no está disponible';
            $message = 'Tu consulta es válida, pero el servidor todavía no puede enviarla por correo. Escríbenos directamente para que podamos atenderte.';
            error_log('IESTP MAC: definir CONTACT_EMAIL_TO y CONTACT_EMAIL_FROM en configuracion/local.php o en el entorno del hosting.');
        } elseif (!function_exists('mail')) {
            http_response_code(503);
            $status = 'config';
            $title = 'El envío por correo no está disponible';
            $message = 'Tu consulta es válida, pero el servidor no tiene habilitado el envío de correo. Escríbenos directamente para que podamos atenderte.';
            error_log('IESTP MAC: la función mail() no está disponible en el hosting.');
        } elseif (($limitador = mac_rate_limit_contact(3, 600)) !== 'permitido') {
            if ($limitador === 'limitado') {
                http_response_code(429);
                header('Retry-After: 600');
                $status = 'error';
                $title = 'Demasiados intentos de envío';
                $message = 'Por seguridad, se alcanzó el límite de consultas de esta sesión. Espera unos minutos antes de intentarlo de nuevo.';
            } else {
                http_response_code(503);
                header('Retry-After: 300');
                header('X-Formulario-Estado: no-disponible');
                $status = 'error';
                $title = 'El envío no está disponible por el momento';
                $message = 'No pudimos procesar tu consulta en este momento. Inténtalo más tarde o escríbenos directamente para que podamos atenderte.';
            }
        } else {
            $subjectText = 'Consulta web IESTP MAC: ' . preg_replace('/[\r\n]+/', ' ', $name);
            $subject = function_exists('mb_encode_mimeheader')
                ? mb_encode_mimeheader($subjectText, 'UTF-8')
                : '=?UTF-8?B?' . base64_encode($subjectText) . '?=';
            $safeOrigin = preg_replace('/[^a-zA-Z0-9 _.-]/', '', $origin) ?: 'formulario web';
            $mailBody = "Nueva consulta desde el sitio web del IESTP MAC\n\n"
                . "Origen: {$safeOrigin}\nNombre: {$name}\nCorreo: {$safeReplyTo}\n\nMensaje:\n{$body}\n";
            $headers = [
                'From: IESTP MAC Web <' . $safeFrom . '>',
                'Reply-To: ' . $safeReplyTo,
                'MIME-Version: 1.0',
                'Content-Type: text/plain; charset=UTF-8',
                'X-Mailer: PHP/' . PHP_VERSION,
            ];
            $sent = @mail($to, $subject, $mailBody, implode("\r\n", $headers));
            if ($sent) {
                $status = 'success';
                $title = 'Gracias por comunicarte';
                $message = 'Recibimos tu consulta. El instituto te responderá al correo que indicaste.';
            } else {
                http_response_code(502);
                $status = 'error';
                $title = 'No se pudo entregar el correo';
                $message = 'El servidor no pudo enviar tu consulta en este momento. Escríbenos directamente para que podamos atenderte.';
                error_log('IESTP MAC: mail() devolvió false al enviar una consulta.');
            }
        }
    }
} elseif (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'GET') {
    http_response_code(405);
    header('Allow: GET, POST');
    $status = 'error';
    $title = 'Método no permitido';
    $message = 'Usa el formulario de la página para enviar una consulta.';
}
$titulo = $title;
$activo = 'contacto';
$pagina = 'contacto';
$raiz = '../../';
$lead = mac_e($message);
$macNoIndex = true;
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<div class="acciones">
  <a class="boton" href="contacto.php">Volver al formulario de contacto</a>
  <a class="boton boton-contorno" href="../../index.php">Ir a la página de inicio</a>
</div>
<?php if ($status !== 'success'): ?>
<?= mac_aviso('También puedes escribirnos directamente', 'Envía tu consulta a <a href="mailto:' . mac_e(mac_dato('correo')) . '">' . mac_e(mac_dato('correo')) . '</a> o llama al <a href="tel:' . mac_e(mac_dato('telefono_enlace')) . '">' . mac_e(mac_dato('telefono')) . '</a>.') ?>
<?php endif; ?>
<?php mac_pagina_cerrar(false); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
