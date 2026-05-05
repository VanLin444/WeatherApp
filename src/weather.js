async function loadWeatherByCoords(lat, lon) {
    try {
        const res = await fetch(`../src/WeatherService.php?lat=${lat}&lon=${lon}`);
        const data = await res.json();
        console.log(data);

        if (data.error) {
            alert(data.error);
            return;
        }

        // обновляем данные
        document.getElementById('temp').innerText = data.temp + '°C';
        document.getElementById('city').innerText = data.city;
        document.getElementById('wind').innerText = data.wind;
        document.getElementById('pressure').innerText = data.pressure;
        document.getElementById('humidity').innerText = data.humidity;
        document.getElementById('clouds').innerText = data.clouds;
        //document.getElementById('icon').src =`https://openweathermap.org/payload/api/media/file/${data.icon}.png`;

    } catch (e) {
        console.error('Ошибка:', e);
    }
}