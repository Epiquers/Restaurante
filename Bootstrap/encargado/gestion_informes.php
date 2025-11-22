<?php
session_start();
include('seguridad_encargado.php');

if (isset($_SESSION['fecha_inicio'])) {
    $fecha_inicio = $_SESSION['fecha_inicio'];
    $fecha_fin = $_SESSION['fecha_fin'];
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Informes - Grill & Growler</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body class="d-flex flex-column min-vh-100">

    <?php
    include '../includes/header.php';
    include 'navbar_encargado.php';
    ?>

    <main class="container mt-4 flex-grow-1">
        <h1 class="titulo">Informe de Comensales e Ingresos</h1>

        <form action="logica_informes.php" method="POST" class="row g-3 mb-4">
            <div class="col-md-4">
                <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" value="<?php echo $fecha_inicio; ?>" required />
            </div>
            <div class="col-md-4">
                <label for="fecha_fin" class="form-label">Fecha Fin</label>
                <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" value="<?php echo $fecha_fin; ?>" required />
            </div>
            <div class="col-md-4 align-self-end">
                <button type="submit" class="btn btn-primary">Generar Informe</button>
            </div>
        </form>

        <div class="caja">
            <h2>Resultados</h2>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th style="text-align: center;">Total Comensales</th>
                        <th style="text-align: center;">Total Ingresos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Mostramos mensaje de que no hay datos si no los hay en esas fechas
                    if (isset($_SESSION['error'])) {
                        echo "<tr>";
                        echo "<td colspan ='3' class='alert text-danger pb-0'>No hay informes de esas fechas..</td>";
                        echo "</tr>";
                        unset($_SESSION['error']);
                    } else {
                        if (isset($_SESSION['informe'])) {
                            // Recorremos el informe
                            foreach ($_SESSION['informe'] as $indice => $datos) {
                                echo "<tr>";
                                echo "<td>" . $datos['fecha'] . "</td>";
                                echo "<td align='center'>" . $datos['comensales'] . "</td>";
                                echo "<td align='center'>" . number_format($datos['ingresos'], 2) . " €</td>";
                                echo "</tr>";
                            }
                            unset($_SESSION['informe']);
                            unset($_SESSION['fecha_inicio']);
                            unset($_SESSION['fecha_fin']);  
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>


    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>