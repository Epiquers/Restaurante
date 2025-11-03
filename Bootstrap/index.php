<?php
session_start();

// Comprobamos si el usuario ya ha iniciado sesión
if (isset($_SESSION['usuario_id']) && isset($_SESSION['rol'])) {
    
    // Redirigimos según el rol
    switch ($_SESSION['rol']) {
        case 'encargado':
            header('Location: encargado/gestion_personal.php'); // O la página principal del encargado
            exit();
        case 'camarero':
            header('Location: camarero/mesas.php');
            exit();
        case 'cliente':
            header('Location: cliente/carta.php'); // O la página de elegir mesa
            exit();
        default:
            // Si hay un rol raro, lo mandamos al login
            header('Location: login.php?error=rol_invalido');
            exit();
    }

} else {
    // Si no hay sesión, lo mandamos siempre al login
    header('Location: login.php');
    exit();
}
?>