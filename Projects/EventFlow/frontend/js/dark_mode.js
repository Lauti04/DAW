// frontend/js/dark_mode.js

document.addEventListener('DOMContentLoaded', () => {
  const root = document.documentElement;
  const headerEl = document.querySelector('header.sticky');
  const mobileMen = document.getElementById('mobile-menu');
  const btnMenu = document.getElementById('btn-mobile-menu');
  const btnTheme = document.getElementById('btn-theme-toggle');
  const iconTheme = document.getElementById('theme-icon');
  const logoLight = document.getElementById('logo-light');
  const logoDark = document.getElementById('logo-dark');
  const bannerLight = document.getElementById('banner-light');
  const bannerDark = document.getElementById('banner-dark');

  // Guardamos el SVG de hamburguesa solo si existe el botón móvil
  const hamburgerSVG = btnMenu ? btnMenu.innerHTML.trim() : '';
  const closeSVG = `
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M6 18L18 6M6 6l12 12"/>
    </svg>`;

  // Función que aplica el tema y ajusta todos los elementos
  function applyTheme(theme) {
    const darkBg = getComputedStyle(root).getPropertyValue('--dark').trim();

    if (theme === 'dark') {
      root.classList.add('dark');
      if (iconTheme) iconTheme.classList.replace('fa-moon', 'fa-sun');
      if (headerEl) headerEl.style.backgroundColor = darkBg;
      if (mobileMen) mobileMen.style.backgroundColor = darkBg;
      if (logoLight) logoLight.style.display = 'none';
      if (logoDark) logoDark.style.display = 'block';
      if (bannerLight) bannerLight.style.display = 'none';
      if (bannerDark) bannerDark.style.display = 'block';
    } else {
      root.classList.remove('dark');
      if (iconTheme) iconTheme.classList.replace('fa-sun', 'fa-moon');
      if (headerEl) headerEl.style.backgroundColor = '#FFFFFF';
      if (mobileMen) mobileMen.style.backgroundColor = '#FFFFFF';
      if (logoLight) logoLight.style.display = 'block';
      if (logoDark) logoDark.style.display = 'none';
      if (bannerLight) bannerLight.style.display = 'block';
      if (bannerDark) bannerDark.style.display = 'none';
    }
  }

  // 🔹 Inicializar tema según storage o preferencia
  const stored = localStorage.getItem('theme');
  const preferDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  applyTheme(stored || (preferDark ? 'dark' : 'light'));

  // 🔹 Toggle tema
  if (btnTheme) {
    btnTheme.addEventListener('click', () => {
      const next = root.classList.contains('dark') ? 'light' : 'dark';
      applyTheme(next);
      localStorage.setItem('theme', next);
    });
  }

  // 🔹 Mobile menu open/close (si existe)
  if (btnMenu && mobileMen) {
    let menuOpen = false;
    function openMenu() {
      mobileMen.classList.remove('max-h-0', 'opacity-0', 'pointer-events-none');
      mobileMen.classList.add('max-h-screen', 'opacity-100', 'pointer-events-auto');
      btnMenu.innerHTML = closeSVG;
      menuOpen = true;
    }
    function closeMenu() {
      mobileMen.classList.remove('max-h-screen', 'opacity-100', 'pointer-events-auto');
      mobileMen.classList.add('max-h-0', 'opacity-0', 'pointer-events-none');
      btnMenu.innerHTML = hamburgerSVG;
      menuOpen = false;
    }
    btnMenu.addEventListener('click', (e) => {
      e.stopPropagation();
      menuOpen ? closeMenu() : openMenu();
    });
    document.addEventListener('click', (e) => {
      if (menuOpen && !mobileMen.contains(e.target) && !btnMenu.contains(e.target)) {
        closeMenu();
      }
    });
  }

  // 🔹 Nav-link: sólo uno activo y scroll suave
  document.querySelectorAll('.nav-link').forEach((link) => {
    link.addEventListener('click', (e) => {
      document.querySelectorAll('.nav-link.active').forEach((a) => a.classList.remove('active'));
      link.classList.add('active');
      e.preventDefault();
      const target = link.getAttribute('href').slice(1);
      document.getElementById(target)?.scrollIntoView({ behavior: 'smooth' });
    });
  });

  // 🔹 Carrusel (si existe)
  const carousel = document.getElementById('carousel');
  if (carousel) {
    const prevBtn = document.getElementById('prev-slide');
    const nextBtn = document.getElementById('next-slide');
    const scrollAmount = carousel.firstElementChild.clientWidth + 24;
    prevBtn.addEventListener('click', () => {
      carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    });
    nextBtn.addEventListener('click', () => {
      carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });
  }
});
