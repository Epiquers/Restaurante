<?php
session_start();

// Comprobamos que nos llegan datos
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idprod'])) {

    // Creamos el carrito en la sesión si no existe
    if (!isset($_SESSION['pedido'])) {
        $_SESSION['pedido'] = array();
    }

    // Guardamos los datos del producto en un array
    $lista = array(
        'id' => $_POST['idprod'],
        'nombre' => $_POST['nombre'],
        'notas' => isset($_POST['notas']) ? $_POST['notas'] : '' // Si 'notas' existe, la guarda, si no, guarda ''
    );

    // Añadimos el producto al final del array de la sesión
    $_SESSION['pedido'][] = $lista;
}

// Devolvemos al usuario a la carta
header('Location: carta.php');
exit();
?>