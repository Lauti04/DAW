<header class="sticky top-0 z-50 bg-white dark:bg-[var(--dark)] border-b border-gray-200 dark:border-gray-700">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-24 flex items-center justify-between">
    <!-- Logo -->
    <a href="home.php" class="flex-shrink-0">
      <img id="logo-light"
           src="../assets/img/logos/logo2.png"
           alt="EventFlow Logo Light"
           class="block dark:hidden
                  w-[80px] sm:w-[100px] md:w-[120px] lg:w-[140px]
                  h-auto object-contain">
      <img id="logo-dark"
           src="../assets/img/logos/logo2_dark.png"
           alt="EventFlow Logo Dark"
           class="hidden dark:block
                  w-[80px] sm:w-[100px] md:w-[120px] lg:w-[140px]
                  h-auto object-contain"">
    </a>

    <!-- Botón de cambio de tema -->
    <button id="btn-theme-toggle"
            class="p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-accent">
      <i id="theme-icon" class="fas fa-moon text-xl text-text-dark dark:text-text-light"></i>
    </button>
  </div>

</header>

<script src="js/dark_mode.js"></script>