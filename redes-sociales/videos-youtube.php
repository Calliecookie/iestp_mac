<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/configuracion/arranque.php';

$channelId = trim((string) mac_config('youtube_channel_id', ''));
if (!preg_match('/^UC[A-Za-z0-9_-]{22}$/', $channelId)) {
    mac_json_response(500, ['configured' => false, 'videos' => [], 'message' => 'El identificador del canal de YouTube no es válido.']);
}

$cacheKey = 'youtube-videos-' . substr(hash('sha256', $channelId), 0, 12);
$cached = mac_cache_read($cacheKey);
$cachedVideos = is_array($cached['payload']['videos'] ?? null) ? $cached['payload']['videos'] : [];
$isNegativeCache = !empty($cached['payload']['negative']);
if ($cached && time() - $cached['saved_at'] < ($isNegativeCache ? 180 : 900)) {
    if ($isNegativeCache && !$cachedVideos) {
        mac_json_response(502, ['configured' => true, 'channelId' => $channelId, 'videos' => [], 'message' => 'No se pudo consultar el feed de YouTube en este momento.']);
    }
    mac_json_response(200, ['configured' => true, 'channelId' => $channelId, 'videos' => $cachedVideos, 'cached' => true]);
}

$feedUrl = 'https://www.youtube.com/feeds/videos.xml?channel_id=' . rawurlencode($channelId);
$response = mac_http_get($feedUrl, [], 5);
$videos = [];
if ($response['status'] >= 200 && $response['status'] < 300 && $response['body'] !== '') {
    $xmlText = $response['body'];
    if (function_exists('simplexml_load_string')) {
        $previous = libxml_use_internal_errors(true);
        $xml = simplexml_load_string($xmlText, 'SimpleXMLElement', LIBXML_NONET | LIBXML_NOCDATA);
        libxml_clear_errors();
        libxml_use_internal_errors($previous);
        if ($xml !== false) {
            foreach ($xml->entry ?? [] as $entry) {
                $namespaces = $entry->getNamespaces(true);
                $youtubeNs = $namespaces['yt'] ?? 'http://www.youtube.com/xml/schemas/2015';
                $id = (string) ($entry->children($youtubeNs)->videoId ?? '');
                $title = trim((string) ($entry->title ?? ''));
                $published = (string) ($entry->published ?? '');
                if (preg_match('/^[A-Za-z0-9_-]{11}$/', $id)) {
                    $videos[] = [
                        'id' => $id,
                        'title' => $title,
                        'url' => 'https://www.youtube.com/watch?v=' . $id,
                        'thumbnail' => 'https://i.ytimg.com/vi/' . $id . '/hqdefault.jpg',
                        'published_at' => $published,
                    ];
                }
            }
        }
    }
    if (!$videos && preg_match_all('/<entry\b[^>]*>(.*?)<\/entry>/si', $xmlText, $entries)) {
        foreach ($entries[1] as $entryText) {
            if (!preg_match('/<yt:videoId>(.*?)<\/yt:videoId>/si', $entryText, $idMatch)) continue;
            $id = trim(html_entity_decode($idMatch[1], ENT_QUOTES | ENT_XML1, 'UTF-8'));
            $title = '';
            $published = '';
            if (preg_match('/<title>(.*?)<\/title>/si', $entryText, $titleMatch)) {
                $title = trim(html_entity_decode(strip_tags($titleMatch[1]), ENT_QUOTES | ENT_XML1, 'UTF-8'));
            }
            if (preg_match('/<published>(.*?)<\/published>/si', $entryText, $publishedMatch)) {
                $published = trim(html_entity_decode($publishedMatch[1], ENT_QUOTES | ENT_XML1, 'UTF-8'));
            }
            if (preg_match('/^[A-Za-z0-9_-]{11}$/', $id)) {
                $videos[] = [
                    'id' => $id,
                    'title' => $title,
                    'url' => 'https://www.youtube.com/watch?v=' . $id,
                    'thumbnail' => 'https://i.ytimg.com/vi/' . $id . '/hqdefault.jpg',
                    'published_at' => $published,
                ];
            }
        }
    }
}

if (!$videos) {
    error_log('IESTP MAC: no se pudo recuperar el feed RSS público de YouTube.');
    if ($cachedVideos) {
        mac_json_response(200, ['configured' => true, 'channelId' => $channelId, 'videos' => $cachedVideos, 'cached' => true, 'stale' => true]);
    }
    mac_cache_write($cacheKey, ['videos' => [], 'negative' => true]);
    mac_json_response(502, ['configured' => true, 'channelId' => $channelId, 'videos' => [], 'message' => 'No se pudo consultar el feed de YouTube en este momento.']);
}

$result = ['videos' => array_slice($videos, 0, 12)];
mac_cache_write($cacheKey, $result);
mac_json_response(200, ['configured' => true, 'channelId' => $channelId, 'videos' => $result['videos'], 'cached' => false]);
