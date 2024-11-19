// $(window).scroll(function() {

// //Collapse the top bar color on scroll
// if ($(".cabecera contenedor").offset().top > 50) {
//    	$('.cabecera1').slideUp(300);
// } else {
//  $('.cabecera1').slideDown(300);
// }

// });

window.addEventListener('scroll', function () {
    const cabecera1 = document.querySelector('.cabecera1');
    const cabecera2 = document.querySelector('.cabecera2');
    const scrollPosition = window.scrollY;  // Obtener la posición actual del scroll

    if (scrollPosition > 30) {
        cabecera2.classList.add('fixed');
        cabecera1.classList.add('shrink');
    } else {
        cabecera2.classList.remove('fixed');
        cabecera1.classList.remove('shrink');
    }
});

const colorChanger = document.querySelector('.color-changer');
const ruedita = document.querySelector('.ruedita');
ruedita.addEventListener('click', function () {
    colorChanger.classList.toggle('hidden');
});

document.getElementById("menuToggle").addEventListener("click", function () {
    var menu = document.getElementById("menu");
    menu.classList.toggle("active");
});


document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".botones a");
    const panels = document.querySelectorAll(".clinic");
    const triangle = document.querySelector(".triangle"); // Asegúrate de seleccionar el triángulo

    // Aseguramos que pane1 esté visible al cargar
    const defaultPanel = document.getElementById("pane1");
    defaultPanel.classList.add("active");
    defaultPanel.style.display = "block"; // Mostrar el panel

    // Coloca el triángulo inicialmente
    const defaultButtonRect = buttons[0].getBoundingClientRect();
    triangle.style.left = `${defaultButtonRect.left + defaultButtonRect.width / 2}px`; // Centra el triángulo
    triangle.style.opacity = "1"; // Asegúrate de que el triángulo no sea transparente

    buttons.forEach((button, index) => {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            // Quitar 'active' de todos los botones y paneles
            buttons.forEach(btn => btn.classList.remove("active"));
            panels.forEach(panel => {
                panel.style.opacity = "0";
                panel.style.display = "none";
                panel.classList.remove("active");
            });

            // Añadir 'active' al botón y panel seleccionados
            button.classList.add("active");
            panels[index].classList.add("active");
            panels[index].style.display = "block"; // Mostrar el panel correspondiente

            setTimeout(() => {
                panels[index].style.opacity = "1"; // Fade-in más visible
            }, 10); // Añadir leve retraso para el efecto

            // Ajustar la posición del triángulo
            const buttonRect = button.getBoundingClientRect();
            triangle.style.left = `${buttonRect.left + buttonRect.width / 2}px`; // Centra el triángulo debajo del botón activo
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".botones a");
    const clinic1 = document.querySelector(".clinic1");

    // Aseguramos que el contenido se muestre inicialmente
    clinic1.classList.add("active");

    buttons.forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault(); // Evita el comportamiento predeterminado

            // Quitar 'active' de todos los botones y del contenedor
            buttons.forEach(btn => btn.classList.remove("active"));
            clinic1.classList.remove("active");

            // Añadir 'active' al botón y al contenedor seleccionados
            button.classList.add("active");
            clinic1.classList.add("active");
        });
    });
});







document.addEventListener("DOMContentLoaded", function() {
    const faqContainer = document.querySelector(".faq-container");
    const questions = document.querySelectorAll(".faq-question");

    function adjustContainerHeight() {
        const activeAnswer = document.querySelector(".faq-answer[style*='max-height']");
        if (activeAnswer) {
            faqContainer.style.height = faqContainer.scrollHeight + "px";
        }
    }

    questions.forEach(question => {
        question.addEventListener("click", function() {
            const isActive = question.classList.contains("active");

            // Cerrar todos los paneles
            questions.forEach(q => {
                q.classList.remove("active");
                q.nextElementSibling.style.maxHeight = null;
            });

            // Abrir el panel seleccionado solo si no estaba activo
            if (!isActive) {
                question.classList.add("active");
                const answer = question.nextElementSibling;
                answer.style.maxHeight = answer.scrollHeight + "px";
            }

            // Ajustar la altura del contenedor
            adjustContainerHeight();
        });
    });

    // Ajustar la altura del contenedor al cargar la página si el primer elemento está abierto
    adjustContainerHeight();
});




// Mapa Leaflet
const mapContainer = document.getElementById("map");
if (mapContainer && typeof L !== 'undefined') {
    const map = L.map('map').setView([40.7382422317298, -74.00887762461242], 20);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    const largeIcon = L.icon({
        iconUrl: 'https://www.ingridkuhn.com/themes/happypaws/img/mapmarker.png',
        iconSize: [80, 82],
        iconAnchor: [25, 82],
        popupAnchor: [0, -76]
    });
    L.marker([40.7382422317298, -74.00887762461242], { icon: largeIcon }).addTo(map)
        .openPopup();
    console.log("Mapa inicializado exitosamente");
} else {
    console.error("No se encontró el contenedor del mapa o Leaflet no está definido.");
}



document.querySelectorAll('.color-picker a').forEach(button => {
    button.addEventListener('click', event => {
        event.preventDefault();

        // Obtén el color seleccionado del atributo data-color
        const color = button.getAttribute('data-color');

        // Define las combinaciones de colores
        const colorThemes = {
            blue: {
                '--naranja-principal': '#3497db',
                '--naranja-secundario': '#0E4F7C'
            },
            red: {
                '--naranja-principal': '#E26659',
                '--naranja-secundario': '#E26659'
            },
            green: {
                '--naranja-principal': '#567E32',
                '--naranja-secundario': '#31B767'
            },
            brown: {
                '--naranja-principal': '#8e6341',
                '--naranja-secundario': '#DEB35D'
            },
            yellow: {
                '--naranja-principal': '#d35400',
                '--naranja-secundario': '#f29c12'
            }
        };

        // Cambia las variables CSS en :root
        const root = document.documentElement;
        root.style.setProperty('--naranja-principal', colorThemes[color]['--naranja-principal']);
        root.style.setProperty('--naranja-secundario', colorThemes[color]['--naranja-secundario']);
    });
});


function hidePreloader() {
    // Obtiene el elemento preloader del DOM usando su ID
    const preloader = document.getElementById('preloader');
    
    // Establece la opacidad a 0 para que se desvanezca gradualmente
    preloader.style.opacity = '0';
    
    // Después de 500ms (0.5 segundos), oculta completamente el preloader
    // usando setTimeout para dar tiempo a que termine la transición de opacidad
    setTimeout(() => {
        preloader.style.display = 'none';
    }, 500);
}

// Evento que se dispara cuando la página ha cargado completamente
window.addEventListener('load', () => {
    // Simulamos un tiempo de carga mínimo de 1 segundo
    setTimeout(hidePreloader, 1000);
});

const scrollToTopButton = document.getElementById('scroll-to-top');

window.addEventListener('scroll', () => {
    if (window.pageYOffset > 300) { // Mostrar después de 300px de scroll
        scrollToTopButton.classList.add('visible');
    } else {
        scrollToTopButton.classList.remove('visible');
    }
});

scrollToTopButton.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});




const testimonials = document.querySelectorAll('.testimonial');
const dots = document.querySelectorAll('.dot');
let currentIndex = 0;

// Función para actualizar el slider
function updateSlider(index) {
    testimonials.forEach((testimonial, i) => {
        testimonial.classList.remove('active', 'slide-out');

        // Añade el efecto de salida al testimonio actual
        if (i === currentIndex) {
            testimonial.classList.add('slide-out');
        }
        // Añade el efecto de entrada al nuevo testimonio
        if (i === index) {
            testimonial.classList.add('active');
        }
    });

    // Actualiza los puntos de navegación
    dots.forEach((dot, idx) => {
        dot.classList.toggle('active-dot', idx === index);
    });

    currentIndex = index;
}

// Control de los puntos para cambiar el slider
dots.forEach((dot, idx) => {
    dot.addEventListener('click', () => {
        if (idx !== currentIndex) {
            updateSlider(idx);
        }
    });
});

// Cambio automático del slider
setInterval(() => {
    const nextIndex = (currentIndex + 1) % testimonials.length;
    updateSlider(nextIndex);
}, 10000);







const slides = document.querySelector('.slides');

const caja_bullets = document.querySelectorAll('.bullet');

let indiceActual = 0;



function mostrarSlide(index) {
    slides.style.transform = `translateX(-${index * 100}%)`;
    caja_bullets.forEach(bullet => bullet.classList.remove('active'));
    caja_bullets[index].classList.add('active');
}


caja_bullets.forEach(bullet => {
    bullet.addEventListener('click', () => {
        indiceActual = bullet.getAttribute('posicion_slide');
        mostrarSlide(indiceActual);
    });
});



function nextSlide() {
    indiceActual = (indiceActual + 1) % caja_bullets.length;
    mostrarSlide(indiceActual);
}
setInterval(nextSlide, 3000);