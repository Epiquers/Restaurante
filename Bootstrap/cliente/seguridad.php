<?php
// Comprobamos que el usuario ha iniciado sesión y es 'cliente'
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'cliente') {
   header('Location: ../index.php');
   exit();
}
?>