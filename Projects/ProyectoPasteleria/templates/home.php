<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Dulce Encanto</title>
    <script src="../assets/js/theme.js"></script>
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" sizes="100x100" href="../assets/images/logo/Dulce_Encanto_Logo.png">
</head>

<body class="homepage">
    <!-- Header -->
    <?php include '../includes/header.php' ?>
    <?php include '../includes/socials.php' ?>
    
    <!---------------------- SLIDER ---------------------->
    <section id="inicio" class="home-slider">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active position-relative">
                    <img src="../assets/images/slider/slider1.webp" class="d-block w-100" alt="Pasteles de Autor">
                    <!-- Overlay para oscurecer la imagen -->
                    <div class="carousel-overlay"></div>
                    <!-- Caption centrado -->
                    <div class="carousel-caption caption-center container">
                        <div class="caption-inner">
                            <h2>Pasteles de Autor Artesanales</h2>
                            <p>Descubre creaciones exclusivas elaboradas con ingredientes frescos y técnicas artesanales. Dulce Encanto es la pastelería premium que transforma cada celebración en una experiencia única.</p>
                            <a href="../templates/productos.php" class="btn btn-primary">Descubre Nuestros Pasteles</a>
                        </div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="carousel-item position-relative">
                    <img src="../assets/images/slider/slider2.webp" class="d-block w-100" alt="Cupcakes y Postres">
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption caption-center">
                        <div class="caption-inner">
                            <h2>Cupcakes y Postres Artesanales</h2>
                            <p>Explora nuestra amplia variedad de cupcakes y postres, elaborados con recetas tradicionales y un toque innovador. El sabor auténtico que eleva cada celebración.</p>
                            <a href="../templates/productos.php" class="btn btn-secondary">Explora Delicias</a>
                        </div>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="carousel-item position-relative">
                    <img src="../assets/images/slider/slider3.webp" class="d-block w-100" alt="Pedidos Online">
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption caption-center">
                        <div class="caption-inner">
                            <h2>Pedidos Online y Servicio a Domicilio</h2>
                            <p>Realiza tu pedido en línea y recibe nuestros exquisitos postres en la comodidad de tu hogar. Servicio rápido, seguro y pensado para ti.</p>
                            <a href="../templates/productos.php" class="btn btn-accent">Ordena Ahora</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </section>


    <!---------------------- PROMOCIONES ---------------------->
    <section id="promocion" class="container-fluid py-5 seccion-extra" style="background-color: var(--primary-color);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="fw-bold">Oferta de Invierno: ¡20% de Descuento en Pasteles Seleccionados!</h2>
                    <p>Aprovecha esta promoción exclusiva y endulza tus celebraciones con pasteles premium. Oferta válida por tiempo limitado. ¡No te lo pierdas!</p>
                </div>
                <div class="col-md-4">
                    <a href="../templates/productos.php" class="btn btn-accent btn-lg">Ver Promociones</a>
                </div>
            </div>
        </div>
    </section>
    

    <!---------------------- PASTELES PERSONALIZADOS ---------------------->
    <section id="personalizados" class="container py-5 seccion-extra">
        <div class="row">
            <div class="col-md-6">
                <img src="../assets/images/banners/birthday-cake.webp" alt="Pastel Personalizado" class="img-fluid rounded margen-imagen">
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-center">
                <h2>Pasteles Personalizados</h2>
                <p>Personaliza cada detalle de tu pastel para cumpleaños, bodas o eventos especiales. Diseños únicos que reflejan tu estilo y hacen de cada ocasión un recuerdo inolvidable.</p>
                <a href="../templates/productos.php" class="btn btn-primary boton">Diseña el Tuyo</a>
            </div>
        </div>
    </section>


<!---------------------- NUEVOS SABORES ---------------------->
<section id="sabores" class="container py-5 seccion-extra">
    <h2 class="text-center mb-4">Nuevos Sabores</h2>
    <p class="text-center mb-4">Descubre nuestras últimas creaciones, donde cada bocado es una explosión de sabor. ¡Atrévete a probar lo nuevo!</p>
    <div class="row">
        <!-- Card para Cheesecake Oreo -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="../assets/images/productos/cheesecake-oreo.webp" class="card-img-top" alt="Cheesecake Oreo">
                <div class="card-body d-flex flex-column tarjetas">
                    <h5 class="card-title text-start">Cheesecake Oreo</h5>
                    <p class="card-text text-start">La irresistible fusión de queso cremoso y crujientes galletas Oreo.</p>
                    <p class="card-text fw-bold text-start">$52.99</p>
                    <a href="../templates/productos.php" class="btn btn-primary mt-auto w-100 w-md-auto mx-md-0 mx-auto">Pedir Ahora</a>
                </div>
            </div>
        </div>
        <!-- Card para Alfajor de Maicena -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="../assets/images/productos/alfajores-de-maicena.webp" class="card-img-top" alt="Alfajor de Maicena">
                <div class="card-body d-flex flex-column tarjetas">
                    <h5 class="card-title text-start">Alfajor de Maicena</h5>
                    <p class="card-text text-start">Suavidad y tradición en cada bocado. Con nuestro dulce de leche artesanal.</p>
                    <p class="card-text fw-bold text-start">$3.75</p>
                    <a href="../templates/productos.php" class="btn btn-primary mt-auto w-100 w-md-auto mx-md-0 mx-auto">Pedir Ahora</a>
                </div>
            </div>
        </div>
        <!-- Card para Cheesecake de Frambuesa -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="../assets/images/productos/mini-cheesecake-frambuesa.webp" class="card-img-top" alt="Cheesecake de Frambuesa">
                <div class="card-body d-flex flex-column tarjetas">
                    <h5 class="card-title text-start">Cheesecake de Frambuesa</h5>
                    <p class="card-text text-start">Cremoso y refrescante, un toque de frescura en cada porción.</p>
                    <p class="card-text fw-bold text-start">$8.50</p>
                    <a href="../templates/productos.php" class="btn btn-primary mt-auto w-100 w-md-auto mx-md-0 mx-auto">Pedir Ahora</a>
                </div>
            </div>
        </div>
    </div>
</section>





    <!---------------------- SERVICIOS Y BENEFICIOS ---------------------->
    <section id="servicios" class="container seccion-extra margen rounded" style="background-color: var(--secondary-color); color:(var(--dark-text));">
        <div class="container">
            <h2 class="text-center mb-4" style="color:(var(--dark-text));">Nuestros Servicios y Beneficios</h2>
            <div class="row text-center mt-5">
                <div class="col-md-4 mb-4">
                    <div class="card border-0" style="background: transparent;">
                        <div class="card-body">
                        <img class="icon-size mb-3" src="../assets/images/icons/entrega.png" alt="entrega-rapida">
                        <h5 class="card-title">Entrega Rápida</h5>
                            <p class="card-text">Recibe tus pedidos en tiempo récord, garantizando frescura y calidad en cada entrega.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-0" style="background: transparent;">
                        <div class="card-body">
                            <i class="fas fa-birthday-cake fa-3x mb-3" style="color: var(--fixed-accent);"></i>
                            <h5 class="card-title">Personalización</h5>
                            <p class="card-text">Cada pastel se adapta a tus gustos y necesidades, ideal para celebraciones únicas.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-0" style="background: transparent;">
                        <div class="card-body">
                            <i class="fas fa-star fa-3x mb-3" style="color: var(--fixed-accent);"></i>
                            <h5 class="card-title">Calidad Premium</h5>
                            <p class="card-text">Utilizamos solo ingredientes de la más alta calidad para crear sabores inigualables.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!---------------------- LO QUE NOS HACE UNICOS ---------------------->
    <section id="diferenciales" class="container-fluid seccion-extra margen" style="position: relative; background: url('../assets/images/banners/lo-que-nos-hace-unicos.webp') center/cover no-repeat;">
        <!-- Overlay para oscurecer y que resalten los textos -->
        <div class="miOverlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background:rgba(255, 192, 203, 0.44);"></div>
        <div class="container" style="position: relative; z-index: 2;">
            <h2 class="text-center mb-5" style="color: var(--accent-color);">Descubre lo que nos hace únicos</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100" style="border: none; background-color: var(--white);">
                        <div class="card-body text-center">
                            <i class="fas fa-heart fa-3x mb-3" style="color: var(--fixed-primary);"></i>
                            <h5 class="card-title">Pasión en Cada Detalle</h5>
                            <p class="card-text">Nos esforzamos por crear experiencias únicas en cada creación.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100" style="border: none; background-color: var(--white);">
                        <div class="card-body text-center">
                            <i class="fas fa-hands-helping fa-3x mb-3" style="color: var(--fixed-primary);"></i>
                            <h5 class="card-title">Atención Personalizada</h5>
                            <p class="card-text">Tu satisfacción es nuestra prioridad, desde el pedido hasta la entrega.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100" style="border: none; background-color: var(--white);">
                        <div class="card-body text-center">
                            <i class="fas fa-award fa-3x mb-3" style="color: var(--fixed-primary);"></i>
                            <h5 class="card-title">Reconocidos por la Calidad</h5>
                            <p class="card-text">Nuestros clientes y premios avalan nuestro compromiso con la excelencia.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!---------------------- PEDIDOS EN LINEA ---------------------->
    <section id="pedidos" class="container seccion-extra rounded" style="background-color: var(--accent-color);">
        <div class="container text-center text-white">
            <h2>Pedidos Online</h2>
            <p>Tu Dulce Encanto a un clic. Disfruta de nuestros deliciosos pasteles sin salir de casa. ¡Haz tu pedido y recíbelo con rapidez!</p>
            <img width="64" height="64" src="../assets/images/icons/delivery-icon.png" alt="delivery-scooter" /><br><br>
            <a href="../templates/productos.php" class="btn btn-primary btn-lg">Pide ahora</a>
            <p class="mt-3">Envío a domicilio o recogida en tienda.</p>
        </div>
    </section>





    <!---------------------- TESTIMONIOS ---------------------->
    <section id="testimonios" class="container-fluid  py-5 seccion-menos seccion-extra">
        <h2 class="text-center mb-4">Lo que dicen nuestros clientes</h2>
        <div id="testimoniosCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                <!-- Testimonio 1 -->
                <div class="carousel-item active testimonio seccion-extra">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="testimonial-item text-center container">
                                <img src="../assets/images/testimonials/testimonial1.webp" alt="María G." class="rounded-circle mb-3" style="width: 80px; height:80px;">
                                <h5>María Giménez</h5>
                                <div class="star-rating mb-2">
                                    <!-- 4.5 estrellas -->
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                </div>
                                <p class="lead">"La atención en Dulce Encanto es excepcional y la calidad de sus pasteles es insuperable. Cada visita es una experiencia deliciosa y única que me hace sentir muy especial. ¡Definitivamente recomendaré sus productos a mis amigos y familiares!"</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonio 2 -->
                <div class="carousel-item testimonio seccion-extra">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="testimonial-item text-center container">
                                <img src="../assets/images/testimonials/testimonial2.webp" alt="Carlos L." class="rounded-circle mb-3" style="width: 80px; height:80px;">
                                <h5>Carlos Lucero</h5>
                                <div class="star-rating mb-2">
                                    <!-- 4 estrellas -->
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                </div>
                                <p class="lead">"Cada pastel que he probado en Dulce Encanto me sorprende por su originalidad y sabor. La presentación es impecable y se nota la dedicación en cada detalle. Sin duda, es mi pastelería de confianza para cualquier ocasión especial."</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonio 3 -->
                <div class="carousel-item testimonio seccion-extra  ">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="testimonial-item text-center container">
                                <img src="../assets/images/testimonials/testimonial3.webp" alt="Carlos L." class="rounded-circle mb-3" style="width: 80px; height:80px;">
                                <h5>Jose Santos</h5>
                                <div class="star-rating mb-2">
                                    <!-- 4 estrellas -->
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                </div>
                                <p class="lead">"Cada pastel que he probado en Dulce Encanto me sorprende por su originalidad y sabor. La presentación es impecable y se nota la dedicación en cada detalle. Sin duda, es mi pastelería de confianza para cualquier ocasión especial."</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#testimoniosCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimoniosCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </section>


    <!---------------------- CONTACTO ---------------------->
    <section id="contacto" class="container seccion-extra rounded" style="background-color: var(--white);">
        <div class="container text-center">
            <h2>¿Tienes alguna duda?</h2>
            <p>Nuestro equipo de atención está listo para ayudarte. Contáctanos y descubre cómo podemos transformar tu evento en una experiencia inolvidable con nuestros pasteles artesanales.</p>
            <a href="../templates/contacto.php" class="btn btn-secondary btn-lg">Contáctanos</a>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../includes/footer.php' ?>

    <!-- Scripts y Otros enlaces -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/css/global.css"> <!-- Para que algunos estilos se carguen despues de los de boostrap -->
    <link rel="stylesheet" href="../assets/css/home.css"> <!-- Para que algunos estilos se carguen despues de los de boostrap -->
    <script src="../assets/js/script.js"></script>
</body>

</html>