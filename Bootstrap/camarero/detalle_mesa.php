<?php
session_start();
// include("seguridad_camarero.php");

// 1. OBTENER EL ID DE LA MESA DESDE LA URL (GET)
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_mesa = $_GET['id'];
} else {
    // Si no hay ID válido, lo mandamos de vuelta al panel
    header('Location: mesas.php?error=no_mesa');
    exit();
}

// 2. LÓGICA PHP (PROCESAR ACCIONES POST)
//
// Si el camarero marca un producto como "servido"
if (isset($_POST['marcar_servido'])) {
    $id_producto_pedido = $_POST['id_producto_pedido'];
    // LÓGICA DE BBDD: UPDATE productos_pedidos SET estado = 'servido' WHERE id = $id_producto_pedido
    //...
}

// Si el camarero pulsa "Generar Cuenta"
if (isset($_POST['pedir_cuenta'])) {
    // LÓGICA DE BBDD:
    // 1. Generar el PDF/Ticket para la $id_mesa
    // 2. Enviar a la impresora de tickets
    // 3. UPDATE mesas SET estado = 'pidiendo_cuenta' WHERE id = $id_mesa
    //...
}

// Si el camarero marca la mesa como "pagada"
if (isset($_POST['marcar_pagada'])) {
    // LÓGICA DE BBDD: 
    // UPDATE mesas SET estado = 'libre', cliente_id = NULL, comensales = 0 WHERE id = $id_mesa
    // UPDATE productos_pedidos SET estado = 'pagado' WHERE mesa_id = $id_mesa (O moverlos a un histórico)
    // ...
    // Y lo redirigimos al panel principal
    header('Location: mesas.php?exito=mesa_liberada');
    exit();
}
//
// 3. CONSULTAR LA BBDD
//
// ¡AHORA TAMBIÉN NECESITAMOS EL ESTADO DE LA MESA!
// $estado_mesa = ... (SELECT estado FROM mesas WHERE id = $id_mesa)
// $productos_pedidos = ... (SELECT * FROM productos_pedidos WHERE ... )
//
// Simulación para el ejemplo (¡RECUERDA BORRAR ESTO Y PONER TU CONSULTA REAL!):
$estado_mesa = 'comiendo'; // (Cambia a 'pidiendo_cuenta' para probar el otro estado)
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

    <?php include 'navbar_camarero.php'; ?>


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
                    <p class="text-muted">Marcar los productos como "servidos" a medida que se entregan.</p>
                    
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <div class="col-lg-4">
                
                <?php
                // --- CÓDIGO CON SINTAXIS ESTÁNDAR (CON LLAVES {}) ---
                
                // (La variable $estado_mesa se ha obtenido en el PHP de arriba)
                
                if ($estado_mesa == 'pidiendo_cuenta') {
                    
                    // VISTA 1: Si ya se pidió la cuenta
                    // Mostramos el HTML del botón ROJO (Pagar)
                    echo '
                    <div class="caja">
                        <h2>Cerrar Mesa (Sprint 3)</h2>
                        <p>La cuenta ya ha sido generada. Pulsa solo cuando el cliente haya pagado.</p>
                        <form action="detalle_mesa.php?id=' . $id_mesa . '" method="POST">
                            <div class="d-grid">
                                <button type="submit" name="marcar_pagada" class="btn btn-danger btn-lg">
                                    Marcar Mesa como Pagada
                                </button>
                            </div>
                        </form>
                    </div>';

                } else {
                    
                    // VISTA 2: Si la mesa está normal (comiendo)
                    // Mostramos el HTML del botón NARANJA (Pedir Cuenta)
                    echo '
                    <div class="caja">
                        <h2>Generar Cuenta (Sprint 3)</h2>
                        <p>El cliente ha pedido la cuenta de viva voz. Pulsa aquí para imprimir el ticket.</p>
                        <form action="detalle_mesa.php?id=' . $id_mesa . '" method="POST">
                            <div class="d-grid">
                                <button type="submit" name="pedir_cuenta" class="btn btn-warning btn-lg">
                                    Generar Cuenta y Ticket
                                </button>
                            </div>
                        </form>
                    </div>';
                    
                } // Fin del else
                ?>

            </div> </div> </main>

    <?php include '../includes/footer.php'; ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>
</html>