<?php
// Iniciamos variables de sesión
session_start();
// Estableciendo la conexión
include("includes/conexion.php");
// Recogida de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $ape = $_POST['apellidos'];
    $dir = $_POST['direccion'];
    $email = $_POST['email'];
    $tel = $_POST['telefono'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if ($pass1 !== $pass2) {
        $_SESSION['error'] = true;
        header("LOCATION: registro.php");
        exit();
    } else {
        $consulta = "INSERT INTO usuarios (dni,nombre,apellidos,direccion,email,telefono,passwd,rol) 
        VALUES ('$dni','$nombre','$ape','$dir','$email','$tel','$pass1',3)";
        // Ejecutamos la sentencia SQL
        mysqli_query($conn, $consulta);
        // Redireccionamos a la web listados (este fichero lo debeis de crar vosotros)
        mysqli_close($conn);
        header("LOCATION:index.php");
        exit();
    }
}
