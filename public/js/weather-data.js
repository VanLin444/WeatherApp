const DEFAULT_LOCATION = {
    lat: 55.7558,
    lon: 37.6173,
    сity: "Москва!"
};
const PRESSURE_COEFFICIENT = 0.75;

window.addEventListener('load', async () => {
    const loader = document.getElementById('loader');
    const icon = document.getElementById('weather-icon');
    try {
        loader.style.display = 'block';
        const coords = await getUserLocation();
        await loadWeatherByCoords(coords.lat, coords.lon);
    } catch {
        await loadWeatherByCoords();
    } finally {
        loader.style.display = 'none';
        icon.style.display = 'block';
    }
})

// Получение данных о погоде
async function loadWeatherByCoords(lat = DEFAULT_LOCATION.lat, lon = DEFAULT_LOCATION.lon, cityName = DEFAULT_LOCATION.city) {
    try {
        const response = await fetch(`../src/get-weather.php?lat=${lat}&lon=${lon}`);
        if (!response.ok) {
            throw new Error(response.status);
        }
        const data = await response.json();
        renderWeather(data, cityName);
    } catch (e) {
        console.error('Error : ', e);
    }
}

// Обновление данных на странице
function renderWeather(data, cityName = null) {
    document.getElementById('temp').innerHTML = `<b>${(data.main.temp > 0 ? '+' : '') + Math.round(data.main.temp)}</b> °C`;
    document.getElementById('city').innerText = cityName || data.name;
    document.getElementById('wind').innerText = `Ветер : ${Math.round(data.wind.speed)} м/c`;
    document.getElementById('pressure').innerText = `Атм. давление : ${Math.round(data.main.pressure * PRESSURE_COEFFICIENT)} мм. рт. ст`;
    document.getElementById('humidity').innerText = `Влажность : ${data.main.humidity} %`;
    document.getElementById('clouds').innerText = ` Облачность : ${data.clouds.all} %`;
    document.getElementById('icon').src = `https://openweathermap.org/payload/api/media/file/${data.weather[0].icon}.png`;
}