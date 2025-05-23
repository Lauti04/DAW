// dark_mode.js
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

  // Guardamos el SVG de hamburguesa solo si existe el botón
  const hamburgerSVG = btnMenu ? btnMenu.innerHTML.trim() : '';
  const closeSVG = `
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M6 18L18 6M6 6l12 12"/>
    </svg>`.trim();

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

  // 🔹 inicializar tema
  const stored = localStorage.getItem('theme');
  const preferDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  applyTheme(stored || (preferDark ? 'dark' : 'light'));

  // 🔹 toggle tema
  if (btnTheme) {
    btnTheme.addEventListener('click', () => {
      const next = root.classList.contains('dark') ? 'light' : 'dark';
      applyTheme(next);
      localStorage.setItem('theme', next);
    });
  }

  // 🔹 mobile menu open/close
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
    // cerrar al click fuera
    document.addEventListener('click', (e) => {
      if (menuOpen && !mobileMen.contains(e.target) && !btnMenu.contains(e.target)) {
        closeMenu();
      }
    });
  }

  // 🔹 cerrar al pulsar nav-link
  document.querySelectorAll('.nav-link').forEach((link) => {
    link.addEventListener('click', (e) => {
      // 1) quitar ACTIVE donde esté
      document.querySelectorAll('.nav-link.active').forEach((a) => a.classList.remove('active'));

      // 2) poner ACTIVE en *todos* los enlaces con el mismo href (desktop + mobile)
      const href = link.getAttribute('href');
      document
        .querySelectorAll(`.nav-link[href="${href}"]`)
        .forEach((a) => a.classList.add('active'));

      // 3) hacer scroll suave a la sección
      e.preventDefault();
      const target = link.getAttribute('href').slice(1);
      document.getElementById(target)?.scrollIntoView({ behavior: 'smooth' });
    });
  });

  // 🔹 scroll-spy para active link (desactivado)
  /*
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.nav-link');
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        const id = entry.target.id;
        const link = document.querySelector(`.nav-link[href="#${id}"]`);
        if (entry.isIntersecting) {
          navLinks.forEach((a) => a.classList.remove('active'));
          if (link) link.classList.add('active');
        }
      });
    },
    { threshold: 0.6 }
  );
  sections.forEach((sec) => observer.observe(sec));
*/

  // 🔹 carrusel (si existe)
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
