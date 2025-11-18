<?php
  require_once('vendor/autoload.php');
  include("conexion.php");   
  $mpdf= new \Mpdf\Mpdf([


    ]);
function selectTabla($conn){
  
  //creamos la sentencia SQL
  $consulta="select * from platos";

  $result = mysqli_query($conn ,$consulta);

  //Imprimos el error si se ha producido. mysql_error siempre va a mostrar el error de la última función mysql ejecutada
  echo mysqli_error($conn);
  $tabla="";
  $tabla .= "<table border=1 align='center'>
              <tr>
                <th>IMAGEN</th>
                <th>NOMBRE</th>
                <th>DESCRIPCION</th>
              </tr>
            ";
  while($row = mysqli_fetch_array($result))
  {
    $tabla .="<tr>
                <td align='center'><img src=".$row['imagen']." width='50' height='50'></td>
                <td align='center'>".$row['nombre']."</td>
                <td align='center'>".$row['descripcion']."</td>
              </tr>";

            }
  $tabla .= "</table>";        
  mysqli_close($conn);
  return $tabla;
}
  $html="<style> 
  body {
    background-image: url('imagen/textura.jpg');
    background-color: #cccccc;
  }
  </style>";
  $html.= "<h1 align='center'>PLATOS DEL MENÚ VEGA MEDIA</h1>";
  $html .=selectTabla($conn);
  $mpdf->writeHtml($html);
  $mpdf->Output();


?>