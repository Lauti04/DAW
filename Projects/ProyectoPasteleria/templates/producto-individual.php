<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto Individual - Dulce Encanto</title>
    <script src="../assets/js/theme.js"></script>
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="icon" type="image/png" sizes="100x100" href="../assets/images/logo/Dulce_Encanto_Logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
<?php include '../includes/header.php'; ?>
<?php include '../includes/socials.php'; ?>

    <section class="container py-5">
        <div class="row" id="detalle-producto">
            <!-- Contenido dinámico se cargará aquí -->
        </div>
    </section>

    <section class="container py-5 bg-light px-5 rounded rela">
        <h3 class="mb-4" style="color: var(--dark-text) !important;">Productos Relacionados</h3>
        <div class="row" id="productos-relacionados">
            <!-- Productos de la misma categoría -->
        </div>
    </section>

    <?php include '../includes/footer.php'; ?>
    <script src="../assets/js/productos.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/css/productos.css">
</body>

</html>