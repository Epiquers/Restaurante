<?php
session_start();
include("seguridad_camarero.php");
include("../includes/conexion.php");

// Guardamos el id enviado por GET
if (isset($_GET['id'])) {
    $id_mesa = $_GET['id'];
}

// Declaramos la variable del estado de pedido que hace que se muestre el botón de pedir cuenta o pagar
if(!isset($_SESSION['estado_pedido' . $id_mesa])) {
    $_SESSION['estado_pedido' . $id_mesa]=0;
}

// Cambiamos el estado de los productos que marca el camarero como servidos
if (isset($_POST['marcar_servido'])) {
    $id_linea = $_POST['id_linea'];
    $consulta_estado_producto = "UPDATE pedido_producto SET estado = '1' WHERE id_linea = $id_linea";
    mysqli_query($conn, $consulta_estado_producto);
}

// Cuando se pide la cuenta
if (isset($_POST['pedir_cuenta'])) {
    $id_mesa = $_POST['id_mesa'];
    $idped = $_POST['idped'];
    $_SESSION['estado_pedido' . $id_mesa] = 1;
    header("Location: tickets/generar_ticket.php?idm=" . $id_mesa . "&idp=" . $idped);
    exit();
}

// Cuando el cliente paga la cuenta
if (isset($_POST['marcar_pagada'])) {
    $id_mesa = $_POST['id_mesa'];
    // Liberamos la mesa
    $consulta_pagado = "UPDATE mesas SET estado = '0' WHERE idm = $id_mesa";
    mysqli_query($conn, $consulta_pagado);

    // Cambiamos el estado de la reserva a terminada
    $consulta_actualizar_reserva = "UPDATE reservas SET estado = '1' WHERE idm = $id_mesa";
    mysqli_query($conn, $consulta_actualizar_reserva);

    // Cambiamos el estado del pedido a pagado
    $consulta_pedidos = "UPDATE pedidos SET estado = '1' WHERE idm = $id_mesa AND estado = 0";
    mysqli_query($conn, $consulta_pedidos);

    $_SESSION['estado_pedido' . $id_mesa]=0;

    header('Location: mesas.php');
    exit();
}

$estado_pedido = $_SESSION['estado_pedido' . $id_mesa];

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Mesa <?php echo $id_mesa; ?> - Grill & Growler</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include '../includes/header.php'; ?>

    <?php include 'navbar_camarero.php'; ?>


    <main class="container mt-4 flex-grow-1">

        <div class="d-flex justify-content-between align-items-center">
            <h1 class="titulo" style="margin-top:0; margin-bottom: 20px;">
                Gestionando Mesa <?php echo $id_mesa; ?>
            </h1>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="caja mb-5">
                    <h2>Productos Pedidos</h2>
                    <p class="text-muted">Marcar los productos como "servidos" a medida que se entregan.</p>

                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Notas</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include("../includes/conexion.php");

                                // Variables de sesión
                                // Consulta para ver los comensales de cada mesa reservada activa
                                $consulta_pedidos = "SELECT * FROM pedidos WHERE idm='$id_mesa' AND estado='0'";
                                $result3 = mysqli_query($conn, $consulta_pedidos);
                                echo mysqli_error($conn);
                                $row3 = mysqli_fetch_array($result3);
                                $idped = $row3['idped'];

                                // Realizamos consulta de la tabla pedido_producto
                                $consulta_pp = "SELECT * FROM pedido_producto WHERE idped=$idped";
                                $result1 = mysqli_query($conn, $consulta_pp);

                                if (mysqli_num_rows($result1) > 0) {
                                    while ($row1 = mysqli_fetch_array($result1)) {
                                        // Hacemos consulta para conseguir el nombre del producto
                                        $idprod = $row1['idprod'];
                                        $id_linea = $row1['id_linea'];
                                        $consulta_productos = "SELECT * FROM productos WHERE idprod='$idprod'";
                                        $result2 = mysqli_query($conn, $consulta_productos);

                                        $row2 = mysqli_fetch_assoc($result2);
                                        $nombre = $row2['nombre'];

                                        // Guardamos la variable del estado de cada producto, poniendole el estado en que se encuentra
                                        if ($row1['estado'] == 0) {
                                            $estado = 'Pendiente';
                                            $color = 'danger';
                                            $servido = false;
                                        } else {
                                            $estado = 'Servido';
                                            $color = 'success';
                                            $servido = true;
                                        }
                                        echo "<tr>";
                                        echo "<td>" . ($nombre) . "</td>";
                                        echo "<td>" . ($row1['comentario']) . "</td>";
                                        echo "<td><span class='badge bg-" . $color . "'>" . ($estado) . "</td>";
                                        echo "<td>
                                                <form action='detalle_mesa.php?id=" . $id_mesa . "' method='POST'>
                                                <input type='hidden' name='id_linea' value='$id_linea'>";
                                        if (!$servido) {
                                            echo "<button type='submit' name='marcar_servido' class='btn btn-success btn-sm'>Marcar Servido</button>";
                                        } else {
                                            echo "<button type='submit' name='marcar_servido' class='btn btn-danger btn-sm' disabled>Servido</button>";
                                        }

                                        echo "</form>
                                            </td>";
                                        echo "</tr>";
                                    }
                                }

                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">

                <?php


                if ($estado_pedido == '0') {
                    echo '
                    <div class="caja">
                        <h2>Generar Cuenta </h2>
                        <p>El cliente ha pedido la cuenta. Pulsa aquí para imprimir el ticket.</p>
                        <form action="detalle_mesa.php" method="POST">
                            <input type="hidden" name="id_mesa" value="' . $id_mesa . '">
                            <input type="hidden" name="idped" value="' . $idped . '">
                            <div class="d-grid">
                                <button type="submit" name="pedir_cuenta" class="btn btn-warning btn-lg">
                                    Generar Cuenta y Ticket
                                </button>
                            </div>
                        </form>
                    </div>';
                } else {
                    echo '
                    <div class="caja">
                        <h2>Cerrar Mesa </h2>
                        <p>La cuenta ya ha sido generada. Pulsa solo cuando el cliente haya pagado.</p>
                        <form action="detalle_mesa.php" method="POST">
                            <input type="hidden" name="id_mesa" value="' . $id_mesa . '">
                            <div class="d-grid">
                                <button type="submit" name="marcar_pagada" class="btn btn-danger btn-lg">
                                    Marcar Mesa como Pagada
                                </button>
                            </div>
                        </form>
                    </div>';
                }
                // Cerramos conexión con base de datos
                mysqli_close($conn);
                ?>

            </div>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>