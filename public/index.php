

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeatherApp</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body onload="loadWeatherByCoords()">
    <div class="wrapper">
        <input type="text" id="search" class="search-city" placeholder="Введите город..." autocomplete="off">
        <ul class="suggestions" id="suggestions"></ul>

        <div class="current-weather">
            <h1>
                <span id="temp"></span>
                <span id="city"></span>
            </h1>
            <div class="weather-icon">
                <img id="icon" alt="icon">
            </div>
            <ul class="weather-stats">
                <li><span id="wind"><img src="../img/wind.png" alt="wind"></span>Ветер</li>
                <li><span id="pressure"><img src="../img/pressure.png" alt="pressure"></span>Атм. давление</li>
                <li><span id="humidity"><img src="../img/humidity.png" alt="humidity"></span>Влажность</li>
                <li><span id="clouds"><img src="../img/clouds.png" alt="clouds"></span>Облачность</li>
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