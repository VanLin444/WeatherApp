// Город по умолчанию - Москва
async function loadWeatherByCoords(lat = 55.7558, lon = 37.6173) {
    try {
        const res = await fetch(`../src/WeatherService.php?lat=${lat}&lon=${lon}`);
        const data = await res.json();

        if (data.error) {
            alert(data.error);
            return;
        }
        
        // Обновление данных на странице
        document.getElementById('temp').innerText = Math.round(data.main.temp) + ' °C';
        document.getElementById('city').innerText = data.name;
        document.getElementById('wind').innerText = `Ветер : ${Math.round(data.wind.speed)} м/c`;
        document.getElementById('pressure').innerText = `Атм. давление : ${Math.round(data.main.pressure * 0.75)} мм. рт. ст`;
        document.getElementById('humidity').innerText = `Влажность : ${data.main.humidity} %`;
        document.getElementById('clouds').innerText = ` Облачность : ${data.clouds.all} %`;
        document.getElementById('icon').src =`https://openweathermap.org/payload/api/media/file/${data.weather[0].icon}.png`;

    } catch (e) {
        console.error('Ошибка:', e);
    }
}