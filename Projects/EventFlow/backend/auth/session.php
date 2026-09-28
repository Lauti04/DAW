<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    // Redirige al formulario de login. La raíz de la app se deduce de la URL pedida
    // (frontend/ o backend/), así funciona desde cualquier carpeta y con cualquier nombre.
    $root = preg_replace('#/(frontend|backend)/.*$#', '', $_SERVER['SCRIPT_NAME'] ?? '');
    header('Location: ' . $root . '/frontend/login_view.php');
    exit;
}
?>
