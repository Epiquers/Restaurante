<?php
session_start();
include('../includes/conexion.php'); // Incluimos la conexión

// Comprobamos que el carrito NO esté vacío y que el usuario tenga sesión
if (!empty($_SESSION['pedido']) && isset($_SESSION['dni']) && isset($_SESSION['mesa_id'])) {

    // Recogemos los datos de la sesión
    $dni_cliente = $_SESSION['dni'];
    $id_mesa = $_SESSION['mesa_id']; // Usamos 'mesa_id' de la sesión

    // --- PASO 1: Insertar el pedido principal ---
    // (Usamos estado 0 = pendiente)
    // (Guardamos $id_mesa en la columna 'idm' de la BBDD)
    $consulta_pedido = "INSERT INTO pedidos (usuario, idm, estado, comentario) 
                        VALUES ('$dni_cliente', $id_mesa, 0, '')";
    
    $resultado = mysqli_query($conn, $consulta_pedido);

    if ($resultado) {
        // --- PASO 2: Obtener el ID del pedido que acabamos de crear ---
        $id_pedido_nuevo = mysqli_insert_id($conn);

        // --- PASO 3: Insertar cada producto del carrito ---
        foreach ($_SESSION['pedido'] as $producto) {
            
            $id_producto = $producto['id']; 
            $cantidad = 1; 
            
            // (Tu BBDD no tiene 'notas' en 'pedido_producto', así que las ignoramos)
            $consulta_producto = "INSERT INTO pedido_producto (idped, idprod, cant) 
                                  VALUES ($id_pedido_nuevo, $id_producto, $cantidad)";
            
            mysqli_query($conn, $consulta_producto);
        }

        // --- PASO 4: Limpiar el carrito de la sesión ---
        unset($_SESSION['pedido']);
        
        // Redirigimos a la carta
        header('Location: carta.php?exito=1');
        exit();

    } else {
        // Error al crear el pedido
        header('Location: carta.php');
        exit();
    }

} else {
    // Si entran aquí por error
    header('Location: carta.php');
    exit();
}
?>