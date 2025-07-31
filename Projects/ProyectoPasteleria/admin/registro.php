<?php
require '../includes/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $apellidos = trim($_POST["apellidos"]);
    $nacimiento = $_POST["nacimiento"];
    $user = trim($_POST["username"]);
    $pass = trim($_POST["password"]); 

    $sqlCheck = "SELECT id_usuario FROM usuarios WHERE user = :user";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bindParam(":user", $user);
    $stmtCheck->execute();

    if ($stmtCheck->rowCount() > 0) {
        echo "El nombre de usuario ya está en uso.";
    } else {
        $sql = "INSERT INTO usuarios (nombre, apellidos, nacimiento, user, pass) 
                VALUES (:nombre, :apellidos, :nacimiento, :user, :pass)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":apellidos", $apellidos);
        $stmt->bindParam(":nacimiento", $nacimiento);
        $stmt->bindParam(":user", $user);
        $stmt->bindParam(":pass", $pass);

        if ($stmt->execute()) {
            header("Location: login.php?registro=exito"); 
            exit();
        } else {
            echo "Error en el registro.";
        }
    }
}

include('../includes/header.php');  
?>

<section class="registro-form mt-5">
    <div class="container">
        <h2>Registrarse</h2>
        <form action="registro.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nacimiento">Fecha de nacimiento</label>
                <input type="date" id="nacimiento" name="nacimiento" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="d-inline-flex gap-3 mt-4 align-items-center">
                <button type="submit" class="btn btn-primary">Registrarse</button>
                <a href="login.php">¿Ya tienes cuenta? Inicia Sesión Aquí</a>
            </div>
        </form>
    </div>
</section>

<link rel="stylesheet" href="../assets/css/admin.css">

<?php include('../includes/footer.php'); ?>