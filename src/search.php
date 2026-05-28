<?php

header('Content-Type: application/json');

$env = parse_ini_file(__DIR__ . '/../.env');
$apiKey = $env['API_KEY'];

$query = $_GET['q'] ?? '';

if (strlen($query) < 2) {
    echo json_encode([]);
    exit;
}

// Geocoding API
$url = "http://api.openweathermap.org/geo/1.0/direct?q=" . urlencode($query) . "&limit=5&appid=" . $apiKey;

$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
]);

$response = curl_exec($ch);
unset($ch);

$data = json_decode($response, true);

// Упрощаем ответ
$result = [];

foreach ($data as $city) {
    $result[] = [
        "name" => $city['name'],
        "country" => $city['country'],
        "lat" => $city['lat'],
        "lon" => $city['lon']
    ];
}

echo json_encode($result);