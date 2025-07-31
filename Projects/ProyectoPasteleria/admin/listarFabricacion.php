<?php
session_start();
require_once '../includes/conexion.php';
include('../includes/header.php');
?>

<link rel="stylesheet" href="../assets/css/admin.css">
<style>
    footer{
        position: static !important;
    }
</style>
<div class="container">
    <div class="headingUser">
        <h2>Listado de Productos Fabricados</h2>
        <div class="user"><p><strong>Usuario:</strong> <?php echo htmlspecialchars($_SESSION['user']); ?></p></div>
    </div>
    <a href="admin.php" class="btn btn-secondary">Volver al Inicio</a>


    <?php
    $sql = "SELECT f.*, r.titulo, r.imagen 
            FROM fabricacion f 
            JOIN recetas r ON f.id_receta = r.id_receta 
            ORDER BY f.fecha DESC";
    $stmt = $conn->query($sql);
    $fabricaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($fabricaciones) > 0) {
        echo '<div class="fabricacion-listado">';
        foreach($fabricaciones as $producto) {
            echo '<div class="fabricacion">';
            echo '<h3>Producto: ' . htmlspecialchars($producto['titulo']) . '</h3>';
            echo '<p><strong>Fecha de Fabricación:</strong> ' . htmlspecialchars($producto['fecha']) . '</p>';
            echo '<p><strong>Caducidad:</strong> ' . htmlspecialchars($producto['caducidad']) . '</p>';
            echo '<img src="' . htmlspecialchars($producto['imagen']) . '" alt="' . htmlspecialchars($producto['titulo']) . '" style="max-width:200px;">';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p>No hay productos fabricados para mostrar.</p>';
    }
    ?>
</div>

<!-- <?php include('../includes/footer.php'); ?> -->
