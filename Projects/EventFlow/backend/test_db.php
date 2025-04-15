<?php
// Incluir el archivo de conexión
require 'db.php';

// Ejecutar una consulta simple para verificar que se reciben datos.
// Ejemplo: contar el número de usuarios
try {
    $stmt = $pdo->query("SELECT COUNT(*) AS total FROM usuarios");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Conexión establecida. Número de usuarios: " . $result['total'];
} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}
?>