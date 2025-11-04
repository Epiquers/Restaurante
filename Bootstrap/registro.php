<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Grill & Growler</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>

<body class="body-login">

    <main class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">

                <div class="caja p-4 shadow-sm">
                    <h1 class="titulo text-center mb-4">Registro de Cliente</h1>

                    <form action="registro.php" method="POST">
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
                        <div class="col mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="password" class="form-control" id="direccion" name="direccion" required>
                        </div>
                        <div class="col mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="password" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="pass1" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="pass1" name="pass1" required>
                            </div>
                            <div class="col-md-6 mb-3">
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

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success">Registrarme</button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted">¿Ya tienes cuenta?
                            <a href="index.php">Inicia sesión</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>