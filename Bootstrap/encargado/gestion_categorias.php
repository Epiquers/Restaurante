<?php
session_start();
include("seguridad_encargado.php");
include("../includes/conexion.php");

// 1. Lógica para AÑADIR una nueva categoría
if (isset($_POST['guardar_categoria'])) {
    $nombre = $_POST['nombre_categoria'];
    $consulta_insertar = "INSERT INTO categoria (nombre, estado) VALUES ('$nombre', '0')";
    mysqli_query($conn, $consulta_insertar);
}

// Cambiamos el estado de la categorias a bloqueado
if (isset($_POST['bloquear'])) {
    $idc = $_POST['idc'];
    $consulta_bloquear = "UPDATE categoria SET estado = '1' WHERE idc = $idc";
    mysqli_query($conn, $consulta_bloquear);

    // Cambio el estado de la categoria en los productos
    $consulta_productos  = "UPDATE productos SET estado_cat = '1' WHERE categoria='$idc'";
    mysqli_query($conn, $consulta_productos);
}

// Cambiamos el estado de la categorias a activo
if (isset($_POST['activar'])) {
    $idc = $_POST['idc'];
    $consulta_activar = "UPDATE categoria SET estado = '0' WHERE idc = $idc";
    mysqli_query($conn, $consulta_activar);

    // Cambio el estado de la categoria en los productos
    $consulta_productos  = "UPDATE productos SET estado_cat = '0' WHERE categoria='$idc'";
    mysqli_query($conn, $consulta_productos);
}

// Modificar una categoría
if (isset($_POST['modificar'])) {
    $idc = $_POST['idc'];
    $nombre = $_POST['nombre'];
    $consulta_modificar = "UPDATE categoria SET nombre = '$nombre' WHERE idc = $idc";
    mysqli_query($conn, $consulta_modificar);
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías - Grill & Growler</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Incluímos cabecera y navbar -->
    <?php include '../includes/header.php'; ?>

    <?php include 'navbar_encargado.php'; ?>


    <main class="container mt-4 flex-grow-1">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="titulo" style="margin-top: 0; margin-bottom: 0;">Gestión de Categorías</h1>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAñadirCategoria">
                Añadir Categoría
            </button>
        </div>

        <div class="modal fade" id="modalAñadirCategoria" tabindex="-1" aria-labelledby="labelModalAñadir" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-dark text-light">
                    <form action="gestion_categorias.php" method="POST">

                        <div class="modal-header border-0">
                            <h5 class="modal-title" id="labelModalAñadir">Añadir Nueva Categoría</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nombre_categoria" class="form-label">Nombre de la Categoría</label>
                                <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" required>
                            </div>
                        </div>

                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="guardar_categoria" class="btn btn-primary">Guardar Categoría</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="caja">
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre de la Categoría</th>
                            <th>Estado</th>
                            <th class='text-center'>Modificaciones</th>
                            <th class="text-end">Bloqueos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("../includes/conexion.php");

                        // Realizamos consulta de la tabla categoría
                        $consulta_categoria = "SELECT * FROM categoria";
                        $result = mysqli_query($conn, $consulta_categoria);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                // Hacemos consulta para conseguir el nombre del producto
                                $idc = $row['idc'];
                                $nombre = $row['nombre'];

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
                                echo "<td>" . ($idc) . "</td>";
                                echo "<td>" . ($nombre) . "</td>";
                                echo "<td><span class='badge bg-" . $color . "'>" . ($estado) . "</td>";
                                echo "<td class='text-center'>
                                        <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalModificar$idc'>
                                            Modificar
                                        </button>
                                    </td>";
                                echo "<td class='text-end'>
                                        <form action='gestion_categorias.php' method='POST'>
                                            <input type='hidden' name='idc' value='$idc'>";
                                            if (!$bloquear) {
                                                echo "<button type='submit' name='bloquear' class='btn btn-danger btn-sm'>Bloquear</button>";
                                            } else {
                                                echo "<button type='submit' name='activar' class='btn btn-success btn-sm'>Activar</button>";
                                            }
                                echo "</form>
                                        </td>";

                                echo "</tr>";

                                echo "<div class='modal fade' id='modalModificar$idc' tabindex='-1' aria-labelledby='labelModalModificar$idc' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content bg-dark text-light'>
                                                <form action='gestion_categorias.php' method='POST'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='labelModalModificar$idc'>Modificar Categoría</h5>
                                                        <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal' aria-label='Cerrar'></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <input type='hidden' name='idc' value='$idc'>
                                                        <div class='mb-3'>
                                                            <label class='form-label'>Nombre</label>
                                                            <input type='text' class='form-control' name='nombre' value='$nombre' required>
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
            </div>
            </tbody>
            </table>
        </div>
        </div>

    </main>


    <?php include '../includes/footer.php'; ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>