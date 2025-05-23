<?php
// backend/auth/login.php

// 1) Errores en desarrollo (quitar en producción)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// 2) Cabecera JSON + sesión
header('Content-Type: application/json');
session_start();

// 3) Conexión PDO (ajusta la ruta si tu db.php está en otro sitio)
require __DIR__ . '/../db.php';

// 4) Solo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
      'success' => false,
      'message' => 'Método no permitido'
    ]);
    exit;
}

// 5) Recoger y sanear datos
$email    = trim($_POST['email']    ?? '');
$password =           $_POST['password'] ?? '';

// 6) Validaciones
if (!$email || !$password) {
    echo json_encode([
      'success' => false,
      'message' => 'Completa todos los campos'
    ]);
    exit;
}

try {
    // 7) Buscar usuario por email
    $stmt = $pdo->prepare(
      "SELECT id_usuario, password 
         FROM usuarios 
        WHERE email = ?"
    );
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // 8) Éxito → guardar sesión y devolver redirect
        $_SESSION['id_usuario'] = $user['id_usuario'];
        echo json_encode([
          'success'  => true,
          // la vista está en frontend/, así que dashboard.php debe vivir ahí:
          'redirect' => 'home.php'
        ]);
        exit;
    }

    // Si llegamos aquí, credenciales inválidas
    echo json_encode([
      'success' => false,
      'message' => 'Credenciales inválidas'
    ]);
    exit;

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
      'success' => false,
      'message' => 'Error de base de datos: ' . $e->getMessage()
    ]);
    exit;
}