let menuIcon = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');
let sections = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('header nav a');
const toolbar = document.querySelector('.toolbar');

window.onscroll = () => {
    sections.forEach(sec => {
        let top = window.scrollY;
        let offset = sec.offsetTop - 150;
        let height = sec.offsetHeight;
        let id = sec.getAttribute('id');

        if (top >= offset && top < offset + height) {
            navLinks.forEach(links => {
                links.classList.remove('active');
                document.querySelector('header nav a[href*=' + id + ' ]').classList.add('active');
            })
        }
    })
}

menuIcon.onclick = () => {
    menuIcon.classList.toggle('bx-x');
    navbar.classList.toggle('active');

    if (navbar.classList.contains('active')) {
        toolbar.style.display = 'none';
    } else {
        toolbar.style.display = 'flex';
    }
}

const translations = {
    es: {
        header: {
            logo: "Lautaro <span>Johnston</span>",
            nav: ["Inicio", "Sobre mí", "Servicios", "Proyectos", "Contacto"],
        },
        home: {
            greeting: "Hola, soy <span>Lautaro</span>",
            rolePrefix: "Soy un",
            roles: [
                "Desarrollador Frontend",
                "Diseñador Web",
                "Junior Backend Developer",
                "Entusiasta de UI",
                "Futuro Experto en React",
            ],
            description: "Estudiante de Desarrollo Web especializado en Frontend y con conocimientos " +
            "básicos de Backend. Me apasiona crear sitios web funcionales y atractivos, " +
            "siempre buscando mejorar y aprender nuevas tecnologías para superar las " +
            "expectativas de cada proyecto.",
           buttons: ["Contratar", "Contactar", "Descargar CV"],
        },
        about: {
            heading: "Sobre <span>Mí</span>",
            content: "Soy Lautaro, un estudiante de Desarrollo de Aplicaciones Web con un fuerte enfoque en Frontend " +
            "nacido en Argentina, especializado en HTML, CSS y Javascript, aunque también tengo conocimientos " +
            "básicos de Backend utilizando PHP, MySQL y Java. <br><br> Mi objetivo es seguir aprendiendo y perfeccionando " +
            "mis habilidades, tanto en diseño web como en desarrollo, para ofrecer soluciones innovadoras y personalizadas. <br><br> " +
            "Trabajo de manera ordenada y estructurada, prestando atención a cada detalle para garantizar que los proyectos " +
            "no solo funcionen, sino que también destaquen. Aunque no soy un diseñador profesional, me esfuerzo cada día " +
            "para mejorar en este aspecto, con el objetivo de aprender herramientas como Figma en el futuro. <br><br> " +
            "Estoy comprometido a adaptarme a los desafíos, y si un proyecto requiere trabajar con tecnologías, frameworks " +
            "o librerías nuevas, estoy siempre dispuesto a aprender y aplicar lo necesario.",
            button: "Leer Más",
        },
        services: {
            heading: "Servicios",
            items: [
                {
                    title: "Diseño Web",
                    description: "Personalización de interfaces enfocadas en la experiencia del usuario (UX) y el diseño visual " +
                        "atractivo (UI), garantizando un estilo único y funcional.",
                },
                {
                    title: "Desarrollo Frontend",
                    description: "Creación de sitios web responsivos y dinámicos utilizando HTML, CSS y JavaScript, optimizados " +
                        "para ofrecer una experiencia fluida en cualquier dispositivo.",
                },
                {
                    title: "Mejora de una Web",
                    description: "Actualización de sitios web para optimizar su rendimiento, estética y compatibilidad con las " +
                        "tecnologías actuales.",
                },
            ],
        },
        projects: {
            heading: "Proyectos",
            items: [
                {
                    title: "Happy Paws",
                    description: 
                        "Diseño y desarrollo de una web responsiva para servicios relacionados con mascotas, " +
                        "incluyendo veterinaria, adopción y cuidado. Este proyecto me permitió profundizar en el diseño " +
                        "y en el manejo dinámico del DOM, especialmente a través de la integración de múltiples banners " +
                        "interactivos.",
                    button: "Ver Proyecto",
                },
                {
                    title: "MalagaSupercars",
                    description: 
                        "Desarrollo de una plataforma web para la venta de coches de alta gama, conectada a una base " +
                        "de datos MySQL. La aplicación incluye funcionalidades clave como filtros avanzados para " +
                        "vehículos, inserción y eliminación de coches, registro de usuarios, inicio de sesión y " +
                        "gestión de cuentas, ofreciendo una experiencia completa tanto para administradores como para " +
                        "clientes.",
                    button: "Ver Proyecto",
                },
                {
                    title: "World Slider",
                    description: 
                        "Diseño de un mini proyecto que incluye un slider responsivo de videos sobre lugares del " +
                        "mundo. Este proyecto me permitió trabajar en la optimización de la experiencia visual y en la " +
                        "adaptabilidad del contenido en diferentes dispositivos.",
                    button: "Ver Proyecto",
                },
            ],
        },
    },
    en: {
        header: {
            logo: "Lautaro <span>Johnston</span>",
            nav: ["Home", "About Me", "Services", "Projects", "Contact"],
        },
        home: {
            greeting: "Hi, It's <span>Lautaro</span>",
            rolePrefix: "I'm a",
            roles: [
                "Frontend Developer",
                "Web Designer",
                "Junior Backend Developer",
                "UI Enthusiast",
                "Future React Expert",
            ],
            description: "A web development student specializing in Frontend " +
             "with basic knowledge of Backend. I'm passionate about creating functional " +
             "and visually appealing websites, always striving to improve and learn new " +
             "technologies to exceed expectations in every project.",
            buttons: ["Hire Me", "Contact", "Download CV"],
        },
        about: {
            heading: "About <span>Me</span>",
            content: "I'm Lautaro, a Web Application Development student with a strong focus on Frontend and basic " +
            "knowledge of Backend, working with PHP, MySQL, and Java. My goal is to continue learning and refining " +
            "my skills in both web design and development to deliver innovative and tailored solutions. <br><br> " +
            "I work in an organized and structured manner, paying attention to every detail to ensure that projects " +
            "not only work perfectly but also stand out. Although I'm not a professional designer, I strive daily " +
            "to improve in this area, with plans to learn tools like Figma in the near future. <br><br> " +
            "I am committed to adapting to challenges, and if a project requires working with new technologies, " +
            "frameworks, or libraries, I am always eager to learn and apply them as needed.",
            button: "Read More",
        },
        services: {
            heading: "Services",
            items: [
                {
                    title: "Web Design",
                    description: "Customization of interfaces focused on user experience (UX) and visually appealing design (UI), " +
                        "ensuring a unique and functional style.",
                },
                {
                    title: "Frontend Development",
                    description: "Creation of responsive and dynamic websites using HTML, CSS, and JavaScript, optimized to " +
                        "deliver a seamless experience across any device.",
                },
                {
                    title: "Website Improvement",
                    description: "Updating websites to optimize performance, aesthetics, and compatibility with current " +
                        "technologies.",
                },
            ],
        },
        projects: {
            heading: "Projects",
            items: [
                {
                    title: "Happy Paws",
                    description: 
                        "Design and development of a responsive website for pet-related services, including " +
                        "veterinary care, adoption, and pet care. This project allowed me to deepen my design skills " +
                        "and dynamic DOM handling, especially through the integration of multiple interactive banners.",
                    button: "See Project",
                },
                {
                    title: "MalagaSupercars",
                    description: 
                        "Development of a web platform for the sale of luxury cars, connected to a MySQL database. " +
                        "The application includes key features like advanced vehicle filters, insertion and removal of " +
                        "cars, user registration, login, and account management, offering a complete experience for " +
                        "both administrators and clients.",
                    button: "See Project",
                },
                {
                    title: "World Slider",
                    description: 
                        "Design of a mini-project that includes a responsive video slider showcasing locations around " +
                        "the world. This project allowed me to work on optimizing the visual experience and adapting " +
                        "content across various devices.",
                    button: "See Project",
                },
            ],
        },
    },
};

function changeLanguage(lang) {
    localStorage.setItem("selectedLang", lang);

    // Actualizar header
    const headerTranslations = translations[lang].header;
    document.querySelector(".logo").innerHTML = headerTranslations.logo;
    const navLinks = document.querySelectorAll(".navbar a");
    navLinks.forEach((link, index) => {
        link.textContent = headerTranslations.nav[index];
    });

    // Actualizar home
    const homeTranslations = translations[lang].home;
    document.querySelector(".home-content h1").innerHTML = homeTranslations.greeting;

    // Actualizar "Soy un" o "I'm a"
    document.querySelector(".home-content h3").childNodes[0].textContent = homeTranslations.rolePrefix + " ";

    // Actualizar roles animados
    const roleSpan = document.querySelector(".home-content h3 span");
    roleSpan.setAttribute('data-role', homeTranslations.roles.join(', '));

    document.querySelector(".home-content p").textContent = homeTranslations.description;

    const buttons = document.querySelectorAll(".btn-group .btn");
    buttons.forEach((button, index) => {
        button.textContent = homeTranslations.buttons[index];
    });

    // Actualizar about
    const aboutTranslations = translations[lang].about;
    document.querySelector(".about-content h2").innerHTML = aboutTranslations.heading;
    document.querySelector(".about-content p").innerHTML = aboutTranslations.content;
    document.querySelector(".about-content .btn").textContent = aboutTranslations.button;

    // Actualizar services
    const servicesTranslations = translations[lang].services;
    document.querySelector(".services .heading").textContent = servicesTranslations.heading;
    const serviceBoxes = document.querySelectorAll(".service-box");
    serviceBoxes.forEach((box, index) => {
        box.querySelector("h4").textContent = servicesTranslations.items[index].title;
        box.querySelector("p").textContent = servicesTranslations.items[index].description;
    });

    // Actualizar projects
    const projectsTranslations = translations[lang].projects;
    document.querySelector(".projects .heading").textContent = projectsTranslations.heading;
    const projectCards = document.querySelectorAll(".project-card");

    projectCards.forEach((card, index) => {
        const project = projectsTranslations.items[index];
        card.querySelector("h3").textContent = project.title;
        card.querySelector("p").textContent = project.description;
        card.querySelector(".btn").textContent = project.button;
    });


    // Actualizar los roles en la animación
    updateKeyframes(lang);
}

function updateKeyframes(lang) {
    const roles = translations[lang].home.roles;

    // Crear una nueva regla dinámica de @keyframes
    const keyframes = `
        @keyframes words {
            0%, 20% { content: "${roles[0]}"; }
            21%, 40% { content: "${roles[1]}"; }
            41%, 60% { content: "${roles[2]}"; }
            61%, 80% { content: "${roles[3]}"; }
            81%, 100% { content: "${roles[4]}"; }
        }
    `;

    // Actualizar las reglas del estilo dinámico
    const styleSheet = document.styleSheets[0];
    styleSheet.insertRule(keyframes, styleSheet.cssRules.length);
}


window.addEventListener("load", () => {
    const savedLang = localStorage.getItem("selectedLang") || "es";
    changeLanguage(savedLang);

    document.querySelectorAll(".language-selector button").forEach((button) => {
        button.addEventListener("click", () => {
            const lang = button.getAttribute("data-lang");
            changeLanguage(lang);
        });
    });
});


document.addEventListener("DOMContentLoaded", () => {
    const lines = document.querySelectorAll(".line");
    lines.forEach(line => {
        const delay = line.getAttribute("data-delay") * 500; // Cada línea aparece con un retraso
        setTimeout(() => {
            line.style.opacity = "1";
            line.style.transform = "translateY(0)";
        }, delay);
    });
});

