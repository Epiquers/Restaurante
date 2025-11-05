<?php
// session_start();
// ... (Tu código de seguridad y lógica PHP) ...
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Personal - Grill & Growler</title>
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include '../includes/navbar_encargado.php'; ?>


    <main class="container mt-4 flex-grow-1">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="titulo" style="margin-top: 0; margin-bottom: 0;">Gestión de Clientes</h1>
        </div>

        <div class="caja">
            <h2>Personal Actual</h2>
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>(imagen)</td>
                            <td>Juan Pérez</td>
                            <td>12345678A</td>
                            <td>Camarero</td>
                            <td><span class="badge bg-success">Activo</span></td>
                            <td>
                                <button class="btn btn-warning btn-sm">Modificar</button>
                                <button class="btn btn-danger btn-sm">Suspender</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>
</html>