<?php
// 1. Iniciar la sesión para poder acceder a ella
session_start();

// 2. Limpiar todas las variables de sesión (opcional, pero buena práctica)
//    Esto borra los datos como $_SESSION['rol'], $_SESSION['usuario_id'], etc.
session_unset();

// 3. Destruir la sesión actual del servidor
session_destroy();

// 4. Redirigir al usuario a la página de login
header('Location: login.php?exito=sesion_cerrada');
exit(); // Asegura que el script se detiene después de la redirección
?>