<?php
// session_start();
//
// AQUÍ VA TU CÓDIGO DE SEGURIDAD
// (Comprobar rol de camarero)
//
// 1. OBTENER EL ID DE LA MESA DESDE LA URL (GET)
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_mesa = $_GET['id'];
} else {
    // Si no hay ID válido, lo mandamos de vuelta al panel
    header('Location: mesas.php?error=no_mesa');
    exit();
}
//
// 2. LÓGICA PHP (PROCESAR ACCIONES POST)
//
// Si el camarero marca un producto como "servido"
if (isset($_POST['marcar_servido'])) {
    $id_producto_pedido = $_POST['id_producto_pedido'];
    // LÓGICA DE BBDD: UPDATE productos_pedidos SET estado = 'servido' WHERE id = $id_producto_pedido
    //...
}

// Si el camarero marca la mesa como "pagada"
if (isset($_POST['marcar_pagada'])) {
    // LÓGICA DE BBDD: UPDATE mesas SET estado = 'libre', cliente_id = NULL WHERE id = $id_mesa
    // ...
    // Y lo redirigimos al panel principal
    header('Location: mesas.php?exito=mesa_liberada');
    exit();
}
//
// 3. CONSULTAR LA BBDD
// (Obtener los productos pedidos por $id_mesa)
// $productos_pedidos = ...
//
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Mesa <?php echo $id_mesa; ?> - Grill & Growler</title>
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include '../includes/header.php'; ?>

    <?php include '../includes/navbar_camarero.php'; ?>


    <main class="container mt-4 flex-grow-1">

        <div class="d-flex justify-content-between align-items-center">
            <h1 class="titulo" style="margin-top:0; margin-bottom: 20px;">
                Gestionando Mesa <?php echo $id_mesa; ?>
            </h1>
            <a href="mesas.php" class="btn btn-secondary">Volver al Panel</a>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="caja">
                    <h2>Productos Pedidos</h2>
                    <p class="text-muted">Marcar los productos como "servidos" a medida que se entregan (Sprint 2).</p>
                    
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Notas</th>
                                    <th>Estado</th>
                                    <th>Acción (usando POST)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Hamburguesa "Brasa"</td>
                                    <td>Sin pepinillos</td>
                                    <td><span class="badge bg-warning">Pedido</span></td>
                                    <td>
                                        <form action="detalle_mesa.php?id=<?php echo $id_mesa; ?>" method="POST">
                                            <input type="hidden" name="id_producto_pedido" value="101">
                                            <button type="submit" name="marcar_servido" class="btn btn-success btn-sm">Marcar Servido</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td>IPA "Growler"</td>
                                    <td>-</td>
                                    <td><span class="badge bg-success">Servido</span></td>
                                    <td><span class="text-muted">- Ya servido -</span></td>
                                </tr>
                                 <tr>
                                    <td>Costillar BBQ</td>
                                    <td>-</td>
                                    <td><span class="badge bg-warning">Pedido</span></td>
                                    <td>
                                        <form action="detalle_mesa.php?id=<?php echo $id_mesa; ?>" method="POST">
                                            <input type="hidden" name="id_producto_pedido" value="102">
                                            <button type="submit" name="marcar_servido" class="btn btn-success btn-sm">Marcar Servido</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <div class="col-lg-4">
                <div class="caja">
                    <h2>Cerrar Mesa (Sprint 3)</h2>
                    <p>Cuando el cliente haya pagado, pulsa este botón para liberar la mesa.</p>
                    <form action="detalle_mesa.php?id=<?php echo $id_mesa; ?>" method="POST">
                        <div class="d-grid">
                            <button type="submit" name="marcar_pagada" class="btn btn-danger btn-lg">
                                Marcar Mesa como Pagada
                            </button>
                        </div>
                    </form>
                </div>
            </div> </div> </main>

    <?php include '../includes/footer.php'; ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>
</html>