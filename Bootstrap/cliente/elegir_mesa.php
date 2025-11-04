<?php
session_start();

// AQUÍ VA TU CÓDIGO DE SEGURIDAD
// 1. Comprobar que el usuario ha iniciado sesión y es 'cliente'
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'cliente') {
   header('Location: ../login.php');
   exit();
}

// 2. ¡LÓGICA CLAVE! (Sprint 2)
// Si el cliente YA tiene una mesa asignada en la sesión, no puede elegir otra.
// Lo mandamos directo a la carta.
if (isset($_SESSION['mesa_id'])) {
   header('Location: carta.php');
   exit();
}

// 3. LÓGICA PARA PROCESAR EL FORMULARIO (Esta es la parte que buscas)
//    Esto solo se ejecuta CUANDO el usuario pulsa el botón (envía por POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['seleccionar_mesa'])) {
    
    $id_mesa = $_POST['mesa'];
    $comensales = $_POST['comensales'];
    
    // --- AQUÍ VA TU LÓGICA DE BBDD ---
    // 1. Comprobar si $id_mesa está realmente 'libre' en la BBDD.
    // $mesa_esta_libre = tu_funcion_de_comprobacion($id_mesa);
    $mesa_esta_libre = true; // (Simulación, debes comprobarlo de verdad)
    
    if ($mesa_esta_libre) {
        // 2. Si está libre:
        //    UPDATE mesas SET estado = 'ocupada', cliente_id = $_SESSION['usuario_id'], comensales = $comensales WHERE id = $id_mesa
        
        // 3. Guardamos la mesa en la sesión del cliente
        $_SESSION['mesa_id'] = $id_mesa; 

        // 4. ¡AQUÍ ESTÁ LA REDIRECCIÓN!
        header('Location: carta.php');
        
        // 5. Es CRUCIAL poner exit() después de una redirección
        exit(); 
    
    } else {
        // 3. Si no está libre:
        $error = "Esa mesa acaba de ser ocupada. Por favor, elige otra.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Mesa - Grill & Growler</title>
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include '../includes/header.php'; ?>

    <main class="container mt-4 flex-grow-1 d-flex align-items-center"> <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6">
                <div class="caja p-4">
                    <h1 class="titulo text-center">¡Bienvenido!</h1>
                    <h2 class="h4 text-center">Elige tu mesa para empezar</h2>
                    
                    <form action="elegir_mesa.php" method="POST" class="mt-4">
                        
                        <div class="mb-3">
                            <label for="mesa" class="form-label">Mesa disponible:</label>
                            <select class="form-select form-select-lg" id="mesa" name="mesa" required>
                                <option value="1">Mesa 1</option>
                                <option value="2">Mesa 2</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                             <label for="comensales" class="form-label">Número de comensales:</label>
                             <input type="number" class="form-control form-control-lg" id="comensales" name="comensales" value="1" min="1" max="10" required>
                        </div>
                        
                        <div class="d-grid mt-4">
                            <button type="submit" name="seleccionar_mesa" class="btn btn-primary btn-lg">
                                Ver la Carta y Empezar Pedido
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>
</html>