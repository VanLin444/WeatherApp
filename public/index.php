<?php 
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
require '../src/WeatherService.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeatherApp</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="wrapper">
        <input type="text" class="search-city" placeholder="Введите город...">

        <div class="current-weather">
            <H1><span><?= round($data->main->temp); ?>°C</span><?= $data->name; ?></H1>
            <div class="weather-icon"><img src="" alt="icon"></div>
            <ul class="weather-stats">
                <li><span></span>4,1 м/с, Ю</li>
                <li><span></span>730</li>
                <li><span></span>48%</li>
            </ul>
        </div>
        <div class="week-weather">
            <div class="week-day"></div>
            <div class="week-day"></div>
            <div class="week-day"></div>
            <div class="week-day"></div>
            <div class="week-day"></div>
            <div class="week-day"></div>
        </div>
    </div>
</body>

<footer>
    © 2026 VanLin444 | GitHub Projects Hub
</footer>
</html>