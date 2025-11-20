<?php
// Empezamos la sesión
session_start();

// Iniciamos la conexión
include('../includes/conexion.php');

// Comprobamos que el carrito no esté vacío
if (!empty($_SESSION['pedido'])) {

    // Guardamos variable del dni del usuario
    $dni = $_SESSION['dni'];

    // Obtenemos el id del pedido para poder insertarlo en la tabla pedido_producto
    $consulta_idpedido = "SELECT * FROM pedidos WHERE usuario='$dni' AND estado=0";
    $result = mysqli_query($conn, $consulta_idpedido);

    $row = mysqli_fetch_assoc($result);
    $idped = $row['idped'];

    // Guardamos variable de sesión del idped para usarlo mas adelante
    $_SESSION['idped'] = $idped;

    // Recorremos el carrito 
    foreach ($_SESSION['pedido'] as $producto) {

        // Guardamos los productos del carrito en la tabla pedido_producto
        $idprod = $producto['id'];
        $notas = $producto['notas'];
        $consulta_producto = "INSERT INTO pedido_producto (idped, idprod, comentario, estado) 
                                  VALUES ('$idped', '$idprod', '$notas', '0')";

        mysqli_query($conn, $consulta_producto);       
        
    }
    mysqli_close($conn);

    // Redirigimos al ticket de cocina
    header('Location: tickets/generar_ticket.php?idp=' . $idped);
    exit();
} else {
    // Si alguien entra a este archivo sin productos o sin sesión
    header('Location: carta.php');
    exit();
}
