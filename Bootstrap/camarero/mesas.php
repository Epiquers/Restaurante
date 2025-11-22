<?php
session_start();
include("seguridad_camarero.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Mesas - Grill & Growler</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include '../includes/header.php'; ?>

    <?php include 'navbar_camarero.php'; ?>


    <main class="container mt-4 flex-grow-1">

        <h1 class="titulo">Estado de las Mesas</h1>

        <div class="row">
            <?php
            include("../includes/conexion.php");

            // Consulta para ver las meses que hay
            $consulta_mesa = "SELECT * FROM mesas";
            $result1 = mysqli_query($conn, $consulta_mesa);
            echo mysqli_error($conn);

            while ($row1 = mysqli_fetch_array($result1)) {
                $estado = $row1['estado'];
                $idm = $row1['idm'];

                // Consulta para ver los comensales de cada mesa reservada
                $consulta_reserva = "SELECT * FROM reservas WHERE idm='$idm' AND estado='0'";
                $result2 = mysqli_query($conn, $consulta_reserva);
                echo mysqli_error($conn);
                $row2 = mysqli_fetch_array($result2);
                if (isset($row2['comensales']))
                    $comensales = $row2['comensales'];

                switch ($estado) {
                    case 0:
                        echo '<div class="col-md-4 col-lg-3 mb-4">
                                <div class="caja text-center border border-success">
                                    <h2 class="h4">Mesa ' . $idm . '</h2>
                                    <p class="h5 fw-bold text-success">LIBRE</p>
                                </div>
                            </div>';
                        break;
                    case 1:
                        echo '<div class="col-md-4 col-lg-3 mb-4">
                                <a href="detalle_mesa.php?id=' . $idm . '" class="text-decoration-none">
                                <div class="caja text-center border border-danger">
                                    <h2 class="h4">Mesa ' . $idm . '</h2>
                                    <p class="h5 fw-bold text-danger">OCUPADA</p>
                                    <small class="text-muted">Comensales: ' . $comensales . '</small><br>
                                    
                                </div>
                                </a>
                            </div>';
                        break;
                }
            }
            mysqli_close($conn);
            ?>
        </div>

    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>