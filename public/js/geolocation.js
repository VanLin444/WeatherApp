// Получение данных о гео-локации пользователя
async function getUserLocation() {
    return new Promise((resolve, reject) => {
        if (!navigator.geolocation) {
            reject("Геолокация не поддерживается");
            return;
        }

        navigator.geolocation.getCurrentPosition(
            (position) => {
                resolve({ 
                    lat: position.coords.latitude, 
                    lon: position.coords.longitude 
                });
            },
            (error) => {
                reject(error);
            }
        );
    });
}
