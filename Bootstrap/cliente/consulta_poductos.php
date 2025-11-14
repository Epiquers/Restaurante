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
    echo '
</div>';
