<?php
session_start();
//include("seguridad_encargado.php");
include("../includes/conexion.php");

// Cambiamos el estado de los productos a bloqueado
if (isset($_POST['bloquear'])) {
    $idprod = $_POST['idprod'];
    $consulta_bloquear = "UPDATE productos SET estado = '1' WHERE idprod = $idprod";
    mysqli_query($conn, $consulta_bloquear);
}

// Cambiamos el estado de los productos a activo
if (isset($_POST['activar'])) {
    $idprod = $_POST['idprod'];
    $consulta_activar = "UPDATE productos SET estado = '0' WHERE idprod = $idprod";
    mysqli_query($conn, $consulta_activar);
}

// Modificar un producto
if (isset($_POST['modificar'])) {
    $idprod = $_POST['idprod'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $consulta_modificar = "UPDATE productos SET nombre = '$nombre', descripcion='$descripcion', precio='$precio', stock='$stock' WHERE idprod = $idprod";
    mysqli_query($conn, $consulta_modificar);
}

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

    <!-- Incluímos cabecera y navbar -->
    <?php include '../includes/header.php'; ?>
    <?php include 'navbar_encargado.php'; ?>


    <main class="container mt-4 flex-grow-1">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="titulo" style="margin-top: 0; margin-bottom: 0;">Gestión de Productos</h1>
            <button class="btn btn-success" data-bs-toggle="collapse" data-bs-target="#collapseAnadir">
                Añadir Producto
            </button>
        </div>

        <div class="collapse" id="collapseAnadir">
            <div class="caja mb-4">
                <h2>Añadir Nuevo Producto</h2>
                <form action="altas_productos.php" method="POST" enctype="multipart/form-data">
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
                            <th>Estado</th>
                            <th>Modificaciones</th>
                            <th>Bloqueos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("../includes/conexion.php");

                        // Realizamos consulta de la tabla pedido_producto
                        $consulta_productos = "SELECT * FROM productos";
                        $result = mysqli_query($conn, $consulta_productos);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $nombre = $row['nombre'];
                                $descripcion = $row['descripcion'];
                                $precio = $row['precio'];
                                $stock = $row['stock'];
                                $idprod = $row['idprod'];

                                // Guardamos la variable del estado de cada producto, poniendole el estado en que se encuentra
                                if ($row['estado'] == 0) {
                                    $estado = 'Activo';
                                    $color = 'success';
                                    $bloquear = false;
                                } else {
                                    $estado = 'Bloqueado';
                                    $color = 'danger';
                                    $bloquear = true;
                                }
                                echo "<tr>";
                                echo "<td>" . ($nombre) . "</td>";
                                echo "<td>" . ($descripcion) . "</td>";
                                echo "<td>" . number_format($precio, 2) . " €</td>";
                                echo "<td>" . ($stock) . "</td>";
                                echo "<td><span class='badge bg-" . $color . "'>" . ($estado) . "</td>";
                                echo "<td class='text-center'>
                                        <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalModificar$idprod'>
                                            Modificar
                                        </button>
                                    </td>";
                                echo "<td>
                                        <form action='gestion_productos.php' method='POST'>
                                            <input type='hidden' name='idprod' value='$idprod'>";
                                if (!$bloquear) {
                                    echo "<button type='submit' name='bloquear' class='btn btn-danger btn-sm'>Bloquear</button>";
                                } else {
                                    echo "<button type='submit' name='activar' class='btn btn-success btn-sm'>Activar</button>";
                                }
                                echo "</form>
                                        </td>";
                                echo "</tr>";

                                echo "<div class='modal fade' id='modalModificar$idprod' tabindex='-1' aria-labelledby='labelModalModificar$idprod' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content bg-dark text-light'>
                                                <form action='gestion_productos.php' method='POST'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='labelModalModificar$idprod'>Modificar Categoría</h5>
                                                        <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal' aria-label='Cerrar'></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <input type='hidden' name='idprod' value='$idprod'>
                                                        <div class='mb-3'>
                                                            <label class='form-label'>Nombre</label>
                                                            <input type='text' class='form-control' name='nombre' value='$nombre' required>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label class='form-label'>Descripción</label>
                                                            <input type='text' class='form-control' name='descripcion' value='$descripcion' required>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label class='form-label'>Precio</label>
                                                            <input type='text' class='form-control' name='precio' value='$precio' required>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label class='form-label'>Stock</label>
                                                            <input type='text' class='form-control' name='stock' value='$stock' required>
                                                        </div>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                                                        <button type='submit' name='modificar' class='btn btn-primary'>Guardar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    ";
                            }
                        }
                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>