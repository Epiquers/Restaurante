<?php
session_start();

// Comprobamos que nos llega el 'id' por la URL
if (isset($_GET['id'])) {
    
    // El 'id' es la posición en el array
    $id = $_GET['id'];

    // Si esa posición existe en el carrito, la borramos
    if (isset($_SESSION['pedido'][$id])) {
        unset($_SESSION['pedido'][$id]);
    }
}

// Volvemos a la carta
header('Location: carta.php');
exit();
?>