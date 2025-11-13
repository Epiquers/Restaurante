<?php
session_start();
// include("seguridad_camarero.php");
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

            $consulta = "SELECT * FROM mesas";
            $result = mysqli_query($conn, $consulta);
            echo mysqli_error($conn);

            while ($row = mysqli_fetch_array($result)) {
                $estado=$row['estado'];
                $mesa=$row['idm'];
                switch ($estado){
                    case 0: 
                        echo '<div class="col-md-4 col-lg-3 mb-4">
                                <div class="caja text-center border border-success">
                                    <h2 class="h4">Mesa ' . $mesa . '</h2>
                                    <p class="h5 fw-bold text-success">LIBRE</p>
                                </div>
                            </div>'; break;
                    case 1:
                        echo '<div class="col-md-4 col-lg-3 mb-4">
                                <a href="detalle_mesa.php?id='. $mesa .'" class="text-decoration-none">
                                <div class="caja text-center border border-danger">
                                    <h2 class="h4">Mesa ' . $mesa . '</h2>
                                    <p class="h5 fw-bold text-danger">OCUPADA</p>
                                    <small class="text-muted">Comensales: ' . $_SESSION['comensales'] . '</small><br>
                                    
                                </div>
                                </a>
                            </div>'; break;
                }
            }
            mysqli_close($conn);
            ?>
        </div>

        <!--<div class="row">
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="caja text-center border border-success">
                    <h2 class="h4">Mesa 1</h2>
                    <p class="h5 fw-bold text-success">LIBRE</p>
                </div>
            </div>

            <div class="col-md-4 col-lg-3 mb-4">
                <a href="detalle_mesa.php?id=2" class="text-decoration-none">
                    <div class="caja text-center border border-danger">
                        <h2 class="h4">Mesa 2</h2>
                        <p class="h5 fw-bold text-danger">OCUPADA</p>
                        <small class="text-muted">Comensales: 4</small><br>
                        <small class="text-warning">Pedido pendiente</small>
                    </div>
                </a>
            </div>

            <div class="col-md-4 col-lg-3 mb-4">
                <a href="detalle_mesa.php?id=3" class="text-decoration-none">
                    <div class="caja text-center border border-info">
                        <h2 class="h4">Mesa 3</h2>
                        <p class="h5 fw-bold text-info">COMIENDO</p>
                        <small class="text-muted">Comensales: 2</small><br>
                        <small class="text-info">Todo servido</small>
                    </div>
                </a>
            </div>

            <div class="col-md-4 col-lg-3 mb-4">
                <a href="detalle_mesa.php?id=4" class="text-decoration-none">
                    <div class="caja text-center border border-warning bg-warning text-dark">
                        <h2 class="h4">Mesa 4</h2>
                        <p class="h5 fw-bold">PIDIENDO CUENTA</p>
                        <small>Comensales: 5</small><br>
                        <small>Total: 120.50€</small>
                    </div>
                </a>
            </div>
        </div>-->
    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>