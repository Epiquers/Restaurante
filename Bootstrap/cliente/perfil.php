<?php
session_start();
include("seguridad_cliente.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Grill & Growler</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Incluímos cabecera y navbar -->
    <?php include '../includes/header.php';

    if (isset($_SESSION['mesa_id'])) {
        include 'navbar_cliente.php';
    } else {
        include 'navbar_mesas.php';
    }

    ?>


    <main class="container mt-4 flex-grow-1">

        <h1 class="titulo">Mi Perfil y Facturas</h1>

        <div class="row">

            <div class="col-lg-6">

                <div class="caja mb-4">
                    <h2>Datos Personales</h2>
                    <form action="perfil.php" method="POST">
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" value="12345678A" readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="Juan">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="Pérez García">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="juan.perez@email.com">
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" value="600123456">
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección (para facturas)</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="Calle Falsa, 123">
                        </div>
                        <button type="submit" name="guardar_datos" class="btn btn-primary">Guardar Datos</button>
                    </form>
                </div>

                <div class="caja mb-4">
                    <h2>Cambiar Contraseña</h2>
                    <form action="perfil.php" method="POST">
                        <div class="mb-3">
                            <label for="pass_actual" class="form-label">Contraseña Actual</label>
                            <input type="password" class="form-control" id="pass_actual" name="pass_actual" required>
                        </div>
                        <div class="mb-3">
                            <label for="pass_nueva" class="form-label">Contraseña Nueva</label>
                            <input type="password" class="form-control" id="pass_nueva" name="pass_nueva" required>
                        </div>
                        <button type="submit" name="cambiar_pass" class="btn btn-warning">Actualizar Contraseña</button>
                    </form>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="caja">
                    <h2>Historial de Facturas</h2>
                    <p class="text-muted">Aquí puedes ver todos tus pedidos anteriores.</p>

                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha y Hora</th>
                                    <th>Total Pagado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include("../includes/conexion.php");

                                $dni = $_SESSION['dni'];

                                // Realizamos consulta de la tabla pedidos
                                $consulta_pedidos = "SELECT * FROM pedidos WHERE usuario='$dni'";
                                $result1 = mysqli_query($conn, $consulta_pedidos);

                                if (mysqli_num_rows($result1) > 0) {
                                    while ($row1 = mysqli_fetch_array($result1)) {
                                        $total = 0;
                                        // Hacemos consulta para conseguir el nombre del producto
                                        $idped = $row1['idped'];
                                        $fecha = $row1['fechaHora'];
                                        $consulta_pp = "SELECT SUM(p.precio) AS total
                                                        FROM pedido_producto pp, productos p
                                                        WHERE pp.idprod = p.idprod
                                                        AND pp.idped = '$idped'";   
                                        $result2 = mysqli_query($conn, $consulta_pp);
                                        while ($row2 = mysqli_fetch_array($result2)) {
                                            $total = $row2['total'];
                                        }


                                        echo "<tr>";
                                        echo "<td>" . ($fecha) . "</td>";
                                        echo "<td>" . number_format($total, 2) . " €</td>";
                                        echo "<td>
                                                <a href='PDF/factura.php?id=" . $idped . "' class='btn btn-primary btn-sm'>Ver PDF</a>
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
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>