// Toggle Sidebar y Nav-Link Activo
document.addEventListener('DOMContentLoaded', () => {
  const sidebar = document.getElementById('sidebar');
  const btnOpen = document.getElementById('btn-sidebar-toggle');
  const btnClose = document.getElementById('btn-sidebar-close');
  const navLinks = document.querySelectorAll('.nav-link');
  const DURATION = 300; // ms
  // 2.1. Mapa texto ↔ viewName de FullCalendar
  const VIEW_MAP = {
    mes: 'dayGridMonth',
    semana: 'dayGridWeek',
    día: 'dayGridDay',
    agenda: 'listWeek',
  };

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

  // ─────────────────────────────────────────────────────
  //  3) Disparadores para el “Crear…” y el enlace de ayuda
  // ─────────────────────────────────────────────────────
  const createSelect = document.getElementById('create-item');
  const helpLink = document.getElementById('help-create');

  if (createSelect) {
    createSelect.addEventListener('change', function (e) {
      const tipo = e.target.value;
      if (tipo) {
        // Abrir modal de crear del tipo correspondiente
        window.dispatchEvent(
          new CustomEvent('openModal', {
            detail: { type: tipo, dateStr: new Date().toISOString().slice(0, 10) },
          })
        );
        // Resetear select al placeholder
        e.target.value = '';
      }
    });
  }

  if (helpLink) {
    helpLink.addEventListener('click', function () {
      // Abrir el HelpModal
      window.dispatchEvent(new CustomEvent('openHelpModal'));
    });
  }

  // ─────────────────────────────────────────────────────
  //  2.2. Sidebar nav-links disparan cambio de vista
  // ─────────────────────────────────────────────────────
  document.querySelectorAll('.nav-link').forEach((link) => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      const txt = link.textContent.trim().toLowerCase();
      const view = VIEW_MAP[txt];
      if (view && window.calendar) {
        // Cambiar la vista
        window.calendar.changeView(view);
        // Sincronizar clases “activo” inmediatamente
        updateActive(view);
      }
    });
  });

  // ─────────────────────────────────────────────────────
  //  2.3. Marcar nav-links y botones según la vista activa
  // ─────────────────────────────────────────────────────
  function updateActive(viewName) {
    // Determinar la vista actual (pasada o desde calendar)
    // Obtiene la vista actual (pasada o desde el calendar)
    const currentView =
      viewName || (window.calendar && window.calendar.view && window.calendar.view.type);
    if (!currentView) return;

    // 1) Enlaces del sidebar
    document.querySelectorAll('.nav-link').forEach((link) => {
      const key = link.textContent.trim().toLowerCase();
      const view = VIEW_MAP[key];
      if (view) {
        const isActive = view === currentView;
        // Añadimos/removemos la clase 'active' para disparar las reglas de CSS
        link.classList.toggle('active', isActive);
        link.classList.toggle('bg-accent', isActive);
        link.classList.toggle('text-white', isActive);
      } else {
        link.classList.remove('active', 'bg-accent', 'text-white');
      }
    });

    // 2) Botones del toolbar
    document.querySelectorAll('.fc .fc-button').forEach((btn) => {
      const btnView = btn.getAttribute('data-view');
      // Consideramos activo si FullCalendar le puso fc-button-active o coincide con la vista
      const isBtnActive = btn.classList.contains('fc-button-active') || btnView === currentView;

      // 2.a) Estilos de fondo/texto
      const bg = isBtnActive ? 'var(--accent)' : 'var(--primary)';
      btn.style.setProperty('background-color', bg, 'important');
      btn.style.setProperty('color', '#ffffff', 'important');

      // 2.b) Border (opcional)
      btn.style.setProperty('border', 'none', 'important');
    });
  }

  // 2.4. Escuchar el evento custom que lanzamos en datesSet
  window.addEventListener('fcViewChanged', function (e) {
    updateActive(e.detail);
  });

  // 2.5. Marcar la vista inicial después de que calendar esté listo
  if (window.calendar) {
    updateActive();
  }

  // ─────────────────────────────────────────────────────
  //  4) Filtros: mostrar/ocultar eventos, tareas, recordatorios
  // ─────────────────────────────────────────────────────
  const chkAll = document.getElementById('filter-all');
  const chkEvento = document.getElementById('filter-evento');
  const chkTarea = document.getElementById('filter-tarea');
  const chkRecordatorio = document.getElementById('filter-recordatorio');

  function applyFilters() {
    const cal = window.calendar;
    if (!cal) return;

    // Si “Mostrar todos” está chequeado → mostrar todo
    if (chkAll.checked) {
      cal.getEvents().forEach((ev) => ev.setProp('display', 'block'));
    }

    // Si cambias cualquier filtro individual, desmarca “Mostrar todos”
    if (chkEvento.checked && chkTarea.checked && chkRecordatorio.checked) {
      chkAll.checked = true;
    } else {
      chkAll.checked = false;
    }

    // Recorre cada evento y oculta/enseña según su tipo
    cal.getEvents().forEach((ev) => {
      const tipo = ev.extendedProps.tipo; // 'evento' | 'tarea' | 'recordatorio'
      const mostrar =
        (tipo === 'evento' && chkEvento.checked) ||
        (tipo === 'tarea' && chkTarea.checked) ||
        (tipo === 'recordatorio' && chkRecordatorio.checked);
      ev.setProp('display', mostrar ? 'block' : 'none');
    });
  }

  // ─────────────────────────────────────────────────────
  // Listeners para cada filtro
  // ─────────────────────────────────────────────────────
  // “Mostrar todos”
  if (chkAll) {
    chkAll.addEventListener('change', () => {
      const todos = chkAll.checked;
      chkEvento.checked = todos;
      chkTarea.checked = todos;
      chkRecordatorio.checked = todos;
      applyFilters();
    });
  }
  // Filtros individuales
  [chkEvento, chkTarea, chkRecordatorio].forEach((chk) => {
    if (chk) {
      chk.addEventListener('change', () => {
        // Al desmarcar cualquiera, “Mostrar todos” se quita
        if (!chk.checked) chkAll.checked = false;
        applyFilters();
      });
    }
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
