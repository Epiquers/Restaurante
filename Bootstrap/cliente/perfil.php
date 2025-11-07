<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Grill & Growler</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include '../includes/header.php'; ?>

    <?php include 'navbar_cliente.php'; ?>


    <main class="container mt-4 flex-grow-1">

        <h1 class="titulo">Mi Perfil y Facturas</h1>

        <div class="row">

            <div class="col-lg-6">

                <div class="caja mb-4">
                    <h2>Datos Personales</h2>
                    <form action="perfil.php" method="POST">
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" value="12345678A" readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="Juan">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="Pérez García">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="juan.perez@email.com">
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" value="600123456">
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección (para facturas)</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="Calle Falsa, 123">
                        </div>
                        <button type="submit" name="guardar_datos" class="btn btn-primary">Guardar Datos</button>
                    </form>
                </div>

                <div class="caja mb-4">
                    <h2>Cambiar Contraseña</h2>
                    <form action="perfil.php" method="POST">
                        <div class="mb-3">
                            <label for="pass_actual" class="form-label">Contraseña Actual</label>
                            <input type="password" class="form-control" id="pass_actual" name="pass_actual" required>
                        </div>
                        <div class="mb-3">
                            <label for="pass_nueva" class="form-label">Contraseña Nueva</label>
                            <input type="password" class="form-control" id="pass_nueva" name="pass_nueva" required>
                        </div>
                        <button type="submit" name="cambiar_pass" class="btn btn-warning">Actualizar Contraseña</button>
                    </form>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="caja">
                    <h2>Historial de Facturas</h2>
                    <p class="text-muted">Aquí puedes ver todos tus pedidos anteriores (Sprint 3).</p>

                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Total Pagado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>25/10/2025</td>
                                    <td>45.50 €</td>
                                    <td>
                                        <a href="factura.php?id=101" class="btn btn-primary btn-sm">Ver PDF</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>18/10/2025</td>
                                    <td>82.10 €</td>
                                    <td>
                                        <a href="factura.php?id=95" class="btn btn-primary btn-sm">Ver PDF</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>02/09/2025</td>
                                    <td>12.00 €</td>
                                    <td>
                                        <a href="factura.php?id=78" class="btn btn-primary btn-sm">Ver PDF</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>