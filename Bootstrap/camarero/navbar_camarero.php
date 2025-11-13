<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">Grill & Growler (Camarero)</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCamarero" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCamarero">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="mesas.php">Ver Mesas Activas</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
         <li class="nav-item">
            <a class="nav-link" href="../logout.php">Hola, <?php echo $_SESSION['nombre'] ?> (Cerrar Sesión)</a>
        </li>
      </ul>
    </div>
  </div>
</nav>