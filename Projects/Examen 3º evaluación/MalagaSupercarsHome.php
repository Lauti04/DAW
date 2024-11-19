<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malaga Supercars</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="http://localhost/Examen%203º%20evaluación/MalagaSupercarsHome.php" class="logo">
            <img src="assets/images/logo/MalagaSupercarsLogo.png" alt="logo">
        </a>

        <div class="icono-menu">
            <img src="assets/images/icons/menu.png" id="icono-menu">
        </div>
        
        <div class="cont-menu" id="menu">
            <ul>
                <li>Inicio</li>
                <li>Sobre Nosotros</li>
                <li>Contacto</li>
                <li>Publicar Coche</li>
                <li>Cuenta</li>
            </ul>   
        </div>

        <nav>
            <div>
                <a href="http://localhost/Examen%203º%20evaluación/MalagaSupercarsHome.php" class="nav-link">Inicio</a>
            </div>
            <div>
                <a href="http://localhost/Examen%203º%20evaluación/MalagaSupercarsAboutUs.html" class="nav-link">Sobre Nosotros</a>
            </div>
            <div>
                <a href="http://localhost/Examen%203º%20evaluación/MalagaSupercarsContact.html" class="nav-link">Contacto</a>
            </div>
            <div>
                <a href="http://localhost/Examen%203%C2%BA%20evaluaci%C3%B3n/MalagaSupercarsForm4.html" class="nav-link">Publicar Coche</a>
            </div>
            <div class="cuenta">
                <img src="assets/images/icons/boton-de-cuenta-redonda-con-usuario-dentro.png" alt="">
                <a href="http://localhost/Examen%203º%20evaluación/MalagaSupercarsForm.html" class="nav-link">Cuenta</a> 
            </div>
        </nav>
    </header>

    <div class="banner">
        <div class="capa">
            <div class="contenido">
                <p>Malaga Supercars</p>
                <h1>Encuentra el coche de tus sueños</h1>
                <center><a href="#" class="button">Leer Mas</a></center>
            </div>
        </div>
    </div>

    <h2 class="titulo">Encuentra tu coche</h2>

    <form id="filtro-form" class="filtro-form" action="MalagaSupercarsHome.php" method="get">
    <select name="marca" id="marca" class="filtro-select">
        <option value="">Selecciona una marca</option>
        <option value="ASTON MARTIN">ASTON MARTIN</option>
        <option value="AUDI">AUDI</option>
        <option value="BENTLEY">BENTLEY</option>
        <option value="BMW">BMW</option>
        <option value="DODGE">DODGE</option>
        <option value="FERRARI">FERRARI</option>
        <option value="LAMBORGHINI">LAMBORGHINI</option>
        <option value="MASERATI">MASERATI</option>
        <option value="MCLAREN">MCLAREN</option>
        <option value="MERCEDES-BENZ">MERCEDES-BENZ</option>
        <option value="PORSCHE">PORSCHE</option>
    </select>
    <input type="text" name="modelo" id="modelo" class="filtro-input" placeholder="Modelo">
    <input type="number" name="precio_max" id="precio_max" class="filtro-input" placeholder="Precio máximo">
    <input type="number" name="anio" id="anio" class="filtro-input" placeholder="Año">
    <button type="submit" id="filtrar-btn" class="filtro-btn">Filtrar</button>
    </form> 


    <div class="container-items" id="container-items"> 
    <?php
    try {
        // Establecer la conexión con la base de datos
        // 3307
        $pdo = new PDO("mysql:host=localhost;port=3309;dbname=malagasupercars", "select_user", "1234");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Definir las variables a partir de $_GET
        $marca = isset($_GET['marca']) ? $_GET['marca'] : NULL;
        $modelo = isset($_GET['modelo']) ? $_GET['modelo'] : NULL;
        $precio_max = isset($_GET['precio_max']) ? $_GET['precio_max'] : NULL;
        $anio = isset($_GET['anio']) ? $_GET['anio'] : NULL;

        // Preparar la consulta SQL
        $sql = "CALL mostrar_coches_filtrados(:marca, :modelo, :precio_max, :anio)";


        // Preparar la sentencia
        $stmt = $pdo->prepare($sql);

        // Asignar parámetros
        $stmt->bindValue(':marca', htmlspecialchars($marca));
        $stmt->bindValue(':modelo', htmlspecialchars($modelo));
        $stmt->bindValue(':precio_max', htmlspecialchars($precio_max));
        $stmt->bindValue(':anio', htmlspecialchars($anio));

        // Ejecutar la consulta
        $stmt->execute();

        // Mostrar resultados
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="item">';
            echo '<figure>';
            echo '<img src="assets/images/cars/coche'. $row['id_coche']. '.jpg" alt="producto">';
            echo '</figure>';
            echo '<div class="info-product">';
            echo '<h2>' . htmlspecialchars($row['marca']) . ' ' . htmlspecialchars($row['modelo']) . '</h2>'; 
            echo '<p class="price">' . htmlspecialchars($row['precio']) . '€</p>';
            echo '<button>Reservar</button>';
            echo '</div>';
            echo '</div>';
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    ?>

    </div>

    <div class="container">
        <h2>NUESTROS SERVICIOS</h2>
        <div class="services-container">
            <div class="service">
                <div class="icon"><img src="assets/images/icons/llave-del-coche.png" alt="Alquiler"></div>
                <h3>Alquiler</h3>
                <p>Alquila tu vehículo de lujo en Málaga</p>
            </div>
            <div class="service">
                <div class="icon"><img src="assets/images/icons/turbo.png" alt="Preparaciones"></div>
                <h3>Preparaciones</h3>
                <p>Desde 1985 trabajamos con los mejores preparadores del mercado</p>
            </div>
            <div class="service">
                <div class="icon"><img src="assets/images/icons/destornillador.png" alt="Taller"></div>
                <h3>Taller</h3>
                <p>Especialistas en reparación de coches de lujo y gama</p>
            </div>
            <div class="service">
                <div class="icon"><img src="assets/images/icons/chasis.png" alt="Chapa y pintura"></div>
                <h3>Chapa y pintura</h3>
                <p>Tu coche de lujo mejor que nuevo con nuestro equipo de especialistas</p>
            </div>
            <div class="service">
                <div class="icon"><img src="assets/images/icons/espatula.png" alt="Vinilos"></div>
                <h3>Vinilos</h3>
                <p>Protege o cambia el color de tu vehiculo de alta gama</p>
            </div>
            <div class="service">
                <div class="icon"><img src="assets/images/icons/auto-limpio.png" alt="Detallados"></div>
                <h3>Detallados</h3>
                <p>Los mejores tratamientos con productos de alta calidad</p>
            </div>
        </div>
    </div>

    <footer>
        <div class="contenedor-footer">
            <div class="footer-columna">
                <img class="logo-footer" src="assets/images/logo/MalagaSupercarsLogoF.png" alt="">
                <div class="footer-parrafos">
                    <h3>Encuentranos</h3>
                    <p>Urb. La Alcazaba</p>
                    <p>Avenida de la Aurora s/n, 29002</p>
                    <p>Centro, Málaga (Málaga).</p>
                </div>  
            </div>

            <div class="servicios">
                <h3>Servicios</h3>
                <p>Alquiler</p>
                <p>Preparaciones</p>
                <p>Taller</p>
                <p>Chapa y Pintura</p>
                <p>Vinilos</p>
                <p>Detallados</p>
                <p>Arte</p>
                <p>Conserje</p>
            </div>

            <div class="legal">
                <h3>Legal</h3>
                <p>Aviso legal</p>
                <p>Tus datos seguros</p>
                <p>Protección de datos</p>
                <p>Política de cookies</p>
            </div>

            <div class="sociales">
                <h3>Síguenos</h3>
                <img class="logo-sociales" src="assets/images/social-icons/facebook.png" alt="">
                <img class="logo-sociales" src="assets/images/social-icons/instagram.png" alt="">
                <img class="logo-sociales" src="assets/images/social-icons/youtube.png" alt="">
            </div>  
        </div>
    </footer>

    <div class="derechos">
        <p>© 2024 MalagaSupercars, todos los derechos reservados. Diseño, desarrollo y alojamiento</p>
    </div>
    
    <script src="script.js"></script>
</body>
</html>
