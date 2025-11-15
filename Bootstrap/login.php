<?php
session_start();
include("includes/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['dni']) && isset($_POST['passwd'])) {

        // Creo variable con dni del usuario logueado
        $dni = $_POST['dni'];
        $pass = $_POST['passwd'];

        // Creo consulta con los datos del usuario logueado
        $consulta = "SELECT * FROM usuarios WHERE dni='$dni' AND passwd='$pass'";
        $result = mysqli_query($conn, $consulta);
        echo mysqli_error($conn);
        mysqli_close($conn);

        if (mysqli_num_rows($result) == 1) {
            //Usuario registrado
            $row = mysqli_fetch_assoc($result);

            $_SESSION['rol'] = $row['rol'];
            $_SESSION['dni'] = $row['dni'];
            $_SESSION['nombre'] = $row['nombre'];                        

            // Redirigimos según el rol
            switch ($_SESSION['rol']) {
                case 1:
                    header('Location: encargado/gestion_personal.php');
                    exit();
                case 2:
                    header('Location: camarero/mesas.php');
                    exit();
                case 3:
                    header('Location: cliente/elegir_mesa.php');
                    exit();
                default:
                    // Si hay un rol raro, lo mandamos al login
                    header('Location: index.php');
                    exit();
            }
        } else if (mysqli_num_rows($result) > 1) {
            //"Fallo de integridad en la bbdd";
        } else {
            $_SESSION['error'] = "Usuario no registrado o datos incorrecto";
            header('Location: index.php');
            exit();
        }
    }
}
?>