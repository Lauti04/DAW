document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('theme-toggle');
    const toggleBall = document.querySelector('.toggle-ball');
    const logos = document.querySelectorAll('.logo');
    const html = document.documentElement;

    // Función para aplicar el tema
    const applyTheme = (newTheme) => {
        html.style.opacity = '0';
        requestAnimationFrame(() => {
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            
            // Actualizar toggle y logo
            toggle.checked = newTheme === 'dark';
            toggleBall.innerHTML = newTheme === 'dark' 
                ? '<i class="bi bi-moon-fill"></i>' 
                : '<i class="bi bi-sun-fill"></i>';
            updateLogo(newTheme);
            
            html.style.opacity = '1';
        });
    };

    // Función para actualizar logo con transición
    const updateLogo = (theme) => {
        logos.forEach(logo => {
            logo.style.opacity = '0';
            setTimeout(() => {
                logo.src = theme === 'dark'
                    ? '../assets/images/logo/Dulce_Encanto_Logo_Dark.png'
                    : '../assets/images/logo/Dulce_Encanto_Logo.png';
                logo.style.opacity = '1';
            }, 150);
        });
    };

    // Estado inicial (usando tu lógica original)
    const storedTheme = localStorage.getItem('theme');
    const initialTheme = storedTheme || 'light';
    
    if (storedTheme === 'dark') {
        toggle.checked = true;
        toggleBall.innerHTML = '<i class="bi bi-moon-fill"></i>';
    } else {
        toggle.checked = false;
        toggleBall.innerHTML = '<i class="bi bi-sun-fill"></i>';
    }
    html.setAttribute('data-theme', initialTheme);
    updateLogo(initialTheme);

    // Evento del toggle
    toggle.addEventListener('change', () => {
        const newTheme = toggle.checked ? 'dark' : 'light';
        applyTheme(newTheme);
        
        if (window.innerWidth < 992) {
            const navbar = bootstrap.Collapse.getInstance('#navbarNav');
            navbar?.hide();
        }
    });
});