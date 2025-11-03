<?php
// session_start();
// ... (Tu código de seguridad y lógica PHP) ...
//
// 1. Comprobar si el cliente tiene mesa asignada.
//    Si no tiene: redirigir a "elegir_mesa.php"
//    Si tiene: cargar la carta
//
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta - Grill & Growler</title>
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include '../includes/navbar_cliente.php'; ?>


    <main class="container mt-4 flex-grow-1">

        <div class="row">
        
            <div class="col-lg-8">
                <h1 class="titulo">Nuestra Carta</h1>
                
                <form action="carta.php" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar hamburguesa, cerveza, parrilla..." name="busqueda">
                        <button class="btn btn-outline-primary" type="submit">Buscar</button>
                    </div>
                </form>

                <div class="caja mb-4">
                    <h2 class="border-bottom pb-2">Hamburguesas</h2>
                    
                    <div class="row mb-3 align-items-center">
                        <div class="col-3 col-md-2">
                             </div>
                        <div class="col-9 col-md-10">
                            <div class="d-flex justify-content-between">
                                <h4 class="h5 mb-0">Hamburguesa "Brasa"</h4>
                                <span class="h5 text-warning">12.50 €</span>
                            </div>
                            <p class="text-muted small">Doble carne, queso cheddar, bacon crujiente y salsa G&G.</p>
                            <form action="pedido_add.php" method="POST">
                                <input type="hidden" name="producto_id" value="1">
                                <div class="input-group">
                                    <input type="text" name="notas" class="form-control form-control-sm" placeholder="Notas (ej: sin pepinillos)">
                                    <button type="submit" class="btn btn-primary btn-sm">Añadir</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>

                <div class="caja mb-4">
                    <h2 class="border-bottom pb-2">Cervezas</h2>
                    <div class="row mb-2 align-items-center">
                        <div class="col-9">
                            <h4 class="h5 mb-0">IPA "Growler"</h4>
                            <p class="text-muted small mb-0">Nuestra IPA de la casa. 6.5% Alc.</p>
                        </div>
                        <div class="col-3 text-end">
                            <span class="h5 text-warning d-block">5.00 €</span>
                             <form action="pedido_add.php" method="POST">
                                <input type="hidden" name="producto_id" value="2">
                                <button type="submit" class="btn btn-primary btn-sm">Añadir</button>
                            </form>
                        </div>
                    </div>
                    </div>
                
            </div> <div class="col-lg-4">
                <div class="caja sticky-top" style="top: 80px;"> <h2 class="h4">Mi Pedido (Mesa 3)</h2>
                    
                    <p class="text-muted">Aún no has añadido nada a esta ronda.</p>
                    
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <strong>Hamburguesa "Brasa"</strong><br>
                            <small class="text-muted">Notas: Sin pepinillos</small>
                        </div>
                         <a href="pedido_remove.php?id=1" class="btn btn-danger btn-sm">X</a>
                    </div>
                     <div class="d-flex justify-content-between align-items-center mb-2">
                        <div><strong>IPA "Growler"</strong></div>
                         <a href="pedido_remove.php?id=2" class="btn btn-danger btn-sm">X</a>
                    </div>
                    
                    <hr>
                    
                    <div class="d-grid">
                        <button class="btn btn-success btn-lg">Enviar Pedido a Cocina</button>
                    </div>
                </div>
            </div> </div> </main>

    <?php include '../includes/footer.php'; ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>
</html>