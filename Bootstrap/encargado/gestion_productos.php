<?php
// session_start();
//include("seguridad_encargado.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos - Grill & Growler</title>
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include 'navbar_encargado.php'; ?>


    <main class="container mt-4 flex-grow-1">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="titulo" style="margin-top: 0; margin-bottom: 0;">Gestión de Productos</h1>
            <button class="btn btn-success" data-bs-toggle="collapse" data-bs-target="#collapseAnadir">
                + Añadir Producto
            </button>
        </div>

        <div class="collapse" id="collapseAnadir">
            <div class="caja mb-4">
                <h2>Añadir Nuevo Producto</h2>
                <form action="gestion_productos.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="nombre" class="form-label">Nombre Producto</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="2"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="categoria" class="form-label">Categoría</label>
                            <select class="form-select" id="categoria" name="categoria" required>
                                <?php
                                include("../includes/conexion.php");

                                $consulta = "SELECT * FROM categoria";
                                $result = mysqli_query($conn, $consulta);

                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<option value='" . $row['idc'] . "'>" . $row['nombre'] . "</option>";
                                }
                                mysqli_close($conn);
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="precio" class="form-label">Precio (€)</label>
                            <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="stock" class="form-label">Stock Actual</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>  
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
                </form>
            </div>
        </div>

        <div class="caja">
            <h2>Inventario Actual</h2>
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Hamburguesa "Brasa"</td>
                            <td>Hamburguesas</td>
                            <td>12.50 €</td>
                            <td>50</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Modificar</button>
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td>IPA "Growler"</td>
                            <td>Cervezas</td>
                            <td>5.00 €</td>
                            <td>120</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Modificar</button>
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>
</html>