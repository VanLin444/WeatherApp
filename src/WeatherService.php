<?php
$env = parse_ini_file(__DIR__ . '/../.env');
$apiKey = $env['API_KEY'];

$lat = $_GET['lat'] ?? null;
$lon = $_GET['lon'] ?? null;

if (!$lat & !$lon) {
    $lat = "55.7558";
    $lon = "37.6173";
}

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

$data = json_decode($response);

// 👉 ВСЕГДА возвращаем JSON если есть lat/lon
if (!empty($_GET['lat']) && !empty($_GET['lon'])) {

    header('Content-Type: application/json');

    echo json_encode([
        "city" => $data->name ?? '',
        "temp" => round($data->main->temp ?? 0),
        "wind" => $data->wind->speed ?? 0,
        "pressure" => $data->main->pressure ?? 0,
        "humidity" => $data->main->humidity ?? 0,
        "clouds" => $data->clouds->all ?? 0,
        "icon" => $data->weather[0]->icon ?? ''
    ]);

    exit;
}
?>