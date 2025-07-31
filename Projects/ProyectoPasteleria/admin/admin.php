<?php
    session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }

    require '../includes/conexion.php';
    include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dulce Encanto - Admin</title>
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <h1>¡Bienvenido Pastelero, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
    <div class="botonesAdmin">
        <a href="editarUsuario.php" class="btn btn-primary">Editar mi Usuario</a>
        <a href="listarRecetas.php" class="btn btn-primary">Ver Recetas</a>
        <a href="listarFabricacion.php" class="btn btn-primary">Ver Fabricacion</a>
        <a href="logout.php" class="btn btn-accent">Cerrar Sesión</a>
        
    </div>
</body>
</html>

<?php include '../includes/footer.php'; ?>