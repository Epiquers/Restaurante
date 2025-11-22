<?php
session_start();
include("seguridad_encargado.php");
include("../includes/conexion.php");

// Cambiamos el estado del personal a bloqueado
if (isset($_POST['bloquear'])) {
    $dni = $_POST['dni'];
    $consulta_bloquear = "UPDATE usuarios SET estado = '1' WHERE dni = '$dni'";
    mysqli_query($conn, $consulta_bloquear);
}

// Cambiamos el estado del personal a activo
if (isset($_POST['activar'])) {
    $dni = $_POST['dni'];
    $consulta_activar = "UPDATE usuarios SET estado = '0' WHERE dni = '$dni'";
    mysqli_query($conn, $consulta_activar);
}

// Modificar un empleado
if (isset($_POST['modificar'])) {
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $consulta_modificar = "UPDATE usuarios SET nombre = '$nombre', apellidos='$apellidos', telefono='$telefono', direccion='$direccion', email='$email' WHERE dni = '$dni'";
    mysqli_query($conn, $consulta_modificar);
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Personal - Grill & Growler</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <?php
    include '../includes/header.php';
    include 'navbar_encargado.php';
    ?>


    <main class="container mt-4 flex-grow-1">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="titulo" style="margin-top: 0; margin-bottom: 0;">Gestión de Personal</h1>
            <button class="btn btn-success" data-bs-toggle="collapse" data-bs-target="#collapseAnadir">
                Añadir Nuevo
            </button>
        </div>

        <div class="collapse" id="collapseAnadir">
            <div class="caja mb-4">
                <h2>Añadir Nuevo Personal</h2>
                <form action="altas_personal.php" method="POST">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" maxlength="9" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" maxlength="9" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select class="form-select" id="rol" name="rol" required>
                                <option value="" disabled selected>Elige un rol...</option>
                                <option value="1">Encargado</option>
                                <option value="2">Camarero</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="pass1" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="pass" name="pass" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Personal</button>
                </form>
            </div>
        </div>
        <div class="caja">
            <h2>Personal Actual</h2>
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>DNI</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Modificaciones</th>
                            <th>Bloqueos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        // Realizamos consulta de la tabla personal
                        $consulta_productos = "SELECT * FROM usuarios WHERE rol=1 OR rol=2 ORDER BY rol";
                        $result = mysqli_query($conn, $consulta_productos);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $nombre = $row['nombre'];
                                $apellidos = $row['apellidos'];
                                $dni = $row['dni'];
                                $telefono = $row['telefono'];
                                $direccion = $row['direccion'];
                                $email = $row['email'];

                                // Guardamos la variable del rol del empleado
                                if ($row['rol'] == 1) {
                                    $rol = "Encargado";
                                } else {
                                    $rol = "Camarero";
                                }

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
                                echo "<td>" . ($apellidos) . "</td>";
                                echo "<td>" . ($dni) . "</td>";
                                echo "<td>" . ($telefono) . "</td>";
                                echo "<td>" . ($direccion) . "</td>";
                                echo "<td>" . ($email) . "</td>";
                                echo "<td>" . ($rol) . "</td>";
                                echo "<td><span class='badge bg-" . $color . "'>" . ($estado) . "</td>";
                                echo "<td class='text-center'>
                                        <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalModificar$dni'>
                                            Modificar
                                        </button>
                                    </td>";
                                echo "<td>
                                        <form action='gestion_personal.php' method='POST'>
                                            <input type='hidden' name='dni' value='$dni'>";
                                if (!$bloquear) {
                                    echo "<button type='submit' name='bloquear' class='btn btn-danger btn-sm'>Bloquear</button>";
                                } else {
                                    echo "<button type='submit' name='activar' class='btn btn-success btn-sm'>Activar</button>";
                                }
                                echo "</form>
                                        </td>";
                                echo "</tr>";

                                echo "<div class='modal fade' id='modalModificar$dni' tabindex='-1' aria-labelledby='labelModalModificar$dni' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content bg-dark text-light'>
                                                <form action='gestion_personal.php' method='POST'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='labelModalModificar$dni'>Modificar Categoría</h5>
                                                        <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal' aria-label='Cerrar'></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <input type='hidden' name='dni' value='$dni'>
                                                        <div class='mb-3'>
                                                            <label class='form-label'>Nombre</label>
                                                            <input type='text' class='form-control' name='nombre' value='$nombre' required>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label class='form-label'>Apellidos</label>
                                                            <input type='text' class='form-control' name='apellidos' value='$apellidos' required>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label class='form-label'>Telefono</label>
                                                            <input type='text' class='form-control' name='telefono' value='$telefono' required>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label class='form-label'>Direccion</label>
                                                            <input type='text' class='form-control' name='direccion' value='$direccion' required>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label class='form-label'>Email</label>
                                                            <input type='text' class='form-control' name='email' value='$email' required>
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