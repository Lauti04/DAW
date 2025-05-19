<?php
session_start();
require '../db.php'; // conexión a base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    // Validaciones básicas
    if (empty($nombre) || empty($email) || empty($password)) {
        $_SESSION['error'] = 'Completa todos los campos.';
        header('Location: ../../register.html');
        exit;
    }

    if ($password !== $confirm) {
        $_SESSION['error'] = 'Las contraseñas no coinciden.';
        header('Location: ../../register.html');
        exit;
    }

    // Verificar email duplicado
    $stmt = $conn->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = 'Ya existe una cuenta con ese email.';
        header('Location: ../../register.html');
        exit;
    }

    // Hashear contraseña
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // Insertar nuevo usuario
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $hashed);
    $stmt->execute();

    $_SESSION['success'] = 'Registro exitoso. Ya puedes iniciar sesión.';
    header('Location: ../../login.html');
    exit;
}
?>