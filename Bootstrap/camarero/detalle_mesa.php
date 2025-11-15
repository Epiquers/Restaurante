<?php
session_start();
include("seguridad_camarero.php");
include("../includes/conexion.php");

// Guardamos el id enviado por GET
if (isset($_GET['id'])) {
    $id_mesa = $_GET['id'];
}


// Cambiamos el estado de los productos que marca el camarero como servidos
if (isset($_POST['marcar_servido'])) {
    $id_linea = $_POST['id_linea'];
    $consulta_estado = "UPDATE pedido_producto SET estado = '1' WHERE id_linea = $id_linea";
    mysqli_query($conn, $consulta_estado);
}

// Si el camarero pulsa "Generar Cuenta"
if (isset($_POST['pedir_cuenta'])) {
    // LÓGICA DE BBDD:
    // 1. Generar el PDF/Ticket para la $id_mesa
    // 2. Enviar a la impresora de tickets
    // 3. UPDATE mesas SET estado = 'pidiendo_cuenta' WHERE id = $id_mesa
    //...
}

// Si el camarero marca la mesa como "pagada"
if (isset($_POST['marcar_pagada'])) {
    // LÓGICA DE BBDD: 
    // UPDATE mesas SET estado = 'libre', cliente_id = NULL, comensales = 0 WHERE id = $id_mesa
    // UPDATE productos_pedidos SET estado = 'pagado' WHERE mesa_id = $id_mesa (O moverlos a un histórico)
    // ...
    // Y lo redirigimos al panel principal
    header('Location: mesas.php?exito=mesa_liberada');
    exit();
}
//
// 3. CONSULTAR LA BBDD
//
// ¡AHORA TAMBIÉN NECESITAMOS EL ESTADO DE LA MESA!
// $estado_mesa = ... (SELECT estado FROM mesas WHERE id = $id_mesa)
// $productos_pedidos = ... (SELECT * FROM productos_pedidos WHERE ... )
//
// Simulación para el ejemplo (¡RECUERDA BORRAR ESTO Y PONER TU CONSULTA REAL!):
$estado_mesa = 'comiendo'; // (Cambia a 'pidiendo_cuenta' para probar el otro estado)
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
                                mysqli_close($conn);
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">

                <?php
                // --- CÓDIGO CON SINTAXIS ESTÁNDAR (CON LLAVES {}) ---

                // (La variable $estado_mesa se ha obtenido en el PHP de arriba)

                if ($estado_mesa == 'pidiendo_cuenta') {

                    // VISTA 1: Si ya se pidió la cuenta
                    // Mostramos el HTML del botón ROJO (Pagar)
                    echo '
                    <div class="caja">
                        <h2>Cerrar Mesa </h2>
                        <p>La cuenta ya ha sido generada. Pulsa solo cuando el cliente haya pagado.</p>
                        <form action="detalle_mesa.php?id=' . $id_mesa . '" method="POST">
                            <div class="d-grid">
                                <button type="submit" name="marcar_pagada" class="btn btn-danger btn-lg">
                                    Marcar Mesa como Pagada
                                </button>
                            </div>
                        </form>
                    </div>';
                } else {

                    // VISTA 2: Si la mesa está normal (comiendo)
                    // Mostramos el HTML del botón NARANJA (Pedir Cuenta)
                    echo '
                    <div class="caja">
                        <h2>Generar Cuenta </h2>
                        <p>El cliente ha pedido la cuenta de viva voz. Pulsa aquí para imprimir el ticket.</p>
                        <form action="detalle_mesa.php?id=' . $id_mesa . '" method="POST">
                            <div class="d-grid">
                                <button type="submit" name="pedir_cuenta" class="btn btn-warning btn-lg">
                                    Generar Cuenta y Ticket
                                </button>
                            </div>
                        </form>
                    </div>';
                } // Fin del else
                ?>

            </div>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>