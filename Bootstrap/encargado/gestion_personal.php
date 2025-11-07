<?php
// session_start();
//include("seguridad_encargado.php");
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

    <?php
    include '../includes/header.php';
    include 'navbar_encargado.php';
    ?>


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
                <form action="altas_personal.php" method="POST">
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
                        <div class="col-md-6 mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="password" class="form-control" id="direccion" name="direccion" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="password" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select class="form-select" id="rol" name="rol" required>
                                <option value="" disabled selected>Elige un rol...</option>
                                <option value="encargado">Encargado</option>
                                <option value="camarero">Camarero</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="pass1" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="pass1" name="pass1" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="pass2" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="pass2" name="pass2" required>
                        </div>
                        <?php
                        if (isset($_SESSION['error'])) {
                            echo "<div class='text-danger small mt-1'>Las contraseñas no coinciden..</div>";
                            unset($_SESSION['error']);
                        }
                        ?>
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
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>DNI</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Bloquear</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Juan</td>
                            <td>Pérez</td>
                            <td>12345678A</td>
                            <td>675675675</td>
                            <td>C/ perico</td>
                            <td>pepe@gmail.com</td>
                            <td>Camarero</td>
                            <td>
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