<?php
session_start();

require_once __DIR__ . '/config.php';
$conn = db_mysqli();

// Obtener los datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// Preparar y ejecutar la consulta para verificar las credenciales
$sql = "SELECT id_usuario, password FROM Usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si el usuario existe y si la contraseña es correcta
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Si la contraseña es correcta, eliminar el usuario
        $id_usuario = $row['id_usuario'];
        $delete_sql = "DELETE FROM Usuarios WHERE id_usuario = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        if ($delete_stmt === false) {
            die("Error en la preparación de la consulta de eliminación: " . $conn->error);
        }
        $delete_stmt->bind_param("i", $id_usuario);
        if ($delete_stmt->execute()) {
            echo "Usuario eliminado con éxito.";
        } else {
            echo "Error al eliminar el usuario: " . $conn->error;
        }
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "No se encontró el usuario con ese email.";
}

// Cerrar la conexión
$conn->close();
?>
