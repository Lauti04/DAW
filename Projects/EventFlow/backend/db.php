<?php
require_once __DIR__ . '/config.php';

$db = db_settings();

try {
    $pdo = new PDO(
        "mysql:host={$db['host']};port={$db['port']};dbname={$db['name']};charset=utf8mb4",
        $db['user'],
        $db['pass']
    );

    // Lanzar excepciones ante errores de SQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // El detalle va al log del servidor; al usuario no se le expone el host ni el usuario.
    error_log('EventFlow DB connection failed: ' . $e->getMessage());
    http_response_code(500);
    die('Error de conexión con la base de datos.');
}

unset($db);
