<?php
session_start();

// AQUÍ VA TU CÓDIGO DE SEGURIDAD
// 1. Comprobar que el usuario ha iniciado sesión
// 2. Comprobar que el rol es 'encargado'
// if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'encargado') {
//    header('Location: ../login.php');
//    exit();
// }

// --- LÓGICA PARA PROCESAR FORMULARIOS (POST) ---

// 1. Lógica para AÑADIR una nueva categoría
if (isset($_POST['guardar_categoria'])) {
    $nombre_categoria = $_POST['nombre_categoria'];

    // AQUÍ VA TU CÓDIGO BBDD:
    // INSERT INTO categorias (nombre) VALUES (?)
    // $stmt = $pdo->prepare("INSERT INTO categorias (nombre) VALUES (?)");
    // $stmt->execute([$nombre_categoria]);

    // Redirigimos para evitar reenvío de formulario
    header('Location: gestion_categorias.php?exito=creada');
    exit();
}

// 2. Lógica para ELIMINAR una categoría
if (isset($_POST['eliminar_categoria'])) {
    $id_categoria_eliminar = $_POST['id_categoria_eliminar'];

    // AQUÍ VA TU CÓDIGO BBDD:
    // ¡OJO! Antes de borrar, deberías comprobar que no hay productos en esta categoría.
    // DELETE FROM categorias WHERE id = ?
    // $stmt = $pdo->prepare("DELETE FROM categorias WHERE id = ?");
    // $stmt->execute([$id_categoria_eliminar]);

    header('Location: gestion_categorias.php?exito=eliminada');
    exit();
}

// --- LÓGICA PARA MOSTRAR LA PÁGINA (GET) ---
// AQUÍ VA TU CÓDIGO BBDD:
// $stmt = $pdo->query("SELECT * FROM categorias ORDER BY nombre");
// $categorias = $stmt->fetchAll();
//
// Simulación para el ejemplo:
$categorias = [
    ['id' => 1, 'nombre' => 'Hamburguesas'],
    ['id' => 2, 'nombre' => 'Entrantes'],
    ['id' => 3, 'nombre' => 'Bebidas'],
    ['id' => 4, 'nombre' => 'Postres'],
];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías - Grill & Growler</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include '../includes/header.php'; ?>

    <?php include '../includes/navbar_encargado.php'; ?>


    <main class="container mt-4 flex-grow-1">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="titulo" style="margin-top: 0; margin-bottom: 0;">Gestión de Categorías</h1>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAñadirCategoria">
                + Añadir Nueva Categoría
            </button>
        </div>

        <div class="caja">
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre de la Categoría</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categorias as $categoria): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($categoria['id']); ?></td>
                                <td><?php echo htmlspecialchars($categoria['nombre']); ?></td>
                                <td class="text-end">
                                    <form action="gestion_categorias.php" method="POST" style="display: inline;">
                                        <input type="hidden" name="id_categoria_eliminar" value="<?php echo $categoria['id']; ?>">
                                        <button type="submit" name="eliminar_categoria" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar esta categoría?');">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <div class="modal fade" id="modalAñadirCategoria" tabindex="-1" aria-labelledby="labelModalAñadir" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <form action="gestion_categorias.php" method="POST">

                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="labelModalAñadir">Añadir Nueva Categoría</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nombre_categoria" class="form-label">Nombre de la Categoría</label>
                            <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" required>
                        </div>
                    </div>

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" name="guardar_categoria" class="btn btn-primary">Guardar Categoría</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>