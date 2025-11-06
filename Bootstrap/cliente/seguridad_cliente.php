<?php
// Comprobamos que el usuario ha iniciado sesión y es '3'
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != '3') {
   header('Location: ../index.php');
   exit();
}
?>