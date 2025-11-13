<?php
session_start();

// Comprobamos que nos llega el id por la URL
if (isset($_GET['id'])) {
    
    $id = $_GET['id'];
    $idprod = $_GET['idprod'];

    // Si existe, borramos esa posición del carrito
    if (isset($_SESSION['pedido'][$id])) {
        unset($_SESSION['pedido'][$id]);

        // Sumamos 1 al stock del producto eliminado
        include("../includes/conexion.php");

        $consulta_sumar_stock = "UPDATE productos SET stock=stock+1 WHERE idprod='$idprod'";
        $result = mysqli_query($conn, $consulta_sumar_stock);

        mysqli_close($conn);
    }
}

// Volvemos a la carta
header('Location: carta.php');
exit();
?>