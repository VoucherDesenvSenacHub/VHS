<?php

namespace Src\Application\Utils\YouTube;

function getYoutubeIdFromUrl($url)
{
    $patterns = [
        '/v=([^&]+)/',
        '/youtu\.be\/([^?]+)/',
        '/youtube\.com\/shorts\/([^?]+)/',
        '/youtube\.com\/embed\/([^?]+)/'
    ];

    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $url, $match)) {
            return $match[1];
        }
    }

    return null;
}

function getYoutubeDurationSeconds($videoId, $apiKey)
{
    $endpoint = "https://www.googleapis.com/youtube/v3/videos?id={$videoId}&part=contentDetails&key={$apiKey}";
    $response = file_get_contents($endpoint);

    if (!$response) {
        return null;
    }

    $json = json_decode($response, true);

    if (empty($json['items'][0]['contentDetails']['duration'])) {
        return null;
    }

    $durationISO = $json['items'][0]['contentDetails']['duration'];

    $interval = new \DateInterval($durationISO);

    return ($interval->h * 3600) + ($interval->i * 60) + $interval->s;
}
