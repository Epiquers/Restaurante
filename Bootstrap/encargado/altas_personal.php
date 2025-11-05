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
    if($_POST['rol']==="encargado"){
        $rol = 1;
    }else {
        $rol = 2;
    }

    if ($pass1 !== $pass2) {
        $_SESSION['error'] = true;
        header("LOCATION: gestion_personal.php");
    } else {
        $consulta = "INSERT INTO usuarios (dni,nombre,apellidos,direccion,email,telefono,passwd,rol) 
        VALUES ('$dni','$nombre','$ape','$dir','$email','$tel','$pass1',$rol)";
        // Ejecutamos la sentencia SQL
        mysqli_query($conn, $consulta);
        // Redireccionamos a la web listados (este fichero lo debeis de crar vosotros)
        mysqli_close($conn);
        header("LOCATION:index.php");
    }
}
