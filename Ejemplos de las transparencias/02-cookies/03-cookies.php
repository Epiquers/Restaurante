<?php
/*
En el siguiente ejemplo se van a guardar 3 cookies: 
- Una con el nombre.
- Otra con el Apellido.
- Otra con la ultima fecha en la que el usuario se ha conectado.
- Y otra con la hora exacta en el que se conecto.
*/
setcookie("nombre","Pepito",time() + 31536000);
setcookie("apellidos","Palotes",time() + 31536000);
setcookie("FechaUltima",date("d/m/y"),time() + 31536000);
setcookie("HoraUltima",date("H:i"),time() + 31536000);

print("Las cookies se han guardado correctamente");

?>