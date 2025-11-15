<?php
 // Iniciamos sesión
    session_start();
    
    // Si el usuario es cliente y tiene mesa asignada no se borran las variables de sesión
    if ($_SESSION['rol'] == 3 && isset($_SESSION['mesa_id'])) {
            header('Location: index.php');
            exit();
        
    } else {
    // Limpiamos todas las variables de sesión
    session_unset();

    // Destruimos la sesión actual del servidor
    session_destroy();

    // Redirigimos al usuario a la página de login
    header('Location: index.php');
    exit();
}
?>