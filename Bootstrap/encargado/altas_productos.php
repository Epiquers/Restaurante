<?php
// Iniciamos variables de sesión
session_start();
// Estableciendo la conexión
include("../includes/conexion.php");
// Recogida de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];

    $consulta = "INSERT INTO productos (nombre,descripcion,precio,stock,estado,categoria,estado_cat) 
                VALUES ('$nombre','$descripcion','$precio','$stock','0','$categoria','0')";
    // Ejecutamos la sentencia SQL
    mysqli_query($conn, $consulta);

    mysqli_close($conn);
    header("LOCATION:gestion_productos.php");
    exit();
}
?>