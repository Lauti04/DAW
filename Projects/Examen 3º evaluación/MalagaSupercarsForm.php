<?php
require_once __DIR__ . '/config.php';
$conn = db_mysqli();

// Función para consultar un usuario por correo electrónico y contraseña
function consultarUsuario($conn, $email, $password) {
    $stmt = $conn->prepare("CALL ConsultarUsuario(?, ?)");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();
    // El procedimiento devuelve el usuario por email; la contraseña se comprueba aquí contra el hash.
    if ($usuario && password_verify($password, $usuario['password'])) {
        return $usuario;
    }
    return null;
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
    if (insertarUsuario($conn, $nombre, $email, password_hash($contraseña, PASSWORD_DEFAULT), $telefono)) {
        echo "Usuario registrado exitosamente";
    } else {
        echo "Error al registrar el usuario";
    }
}

// Cerrar la conexión
$conn->close();
?>
