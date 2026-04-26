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
        <input type="text" id="search" class="search-city" placeholder="Введите город..." autocomplete="off">
        <ul class="suggestions" id="suggestions"></ul>

        <div class="current-weather">
            <H1><span><?= round($data->main->temp); ?>°C </span><?= $data->name; ?></H1>
            <div class="weather-icon"><img src="https://openweathermap.org/img/w/<?=  $data->weather[0]->icon ?>.png" alt="icon"></div>
            <ul class="weather-stats">
                <li><span><img src="../img/wind.png" alt="wind"></span>Ветер : <?= $data->wind->speed ?> м/с</li>
                <li><span><img src="../img/pressure.png" alt="pressure"></span>Атм. давление : <?= ($data->main->grnd_level) * 0.75 ?> мм рт. ст.</li>
                <li><span><img src="../img/humidity.png" alt="humidity"></span>Влажность : <?= $data->main->humidity ?> %</li>
                <li><span><img src="../img/clouds.png" alt="clouds"></span>Облачность : <?= $data->clouds->all ?> %</li>
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
    <script src="../src/autocomplete.js"></script>
</body>

<footer>
    © 2026 VanLin444 | GitHub Projects Hub
</footer>

</html>