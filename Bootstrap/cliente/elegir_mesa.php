<?php
session_start();
include("seguridad_cliente.php");

// Si el cliente YA tiene una mesa asignada en la sesión lo mandamos directo a la carta.
if (isset($_SESSION['mesa_id'])) {
    header('Location: carta.php');
    exit();
}

// Asignamos variable de sesión y enviamos a carta
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['seleccionar_mesa'])) {

    $id_mesa = $_POST['mesa'];
    $comensales = $_POST['comensales'];
    $dni = $_SESSION['dni'];

    // Iniciamos la conexión
    include("../includes/conexion.php");

    // Cambiamos estado de la mesa a ocupada
    $consulta_mesa = "UPDATE mesas SET estado=1 WHERE idm=$id_mesa";
    mysqli_query($conn, $consulta_mesa);

    // Realizamos la reserva
    $consulta_reserva = "INSERT INTO reservas (usuario, idm, comensales) VALUES ('$dni','$id_mesa','$comensales')";
    mysqli_query($conn, $consulta_reserva);

    // Insertamos los datos del pedido
    $consulta_pedido = "INSERT INTO pedidos (usuario, estado, idm) VALUES ('$dni', 0, '$id_mesa')";
    $result = mysqli_query($conn, $consulta_pedido);

    // Guardamos el id del pedido, el nº de mesa y los comensales en la sesión del cliente
    $_SESSION['mesa_id'] = $id_mesa;
    $_SESSION['comensales'] = $comensales;
    $consulta_idped = "SELECT * FROM pedidos WHERE usuario='$dni' AND estado='0'";
    $result = mysqli_query($conn, $consulta_idped);
    $row = mysqli_fetch_array($result);
    $_SESSION['idped'] = $row['idped'];

    // Cerramos la conexión
    mysqli_close($conn);

    // Redireccionamos a la carta
    header('Location: carta.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Mesa - Grill & Growler</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Incluímos cabecera y navbar -->
    <?php
    include('../includes/header.php');
    include("navbar_mesas.php");
    ?>

    <main class="container mt-4 flex-grow-1 d-flex align-items-center">
        <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6">
                <div class="caja p-4">
                    <h1 class="titulo text-center">¡Bienvenido!</h1>
                    <h2 class="h4 text-center">Elige tu mesa para empezar</h2>

                    <form action="elegir_mesa.php" method="POST" class="mt-4">

                        <div class="mb-3">
                            <label for="mesa" class="form-label">Mesa disponible:</label>
                            <select class="form-select form-select-lg" id="mesa" name="mesa" required>
                                <?php
                                include("../includes/conexion.php");

                                $consulta_mesalibre = "SELECT * FROM mesas WHERE estado=0";
                                $result = mysqli_query($conn, $consulta_mesalibre);

                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<option value='" . $row['idm'] . "'>Mesa " . $row['idm'] . "</option>";
                                }
                                mysqli_close($conn);
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="comensales" class="form-label">Número de comensales:</label>
                            <input type="number" class="form-control form-control-lg" id="comensales" name="comensales" value="1" min="1" max="10" required>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" name="seleccionar_mesa" class="btn btn-primary btn-lg">
                                Ver la Carta y Empezar Pedido
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>