<?php
// backend/api/categorias.php

// 1) Siempre devolvemos JSON
header('Content-Type: application/json; charset=utf-8');

// 2) Arrancamos la sesión y verificamos usuario
require_once __DIR__ . '/../auth/session.php';
// session.php hace session_start() y comprueba $_SESSION['id_usuario']
// Si no existe, session.php redirige al login_view.php y sale.

$userId = $_SESSION['id_usuario'];  
// NOTA: dado que la tabla de categorías es global y no tiene id_usuario_fk,
// ignoraremos $userId en la consulta. Solo existía la referencia al ENUM tipo.


// 3) Conexión a la base de datos
require_once __DIR__ . '/../db.php';
// db.php contiene la conexión PDO con ERRMODE_EXCEPTION

// 4) Consultamos todas las categorías (sin importar el tipo ni usuario)
try {
    $stmt = $pdo->prepare("
        SELECT 
          id_categoria,
          nombre,
          tipo,
          color
        FROM categorias
        ORDER BY id_categoria ASC
    ");
    $stmt->execute();
    $cats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // $cats: array de { id_categoria, nombre, tipo, color }
    echo json_encode(['success' => true, 'data' => $cats]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
      'success' => false,
      'error'   => 'Error BD al listar categorías: ' . $e->getMessage()
    ]);
}