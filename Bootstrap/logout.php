<?php
// Iniciamos sesión
session_start();

// Limpiamos todas las variables de sesión
session_unset();

// 3. Destruimos la sesión actual del servidor
session_destroy();

// 4. Redirigimos al usuario a la página de login
header('Location: index.php');
exit();
