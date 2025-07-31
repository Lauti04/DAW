<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Dulce Encanto</title>
    <script src="../assets/js/theme.js"></script>
    <link rel="stylesheet" href="../assets/css/theme.css">
    <!-- Enlaces a frameworks y fuentes -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/contacto.css">
    <link rel="icon" type="image/png" sizes="100x100" href="../assets/images/logo/Dulce_Encanto_Logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body style="background-color: var(--bg-color);">
    <?php include '../includes/header.php' ?>
    <?php include '../includes/socials.php' ?>


    <h1 class="text-center margin-contacto">¡Déjanos endulzar tus momentos especiales!</h1>
    <!-- Sección 1: Contacto y Formulario -->
    <section class="container py-5">
        <div class="row g-5">
            <!-- Tarjeta de Información -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg" style="background: var(--primary-color);">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="mb-4 fw-bold" style="color: var(--accent-color); font-family: var(--font-primary);">
                            <i class="bi bi-chat-heart-fill me-2"></i>Contáctanos
                        </h2>
                        <div class="contact-info" style="color: var(--accent-color);">
                            <p class="mb-3">
                                <i class="bi bi-geo-alt-fill me-2"></i>Calle Miel 12, Málaga
                            </p>
                            <p class="mb-3">
                                <i class="bi bi-telephone-fill me-2"></i>+34 608 94 83 29
                            </p>
                            <p class="mb-4">
                                <i class="bi bi-envelope-fill me-2"></i>dulceencanto@gmail.com
                            </p>
                            <div class="business-hours mb-5">
                                <h3 class="h5 fw-bold mb-3"><i class="bi bi-clock-history me-2"></i>Horario</h3>
                                <p class="mb-1">Lunes-Viernes: 8:00 - 20:00</p>
                                <p>Sábados: 9:00 - 14:00</p>
                            </div>
                            <div class="social-media">
                                <a href="https://facebook.com" class="me-3" style="color: var(--accent-color);">
                                    <i class="bi bi-facebook fs-4"></i>
                                </a>
                                <a href="https://www.instagram.com/ro_customcookies?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="me-3" style="color: var(--accent-color);">
                                    <i class="bi bi-instagram fs-4"></i>
                                </a>
                                <a href="https://wa.me/34608948329" class="me-3" style="color: var(--accent-color);">
                                    <i class="bi bi-whatsapp fs-4"></i>
                                </a>
                                <a href="https://www.tiktok.com/" style="color: var(--accent-color);">
                                    <i class="bi bi-tiktok"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario de Contacto -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg" style="background: var(--secondary-color);">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="mb-4 fw-bold" style="color: var(--accent-color); font-family: var(--font-primary);">
                            <i class="bi bi-envelope-paper-heart-fill me-2"></i>Envíanos un mensaje
                        </h2>
                        <form id="pasteleriaForm" class="needs-validation" novalidate>
                            <!-- Campo Nombre -->
                            <div class="mb-3">
                                <label for="nombre" class="form-label" style="color: var(--accent-color);">Nombre</label>
                                <input type="text" class="form-control" id="nombre"
                                    pattern="[A-Za-zÁ-ú\s']{3,40}" required
                                    style="border-color: var(--accent-color);">
                                <div class="invalid-feedback">
                                    Solo letras y espacios (3-40 caracteres)
                                </div>
                            </div>

                            <!-- Campo Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label" style="color: var(--accent-color);">Correo electrónico</label>
                                <input type="email" class="form-control mail" id="email"
                                    pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required
                                    style="border-color: var(--accent-color);">
                                <div class="invalid-feedback">
                                    Por favor ingrese un correo válido (ej: nombre@dominio.com)
                                </div>
                            </div>

                            <!-- Campo Teléfono -->
                            <div class="mb-3">
                                <label for="telefono" class="form-label" style="color: var(--accent-color);">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono"
                                    pattern="^[67]\d{1}[\d\s-]*" required
                                    style="border-color: var(--accent-color);">
                                <div class="invalid-feedback">
                                    El teléfono debe comenzar con 6 o 7 y tener 9 dígitos
                                </div>
                            </div>

                            <!-- Campo Mensaje -->
                            <div class="mb-4">
                                <label for="mensaje" class="form-label" style="color: var(--accent-color);">Mensaje</label>
                                <textarea class="form-control" id="mensaje" rows="4"
                                    placeholder="Cuéntanos tu dulce idea..."
                                    minlength="20" required
                                    style="border-color: var(--accent-color);"></textarea>
                                <div class="invalid-feedback">
                                    Por favor escribe al menos 20 caracteres
                                </div>
                            </div>

                            <button type="submit" class="btn btn-accent w-100">
                                Enviar mensaje <i class="bi bi-cupcake"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección 2: Nuestro Equipo -->
    <section class="container py-5">
        <h2 class="text-center mb-5 fw-bold" style="color: var(--accent-color);">
            <i class="bi bi-people-fill me-2"></i>Nuestro Dulce Equipo
        </h2>
        <div class="row g-4">
            <!-- Miembro 1 -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-lg">
                    <img src="../assets/images/equipo/pastelero1.webp" class="card-img-top" alt="Chef María">
                    <div class="card-body text-center" style="background: var(--primary-color);">
                        <h5 class="card-title fw-bold" style="color: var(--accent-color);">María Gómez</h5>
                        <p class="card-text" style="color: var(--accent-color);">Pastelera Principal</p>
                        <a href="mailto:maria@dulceencanto.com" class="btn btn-accent">
                            <i class="bi bi-envelope"></i> Contactar
                        </a>
                    </div>
                </div>
            </div>
            <!-- Miembro 2 -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-lg">
                    <img src="../assets/images/equipo/pastelero2.webp" class="card-img-top" alt="Chef Juan">
                    <div class="card-body text-center" style="background: var(--primary-color);">
                        <h5 class="card-title fw-bold" style="color: var(--accent-color);">Juan Pérez</h5>
                        <p class="card-text" style="color: var(--accent-color);">Especialista en Decoración</p>
                        <a href="mailto:juan@dulceencanto.com" class="btn btn-accent">
                            <i class="bi bi-envelope"></i> Contactar
                        </a>
                    </div>
                </div>
            </div>
            <!-- Miembro 3 -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-lg">
                    <img src="../assets/images/equipo/pastelero3.webp" class="card-img-top" alt="Chef Laura">
                    <div class="card-body text-center" style="background: var(--primary-color);">
                        <h5 class="card-title fw-bold" style="color: var(--accent-color);">Laura Martínez</h5>
                        <p class="card-text" style="color: var(--accent-color);">Pastelera Creativa</p>
                        <a href="mailto:laura@dulceencanto.com" class="btn btn-accent">
                            <i class="bi bi-envelope"></i> Contactar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección 3: Preguntas Frecuentes -->
    <section class="container py-5">
        <h2 class="text-center mb-5 fw-bold" style="color: var(--accent-color);">
            <i class="bi bi-question-circle-fill me-2"></i>Dudas Dulces
        </h2>
        <div class="accordion" id="faqAccordion">
            <!-- FAQ 1 -->
            <div class="accordion-item" style="border-color: var(--white);">
                <h3 class="accordion-header sin-margen">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq1" style="background-color: var(--fixed-accent); color: var(--fixed-white);">
                        ¿Hacen envíos a domicilio?
                    </button>
                </h3>
                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body" style="background-color: var(--white); color: var(--dark-text) !important;">
                        Sí, realizamos envíos en toda Málaga capital con un mínimo de pedido de 15€.
                    </div>
                </div>
            </div>
            <!-- FAQ 2 -->
            <div class="accordion-item" style="border-color: var(--white);">
                <h3 class="accordion-header sin-margen">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq2" style="background-color: var(--fixed-accent); color: var(--fixed-white);">
                        ¿Puedo personalizar mi pastel?
                    </button>
                </h3>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body" style="background-color: var(--white); color: var(--dark-text) !important;">
                        ¡Absolutamente! Aceptamos pedidos personalizados con mínimo 72 horas de anticipación.
                    </div>
                </div>
            </div>
            <!-- FAQ 3 -->
            <div class="accordion-item" style="border-color: var(--white);">
                <h3 class="accordion-header sin-margen">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq3" style="background-color: var(--fixed-accent); color: var(--fixed-white);">
                        ¿Tienen opciones sin gluten?
                    </button>
                </h3>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body" style="background-color: var(--white); color: var(--dark-text) !important;">
                        Sí, ofrecemos una variedad de postres sin gluten. Consulta nuestro menú especial.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección 4: Newsletter -->
    <section class="container py-5" id="newsletter">
        <div class="card border-0 shadow-lg py-5" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
            <div class="card-body text-center">
                <h2 class="mb-4 fw-bold" style="color: var(--accent-color);">
                    <i class="bi bi-envelope-heart-fill me-2"></i>¡Sé el primero en probar nuestras nuevas creaciones!
                </h2>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <form id="newsletterForm" class="newsletter-form">
                            <div class="input-group centrado">
                                <input type="email" id="newsletterEmail"
                                    class="form-control"
                                    placeholder="Tu dulce email"
                                    required
                                    style="border-color: var(--accent-color);">
                                <button type="submit" class="btn btn-accent">
                                    Suscribirme <i class="bi bi-heart-fill"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback-newsletter mt-2"></div>
                            <p class="mt-3 small" style="color: var(--accent-color);">
                                ¡Recibe recetas exclusivas y novedades directamente en tu bandeja de entrada!
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección 5: Mapa -->
    <section class="container py-5">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4 fw-bold text-center" style="color: var(--accent-color);">
                    <i class="bi bi-geo-alt-heart-fill me-2"></i>Visítanos en Málaga
                </h2>
                <div class="map-container shadow-lg rounded-3 overflow-hidden">
                    <div class="ratio ratio-16x9">
                        <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3197.993780463185!2d-4.424530684444518!3d36.7113954799621!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd72f7c17b0d0649%3A0x7633940d27a4389d!2sPlaza%20de%20la%20Constituci%C3%B3n%2C%20M%C3%A1laga!5e0!3m2!1ses!2ses!4v1659374733783!5m2!1ses!2ses"
                            style="border:0;" allowfullscreen loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección 6: Clima en Málaga -->
    <section class="container py-5" id="clima">
        <h2 class="text-center mb-4" style="color: var(--accent-color);">
            <i class="bi bi-cloud-sun-fill me-2"></i> Clima en Málaga
        </h2>
        <div id="weather-card" class="card border-0 shadow-lg text-center" style="background: var(--secondary-color);">
            <div class="card-body">
                <p>Cargando clima...</p>
            </div>
        </div>
    </section>

    <?php include '../includes/footer.php' ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/contacto.js"></script>
    <!-- Script para obtener el clima -->
    <script src="../assets/js/clima.js"></script>
</body>

</html>