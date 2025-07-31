<?php
session_start();
require_once '../includes/conexion.php';
include('../includes/header.php');
?>

<div class="container">
    <h2>Listado de Recetas</h2>
    <a href="admin.php" class="btn btn-primary">Volver al Inicio</a>
    <?php
    $sql = "SELECT * FROM recetas";
    $stmt = $conn->query($sql);
    $recetas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($recetas) > 0) {
        echo '<div class="recetas-listado">';
        foreach($recetas as $receta) {
            echo '<div class="receta">';
            echo '<h3>' . htmlspecialchars($receta['titulo']) . '</h3>';
            echo '<p><strong>Ingredientes:</strong> ' . htmlspecialchars($receta['ingredientes']) . '</p>';
            echo '<p><strong>Preparación:</strong> ' . htmlspecialchars($receta['como_se_hace']) . '</p>';
            echo '<p><strong>Dificultad:</strong> ' . htmlspecialchars($receta['dificultad']) . '</p>';
            echo '<img src="' . htmlspecialchars($receta['imagen']) . '" alt="' . htmlspecialchars($receta['titulo']) . '" style="max-width:200px;">';
            echo '</div>';  
        }
        echo '</div>';
    } else {
        echo '<p>No hay recetas para mostrar.</p>';
    }
    ?>
</div>

<?php include('../includes/footer.php'); ?>