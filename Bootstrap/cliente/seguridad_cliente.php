<?php
// Comprobamos que el usuario ha iniciado sesión y su rol es'3' (camarero)
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != '3') {
   header('Location: ../index.php');
   exit();
}
?>