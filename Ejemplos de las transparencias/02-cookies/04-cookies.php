<?php
/*
En el siguiente ejemplo leemos los datos guardados del ejemplo anterior.
*/
print("Usted Don '" . $_COOKIE['nombre'] . " " . $_COOKIE['apellidos'] . "
' se ha conectado por el ultima vez el dia:
 '" . $_COOKIE['FechaUltima'] . "', a la hora: '" . $_COOKIE['HoraUltima'] . "'");
?>
