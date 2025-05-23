<!DOCTYPE html>
<html lang="es" class="scroll-smooth scroll-pt-24">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EventFlow – Home</title>
  <link href="../assets/css/tailwind.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="…" crossorigin="anonymous" />
</head>
<body class="bg-secondary dark:bg-dark font-body text-text-dark dark:text-text-light scroll-smooth">

  <?php include __DIR__ . '/partials/header.php'; ?>

  <!-- Hero Banner -->
  <section
    id="hero"
    class="
      pt-24        /* empuja el contenido 6rem abajo para librar el header */
      sm:pt-0      /* a partir de 640px, quita ese padding */
      h-auto       /* en móvil el height se ajusta al contenido */
      sm:h-screen  /* en sm+ (≥640px) ocupa pantalla completa */
      w-full
      bg-secondary dark:bg-dark
      text-text-dark dark:text-text-light
      flex items-center
    "
  >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
      <!-- Texto principal + CTA -->
      <div class="space-y-6 text-center md:text-left">
        <h1 class="text-5xl md:text-6xl font-heading leading-tight transition-colors duration-300 hover:text-accent">
          Organiza <span class="text-accent">eventos</span> y <span class="text-accent">tareas</span> en un solo lugar
        </h1>
        <p class="text-lg md:text-xl text-text-dark/80 dark:text-text-light/80 max-w-2xl">
          Descubre cómo EventFlow unifica tu calendario, gestor de tareas y recordatorios en un dashboard intuitivo. Ahorra tiempo y mejora tu productividad.
        </p>
        <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-4">
          <a href="register_view.php"
            class="btn-primary w-full sm:w-auto transform hover:scale-105 transition duration-300">
            Regístrate gratis
          </a>
          <a href="demo.php"
            class="btn-tertiary w-full sm:w-auto transform hover:scale-105 transition duration-300">
            Prueba el demo
          </a>
        </div>
      </div>
      <!-- Mockup adaptativa al tema -->
      <div class="flex justify-center">
        <img
          id="banner-light"
          src="../assets/img/mockup_banner1_light.png"
          alt="Vista clara de EventFlow"
          class="shadow-2xl rounded-2xl dark:hidden max-w-md w-full transform hover:scale-105 transition duration-300"
        />
        <img
          id="banner-dark"
          src="../assets/img/mockup_banner1_dark.png"
          alt="Vista oscura de EventFlow"
          class="hidden dark:block shadow-[0_25px_50px_-12px_rgba(255,255,255,0.25)] rounded-2xl max-w-md w-full transform hover:scale-105 transition duration-300"
        />
      </div>
    </div>
  </section>

  <!-- Features Banner -->
  <section
    id="features"
    class="mt-8 sm:mt-0 bg-secondary dark:bg-dark text-text-dark dark:text-text-light py-16"
  >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Título -->
      <h2 class="text-3xl md:text-4xl font-heading text-center mb-12">
        Todo lo que necesitas, en un solo lugar
      </h2>
      <!-- Cards de características -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Calendario integrado -->
        <div
          class="
            group
            bg-card dark:bg-dark
            p-6 rounded-2xl shadow-lg
            text-center space-y-4
            transform
            transition-transform
            duration-150 ease-out
            hover:scale-105 hover:shadow-2xl
          ">
          <div
            class="flex items-center justify-center w-12 h-12 mx-auto bg-primary rounded-full text-white
                  transition-colors duration-300 group-hover:bg-accent"
          >
            <!-- Ícono de calendario -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
          </div>
          <h3 class="text-xl font-heading transition-colors duration-300 group-hover:text-accent">
            Calendario integrado
          </h3>
          <p class="text-text-dark/80 dark:text-text-light/80">
            Consulta todas tus citas y fechas clave en una única vista. Cambia entre mes, semana o día y reorganiza con drag & drop.
          </p>
        </div>

        <!-- Gestión de tareas vinculadas -->
        <div
          class="group bg-card dark:bg-secondary p-6 rounded-2xl shadow-lg text-center space-y-4
                transform transition-all duration-300 hover:scale-105 hover:shadow-2xl"
        >
          <div
            class="flex items-center justify-center w-12 h-12 mx-auto bg-primary rounded-full text-white
                  transition-colors duration-300 group-hover:bg-accent"
          >
            <!-- Ícono de tareas -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2m-2-2h-4m4 0v2m-4-2v2M9 12h6m-6 4h6" />
            </svg>
          </div>
          <h3 class="text-xl font-heading transition-colors duration-300 group-hover:text-accent">
            Tareas vinculadas
          </h3>
          <p class="text-text-dark/80 dark:text-text-light/80">
            Crea y prioriza tareas directamente desde tus eventos. Añade fechas de entrega, estados y notificaciones para no perder ningún detalle.
          </p>
        </div>

        <!-- Notificaciones personalizables -->
        <div
          class="group bg-card dark:bg-secondary p-6 rounded-2xl shadow-lg text-center space-y-4
                transform transition-all duration-300 hover:scale-105 hover:shadow-2xl"
        >
          <div
            class="flex items-center justify-center w-12 h-12 mx-auto bg-primary rounded-full text-white
                  transition-colors duration-300 group-hover:bg-accent"
          >
            <!-- Ícono de campana -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
          </div>
          <h3 class="text-xl font-heading transition-colors duration-300 group-hover:text-accent">
            Notificaciones
          </h3>
          <p class="text-text-dark/80 dark:text-text-light/80">
            Recibe alertas por email o push en los horarios que tú elijas. Personaliza frecuencias y métodos para mantenerte siempre al día.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- How It Works – Video Tour + Highlights + Carousel -->
  <section id="how" class="py-20 bg-secondary dark:bg-dark text-text-dark dark:text-text-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
      <!-- Video + Bullets -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
        <!-- Vídeo embed -->
        <div class="aspect-video w-full rounded-2xl overflow-hidden shadow-lg 
                    transform transition-transform duration-500 ease-in-out
                    hover:scale-105 hover:shadow-2xl">
          <!-- Reemplaza SRC con tu video o demo guiado -->
          <iframe src="https://www.youtube.com/embed/VIDEO_ID?rel=0" 
                  title="Tour de EventFlow" 
                  class="w-full h-full" 
                  frameborder="0" 
                  allow="autoplay; fullscreen" 
                  allowfullscreen>
          </iframe>
        </div>
        <!-- Puntos clave -->
        <div class="space-y-6">
          <h2 class="text-3xl font-heading text-primary dark:text-accent
                    transform translate-y-4
                    animate-[fade-in_0.8s_ease-out_forwards]">
            Mira EventFlow en acción
          </h2>
          <ul class="space-y-4">
            <li class="group flex items-start space-x-4
                      transform transition-all duration-300 ease-in-out
                      hover:translate-x-2">
              <div class="mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="w-6 h-6 text-primary group-hover:text-accent transition-colors duration-300" 
                    viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 5h18M3 19h18M3 12h18" />
                </svg>
              </div>
              <p class="text-lg text-text-dark/80 dark:text-text-light/80">
                Crea eventos y tareas en un solo flujo, sin cambiar de pantalla.  
              </p>
            </li>
            <li class="group flex items-start space-x-4
                      transform transition-all duration-300 ease-in-out
                      hover:translate-x-2">
              <div class="mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="w-6 h-6 text-primary group-hover:text-accent transition-colors duration-300" 
                    viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 13l4 4L19 7" />
                </svg>
              </div>
              <p class="text-lg text-text-dark/80 dark:text-text-light/80">
                Arrastra y suelta tareas directamente dentro de tu calendario para máxima productividad.  
              </p>
            </li>
            <li class="group flex items-start space-x-4
                      transform transition-all duration-300 ease-in-out
                      hover:translate-x-2">
              <div class="mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="w-6 h-6 text-primary group-hover:text-accent transition-colors duration-300" 
                    viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
              </div>
              <p class="text-lg text-text-dark/80 dark:text-text-light/80">
                Configura recordatorios push o email con un solo clic para no perder nada.  
              </p>
            </li>
          </ul>
          <a href="register_view.php" 
            class="btn-primary mt-4 inline-block transform transition 
                    duration-300 ease-in-out hover:scale-105 hover:shadow-lg">
            Pruébalo gratis
          </a>
        </div>
      </div>

      <!-- Carrusel / Galería de capturas -->
      <div class="space-y-6">
        <h3 class="text-2xl font-heading text-center
                  opacity-0 transform translate-y-4
                  animate-[fade-in_0.8s_ease-out_forwards]">
          Vistas rápidas de la app
        </h3>
        <div class="relative px-4">
          <!-- Flechas -->
          <button id="prev-slide"
                  class="absolute top-1/2 left-0 -translate-y-1/2 p-2 bg-primary text-white rounded-full shadow-lg z-20 hover:bg-accent md:hidden w-10 aspect-square flex items-center justify-center">
            &larr;
          </button>
          <div id="carousel"
              class="flex space-x-6 overflow-x-auto snap-x snap-mandatory
                      md:grid md:grid-cols-3 md:gap-6 md:overflow-visible md:space-x-0
                      scrollbar-thin scrollbar-thumb-primary scrollbar-track-secondary">
            <div class="snap-start md:snap-none flex-shrink-0 md:flex-grow transform transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-2xl">
              <img src="../assets/img/slider/dashboard.png"
                  alt="Dashboard EventFlow"
                  class="w-60 md:w-full rounded-lg"/>
            </div>
            <div class="snap-start md:snap-none flex-shrink-0 md:flex-grow transform transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-2xl">
              <img src="../assets/img/slider/calendar.png"
                  alt="Calendario mensual"
                  class="w-60 md:w-full rounded-lg"/>
            </div>
            <div class="snap-start md:snap-none flex-shrink-0 md:flex-grow transform transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-2xl">
              <img src="../assets/img/slider/tasks.png"
                  alt="Gestión de tareas"
                  class="w-60 md:w-full rounded-lg"/>
            </div>
          </div>
          <button id="next-slide"
                  class="absolute top-1/2 right-0 -translate-y-1/2 p-2 bg-primary text-white rounded-full shadow-lg z-20 hover:bg-accent md:hidden w-10 aspect-square flex items-center justify-center">
            &rarr;
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- TESTIMONIOS -->
  <section id="testimonials" class="py-20 bg-secondary dark:bg-dark text-text-dark dark:text-text-light">
    <div class="max-w-6xl mx-auto px-4 space-y-8">
      <!-- Título de sección -->
      <h2 class="text-3xl md:text-4xl font-heading text-center text-primary dark:text-accent
                opacity-0 animate-fade-in">
        Lo que dicen nuestros usuarios
      </h2>

      <!-- Grid de testimonios -->
      <div class="grid gap-8 md:grid-cols-3 lg:grid-cols-2">
        <?php
          $testimonials = [
            ['women/44.jpg', 'Helene Engels',      'CFO en ExampleCorp',    '“EventFlow ha transformado mi manera de trabajar.”'],
            ['men/36.jpg',   'Leslie Livingston',  'Director Creativo',      '“La unión de calendario y tareas es perfecta.”'],
            ['men/54.jpg',   'Carlos Pérez',       'Desarrollador Web',      '“La interfaz es tan intuitiva que me ahorra tiempo cada día.”'],
            ['women/68.jpg', 'Mariana Fernández',  'Project Manager',        '“Desde que uso EventFlow, nunca se me escapa una fecha límite.”']
          ];
          foreach($testimonials as $index => $t) {
            echo "
              <div class=\"group bg-card p-6 rounded-2xl shadow-md transform transition-all duration-300
                            hover:shadow-lg hover:scale-105
                            opacity-0 animate-fade-in\">
                <p class=\"italic mb-6 text-text-dark/80 dark:text-text-light/80\">{$t[3]}</p>
                <div class=\"flex items-center space-x-4\">
                  <img src=\"https://randomuser.me/api/portraits/{$t[0]}\" alt=\"{$t[1]}\"
                      class=\"w-12 h-12 rounded-full border-2 border-primary
                              transform transition-transform duration-300
                              group-hover:scale-110\"/>
                  <div>
                    <p class=\"font-semibold text-primary dark:text-accent\">{$t[1]}</p>
                    <p class=\"text-sm text-text-dark/70 dark:text-text-light/70\">{$t[2]}</p>
                  </div>
                </div>
              </div>
            ";
          }
        ?>
      </div>
    </div>
  </section>

  <!-- PLANES Y PRECIOS – Versión animada -->
  <section id="pricing" class="py-20 bg-secondary dark:bg-dark text-text-dark dark:text-text-light">
    <div class="max-w-6xl mx-auto px-4 space-y-8">
      <!-- Título de sección -->
      <div class="text-center space-y-2 opacity-0 animate-fade-in">
        <h2 class="text-3xl md:text-4xl font-heading text-primary dark:text-accent">
          Elige el plan que se adapte a ti
        </h2>
        <p class="text-text-dark/70 dark:text-text-light/70">
          Tres opciones flexibles: desde uso personal hasta grandes equipos.
        </p>
      </div>

      <!-- Grid de planes -->
      <div class="grid gap-8 sm:grid-cols-1 md:grid-cols-3">
        <!-- Plan Gratis -->
        <div class="group flex flex-col h-full bg-card p-6 rounded-2xl shadow-md
                    opacity-0 animate-fade-in
                    transform transition-all duration-300 ease-in-out
                    hover:scale-105 hover:shadow-lg">
          <div>
            <h3 class="text-xl font-heading mb-2 group-hover:text-accent transition-colors duration-300">
              Gratis
            </h3>
            <p class="text-4xl font-heading text-primary group-hover:text-accent transition-colors duration-300">
              0€<span class="text-base font-medium text-text-dark/80 dark:text-text-light/80">/mes</span>
            </p>
            <p class="mt-2 text-text-dark/80 dark:text-text-light/80">
              Perfecto para empezar.
            </p>
          </div>
          <ul class="mt-6 space-y-4 flex-1">
            <li class="flex items-start space-x-2 group-hover:text-accent transition-colors duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 group-hover:text-accent transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7" />
              </svg>
              <span>Eventos ilimitados</span>
            </li>
            <li class="flex items-start space-x-2 group-hover:text-accent transition-colors duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 group-hover:text-accent transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7" />
              </svg>
              <span>Tareas básicas</span>
            </li>
            <li class="flex items-start space-x-2 group-hover:text-accent transition-colors duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 group-hover:text-accent transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7" />
              </svg>
              <span>Notificaciones estándar</span>
            </li>
            <li class="flex items-start space-x-2 group-hover:text-accent transition-colors duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 group-hover:text-accent transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7" />
              </svg>
              <span>Tablero de equipo simple</span>
            </li>
          </ul>
          <a href="register_view.php"
            class="btn-primary w-full mt-6 text-center
                    transform transition-transform duration-300 ease-in-out
                    hover:scale-105">
            Comenzar gratis
          </a>
        </div>

        <!-- Plan Pro -->
        <div class="group flex flex-col h-full bg-card p-6 rounded-2xl shadow-md
                    opacity-0 animate-fade-in
                    transform transition-all duration-300 ease-in-out
                    hover:scale-105 hover:shadow-lg">
          <div>
            <h3 class="text-xl font-heading text-primary mb-2 group-hover:text-accent transition-colors duration-300">
              Pro
            </h3>
            <p class="text-4xl font-heading text-primary group-hover:text-accent transition-colors duration-300">
              9,99€<span class="text-base font-medium text-text-dark/80 dark:text-text-light/80">/mes</span>
            </p>
            <p class="mt-2 text-text-dark/80 dark:text-text-light/80">
              Lo mejor para profesionales.
            </p>
          </div>
          <ul class="mt-6 space-y-4 flex-1">
            <li class="flex items-start space-x-2 group-hover:text-accent transition-colors duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 group-hover:text-accent transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7" />
              </svg>
              <span>Todo lo del plan Gratis</span>
            </li>
            <li class="flex items-start space-x-2 group-hover:text-accent transition-colors duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 group-hover:text-accent transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7" />
              </svg>
              <span>Sincronización Google & Outlook</span>
            </li>
            <li class="flex items-start space-x-2 group-hover:text-accent transition-colors duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 group-hover:text-accent transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7" />
              </svg>
              <span>Informes y estadísticas</span>
            </li>
            <li class="flex items-start space-x-2 group-hover:text-accent transition-colors duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 group-hover:text-accent transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7" />
              </svg>
              <span>Integraciones API</span>
            </li>
          </ul>
          <a href="register_view.php"
            class="btn-primary w-full mt-6 text-center
                    transform transition-transform duration-300 ease-in-out
                    hover:scale-105">
            Actualizar a Pro
          </a>
        </div>

        <!-- Plan Empresa -->
        <div class="group flex flex-col h-full bg-card p-6 rounded-2xl shadow-md
                    opacity-0 animate-fade-in
                    transform transition-all duration-300 ease-in-out
                    hover:scale-105 hover:shadow-lg">
          <div>
            <h3 class="text-xl font-heading text-primary mb-2 group-hover:text-accent transition-colors duration-300">
              Empresa
            </h3>
            <p class="text-4xl font-heading text-primary group-hover:text-accent transition-colors duration-300">
              29,99€<span class="text-base font-medium text-text-dark/80 dark:text-text-light/80">/mes</span>
            </p>
            <p class="mt-2 text-text-dark/80 dark:text-text-light/80">
              Para equipos grandes.
            </p>
          </div>
          <ul class="mt-6 space-y-4 flex-1">
            <li class="flex items-start space-x-2 group-hover:text-accent transition-colors duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 group-hover:text-accent transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7" />
              </svg>
              <span>Todo lo del plan Pro</span>
            </li>
            <li class="flex items-start space-x-2 group-hover:text-accent transition-colors duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 group-hover:text-accent transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7" />
              </svg>
              <span>Gestión de usuarios y permisos</span>
            </li>
            <li class="flex items-start space-x-2 group-hover:text-accent transition-colors duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 group-hover:text-accent transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7" />
              </svg>
              <span>Soporte prioritario 24/7</span>
            </li>
            <li class="flex items-start space-x-2 group-hover:text-accent transition-colors duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 group-hover:text-accent transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7" />
              </svg>
              <span>Onboarding personalizado</span>
            </li>
          </ul>
          <a href="register_view.php"
            class="btn-primary w-full mt-6 text-center
                    transform transition-transform duration-300 ease-in-out
                    hover:scale-105">
            Actualizar a Empresa
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTACTO & SOPORTE – Versión animada -->
  <section id="contact" class="py-20 bg-secondary dark:bg-dark text-text-dark dark:text-text-light">
    <div class="max-w-5xl mx-auto px-4 space-y-8">
      <!-- Título -->
      <div class="text-center opacity-0 animate-fade-in">
        <h2 class="text-3xl md:text-4xl font-heading text-primary dark:text-accent">
          ¿Tienes dudas? Contáctanos
        </h2>
        <p class="mt-2 text-text-dark/70 dark:text-text-light/70">
          Nuestro equipo de soporte está listo para ayudarte.
        </p>
      </div>

      <!-- Contenido -->
      <div class="grid gap-12 md:grid-cols-2">
        <!-- Formulario de contacto -->
        <form id="contact-form"
              class="bg-card p-8 rounded-2xl shadow-md space-y-6
                    opacity-0 animate-fade-in
                    transform transition-all duration-300 ease-in-out
                    hover:shadow-lg">
          <div>
            <label for="name" class="block text-sm font-medium mb-1">Nombre</label>
            <input type="text" id="name" name="name" required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg
                          focus:outline-none focus:ring-2 focus:ring-primary
                          transition-shadow duration-300
                          hover:shadow-inner" />
          </div>
          <div>
            <label for="email" class="block text-sm font-medium mb-1">Email</label>
            <input type="email" id="email" name="email" required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg
                          focus:outline-none focus:ring-2 focus:ring-primary
                          transition-shadow duration-300
                          hover:shadow-inner" />
          </div>
          <div>
            <label for="message" class="block text-sm font-medium mb-1">Mensaje</label>
            <textarea id="message" name="message" rows="4" required
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg
                            focus:outline-none focus:ring-2 focus:ring-primary
                            transition-shadow duration-300
                            hover:shadow-inner"></textarea>
          </div>
          <button type="submit"
                  class="btn-primary w-full py-3 mt-4
                        transform transition-transform duration-300 ease-in-out
                        hover:scale-105 hover:shadow-lg cursor-pointer">
            Enviar mensaje
          </button>
        </form>

        <!-- Información de soporte + Redes Sociales -->
        <div class="bg-card p-8 rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300">
          <div class="space-y-6">
            <!-- Email -->
            <div class="flex items-center space-x-4">
              <svg xmlns="http://www.w3.org/2000/svg"
                  class="h-6 w-6 text-primary"
                  fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8
                        M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5
                        a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
              <p class="font-semibold">soporte@eventflow.com</p>
            </div>
            <!-- Teléfono -->
            <div class="flex items-center space-x-4">
              <svg xmlns="http://www.w3.org/2000/svg"
                  class="h-6 w-6 text-primary"
                  fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684
                        l1.499 4.497a1 1 0 01-.21.973l-2.257 2.257
                        a11.042 11.042 0 005.516 5.516l2.257-2.257
                        a1 1 0 01.973-.21l4.497 1.499a1 1 0 01.684.949
                        V19a2 2 0 01-2 2h-1C9.178 21 3 14.822 3 7V5z" />
              </svg>
              <p class="font-semibold">+34 912 345 678</p>
            </div>
            <!-- Chat en vivo -->
            <div class="flex items-center space-x-4">
              <svg xmlns="http://www.w3.org/2000/svg"
                  class="h-6 w-6 text-primary"
                  fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M8 10h.01M12 10h.01M16 10h.01
                        M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-5-.5
                        L3 20l1.5-4.5A8.962 8.962 0 013 12
                        c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
              </svg>
              <div>
                <p class="font-semibold">Chat en vivo</p>
                <p class="text-sm text-text-dark/80 dark:text-text-light/80">09:00–18:00 CET</p>
              </div>
            </div>
          </div>

          <!-- Redes Sociales debajo de la info -->
          <div class="mt-8 border-t pt-6 space-y-4">
            <!-- LinkedIn -->
            <a href="https://linkedin.com/company/eventflow-app" target="_blank"
              class="flex items-center space-x-3 text-primary hover:text-accent hover:scale-110 transition-colors transition-transform">
              <svg xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5
                        1.12 1 2.5 1 4.98 2.12 4.98 3.5zM.5 8h4V24h-4V8zm7.5 0h3.6
                        v2.2h.1c.5-.9 1.7-1.8 3.5-1.8 3.8 0 4.5 2.5 4.5 5.8V24h-4
                        v-7.9c0-1.9 0-4.3-2.6-4.3-2.6 0-3 2-3 4.1V24h-4V8z"/>
              </svg>
              <span class="font-semibold">eventflow-app</span>
            </a>
            <!-- X -->
            <a href="https://x.com/EventFlowHQ" target="_blank"
              class="flex items-center space-x-3 text-primary hover:text-accent hover:scale-110 transition-colors transition-transform">
              <svg xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5" viewBox="0 0 50 50" fill="currentColor">
                <path d="M 5.9199219 6 L 20.582031 27.375 L 6.2304688 44
                        L 9.4101562 44 L 21.986328 29.421875 L 31.986328 44
                        L 44 44 L 28.681641 21.669922 L 42.199219 6 L 39.029297 6
                        L 27.275391 19.617188 L 17.933594 6 L 5.9199219 6 z
                        M 9.7167969 8 L 16.880859 8 L 40.203125 42 L 33.039062 42
                        L 9.7167969 8 z"/>
              </svg>
              <span class="font-semibold">@EventFlowHQ</span>
            </a>
            <!-- YouTube -->
            <a href="https://youtube.com/EventFlowOfficial" target="_blank"
              class="flex items-center space-x-3 text-primary hover:text-accent hover:scale-110 transition-colors transition-transform">
              <svg xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5" viewBox="0 0 50 50" fill="currentColor">
                <path d="M 44.898438 14.5 C 44.5 12.300781 42.601563 10.699219
                        40.398438 10.199219 C 37.101563 9.5 31 9 24.398438 9
                        C 17.800781 9 11.601563 9.5 8.300781 10.199219
                        C 6.101563 10.699219 4.199219 12.199219 3.800781 14.5
                        C 3.398438 17 3 20.5 3 25 C 3 29.5 3.398438 33 3.898438 35.5
                        C 4.300781 37.699219 6.199219 39.300781 8.398438 39.800781
                        C 11.898438 40.5 17.898438 41 24.5 41 C 31.101563 41
                        37.101563 40.5 40.601563 39.800781 C 42.800781 39.300781
                        44.699219 37.800781 45.101563 35.5 C 45.5 33 46 29.398438
                        46.101563 25 C 45.898438 20.5 45.398438 17 44.898438 14.5 Z
                        M 19 32 L 19 18 L 31.199219 25 Z"/>
              </svg>
              <span class="font-semibold">EventFlow Official</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA FINAL – Versión animada sobre fondo accent -->
  <section id="cta-final"
          class="relative py-16 bg-accent dark:bg-accent text-white overflow-hidden">

    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center space-y-6">
      <!-- Título con efecto fade-up -->
      <h2 class="animate-fade-up text-3xl md:text-4xl font-heading">
        ¿Listo para llevar tu productividad al máximo?
      </h2>

      <!-- Subtítulo con delay -->
      <p class="animate-fade-up delay-150 text-lg max-w-2xl mx-auto text-white/80">
        Regístrate gratis y comienza a gestionar eventos y tareas de forma integrada.
      </p>

      <!-- Botón con halo y bounce -->
      <a href="register_view.php"
        class="relative inline-flex items-center justify-center
                btn-primary px-8 py-4 mt-4
                transform transition-transform duration-300 ease-in-out
                hover:scale-105 hover:shadow-lg">
        Regístrate ahora

        <!-- Halo translúcido al hover -->
        <span class="absolute inset-0 rounded-lg bg-white opacity-0
                    transition-opacity duration-500 hover:opacity-10">
        </span>

        <!-- Icono rebotando -->
        <svg xmlns="http://www.w3.org/2000/svg"
            class="ml-2 h-6 w-6 text-white animate-bounce"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 8l4 4m0 0l-4 4m4-4H3"/>
        </svg>
      </a>
    </div>
  </section>

    <!-- Back to Top Button -->
  <button
    id="back-to-top"
    aria-label="Volver arriba"
    class="
      fixed bottom-8 right-8 z-50
      p-3 rounded-full shadow-lg
      bg-primary text-white
      transform transition-transform duration-300 ease-in-out
      hover:scale-105 hover:shadow-lg
      hover:bg-accent
      w-12            
      aspect-square  
      flex items-center justify-center cursor-pointer
    ">
    <i class="fas fa-arrow-up"></i>
  </button>

  <?php include __DIR__ . '/partials/footer.php'; ?>


  <script src="js/dark_mode.js"></script>
  <!-- Incluye SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    (function() {
      const form = document.getElementById('contact-form');

      form.addEventListener('submit', function(e) {
        e.preventDefault(); // evita cualquier envío real

        const isDark = document.documentElement.classList.contains('dark');

        Swal.fire({
          title: '¡Mensaje enviado!',
          text: 'Gracias por contactarnos. Te responderemos pronto.',
          icon: 'success',

          // estilos dinámicos según tema
          background: isDark
            ? 'var(--dark)'
            : 'var(--secondary)',
          color: isDark
            ? 'var(--text-light)'
            : 'var(--text-dark)',

          confirmButtonText: 'Aceptar',
          customClass: {
            confirmButton: 'btn-primary'
          },
          buttonsStyling: false,
          allowOutsideClick: true
        }).then(() => {
          form.reset(); // limpia los campos
        });
      });
    })();

    // Back to Top button
    const backToTop = document.getElementById('back-to-top');
    const hero       = document.getElementById('hero');
    // Altura tras la cual aparece el botón
    const threshold  = hero ? hero.offsetHeight : 300;

    window.addEventListener('scroll', () => {
      if (window.scrollY > threshold) {
        backToTop.classList.remove('opacity-0', 'pointer-events-none');
        backToTop.classList.add('opacity-100');
      } else {
        backToTop.classList.remove('opacity-100');
        backToTop.classList.add('opacity-0', 'pointer-events-none');
      }
    });

    backToTop.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    document.addEventListener('DOMContentLoaded', () => {
      const sections = document.querySelectorAll('section[id]');
      const navLinks = document.querySelectorAll('.nav-link');

      const observerOptions = {
        root: null,
        threshold: 0.5 // se considera visible cuando al menos el 50% está en pantalla
      };

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          const id = entry.target.id;
          const link = document.querySelector(`.nav-link[href="#${id}"]`);

          if (entry.isIntersecting) {
            // quitamos active de todos
            navLinks.forEach(a => a.classList.remove('active'));
            // marcamos el actual
            if (link) link.classList.add('active');
          }
        });
      }, observerOptions);

      sections.forEach(sec => observer.observe(sec));
    });

    // document.getElementById('btn-mobile-menu').addEventListener('click', () => {
    //   const menu = document.getElementById('mobile-menu');
    //   menu.classList.toggle('max-h-0');
    //   menu.classList.toggle('max-h-[500px]');  // o la altura que necesites
    //   menu.classList.toggle('opacity-0');
    //   menu.classList.toggle('opacity-100');
    // });
  </script>
</body>
</html>