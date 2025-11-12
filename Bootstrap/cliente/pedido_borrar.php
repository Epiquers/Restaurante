<?php
session_start();

// Comprobamos que nos llega el id por la URL
if (isset($_GET['id'])) {
    
    $id = $_GET['id'];

    // Si existe, borramos esa posición del carrito
    if (isset($_SESSION['pedido'][$id])) {
        unset($_SESSION['pedido'][$id]);
    }
}

// Volvemos a la carta
header('Location: carta.php');
exit();
?>