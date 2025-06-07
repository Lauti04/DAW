// Toggle Sidebar y Nav-Link Activo
document.addEventListener('DOMContentLoaded', () => {
  const sidebar = document.getElementById('sidebar');
  const btnOpen = document.getElementById('btn-sidebar-toggle');
  const btnClose = document.getElementById('btn-sidebar-close');
  const navLinks = document.querySelectorAll('.nav-link');
  const DURATION = 300; // ms

  const isDesktop = () => window.innerWidth >= 768;

  function updateButtons() {
    const closed = isDesktop()
      ? sidebar.classList.contains('md:w-0')
      : sidebar.classList.contains('-translate-x-full');
    btnOpen.style.display = closed ? 'block' : 'none';
    btnClose.style.display = closed ? 'none' : 'block';
  }

  function closeSidebar() {
    if (isDesktop()) {
      sidebar.classList.remove('md:w-64', 'md:p-6');
      sidebar.classList.add('md:w-0', 'md:p-0');
    } else {
      sidebar.classList.add('-translate-x-full');
    }
    updateButtons();
    setTimeout(() => window.dispatchEvent(new Event('resize')), DURATION);
  }

  function openSidebar() {
    if (isDesktop()) {
      sidebar.classList.remove('md:w-0', 'md:p-0');
      sidebar.classList.add('md:w-64', 'md:p-6');
    } else {
      sidebar.classList.remove('-translate-x-full');
    }
    updateButtons();
    setTimeout(() => window.dispatchEvent(new Event('resize')), DURATION);
  }

  // Inicial
  if (isDesktop()) {
    sidebar.classList.remove('-translate-x-full', 'md:w-0', 'md:p-0');
    sidebar.classList.add('md:w-64', 'md:p-6');
  } else {
    sidebar.classList.remove('md:w-64', 'md:p-6');
    sidebar.classList.add('-translate-x-full');
  }
  updateButtons();

  // Eventos
  btnOpen.addEventListener('click', (e) => {
    e.stopPropagation();
    openSidebar();
  });
  btnClose.addEventListener('click', (e) => {
    e.stopPropagation();
    closeSidebar();
  });
  navLinks.forEach((link) => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      navLinks.forEach((a) => a.classList.remove('active'));
      link.classList.add('active');
    });
  });
  window.addEventListener('resize', updateButtons);

  // — Forzar apertura del date-picker nativo —
  //   document.querySelectorAll('input[type="date"], input[type="datetime-local"]').forEach((input) => {
  //     input.addEventListener('click', () => {
  //       if (typeof input.showPicker === 'function') {
  //         input.showPicker();
  //       }
  //     });
  //   });

  // Perfil: toggle del dropdown de usuario
  const btnProfile = document.getElementById('btn-profile');
  const profileMenu = document.getElementById('profile-menu');

  btnProfile.addEventListener('click', (e) => {
    e.stopPropagation();
    profileMenu.classList.toggle('hidden');
  });
  window.addEventListener('click', () => {
    profileMenu.classList.add('hidden');
  });
});

// tras cargar React y antes de renderizar modales
// flatpickr('input[type="date"]', {
//   dateFormat: 'Y-m-d',
//   allowInput: true,
//   theme: 'light', // por defecto
// });
// flatpickr('input[type="date"]', {
//   dateFormat: 'Y-m-d',
//   allowInput: true,
//   theme: 'material_dark', // automático si media-query anterior
// });
// flatpickr('input[type="datetime-local"]', {
//   enableTime: true,
//   dateFormat: 'Y-m-d H:i',
//   allowInput: true,
//   theme: 'material_dark',
// });
