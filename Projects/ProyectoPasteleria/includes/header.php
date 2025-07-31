  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Header Pastelería - Dulce Encanto</title>
    <script src="../assets/js/theme.js"></script>
    <link rel="stylesheet" href="../assets/css/theme.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <!-- Enlace a estilos globales -->
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/header.css">
  </head>

  <body>
    <!-- Header con Navbar de Bootstrap -->
    <header>
      <!-- Top Bar: Información adicional y CTA -->
      <div class="top-bar">
        <div class="container d-flex justify-content-between align-items-center py-2">
          <div class="info">
            <small class="telefono">¡10% de descuento en tu primer pedido! &nbsp; Llama al: &nbsp;<a href="tel:+34608948329" class="tel">+34 608 94 83 29</a></small>
          </div>
          <div class="cta">
            <a href="../templates/productos.php" class="btn btn-accent boton-header">Ordena Ahora</a>
          </div>
        </div>
      </div>

      <!-- Navbar principal -->
      <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
          <!-- Logo -->
          <a class="navbar-brand" href="/ProyectoPasteleria/templates/home.php#inicio">
            <img class="logo" src="../assets/images/logo/Dulce_Encanto_Logo.png" alt="Logo Dulce Encanto">
          </a>
          <!-- Botón de menú para móvil -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- Enlaces de navegación -->
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
              <!-- Enlaces principales -->
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/ProyectoPasteleria/templates/home.php#inicio">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/ProyectoPasteleria/templates/home.php#personalizados">Personalizados</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/ProyectoPasteleria/templates/home.php#pedidos">Pedidos</a>
              </li>
              <!-- Dropdown con icono de flecha -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle custom-dropdown" href="#" id="navbarDropdown" role="button"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  Más Secciones <i class="fas fa-chevron-down"></i> <!-- Icono de flecha -->
                </a>
                <ul class="dropdown-menu custom-dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="/ProyectoPasteleria/templates/home.php#promocion">Promoción de Invierno</a></li>
                  <li><a class="dropdown-item" href="/ProyectoPasteleria/templates/home.php#sabores">Nuevos Sabores</a></li>
                  <li><a class="dropdown-item" href="/ProyectoPasteleria/templates/home.php#servicios">Servicios y Beneficios</a></li>
                  <li><a class="dropdown-item" href="/ProyectoPasteleria/templates/home.php#diferenciales">Lo que Nos Hace Únicos</a></li>
                  <li><a class="dropdown-item" href="/ProyectoPasteleria/templates/home.php#testimonios">Testimonios</a></li>
                </ul>
              </li>
              <!-- Enlaces a páginas externas -->
              <li class="nav-item">
                <a class="nav-link" href="../templates/productos.php">Productos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../templates/contacto.php">Contacto</a>
              </li>
            </ul>
            <!-- Botón de Modo Claro/Oscuro -->
            <div class="theme-toggle-wrapper">
              <input type="checkbox" id="theme-toggle" class="theme-toggle-checkbox">
              <label for="theme-toggle" class="theme-toggle-label">
                <span class="toggle-ball">
                  <i class="bi bi-sun-fill"></i>
                </span>
              </label>
            </div>
          </div>
        </div>
      </nav>


    </header>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../assets/js/script.js"></script>
    <!-- Script para el Modo Claro/Oscuro -->
    <script src="../assets/js/tema.js"></script>
  </body>

  </html>