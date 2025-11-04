<?php
// session_start();
//
// AQUÍ VA TU CÓDIGO DE SEGURIDAD
// (Comprobar rol de cliente)
//
// AQUÍ VA TU LÓGICA PHP
//
// 1. Lógica para procesar la petición de la cuenta
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmar_cuenta'])) {
//    // AQUÍ VA LA MAGIA (SPRINT 3)
//    $_SESSION['cuenta_pedida'] = true;
// }
//
// 2. Lógica para mostrar la página
// $productos_enviados = ... (Consultar BBDD para la tabla)
// $total_cuenta = ...
// $cuenta_ya_pedida = isset($_SESSION['cuenta_pedida']) && $_SESSION['cuenta_pedida'] == true;
//
// Simulación para el ejemplo:
$cuenta_ya_pedida = false; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de Pedido - Grill & Growler</title>
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include '../includes/header.php'; ?>

    <?php include '../includes/navbar_cliente.php'; ?>


    <main class="container mt-4 flex-grow-1">

        <h1 class="titulo">Resumen de mi Pedido (Mesa <?php /* echo $_SESSION['mesa_id']; */ ?>)</h1>

        <div class="row justify-content-center"> 
            <div class="col-lg-10">
                <div class="caja">

                    <?php if ($cuenta_ya_pedida): ?>
                        <div class="alert alert-success text-center" role="alert">
                            <h4 class="alert-heading">¡Cuenta en Camino!</h4>
                            <p>Hemos recibido tu petición. Un camarero traerá la cuenta a tu mesa en breves instantes.</p>
                            <hr>
                            <p class="mb-0">Gracias por tu visita a Grill & Growler.</p>
                        </div>

                    <?php else: ?>
                        <h2>Total Pedido a la Mesa</h2>
                        <p class="text-muted">Aquí puedes ver todo tu consumo. Cuando estés listo, pulsa el botón para pedir la cuenta.</p>
                        
                        <div class="table-responsive">
                            <table class="table table-dark table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Notas</th>
                                        <th>Estado</th>
                                        <th>Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Costillar BBQ</td>
                                        <td>-</td>
                                        <td><span class="badge bg-success">Servido</span></td>
                                        <td>18.00 €</td>
                                    </tr>
                                    <tr>
                                        <td>Refresco de Cola</td>
                                        <td>Sin hielo</td>
                                        <td><span class="badge bg-success">Servido</span></td>
                                        <td>3.50 €</td>
                                    </tr>
                                     <tr>
                                        <td>Hamburguesa "Brasa"</td>
                                        <td>Sin pepinillos</td>
                                        <td><span class="badge bg-success">Servido</span></td>
                                        <td>12.50 €</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="border-top">
                                        <td colspan="3" class="text-end h5" style="vertical-align: middle;">Total a Pagar:</td>
                                        <td class="h4 text-warning">34.00 €</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div> <hr>
                        
                        <form action="pedido_actual.php" method="POST">
                            <div classs="d-flex justify-content-end">
                                <button type="submit" name="confirmar_cuenta" class="btn btn-warning btn-lg">
                                    Confirmar y Pedir la Cuenta
                                </button>
                            </div>
                        </form>
                        
                    <?php endif; ?>

                </div>
            </div> </div> </main>

    <?php include '../includes/footer.php'; ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>
</html>