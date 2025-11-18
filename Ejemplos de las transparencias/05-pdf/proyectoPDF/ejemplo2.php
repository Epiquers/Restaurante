<?php
require_once('vendor/autoload.php');
$mpdf= new \Mpdf\Mpdf([]);
$html ="
<h4>Titulo principal</h4>
<p align='center'><b>Titulo del documento<b></p>
<hr>
<table border=1>
    <th>
        <tr>
            <td>Encabezado 1</td>
            <td>Encabezado 2</td>
        </tr>
    </th>
    <tbody>
    <tr>
        <td>contenido 1</td>
        <td>contenido 2</td>
    </tr>
    </tbody>
</table>
";
$mpdf->writeHtml($html);
$mpdf->Output();
?>