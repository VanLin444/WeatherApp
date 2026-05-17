<?php
header('Content-Type: application/json');
$env = parse_ini_file(__DIR__ . '/../.env');
$apiKey = $env['API_KEY'];

$lat = $_GET['lat'] ?? null;
$lon = $_GET['lon'] ?? null;

$googleApiUrl = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&lang=ru&units=metric&appid={$apiKey}";

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
unset($ch);

echo $response;
?>