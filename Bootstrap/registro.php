
<?php
session_start();
include("includes/conexion.php");

// Recogida de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dni'])) {
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if ($pass1 !== $pass2) {
        $_SESSION['error'] = true;
    } else {
        $consulta = "INSERT INTO usuarios (dni,nombre,apellidos,direccion,email,telefono,passwd,rol) 
        VALUES ('$dni','$nombre','$apellidos','$direccion','$email','$telefono','$pass1',3)";
        // Ejecutamos la sentencia SQL
        mysqli_query($conn, $consulta);
        // Redireccionamos a la web listados (este fichero lo debeis de crar vosotros)
        mysqli_close($conn);
        header("LOCATION:index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Grill & Growler</title>
    <link rel="icon" type="../image/x-icon" href="img/LogoBG.png">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>

<body class="body-login">

    <main class="container">
        <div class="row justify-content-center vh-100 align-items-center">
            <div class="col-md-7 col-lg-6">

                <div class="caja p-4 shadow-sm">
                    <h1 class="titulo text-center mb-4">Registro de Cliente</h1>

                    
                    <form action="registro.php" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php if(isset($nombre)) echo $nombre ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php if(isset($apellidos)) echo $apellidos ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="dni" class="form-label">DNI</label>
                                <input type="text" class="form-control" id="dni" name="dni" maxlength="9" value="<?php if(isset($dni)) echo $dni ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="9" value="<?php if(isset($telefono)) echo $telefono ?>" required>
                            </div>
                        </div>
                        <div class="col mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php if(isset($direccion)) echo $direccion ?>" required>
                        </div>
                        <div class="col mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php if(isset($email)) echo $email ?>" required>
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
                            // Si las contraseñas no coinciden se muestra un error 
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
                        <p><a href="index.php">Volver al inicio</a></p>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>