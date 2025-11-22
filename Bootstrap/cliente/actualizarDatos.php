<?php
// Iniciamos variables de sesión
session_start();
// Estableciendo la conexión
include("../includes/conexion.php");
// Recogida de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dni = $_SESSION['dni'];

    if (isset($_POST['dni'])) {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];

        $consulta1 = "UPDATE usuarios
                    SET nombre = '$nombre',
                        apellidos = '$apellidos',
                        direccion = '$direccion',
                        telefono = '$telefono',
                        email = '$email'
                    WHERE dni = '$dni'";

        // Ejecutamos la sentencia SQL
        mysqli_query($conn, $consulta1);
    }

    if (isset($_POST['pass_actual'])) {
        $pass1 = $_POST['pass_actual']; // Contraseña antigua que mete el usuario
        $pass2 = $_POST['pass_nueva'];  // Contraseña nueva
        $passwd = $_POST['passwd'];     // Contraseña antigua

        if ($pass1 !== $passwd) {
            $_SESSION['error'] = true;
            header("LOCATION: perfil.php");
            exit();
        } else {
            $consulta2 = "UPDATE usuarios
                        SET passwd = '$pass2'   
                        WHERE dni = '$dni'";
            // Ejecutamos la sentencia SQL
            mysqli_query($conn, $consulta2);
        }
    }
}

// Redireccionamos a perfil
mysqli_close($conn);
header("LOCATION:perfil.php");
exit();

?>