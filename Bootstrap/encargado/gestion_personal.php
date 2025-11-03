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
            <h1 class="titulo" style="margin-top: 0; margin-bottom: 0;">Gestión de Personal</h1>
            <button class="btn btn-success" data-bs-toggle="collapse" data-bs-target="#collapseAnadir">
                + Añadir Nuevo
            </button>
        </div>

        <div class="collapse" id="collapseAnadir">
            <div class="caja mb-4">
                <h2>Añadir Nuevo Personal</h2>
                <form action="gestion_personal.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edad" class="form-label">Edad</label>
                            <input type="number" class="form-control" id="edad" name="edad" required>
                        </div>
                         <div class="col-md-4 mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select class="form-select" id="rol" name="rol" required>
                                <option value="camarero">Camarero</option>
                                <option value="encargado">Encargado</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                         <div class="col-md-6 mb-3">
                            <label for="pass" class="form-label">Contraseña Provisional</label>
                            <input type="password" class="form-control" id="pass" name="pass" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Personal</button>
                </form>
            </div>
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