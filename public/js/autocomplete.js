const input = document.getElementById('search');
const list = document.getElementById('suggestions');
const SEARCH_DELAY = 500;

let timeout = null;
input.addEventListener('input', () => {
    const query = input.value;
    // debounce (чтобы не спамить API, ждем пока пользователь введет город)
    clearTimeout(timeout);

    timeout = setTimeout(() => {
        if (query.length < 2) {
            list.style.display = 'none';
            return;
        }
        fetch(`../src/city-search.php?q=${query}`)
            .then(res => res.json())
            .then(data => {
                list.innerHTML = '';
                // Если такого города нет, то скрыть поле
                if (data.length === 0) {
                    list.style.display = 'none';
                    return;
                }
                list.style.display = 'block';

                data.forEach(city => {
                    // Создаем элемент списка и задаем его содержимое
                    const li = document.createElement('li');
                    li.textContent =`${city.name}, ${city.country}`;

                    // Задаем действия для обработчика событий, при нажатии на элемент списка
                    li.addEventListener('click', () => {
                        input.value = city.name;
                        list.style.display = 'none';
                        // Сохраняем выбранный город
                        saveCity(city);
                        // Загрузка погоды 
                        loadWeatherByCoords(city.lat, city.lon, city.name);
                    });
                    // Добавляем в DOM
                    list.appendChild(li);
                });
            }, SEARCH_DELAY);
    });
});

input.addEventListener('focus', () => {
    showRecentCities();
});

input.addEventListener('blur', () => {
    setTimeout(() => {
        list.style.display = 'none';
    }, 200);
});

// Вывод последних городов
function showRecentCities() {
    // Получаем данные из localstorage, если их нет, то зададим пустой массив (это происходит при первом заходе на сайт)
    const cities = JSON.parse(localStorage.getItem('selectedCities')) || [];
    if (cities.length === 0) {
        return;
    }
    if (!Array.isArray(cities)) {
        return;
    }

    list.innerHTML = '';
    list.style.display = 'block';

    // Добавляем все полученные города в список
    cities.forEach(city => {
        const li = document.createElement('li');
        li.textContent = `${city.city}, ${city.country}`;

        li.addEventListener('click', () => {
            input.value = city.city;
            list.style.display = 'none';
            loadWeatherByCoords(city.coords[0], city.coords[1], city.city);
        });
        list.appendChild(li);
    })
}

// Сохранение последних 5 городов в localstorage
function saveCity(city) {
    const cities = JSON.parse(localStorage.getItem('selectedCities')) || [];

    const cityData = {
        city: city.name,
        country: city.country,
        coords: [city.lat, city.lon]
    };

    // Убираем дубликаты
    const filteredCities = cities.filter(item => !(item.coords[0] === cityData.coords[0] && item.coords[1] === cityData.coords[1]));
    filteredCities.unshift(cityData);
    // Ограничение кол-ва элементов до 5
    const lastFiveCities = filteredCities.slice(0, 5);

    localStorage.setItem('selectedCities', JSON.stringify(lastFiveCities));
}