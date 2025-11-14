<?php
session_start();
include("seguridad_cliente.php");
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

    <!-- Incluímos cabecera y navbar -->
    <?php include '../includes/header.php'; ?>

    <?php include 'navbar_cliente.php'; ?>


    <main class="container mt-4 flex-grow-1">

        <div class="row">

            <div class="col-lg-8">
                <h1 class="titulo">Nuestra Carta</h1>

                <!-- Formulario de búsqueda -->
                <form method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="buscar" class="form-control" placeholder="Buscar producto...">
                        <button class="btn btn-primary" type="submit">Buscar</button>
                    </div>
                </form>

                <?php
                // Conexión
                include("../includes/conexion.php");

                // Si el cliente busca algún producto a través del buscador entra en este if
                if (isset($_GET['buscar']) && $_GET['buscar']!=="") {
                    // Hacemos consulta del producto que busca el cliente
                    $nom = $_GET['buscar'];

                    $consulta_productos = "SELECT * FROM productos WHERE stock>0 AND estado=0 AND nombre LIKE '%$nom%'";

                    $result_productos = mysqli_query($conn, $consulta_productos);

                    // HTML para los productos
                    echo '<div class="caja mb-4">';
                        echo '<div class="row mb-3 align-items-center">';
                        while ($row = mysqli_fetch_array($result_productos)) {
                            echo '
                                <div class="col-12 mb-0">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="h5 mb-0">' . $row['nombre'] . '</h4>
                                        <span class="h5 text-warning">' . number_format($row['precio'], 2) . ' €</span>
                                    </div>
                                    <p class="text-muted small">' . $row['descripcion'] . '</p>
                                    <form action="pedido_añadir.php" method="POST">
                                        <input type="hidden" name="precio" value="' . $row['precio'] . '">
                                        <input type="hidden" name="idprod" value="' . $row['idprod'] . '">
                                        <input type="hidden" name="nombre" value="' . $row['nombre'] . '">
                                        <div class="input-group mb-5">
                                            <input type="text" name="notas" class="form-control form-control-sm" placeholder="Notas (ej: sin tomate, al punto...)">
                                            <button type="submit" class="btn btn-primary btn-sm">Añadir</button>
                                        </div>
                                    </form>
                                </div>';
                        }
                        echo '</div>';
                    echo '</div>';
                } else {
                    // Buscamos todas las categorías 
                    $consulta_categorias = "SELECT * FROM categoria WHERE estado='0'";
                    $result_categorias = mysqli_query($conn, $consulta_categorias);

                    // Recorremos cada categoría (Bebidas, Hamburguesas, etc.)
                    while ($categoria = mysqli_fetch_array($result_categorias)) {

                        // Imprimimos el título de la categoría
                        echo '<div class="caja mb-4">';
                        echo '<h2 class="border-bottom pb-2">' . $categoria['nombre'] . '</h2>';

                        // Guardamos el ID de la categoría actual
                        $id_categoria_actual = $categoria['idc'];


                        // Buscamos solo los productos de la categoría actual que tengan stock
                        $consulta_productos = "SELECT * FROM productos WHERE stock>0 AND estado=0 AND estado_cat=0 AND categoria = $id_categoria_actual";


                        $result_productos = mysqli_query($conn, $consulta_productos);

                        // HTML para los productos 
                        echo '<div class="row mb-3 align-items-center">';
                            while ($row = mysqli_fetch_array($result_productos)) {
                                echo '
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="h5 mb-0">' . $row['nombre'] . '</h4>
                                            <span class="h5 text-warning">' . number_format($row['precio'], 2) . ' €</span>
                                        </div>
                                        <p class="text-muted small">' . $row['descripcion'] . '</p>
                                        <form action="pedido_añadir.php" method="POST">
                                            <input type="hidden" name="precio" value="' . $row['precio'] . '">
                                            <input type="hidden" name="idprod" value="' . $row['idprod'] . '">
                                            <input type="hidden" name="nombre" value="' . $row['nombre'] . '">
                                            <div class="input-group mb-5">
                                                <input type="text" name="notas" class="form-control form-control-sm" placeholder="Notas (ej: sin tomate, al punto...)">
                                                <button type="submit" class="btn btn-primary btn-sm">Añadir</button>
                                            </div>
                                        </form>
                                    </div>';
                            }
                            echo '</div>';
                        echo '</div>';
                    }
                }

                // Cerramos la conexión al final de todo
                mysqli_close($conn);
                ?>

            </div>

            <div class="col-lg-4">
                <div class="caja sticky-top" style="top: 80px;">
                    <h2 class="h4">Mi Pedido (Mesa <?php echo $_SESSION['mesa_id']; ?>)</h2>

                    <!-- Si no queda stock de un producto se muestra mensaje al intentar pedirlo -->
                    <?php
                    if (isset($_GET['error'])) {
                        echo "<div class='alert text-danger pb-0 small'> Lo sentimos, el producto se ha agotado.. </div>";
                        unset($_GET['error']);
                    }
                    // Comprobamos si el carrito está vacío
                    if (empty($_SESSION['pedido'])) {

                        echo "<p class='text-muted'> ¿Todavía no has añadido nada? </p>";
                    } else {
                        echo "<p class='text-muted'> ¡No te cortes y pide todo lo que te apetezca! </p>";
                        // Recorremos el carrito
                        foreach ($_SESSION['pedido'] as $indice => $producto) {
                            echo '<div class="d-flex justify-content-between align-items-center mb-2">';
                            echo '<div><strong>' . $producto['nombre'] . '</strong><br>';

                            // Mostramos las notas si no están vacías
                            if (!empty($producto['notas'])) {
                                echo '  <small class="text-muted">Notas: ' . $producto['notas'] . '</small>';
                            }
                            echo '</div>';

                            // El botón de borrar
                            echo '  <a href="pedido_borrar.php?id=' . $indice . '&idprod=' . $producto['id'] . '" class="btn btn-danger btn-sm">X</a></div>';
                        }
                    }


                    ?>
                    <hr>
                    <form action="pedido_enviar.php" method="POST" class="d-grid">
                        <button class="btn btn-success btn-lg" <?php if (empty($_SESSION['pedido'])) echo 'disabled'; ?>>
                            <span>Enviar Pedido</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>