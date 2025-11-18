<?php
session_start();
require_once('vendor/autoload.php');
$mpdf = new \Mpdf\Mpdf([]);

// Iniciamos la conexión
include("../../includes/conexion.php");
$idped = $_SESSION['idped'];
$dni = $_SESSION['dni'];
$precio_final = 0;

// Consulta fecha del pedido
$consulta_fecha = "SELECT *
                    FROM pedidos
                    WHERE idped = '$idped'";
$result1 = mysqli_query($conn, $consulta_fecha);  
$row1 = mysqli_fetch_array($result1);            
$fecha = $row1['fechaHora'];

// Consulta datos cliente
$consulta_cliente = "SELECT *
                    FROM usuarios
                    WHERE dni = '$dni'";
$result3 = mysqli_query($conn, $consulta_cliente);  
$row3 = mysqli_fetch_array($result3);            
$nombre = $row3['nombre'];
$apellidos = $row3['apellidos'];


$html = "
<h1 align='center' style='text-decoration: underline;'>Grill & Growler</h1>
<br>
<p><b>Fecha y hora:</b> " . $fecha . "</p>
<p><b>Cliente:</b> " . $nombre . " " . $apellidos . "</p>
<hr>
<table border='none' cellpadding='5' cellspacing='0' width='100%'>
    <thead>
        <tr style='background: beige;'>
            <th style='padding-bottom: 10px; padding-top: 10px;' align='left'>Producto</th>
            <th style='padding-bottom: 10px; padding-top: 10px'>Cantidad</th>
            <th style='padding-bottom: 10px; padding-top: 10px' align='right'>Precio_unidad</th>
            <th style='padding-bottom: 10px; padding-top: 10px' align='right'>P. Total</th>
        </tr>
    </thead>
    <tbody>
";

$consulta_pedido = "SELECT 
                        p.nombre,
                        COUNT(*) AS cantidad,
                        p.precio,
                        COUNT(*) * p.precio AS total
                    FROM pedido_producto pp, productos p
                    WHERE pp.idprod = p.idprod
                    AND pp.idped = '$idped'
                    GROUP BY p.nombre, p.precio";
$result2 = mysqli_query($conn, $consulta_pedido);
while ($row2 = mysqli_fetch_array($result2)){
    $html .= "<tr>
                <td style='padding-top: 10px;'>" . $row2['nombre'] . "</td>
                <td style='padding-top: 10px;' align='center'>" . $row2['cantidad'] . "</td>
                <td style='padding-top: 10px;' align='right'>" . number_format($row2['precio'], 2) . " €</td>
                <td style='padding-top: 10px;' align='right'>" . number_format($row2['total'], 2) . " €</td>
            </tr>";
    $precio_final += $row2['total'];
}

$html .= "
    </tbody>
</table>
<hr>
<p align='right'><b>Total: " . number_format($precio_final, 2) . " €</b></p>
";
$mpdf->WriteHTML($html);
$mpdf->Output();
  
?>
