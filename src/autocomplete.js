const input = document.getElementById('search');
const list = document.getElementById('suggestions');

let timeout = null;
input.addEventListener('input', () => {
    const query = input.value;
    // debounce (чтобы не спамить API)
    clearTimeout(timeout);

    timeout = setTimeout(() => {
        if (query.length < 2) {
            list.innerHTML = '';
            document.getElementById("suggestions").style.display = "none";
            return;
        } else {
            document.getElementById("suggestions").style.display = "block";
        }

        fetch(`search.php?q=${query}`)
            .then(res => res.json())
            .then(data => {
                list.innerHTML = '';

                data.forEach(city => {
                    const li = document.createElement('li');
                    li.textContent = `${city.name}, ${city.country}`;

                    li.addEventListener('click', () => {
                        input.value = city.name;
                        list.style.display = 'none';
                        // Сохранение ранее выбранного города
                        window.localStorage.setItem("selectedCities", JSON.stringify(
                            {
                                city: city.name,
                                country: city.country,
                                coords: [city.lat, city.lon]
                            }))
                        // Загрузка погоды
                        loadWeatherByCoords(city.lat, city.lon);
                    });

                    list.appendChild(li);
                });
            });
    }, 300); // задержка
});

// Клик по полю ввода работает единожды
input.addEventListener('click', () => {
    if (localStorage.getItem('selectedCities') !== null) {
        list.innerHTML = '';
        document.getElementById("suggestions").style.display = "block";
        const li = document.createElement('li');
        const selCities = JSON.parse(localStorage.getItem('selectedCities'));
        li.textContent = `${selCities.city}, ${selCities.country}`;
        list.appendChild(li);

        li.addEventListener('click', () => {
            input.value = selCities.city;
            list.style.display = 'none';
            loadWeatherByCoords(selCities.coords[0], selCities.coords[1]);
        });
    }
},)