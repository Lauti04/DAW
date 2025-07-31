// Script para obtener el clima con Open-Meteo
async function obtenerClima() {
    // Coordenadas aproximadas de Málaga
    const lat = 36.7213;
    const lon = -4.4217;
    const url = `https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true&timezone=Europe/Madrid`;

    try {
        const response = await fetch(url);
        if (!response.ok) throw new Error('Error en la respuesta de la API');
        const data = await response.json();
        const temp = data.current_weather.temperature;
        const weathercode = data.current_weather.weathercode;
        let description = getWeatherDescription(weathercode);

        const html = `
        <h3 class="mt-4" style="color: var(--accent-color);">Málaga</h3>
        <p style="color: var(--accent-color); font-size: 1.2rem;">${temp}°C, ${description}</p>
      `;
        document.getElementById('weather-card').innerHTML = html;
    } catch (error) {
        console.error('Error al obtener el clima:', error);
        document.getElementById('weather-card').innerHTML = '<p style="color: var(--accent-color);">No se pudo obtener el clima.</p>';
    }
}

// Función para mapear los códigos de Open-Meteo a descripciones en español
function getWeatherDescription(code) {
    switch (code) {
        case 0: return "Cielo despejado";
        case 1: return "Mayormente despejado";
        case 2: return "Parcialmente nublado";
        case 3: return "Nublado";
        case 45:
        case 48: return "Niebla";
        case 51: return "Llovizna ligera";
        case 53: return "Llovizna moderada";
        case 55: return "Llovizna intensa";
        case 56: return "Llovizna helada ligera";
        case 57: return "Llovizna helada intensa";
        case 61: return "Lluvia ligera";
        case 63: return "Lluvia moderada";
        case 65: return "Lluvia intensa";
        case 66: return "Lluvia helada ligera";
        case 67: return "Lluvia helada intensa";
        case 71: return "Nevada ligera";
        case 73: return "Nevada moderada";
        case 75: return "Nevada intensa";
        case 77: return "Granos de nieve";
        case 80: return "Chubascos ligeros";
        case 81: return "Chubascos moderados";
        case 82: return "Chubascos intensos";
        case 85: return "Chubascos de nieve ligeros";
        case 86: return "Chubascos de nieve intensos";
        case 95: return "Tormenta moderada";
        case 96: return "Tormenta con granizo leve";
        case 99: return "Tormenta con granizo intenso";
        default: return "Condiciones desconocidas";
    }
}

// Llamada inicial para mostrar el clima en Málaga
obtenerClima();