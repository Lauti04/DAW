<?php
// frontend/partials/header_dashboard.php
// Asegúrate de que session_start() ya se haya llamado antes de incluir este archivo
?>
<header class="sticky top-0 z-50 w-full bg-secondary dark:bg-dark border-b border-gray-200 dark:border-gray-700">
  <div class="w-full px-4 sm:px-6 lg:px-8 h-24 flex items-center justify-between">
    <!-- Toggle sidebar (visible solo en mobile, oculto en desktop) -->
    <button
      id="btn-sidebar-toggle"
      class="p-2 text-text-dark dark:text-text-light focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-accent hover:bg-accent rounded transition md:hidden"
    >
      <i class="fas fa-bars text-2xl"></i>
    </button>

    <!-- Logo -->
    <a href="dashboard.php" class="flex-shrink-0">
      <img
        id="logo-light"
        src="../assets/img/logos/logo2.png"
        alt="EventFlow Logo Light"
        class="block dark:hidden w-[140px] h-[140px] object-contain"
      />
      <img
        id="logo-dark"
        src="../assets/img/logos/logo2_dark.png"
        alt="EventFlow Logo Dark"
        class="hidden dark:block w-[140px] h-[140px] object-contain"
      />
    </a>

    <!-- Acciones -->
    <div class="flex items-center space-x-4">
      <!-- Saludo (oculto en pantallas muy pequeñas) -->
      <?php if (isset($_SESSION['user_name'])): ?>
      <span class="hidden sm:inline text-text-dark dark:text-text-light">
        Hola, <?= htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8') ?>
      </span>
      <?php endif; ?>

      <!-- Notificaciones -->
      <button
        id="notifications"
        class="p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-accent text-text-dark dark:text-text-light hover:bg-accent transition"
      >
        <i class="fas fa-bell text-xl"></i>
      </button>

      <!-- Theme toggle -->
      <button
        id="btn-theme-toggle"
        class="p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-accent text-text-dark dark:text-text-light hover:bg-accent transition"
      >
        <i id="theme-icon" class="fas fa-moon text-xl"></i>
      </button>

      <!-- Perfil con dropdown -->
      <div class="relative">
        <button
          id="btn-profile"
          class="w-10 h-10 flex items-center justify-center rounded-full bg-primary dark:bg-dark text-white focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-accent hover:bg-accent transition"
        >
          <i class="fas fa-user text-xl"></i>
        </button>
        <!-- Menú desplegable -->
        <div
          id="profile-menu"
          class="hidden absolute right-0 mt-2 w-40 bg-card dark:bg-dark rounded-lg shadow-lg overflow-hidden z-50
                border border-secondary dark:border-fc-border-color
                divide-y divide-secondary dark:divide-fc-border-color"
        >
          <?php if (isset($_SESSION['user_name'])): ?>
          <div
            class="px-4 py-2 text-sm text-text-dark dark:text-text-light
                  bg-secondary dark:bg-dark
                  hover:bg-accent hover:text-white dark:hover:bg-accent dark:hover:text-white transition"
          >
            <?= htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8') ?>
          </div>
          <?php endif; ?>
          <a
            href="../backend/auth/logout.php"
            class="block px-4 py-2 text-sm text-text-dark dark:text-text-light
                  bg-secondary dark:bg-dark
                  hover:bg-accent dark:hover:bg-accent transition"
          >
            Cerrar sesión
          </a>
        </div>
      </div>
    </div>
  </div>
</header>