<?php
/*
En el siguiente ejemplo vamos a ver como se guarda el nombre de usuario medienta una cookie.
La cookie va  expirar dentro de un año
*/
setcookie("nombreUsuario","Pepito",time() + 31536000);

?>