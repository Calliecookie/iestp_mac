<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/configuracion/arranque.php';

$pageId = trim((string) mac_config('facebook_page_id', ''));
$token = trim((string) mac_config('facebook_page_access_token', ''));
$version = trim((string) mac_config('meta_graph_api_version', 'v26.0'));
if ($version === '') $version = 'v26.0';

if ($pageId === '' || $token === '' || !preg_match('/^[0-9]{5,30}$/', $pageId) || !preg_match('/^v[0-9]+\.[0-9]+$/', $version)) {
    mac_json_response(200, ['configured' => false, 'photos' => []]);
}

$cacheKey = 'facebook-photos-' . substr(hash('sha256', $pageId), 0, 12);
$cached = mac_cache_read($cacheKey);
$cachedPhotos = is_array($cached['payload']['photos'] ?? null) ? $cached['payload']['photos'] : [];
$isNegativeCache = !empty($cached['payload']['negative']);
if ($cached && time() - $cached['saved_at'] < ($isNegativeCache ? 180 : 900)) {
    mac_json_response(200, ['configured' => true, 'photos' => $cachedPhotos, 'cached' => true]);
}

$query = http_build_query([
    'type' => 'uploaded',
    'fields' => 'id,name,link,images,created_time',
    'limit' => 12,
]);
$url = 'https://graph.facebook.com/' . $version . '/' . rawurlencode($pageId) . '/photos?' . $query;
$response = mac_http_get($url, ['Authorization: Bearer ' . $token], 5);
$payload = $response['status'] >= 200 && $response['status'] < 300
    ? json_decode($response['body'], true)
    : null;

if (!is_array($payload) || isset($payload['error']) || !isset($payload['data']) || !is_array($payload['data'])) {
    error_log('IESTP MAC: no se pudo recuperar la galería de Facebook. Revisar token y permisos de Meta.');
    if ($cachedPhotos) {
        mac_json_response(200, ['configured' => true, 'photos' => $cachedPhotos, 'cached' => true, 'stale' => true]);
    }
    mac_cache_write($cacheKey, ['photos' => [], 'negative' => true]);
    mac_json_response(200, ['configured' => true, 'photos' => [], 'cached' => false]);
}

$photos = [];
foreach ($payload['data'] as $item) {
    if (!is_array($item)) continue;
    $bestUrl = '';
    $bestArea = -1;
    foreach (($item['images'] ?? []) as $image) {
        if (!is_array($image)) continue;
        $source = (string) ($image['source'] ?? '');
        if (stripos($source, 'https://') !== 0) continue;
        $area = (int) ($image['width'] ?? 0) * (int) ($image['height'] ?? 0);
        if ($area > $bestArea) {
            $bestArea = $area;
            $bestUrl = $source;
        }
    }
    if ($bestUrl === '') continue;
    $link = (string) ($item['link'] ?? mac_config('facebook_page_url'));
    if (stripos($link, 'https://') !== 0) $link = (string) mac_config('facebook_page_url');
    $photos[] = [
        'id' => (string) ($item['id'] ?? ''),
        'title' => trim((string) ($item['name'] ?? '')),
        'url' => $bestUrl,
        'link' => $link,
        'created_time' => (string) ($item['created_time'] ?? ''),
    ];
}

$result = ['photos' => array_slice($photos, 0, 12)];
mac_cache_write($cacheKey, $result);
mac_json_response(200, ['configured' => true, 'photos' => $result['photos'], 'cached' => false]);
