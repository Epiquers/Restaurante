<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Grill & Growler</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="body-login">

    <main class="container">
        <div class="row justify-content-center vh-100 align-items-center">
            <div class="col-md-6 col-lg-5">
                
                <div class="caja p-4 shadow-sm">
                    <h1 class="titulo text-center mb-4">Grill & Growler</h1>

                    <h2 class="h4 text-center">Iniciar Sesión</h2>

                    <form action="login.php" method="POST">
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" required>
                        </div>
                        <div class="mb-3">
                            <label for="passwd" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="passwd" name="passwd" required>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Entrar</button>
                            <?php
                            session_start();
                            if (isset($_SESSION['error'])) {
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            }
                            ?>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted">¿Eres cliente y no tienes cuenta?
                            <a href="registro.php">Regístrate aquí</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>