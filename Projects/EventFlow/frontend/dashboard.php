<?php
// Protege la página con la sesión de PHP
define('BASE_PATH', __DIR__ . '/..');
require BASE_PATH . '/backend/auth/session.php';
?>
<!DOCTYPE html>
<html lang="es" class="<?php echo (isset($_COOKIE['theme']) && $_COOKIE['theme']==='dark') ? 'dark' : ''; ?>">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>EventFlow – Dashboard</title>
  <link rel="icon" type="image/png" sizes="64x64" href="../assets/img/logos/CalendarWeb.png">

  <!-- Tailwind CSS -->
  <link href="../assets/css/tailwind.css" rel="stylesheet" />

  <!-- FontAwesome -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="…"
    crossorigin="anonymous"
  />

  <!-- React + ReactDOM (vía CDN) -->
  <script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
  <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>

  <!-- Babel para transformar JSX in-browser -->
  <script src="https://cdn.jsdelivr.net/npm/@babel/standalone@7.27.2/babel.min.js"></script>

  <!-- Flatpickr CSS/light -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css"
  />
  <!-- confirmDate plugin CSS -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/plugins/confirmDate/confirmDate.css"
  />

  <!-- Flatpickr JS -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13"></script>
  <!-- confirmDate plugin JS -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/plugins/confirmDate/confirmDate.js"></script>

  <!-- Toolbar responsive de FullCalendar (solo estilos extra) -->
  <style>
    @media (max-width: 640px) {
      .fc .fc-header-toolbar {
        flex-direction: column !important;
        gap: 0.5rem !important;
      }
    }

    /* tailwind-input.css o tu CSS base */
    .js-loading body {
      visibility: hidden;
    }
    .js-loading .loader {
      display: flex; /* o block, según tu loader */
    }
  </style>
</head>
<body class="bg-secondary dark:bg-dark">
  <!-- Header -->
  <?php include __DIR__ . '/partials/header_dashboard.php'; ?>

  <!-- Contenedor principal -->
  <div class="relative flex h-[calc(100vh-6rem)]">
    <!-- Sidebar -->
    <aside
      id="sidebar"
      class="
        absolute inset-y-0 left-0 z-20
        transform transition-transform duration-300 ease-in-out
        w-64 p-6 bg-primary dark:bg-dark text-white overflow-auto
        md:relative
        md:transform-none
        md:transition-all md:duration-300 md:ease-in-out
        md:w-64 md:p-6
      "
    >
      <div class="flex justify-end mb-4">
        <button
          id="btn-sidebar-close"
          class="p-2 text-white hover:text-accent focus:outline-none transition"
        >
          <i class="fas fa-chevron-left text-xl"></i>
        </button>
      </div>
      <?php
        // session.php ya arrancó la sesión y validó usuario
        $nombre = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : 'Usuario';
      ?>
      <h2 class="text-xl font-heading mb-4 px-3">
        Bienvenido, <?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?>!
      </h2>
      <!-- ▼ CREAR ÍTEM ▼ -->
      <div class="mb-4 px-3">
        <select
          id="create-item"
          class="w-full bg-card dark:bg-dark text-text-dark dark:text-text-light placeholder:text-gray-500 dark:placeholder:text-gray-400 rounded p-2 focus:outline-none"
        >
          <option value="" disabled selected>Crear…</option>
          <option value="evento">Evento</option>
          <option value="tarea">Tarea</option>
          <option value="recordatorio">Recordatorio</option>
        </select>
      </div>
      <span
        id="help-create"
        class="block mt-1 mb-4 px-3 text-sm text-accent dark:text-text-light cursor-pointer hover:underline"
      >
        ¿No sabes cuál elegir?
      </span>
      <!-- ▲ FIN CREAR ÍTEM ▲ -->
      <nav class="space-y-3 mb-6">
        <?php
          $items = ['Mes','Semana','Día','Agenda'];
          foreach($items as $item) {
            echo "<a href='#' class='nav-link block px-3 py-2 rounded text-white font-normal transition-colors duration-200 ease-in-out'>$item</a>";          }
        ?>
      </nav>

      <!-- ──────────────── FILTROS ──────────────── -->
      <div class="px-3 space-y-2">
        <label class="flex items-center space-x-2">
          <input
            type="checkbox"
            id="filter-all"
            checked
            class="form-checkbox checked:bg-accent checked:border-accent focus:ring-accent transition-colors duration-200 ease-in-out"
          />
          <span class="text-white dark:text-text-light">Mostrar todos</span>
        </label>
        <label class="flex items-center space-x-2">
          <input
            type="checkbox"
            id="filter-evento"
            checked
            class="form-checkbox checked:bg-accent checked:border-accent focus:ring-accent transition-colors duration-200 ease-in-out"
          />
          <span class="text-white dark:text-text-light">Eventos</span>
        </label>
        <label class="flex items-center space-x-2">
          <input
            type="checkbox"
            id="filter-tarea"
            checked
            class="form-checkbox checked:bg-accent checked:border-accent focus:ring-accent transition-colors duration-200 ease-in-out"
          />
          <span class="text-white dark:text-text-light">Tareas</span>
        </label>
        <label class="flex items-center space-x-2">
          <input
            type="checkbox"
            id="filter-recordatorio"
            checked
            class="form-checkbox checked:bg-accent checked:border-accent focus:ring-accent transition-colors duration-200 ease-in-out"
          />
          <span class="text-white dark:text-text-light">Recordatorios</span>
        </label>
      </div>
    </aside>

    <!-- Main -->
    <main
      id="main-content"
      class="flex-1 p-6 overflow-auto bg-secondary dark:bg-dark transition-all duration-300 ease-in-out"
    >
      <div id="calendar"></div>
      <div id="react-root"></div>
    </main>
  </div>

  <!-- FullCalendar JS (antes de inicializarlo) -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/es.global.min.js"></script> -->

  <!-- Tus scripts de inicialización -->
  <script src="js/fullcalendar-init.js"></script>
  <script src="js/dark_mode.js"></script>
  <script src="js/dashboard-scripts.js"></script>

  <!-- 1) Cargamos edit-modals.jsx para que defina globalmente los componentes de edición -->
  <script
    type="text/babel"
    data-presets="react"
    src="js/edit-modals.jsx"
  ></script>

  <!-- 2) Cargamos react-modals.jsx, que usa EditEventModal, EditTaskModal y EditReminderModal -->
  <script
    type="text/babel"
    data-presets="react"
    src="js/react-modals.jsx"
  ></script>
</body>
</html>