<?php
// Datos de conexión a la base de datos
// $servername = "localhost:3307";
$servername = "localhost:3309";
$username = "insert_delete_user"; 
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

// Función para insertar un nuevo usuario
function insertarUsuario($conn, $nombre, $email, $password, $telefono) {
    $stmt = $conn->prepare("CALL InsertarUsuario(?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $email, $password, $telefono);
    return $stmt->execute();
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

// Si se envió el formulario de registro
if (isset($_POST['action']) && $_POST['action'] === 'register') {
    // Obtener los datos del formulario de registro
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contraseña = $_POST['password']; // Cambiar a contraseña para mantener consistencia
    $telefono = $_POST['telefono'];

    // Insertar usuario usando el procedimiento almacenado
    if (insertarUsuario($conn, $nombre, $email, $contraseña, $telefono)) {
        echo "Usuario registrado exitosamente";
    } else {
        echo "Error al registrar el usuario";
    }
}

// Cerrar la conexión
$conn->close();
?>
