<?php
session_start();
include("seguridad_encargado.php");
include("../includes/conexion.php");

// Cambiamos el estado de los clientes a bloqueado
if (isset($_POST['bloquear'])) {
    $dni = $_POST['dni'];
    $consulta_bloquear = "UPDATE usuarios SET estado = '1' WHERE dni = '$dni'";
    mysqli_query($conn, $consulta_bloquear);
}

// Cambiamos el estado de los clientes a activo
if (isset($_POST['activar'])) {
    $dni = $_POST['dni'];
    $consulta_activar = "UPDATE usuarios SET estado = '0' WHERE dni = '$dni'";
    mysqli_query($conn, $consulta_activar);
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

    <!-- Incluímos cabecera y navbar -->
    <?php include '../includes/header.php'; ?>

    <?php include 'navbar_encargado.php'; ?>


    <main class="container mt-4 flex-grow-1">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="titulo" style="margin-top: 0; margin-bottom: 0;">Gestión de Clientes</h1>
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
                            <th>Estado</th>
                            <th>Bloqueos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        // Realizamos consulta de la tabla personal
                        $consulta_productos = "SELECT * FROM usuarios WHERE rol=3";
                        $result = mysqli_query($conn, $consulta_productos);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $nombre = $row['nombre'];
                                $apellidos = $row['apellidos'];
                                $dni = $row['dni'];
                                $telefono = $row['telefono'];
                                $direccion = $row['direccion'];
                                $email = $row['email'];

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
                                echo "<td><span class='badge bg-" . $color . "'>" . ($estado) . "</td>";                                
                                echo "<td>
                                        <form action='gestion_clientes.php' method='POST'>
                                            <input type='hidden' name='dni' value='$dni'>";
                                if (!$bloquear) {
                                    echo "<button type='submit' name='bloquear' class='btn btn-danger btn-sm'>Bloquear</button>";
                                } else {
                                    echo "<button type='submit' name='activar' class='btn btn-success btn-sm'>Activar</button>";
                                }
                                echo "</form>
                                        </td>";
                                echo "</tr>";
                                
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