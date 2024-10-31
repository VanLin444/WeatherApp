<?php include 'request.php';?>
<!doctype html>
<html>
<head>
<title>WeatherApp</title>
<link rel='stylesheet' href='style.css' />
</head>
<body>
    <div class="report-container">
        <h2><?php echo $data->name; ?> Weather Status</h2>
        <div class="time">
            <div><?php echo date("l G:i a", $currentTime); ?></div>
            <div><?php echo date("jS F, Y",$currentTime); ?></div>
        </div>
        <div class="weather-forecast">
            <div><?php echo ucwords($data->weather[0]->description); ?></div>
            <img src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png" class="weather-icon"> 
            <span class="max-temperature"><?php echo $data->main->temp_max; ?>&deg;C</span>
            <span class="min-temperature"><?php echo $data->main->temp_min; ?>&deg;C</span>
        </div>
        <div class="time">
            <div><img src="https://icon666.com/r/_thumb/7zd/7zdkkbsr7qa5_64.png" width="45" height="45" class="weather-icon">Humidity: <?php echo $data->main->humidity; ?> %</div>
            <div><img src="https://icon-library.com/images/windy-weather_16590.png" width="45" height="45" class="weather-icon">Wind: <?php echo $data->wind->speed; ?> km/h</div>
        </div>
    </div>
</body>
</html>