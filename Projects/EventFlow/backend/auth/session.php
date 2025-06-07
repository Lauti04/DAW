<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    // Redirige al formulario de login
    header('Location: ../../EventFlow/frontend/login_view.php');
    exit;
}
?>