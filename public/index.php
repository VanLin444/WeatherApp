<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeatherApp</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../img/icon.png">
</head>

<body onload="loadWeatherByCoords()">
    <div class="wrapper">
        <input type="text" id="search" class="search-city" placeholder="Введите город..." autocomplete="off">
        <ul class="suggestions" id="suggestions"></ul>

        <div class="current-weather">
            <div class="weather-header">
                <div class="info">
                    <span id="city" class="city"></span>
                    <span id="temp" class="temp"></span>
                </div>
                <div class="weather-icon">
                    <img id="icon" alt="icon">
                </div>
            </div>
            <ul class="weather-stats">
                <li><img src="../img/wind.png" alt="wind"><span id="wind"></span></li>
                <li><img src="../img/pressure.png" alt="pressure"><span id="pressure"></span></li>
                <li><img src="../img/humidity.png" alt="humidity"><span id="humidity"></span></li>
                <li><img src="../img/clouds.png" alt="clouds"><span id="clouds"></span></li>
            </ul>
        </div>
    </div>
    <script src="../src/autocomplete.js"></script>
    <script src="../src/weather.js"></script>
</body>

<footer>
    © 2026 VanLin444 | GitHub Projects Hub
</footer>

</html>