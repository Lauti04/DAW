<?php
// Datos de conexión
$host = 'srv1590.hstgr.io';
$dbName = 'u214508706_EventFlow';
$username = 'u214508706_lautaro';
$password = '3L^!Y|a]cT';

try {
    // Crear una instancia de PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8mb4", $username, $password);
    
    // Configurar PDO para que lance excepciones ante errores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mensaje de confirmación para la conexión (para pruebas)
    echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    // En caso de error, se muestra el mensaje y se detiene la ejecución
    die("Error de conexión: " . $e->getMessage());
}
?>