<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit();
}

require_once '../includes/conexion.php';

$id_usuario = $_SESSION["id_usuario"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre     = trim($_POST["nombre"]);
    $apellidos  = trim($_POST["apellidos"]);
    $nacimiento = $_POST["nacimiento"];
    $user       = trim($_POST["user"]);

    if (!empty($_POST["pass"])) {
        $password = $_POST["pass"];
        $sql = "UPDATE usuarios 
                SET nombre = :nombre, 
                    apellidos = :apellidos, 
                    nacimiento = :nacimiento, 
                    user = :user, 
                    pass = :pass 
                WHERE id_usuario = :id_usuario";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":pass", $password);
    } else {
        $sql = "UPDATE usuarios 
                SET nombre = :nombre, 
                    apellidos = :apellidos, 
                    nacimiento = :nacimiento, 
                    user = :user 
                WHERE id_usuario = :id_usuario";
        $stmt = $conn->prepare($sql);
    }

    $stmt->bindParam(":nombre", $nombre);
    $stmt->bindParam(":apellidos", $apellidos);
    $stmt->bindParam(":nacimiento", $nacimiento);
    $stmt->bindParam(":user", $user);
    $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $mensaje = "Datos actualizados exitosamente.";
    } else {
        $mensaje = "Error al actualizar los datos.";
    }
}

$sql = "SELECT nombre, apellidos, nacimiento, user FROM usuarios WHERE id_usuario = :id_usuario";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
$stmt->execute();
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<?php include('../includes/header.php'); ?>


<div class="container">
    <div class="headingUser">
        <h2>Editar Mis Datos</h2>
        <div class="user">
            <p><strong>Usuario:</strong> <?php echo htmlspecialchars($_SESSION['user']); ?></p>
        </div>
    </div>

    <?php
    if (isset($mensaje)) {
        echo "<p>$mensaje</p>";
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dulce Encanto - Editar Usuario</title>
        <link rel="stylesheet" href="../assets/css/admin.css">
    </head>

    <body>
        <form class="form" action="editarUsuario.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="form-control"
                    value="<?php echo htmlspecialchars($user_data['nombre']); ?>" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" class="form-control"
                    value="<?php echo htmlspecialchars($user_data['apellidos']); ?>" required>
            </div>
            <div class="form-group">
                <label for="nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="nacimiento" name="nacimiento" class="form-control"
                    value="<?php echo htmlspecialchars($user_data['nacimiento']); ?>" required>
            </div>
            <div class="form-group">
                <label for="user">Usuario:</label>
                <input type="text" id="user" name="user" class="form-control"
                    value="<?php echo htmlspecialchars($user_data['user']); ?>" required>
            </div>
            <div class="form-group">
                <label for="pass">Nueva Contraseña (dejar en blanco para no cambiar):</label>
                <input type="password" id="pass" name="pass" class="form-control">
            </div>
            <div class="d-inline-flex gap-3">
                <button type="submit" class="btn btn-primary">Actualizar</button><br>
                <a href="admin.php" class="btn btn-secondary">Volver al Inicio</a>
            </div>

        </form>
</div>
</body>

</html>



<?php include('../includes/footer.php'); ?>