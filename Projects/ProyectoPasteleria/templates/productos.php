<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Dulce Encanto</title>
    <script src="../assets/js/theme.js"></script>
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/productos.css">
    <link rel="icon" type="image/png" sizes="100x100" href="../assets/images/logo/Dulce_Encanto_Logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <?php include '../includes/socials.php'; ?>


    <section class="container py-5">
        <h1 class="text-center mb-4">Nuestra Dulce Selección</h1>
        <p class="text-center lead mb-5">Descubre nuestros exquisitos productos artesanales</p>

        <!-- Filtros -->
        <div class="filtros-container sticky-top py-3 shadow-sm mb-4" style="background-color: var(--white) !important;">
            <div class="container d-flex flex-wrap gap-2 align-items-center">
                <button class="btn btn-outline-accent active" data-categoria="todos">Todos</button>
                <button class="btn btn-outline-accent" data-categoria="Pasteles">Pasteles</button>
                <button class="btn btn-outline-accent" data-categoria="Postres Individuales">Individuales</button>
                <button class="btn btn-outline-accent" data-categoria="Cupcakes">Cupcakes</button>
                <button class="btn btn-outline-accent" data-categoria="Tartas">Tartas</button>
                <button class="btn btn-outline-accent" data-categoria="Otros">Otros</button>
                <button class="btn btn-outline-accent" data-categoria="Especiales de Temporada">Temporada</button>

                <div class="ms-md-auto mt-2 mt-md-0" style="flex-basis: 300px;">
                    <input type="text" class="form-control" placeholder="Buscar por nombre..." id="buscador">
                </div>
            </div>
        </div>

        <!-- Grid de Productos -->
        <div class="row" id="productos-grid">
            <div id="paginacion" class="d-flex justify-content-center mt-4"></div>
            <!-- Los productos se cargarán aquí dinámicamente -->
        </div>
    </section>

    <?php include '../includes/footer.php'; ?>

    <!-- Asegúrate de incluir el script -->
    <script src="../assets/js/productos.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>