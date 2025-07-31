<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Footer Fusion</title>
  <script src="../assets/js/theme.js"></script>
  <link rel="stylesheet" href="../assets/css/theme.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    .logo {
      max-width: 100px;
      height: auto;
    }

    [data-theme="dark"] footer {
      background-color: var(--secondary-color) !important;
      color: var(--accent-color) !important;
    }
  </style>
</head>
<body>
<footer class="footer mt-5 py-4" style="background-color: var(--accent-color); color: var(--white);">
  <div class="container">
    <div class="row row-cols-1 row-cols-md-4">
      <!-- Logo y descripción -->
      <div class="col mb-3">
        <a href="#inicio" class="d-flex align-items-center mb-3 link-light text-decoration-none">
          <img src="../assets/images/logo/Dulce_Encanto_Logo.png" class="img-fluid logo" alt="Logo Dulce Encanto" />
        </a>
        <p>Disfruta de nuestros deliciosos pasteles y postres personalizados. ¡Hechos con amor para cada ocasión!</p>
      </div>

      <!-- Enlaces principales -->
      <div class="col mb-3">
        <h5>Enlaces</h5>
        <ul class="nav flex-column">
          <li class="nav-item"><a href="#inicio" class="nav-link p-0 text-light">Inicio</a></li>
          <li class="nav-item"><a href="#personalizados" class="nav-link p-0 text-light">Personalizados</a></li>
          <li class="nav-item"><a href="#pedidos" class="nav-link p-0 text-light">Pedidos</a></li>
          <li class="nav-item"><a href="#testimonios" class="nav-link p-0 text-light">Testimonios</a></li>
        </ul>
      </div>

      <!-- Otras secciones -->
      <div class="col mb-3">
        <h5>Más Secciones</h5>
        <ul class="nav flex-column">
          <li class="nav-item"><a href="#promocion" class="nav-link p-0 text-light">Promoción de Invierno</a></li>
          <li class="nav-item"><a href="#sabores" class="nav-link p-0 text-light">Nuevos Sabores</a></li>
          <li class="nav-item"><a href="#servicios" class="nav-link p-0 text-light">Servicios y Beneficios</a></li>
          <li class="nav-item"><a href="#diferenciales" class="nav-link p-0 text-light">Lo que Nos Hace Únicos</a></li>
        </ul>
      </div>

      <!-- Contacto y redes -->
      <div class="col mb-3">
        <h5>Contacto</h5>
        <ul class="nav flex-column">
          <li class="nav-item"><a href="../templates/contacto.php" class="nav-link p-0 text-light">Contacto</a></li>
          <li class="nav-item"><a href="tel:+34608948329" class="nav-link p-0 text-light">+34 608 94 83 29</a></li>
          <li class="nav-item"><a href="../templates/productos.php" class="nav-link p-0 text-light">Ver Productos</a></li>
        </ul>
      </div>
    </div>

    <!-- Copyright y redes -->
    <div class="d-flex flex-column flex-sm-row justify-content-between py-3 mt-4 border-top" style="border-color: var(--white) !important;">
      <p class="mb-0">© 2025 Dulce Encanto. Todos los derechos reservados.</p>
      <div>
        <a href="https://facebook.com" class="text-light me-3"><i class="bi bi-facebook"></i></a>
        <a href="https://www.instagram.com/ro_customcookies?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="text-light me-3"><i class="bi bi-instagram"></i></a>
        <a href="https://wa.me/34608948329" class="text-light me-3"><i class="bi bi-whatsapp"></i></a>
        <a href="https://www.tiktok.com/?lang=es" class="text-light"><i class="bi bi-tiktok"></i></a>
      </div>
    </div>
  </div>
</footer>


  <!-- Bootstrap JS Bundle (opcional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
