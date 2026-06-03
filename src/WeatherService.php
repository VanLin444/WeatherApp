<?php
header('Content-Type: application/json');
require_once __DIR__ . '/Cache.php';

$env = parse_ini_file(__DIR__ . '/../.env');
$apiKey = $env['API_KEY'];
$cache = new Cache();

// Проверка входных данных
$lat = filter_input(INPUT_GET, 'lat', FILTER_VALIDATE_FLOAT);
$lon = filter_input(INPUT_GET, 'lon', FILTER_VALIDATE_FLOAT);

if ($lat === false || $lon === false) {
    http_response_code(400);
    echo json_encode([
        'error' => 'Invalid coordinates'
    ]);
    exit;
}

$cacheKey = "weather_{$lat}_{$lon}";
$cachedWeather = $cache->get($cacheKey);

if ($cachedWeather !== null) {
    echo $cachedWeather;
    exit;
}

$googleApiUrl = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&lang=ru&units=metric&appid={$apiKey}";

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_HEADER => 0,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $googleApiUrl,
    CURLOPT_FOLLOWLOCATION => 1,
    CURLOPT_VERBOSE => 0,
    CURLOPT_SSL_VERIFYPEER => false,
]);
$response = curl_exec($ch);
$error = curl_error($ch);
unset($ch);

// Проверка ответа api
if ($response === false) {
    http_response_code(500);
    echo json_encode([
        'error' => $error
    ]);
    exit;
}

$cache->set($cacheKey, $response);

echo $response;
