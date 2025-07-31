<?php
require '../includes/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST["username"]);
    $pass = trim($_POST["password"]);

    $sql = "SELECT id_usuario, pass FROM usuarios WHERE user = :user";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":user", $user);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && $pass) {
        session_start();
        $_SESSION["id_usuario"] = $usuario["id_usuario"];
        $_SESSION["user"] = $user;
        header("Location: admin.php");
        echo "Login exitoso.";
        exit();
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}

include('../includes/header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dulce Encanto - Iniciar Sesión</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>
    <section class="login-form">
        <div class="container">
            <h2 class="iniciarSesion">Iniciar sesión</h2>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group contrasena">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="d-inline-flex gap-3 mt-4 align-items-center">
                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                    <a href="registro.php">¿No tienes cuenta? Regístrate Aquí</a>
                </div>
            </form>
        </div>
    </section>
</body>

</html>



<?php include('../includes/footer.php'); ?>