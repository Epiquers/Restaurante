<?php
    $servidor="localhost";
    $user="root";
    $clave="";
    $basededatos="restaurant";
    //Establecimiento de la conexión al servidor localhost, 
    //con el usuario root y sin clave
    $conn= mysqli_connect($servidor,$user,$clave);

    //Todo lo que rescatemos lo parsearemos a UTF8
    mysqli_set_charset($conn, "utf8");
    //Seleccionamos la base de datos empresa
    mysqli_select_db($conn,$basededatos);
    //Imprimimos si hay algún error
    echo mysqli_error($conn);
?>
