<?php
// Conectar a la base de datos
$servername = "localhost:3309";
$username = "insert_delete_user";
$password = "1234";
$dbname = "malagasupercars";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se envió el formulario de inserción
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "register") {
    // Obtener datos del formulario
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $ano = $_POST["ano"];
    $precio = $_POST["precio"];
    $descripcion = $_POST["descripcion"];
    $imagen = $_POST["imagen"];

    // Llamar al procedimiento almacenado para insertar coche
    $stmt = $conn->prepare("CALL InsertarCoche(?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsis", $marca, $modelo, $ano, $precio, $descripcion, $imagen);

    // Ejecutar la consulta
    if ($stmt->execute() === TRUE) {
        echo "Coche insertado correctamente.";
    } else {
        echo "Error al insertar el coche: " . $conn->error;
    }

    // Cerrar la consulta
    $stmt->close();
}

// Verificar si se envió el formulario de eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "delete") {
    // Obtener la marca y el modelo del coche a eliminar
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];

    // Llamar al procedimiento almacenado para eliminar coche
    $stmt = $conn->prepare("CALL EliminarCoche(?, ?)");
    $stmt->bind_param("ss", $marca, $modelo);

    // Ejecutar la consulta
    if ($stmt->execute() === TRUE) {
        echo "Coche eliminado correctamente.";
    } else {
        echo "Error al eliminar el coche: " . $stmt->error;
    }

    // Cerrar la consulta
    $stmt->close();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
