<?php
session_start();
include("seguridad_cliente.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de Pedido - Grill & Growler</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Incluímos cabecera y navbar -->
    <?php include '../includes/header.php'; ?>
    <?php include 'navbar_cliente.php'; ?>

    <main class="container mt-4 flex-grow-1">

        <h1 class="titulo">Resumen de mi Pedido (Mesa <?php echo $_SESSION['mesa_id']; ?>)</h1>

        <div class="row justify-content-center mb-5">
            <div class="col-lg-10">
                <div class="caja">

                    <h2>Total Pedido a la Mesa</h2>
                    <p class="text-muted">Aquí puedes ver todo tu consumo.</p>

                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Notas</th>
                                    <th>Estado</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include("../includes/conexion.php");

                                $dni = $_SESSION['dni'];
                                $idped = $_SESSION['idped'];
                                $total = $_SESSION['total'];

                                // Realizamos consulta de la tabla pedido_producto
                                $consulta_pp = "SELECT * FROM pedido_producto WHERE idped=$idped";
                                $result1 = mysqli_query($conn, $consulta_pp);

                                if (mysqli_num_rows($result1) > 0) {
                                    while ($row1 = mysqli_fetch_array($result1)) {
                                        // Hacemos consulta para conseguir el nombre del producto
                                        $idprod=$row1['idprod'];
                                        $consulta_productos = "SELECT * FROM productos WHERE idprod='$idprod'";
                                        $result2 = mysqli_query($conn, $consulta_productos);

                                        $row2 = mysqli_fetch_assoc($result2);
                                        $nombre = $row2['nombre'];
                                        $precio = $row2['precio'];

                                        // Guardamos la variable del estado de cada producto, poniendole el estado en que se encuentra
                                        if($row1['estado']==0){
                                            $estado = 'Pendiente';
                                            $color = 'danger';
                                        }else{
                                            $estado = 'Servido';
                                            $color = 'success';
                                        }
                                        echo "<tr>";
                                            echo "<td>" . ($nombre) . "</td>";
                                            echo "<td>" . ($row1['comentario']) . "</td>";
                                            echo "<td><span class='badge bg-" . $color . "'>" . ($estado) . "</td>";
                                            echo "<td>" . number_format($precio,2) . " €</td>";
                                        echo "</tr>";
                                    }
                                }
                                mysqli_close($conn);
                                ?>
                            </tbody>
                            <tfoot>
                                <tr class="border-top">
                                    <td colspan="3" class="text-end h5" style="vertical-align: middle;">Total a Pagar:</td>
                                    <td class="h4 text-warning"><?php echo number_format($total, 2) . " €"; ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>