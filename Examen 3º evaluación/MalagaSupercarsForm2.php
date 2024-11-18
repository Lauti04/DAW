<?php
// Datos de conexión a la base de datos
// $servername = "localhost:3307";
$servername = "localhost:3309";
$username = "select_user"; 
$password = "1234"; 
$database = "malagasupercars"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Función para consultar un usuario por correo electrónico y contraseña
function consultarUsuario($conn, $email, $password) {
    $stmt = $conn->prepare("CALL ConsultarUsuario(?, ?)");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Si se envió el formulario de inicio de sesión
if (isset($_POST['action']) && $_POST['action'] === 'login') {
    // Obtener los datos del formulario de inicio de sesión
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consultar usuario usando el procedimiento almacenado
    $usuario = consultarUsuario($conn, $email, $password);

    // Verificar si se encontró un usuario
    if ($usuario !== null) {
        echo "Inicio de sesión exitoso";
    } else {
        echo "El correo electrónico o la contraseña son incorrectos";
    }
}

// Cerrar la conexión
$conn->close();
?>
