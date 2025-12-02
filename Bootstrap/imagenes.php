<?php
// Iniciamos variables de sesión
session_start();

// Estableciendo la conexión
include("conexion.php");
// Añadimos url base
include("../config.php");

// Consulta para sacar el id de las imagenes
$consulta1 = "SELECT MAX(id) as id FROM pokemons";

// Ejecutamos consulta
$result = mysqli_query($conn, $consulta1);

// Obtiene obtenemos el resultado
$row = mysqli_fetch_assoc($result);
$id = $row['id'];

// Comprobamos si el valor es null y asignamos valor
if ($id === null) {
    $id = 1;
} else {
    $id += 1;
}

// Recogida de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nombre'];
    $img = $id . ".png";
    $nif = $_SESSION['nif'];

    $consulta2 = "INSERT INTO pokemons (nombre, imagen, usuario) 
    VALUES ('$nom', '$img', '$nif')";

    $ruta = "../images/" . $img;
    // Copiamos la imagen a la carpeta destino
    copy($_FILES["imagen"]["tmp_name"], $ruta);
    // Ejecutamos la sentencia SQL
    mysqli_query($conn, $consulta2);
    // Mostramos error si lo hubiera
    echo mysqli_error($conn);
    // Cerramos conexión
    mysqli_close($conn);
    header("LOCATION:mostrarNormal.php");
}
