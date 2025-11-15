<?php
// Iniciamos variables de sesión
session_start();
// Estableciendo la conexión
include("../includes/conexion.php");
// Recogida de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $pass = $_POST['pass'];
    $rol = $_POST['rol'];

    $consulta = "INSERT INTO usuarios (dni,nombre,apellidos,direccion,email,telefono,passwd,rol,estado) 
        VALUES ('$dni','$nombre','$apellidos','$direccion','$email','$telefono','$pass',$rol,'0')";
    // Ejecutamos la sentencia SQL
    mysqli_query($conn, $consulta);
    // Redireccionamos a la web listados (este fichero lo debeis de crar vosotros)
    mysqli_close($conn);
    header("LOCATION:gestion_personal.php");
    exit();
}
