<!-- Private Header (frontend/dashboard.html) -->
<header class="bg-white dark:bg-gray-900">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
    <!-- Logo -->
    <a href="dashboard.html">
      <img src="../assets/img/logos/logo2.png" alt="EventFlow" class="h-8 dark:hidden">
      <img src="../assets/img/logos/logo2_dark.png" alt="EventFlow" class="h-8 hidden dark:block">
    </a>
    <!-- Navegación interna -->
    <nav class="hidden md:flex space-x-8">
      <a href="dashboard.html" class="text-gray-900 dark:text-gray-200 hover:text-primary">Dashboard</a>
      <a href="tareas.html" class="text-gray-900 dark:text-gray-200 hover:text-primary">Tareas</a>
      <a href="calendario.html" class="text-gray-900 dark:text-gray-200 hover:text-primary">Calendario</a>
      <a href="notificaciones.html" class="text-gray-900 dark:text-gray-200 hover:text-primary">Notificaciones</a>
      <a href="perfil.html" class="text-gray-900 dark:text-gray-200 hover:text-primary">Perfil</a>
      <a href="soporte.html" class="text-gray-900 dark:text-gray-200 hover:text-primary">Soporte</a>
    </nav>
    <!-- Logout / perfil -->
    <div class="hidden md:flex items-center space-x-4">
      <a href="../backend/auth/logout.php"
         class="px-4 py-2 font-medium text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition">
        Cerrar sesión
      </a>
    </div>
    <!-- Menú móvil -->
    <div class="md:hidden">
      <button id="btn-mobile-menu-priv" class="text-gray-900 dark:text-gray-200 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>
  </div>
  <!-- Menú móvil interno -->
  <div id="mobile-menu-priv" class="hidden md:hidden bg-white dark:bg-gray-900">
    <nav class="px-4 pb-4 space-y-1">
      <a href="dashboard.html" class="block py-2 text-gray-900 dark:text-gray-200">Dashboard</a>
      <a href="tareas.html" class="block py-2 text-gray-900 dark:text-gray-200">Tareas</a>
      <a href="calendario.html" class="block py-2 text-gray-900 dark:text-gray-200">Calendario</a>
      <a href="notificaciones.html" class="block py-2 text-gray-900 dark:text-gray-200">Notificaciones</a>
      <a href="perfil.html" class="block py-2 text-gray-900 dark:text-gray-200">Perfil</a>
      <a href="../backend/auth/logout.php" class="block py-2 text-primary">Cerrar sesión</a>
    </nav>
  </div>
</header>