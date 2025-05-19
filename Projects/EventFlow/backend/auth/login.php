<?php
session_start();
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Completa todos los campos.';
        header('Location: ../../login.html');
        exit;
    }

    $stmt = $conn->prepare("SELECT id_usuario, password FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hashed);
        $stmt->fetch();

        if (password_verify($password, $hashed)) {
            $_SESSION['id_usuario'] = $id;
            header('Location: ../../dashboard.php');
            exit;
        }
    }

    $_SESSION['error'] = 'Credenciales inválidas.';
    header('Location: ../../login.html');
    exit;
}
?>