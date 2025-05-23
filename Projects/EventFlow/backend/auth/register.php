<?php
// backend/auth/register.php

// Mostrar errores en desarrollo (quítalo en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Salida JSON y sesión
header('Content-Type: application/json');
session_start();

// Conexión PDO
require __DIR__ . '/../db.php';  // ajusta si tu db.php está en otra ruta

// Solo aceptar POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success'=>false,'message'=>'Método no permitido']);
    exit;
}

// Recoger y sanear datos
$nombre      = trim($_POST['nombre']           ?? '');
$email       = trim($_POST['email']            ?? '');
$password    =          $_POST['password']     ?? '';
$confirmPass =          $_POST['confirm_password'] ?? '';

// Validaciones básicas
if (!$nombre || !$email || !$password || !$confirmPass) {
    echo json_encode(['success'=>false,'message'=>'Todos los campos son obligatorios.']);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success'=>false,'message'=>'Email inválido.']);
    exit;
}
if ($password !== $confirmPass) {
    echo json_encode(['success'=>false,'message'=>'Las contraseñas no coinciden.']);
    exit;
}

try {
    // Comprobar email duplicado
    $stmt = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo json_encode(['success'=>false,'message'=>'Ya existe una cuenta con ese email.']);
        exit;
    }

    // Insertar nuevo usuario
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare(
      "INSERT INTO usuarios (nombre,email,password) VALUES (?,?,?)"
    );
    if ($stmt->execute([$nombre,$email,$hashed])) {
        echo json_encode([
          'success'  => true,
          'redirect' => 'login_view.php'
        ]);
        exit;
    } else {
        echo json_encode(['success'=>false,'message'=>'Error al registrar el usuario.']);
        exit;
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
      'success'=>false,
      'message'=>'Error de base de datos: '.$e->getMessage()
    ]);
    exit;
}