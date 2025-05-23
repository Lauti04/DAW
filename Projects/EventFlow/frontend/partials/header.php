<?php
  // header.php
  $links = [
    ['Inicio',        'hero'],        // Banner principal
    ['Características','features'],    // Features
    ['Uso',           'how'],         // Cómo funciona
    ['Testimonios',   'testimonials'],// Testimonials
    ['Precios',       'pricing'],     // Planes y precios
    ['Contacto',      'contact'],     // Contacto & soporte
    ['Regístrate',    'cta-final'],   // CTA final
  ];
?>

<header class="sticky top-0 z-50 bg-white dark:bg-white border-b border-gray-200 dark:border-gray-700 overflow-hidden">
  <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 h-24 flex items-center justify-between overflow-hidden">
    <!-- Logo -->
    <a href="home.php" class="flex-shrink-0">
      <img id="logo-light"
           src="../assets/img/logos/logo2.png"
           alt="EventFlow Logo"
           class="block dark:hidden
                  w-[80px] sm:w-[100px] md:w-[120px] lg:w-[140px]
                  h-auto object-contain">
      <img id="logo-dark"
           src="../assets/img/logos/logo2_dark.png"
           alt="EventFlow Logo Dark"
           class="hidden dark:block
                  w-[80px] sm:w-[100px] md:w-[120px] lg:w-[140px]
                  h-auto object-contain">
    </a>

    <!-- Nav desktop (>1090px) -->
    <nav class="hidden [@media(min-width:1090px)]:flex flex-1 justify-center space-x-8">
      <?php foreach($links as $l): ?>
        <a href="#<?= $l[1] ?>"
           class="nav-link relative group px-2 py-1
                  text-[clamp(0.875rem,1vw,1rem)]
                  text-text-dark dark:text-text-light
                  transition-transform duration-200 ease-in-out hover:scale-105">
          <?= $l[0] ?>
          <span class="absolute bottom-0 left-0 block h-0.5 w-0
                       transition-all duration-300 ease-in-out
                       bg-primary dark:bg-accent
                       group-hover:w-full"></span>
        </a>
      <?php endforeach; ?>
    </nav>

    <!-- Actions -->
    <div class="flex items-center space-x-4">
      <!-- Theme toggle -->
      <button id="btn-theme-toggle"
              class="p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-accent">
        <i id="theme-icon" class="fas fa-moon text-xl"></i>
      </button>

      <!-- Mobile menu button (<1090px) -->
      <button id="btn-mobile-menu"
              class="[@media(min-width:1090px)]:hidden p-2 rounded-md text-text-dark dark:text-text-light
                     focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-accent">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>

      <!-- CTA desktop (>1090px) -->
      <div class="hidden [@media(min-width:1090px)]:flex items-center space-x-4">
          <a href="register_view.php"
             class="btn-primary px-4 py-2 text-[clamp(0.875rem,1vw,1rem)]">
            Únete
          </a>
      </div>
    </div>
  </div>

  <!-- Menú mobile (<1090px) -->
  <div id="mobile-menu"
       class="overflow-hidden max-h-0 opacity-0 pointer-events-none
              bg-white dark:bg-[var(--dark)]
              border-t border-gray-200 dark:border-gray-700
              transition-[max-height,opacity] duration-300 ease-in-out
              [@media(min-width:1090px)]:hidden">
      <nav class="flex flex-col items-end px-4 pt-4 pb-4 space-y-2">
      <?php foreach($links as $l): ?>
        <a href="#<?= $l[1] ?>"
           class="nav-link relative group px-3 py-2
                  text-[clamp(0.875rem,1vw,1rem)]
                  text-text-dark dark:text-text-light rounded-md
                  transition-transform duration-200 ease-in-out hover:scale-105">
          <?= $l[0] ?>
          <span class="absolute bottom-0 left-0 block h-0.5 w-0
                       transition-all duration-300 ease-in-out
                       bg-primary dark:bg-accent
                       group-hover:w-full"></span>
        </a>
      <?php endforeach; ?>
      <div class="mt-4 text-right">
          <a href="register_view.php"
             class="btn-primary inline-block px-6 py-2 text-[clamp(0.875rem,1vw,1rem)]">
            Únete
          </a>
      </div>
    </nav>
  </div>

  <script src="../js/dark_mode.js"></script>
</header>