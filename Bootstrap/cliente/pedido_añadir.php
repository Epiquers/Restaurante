<?php
session_start();

// Comprobamos que nos llegan datos
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idprod'])) {

    // Creamos el carrito en la sesión si no existe
    if (!isset($_SESSION['pedido'])) {
        $_SESSION['pedido'] = array();
    }

    // Consultamos stock del producto
    include("../includes/conexion.php");

    $idprod = $_POST['idprod'];

    $consulta_stock = "SELECT * FROM productos WHERE idprod='$idprod'";
    $result = mysqli_query($conn, $consulta_stock);
    $row = mysqli_fetch_assoc($result);

    // Si el stock es 0 redirigimos a carta con error pasado por get
    if ($row['stock'] == 0) {
        header('Location: carta.php?error=1');
        exit();
    } else {
        // Guardamos los datos del producto en un array
        $lista = array(
            'id' => $_POST['idprod'],
            'nombre' => $_POST['nombre'],
            'precio' => $_POST['precio'],
            'notas' => $_POST['notas']
        );

        // Añadimos el producto al final del array 
        $_SESSION['pedido'][] = $lista;

        // Restamos 1 al stock del producto del stock
        $consulta_restar_stock = "UPDATE productos SET stock=stock-1 WHERE idprod='$idprod'";
        $result = mysqli_query($conn, $consulta_restar_stock);
    }

    // Cerramos conexion
    mysqli_close($conn);
}

// Devolvemos al usuario a la carta
header('Location: carta.php');
exit();
