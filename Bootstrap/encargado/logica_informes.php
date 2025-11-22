<?php
session_start();
include('seguridad_encargado.php');
include('../includes/conexion.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recogemos datos
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $Comprobar_fecha = 0;

    $informe = [];

    // Consulta pedidos pagados en rango fechas
    $consulta_pedidos = "SELECT idped, fechaHora 
                        FROM pedidos 
                        WHERE estado=1 AND fechaHora BETWEEN '$fecha_inicio 00:00:00' AND '$fecha_fin 23:59:59' ORDER BY fechaHora";
    $result_pedidos = mysqli_query($conn, $consulta_pedidos);


    if (mysqli_num_rows($result_pedidos) > 0) {
        while ($row1 = mysqli_fetch_assoc($result_pedidos)) {
            $idped = $row1['idped'];
            $fecha = substr($row1['fechaHora'], 0, 10);

            if ($comprobar_fecha != $fecha) {
                $comprobar_fecha = $fecha;
                // Consulta ingresos
                $consulta_ingresos = "SELECT SUM(p.precio) AS total_ingresos
                                FROM pedidos ped, pedido_producto pp, productos p
                                WHERE ped.idped = pp.idped
                                AND pp.idprod = p.idprod
                                AND ped.estado = 1
                                AND DATE(ped.fechaHora) = '$fecha'";
                $result_ingresos = mysqli_query($conn, $consulta_ingresos);
                $row2 = mysqli_fetch_assoc($result_ingresos);
                $ingresos = $row2['total_ingresos'];

                // Consulta conmensales
                $consulta_comensales = "SELECT SUM(comensales) AS total_comensales
                            FROM reservas 
                            WHERE DATE(fechaHora) = '$fecha' AND estado=1";
                $result_comensales = mysqli_query($conn, $consulta_comensales);
                $row3 = mysqli_fetch_assoc($result_comensales);
                $comensales = $row3['total_comensales'];

                // Guardamos los datos en el array del informe
                $informe[] = [
                    'fecha' => $fecha,
                    'ingresos' => $ingresos,
                    'comensales' => $comensales,
                ];
            }
        }
    } else {
        $_SESSION['error'] = true;
        header('Location: gestion_informes.php');
        exit();
    }


    // Guardar datos y fechas en sesión para mostrar en pagina informes.php
    $_SESSION['informe'] = $informe;
    $_SESSION['fecha_inicio'] = $fecha_inicio;
    $_SESSION['fecha_fin'] = $fecha_fin;
}


// Redirigir de vuelta a la página de informes
header('Location: gestion_informes.php');
exit();
