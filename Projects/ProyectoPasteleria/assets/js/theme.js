(function() {
  const html = document.documentElement;
  // 1. Ocultar inmediatamente (antes de cualquier render)
  html.style.cssText = 'visibility:hidden;opacity:0;transition:opacity 0.2s !important;';
  
  // 2. Cargar tema desde localStorage o sistema
  const savedTheme = localStorage.getItem('theme');
  const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
  html.setAttribute('data-theme', savedTheme || systemTheme);
  
  // 3. Mostrar cuando el CSS esté listo
  window.addEventListener('load', () => {
      html.style.visibility = 'visible';
      html.style.opacity = '1';
  });
})();