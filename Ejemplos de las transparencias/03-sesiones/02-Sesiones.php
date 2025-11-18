<?php
/*Este ejemplo es la continuación del ejercicio anterior. Lo que vamos hacer 
es comprobar si se han creado la variables de sesión "login" y "password". 
Si se han creado se mostrará un mensaje por pantalla indicando que el usuario 
esta logueado, si estas dos variables de sesión no existen, significará que 
el usuario no se ha logueado, es decir que no ha pasado por la página php 
01-Sessiones.php
*/

//Con este funcion indicamos que vamos a comenzar a trabajar con sesiones
session_start();

if (isset($_SESSION['login'])&&isset($_SESSION['password'])){
	$login = $_SESSION['login'];
	$password = $_SESSION['password'];
	print("El usuario esta conectado");
	print("<br>");
	print("Sus datos son: ");
	print("<br>");
	print("login: ". $_SESSION['login']);
	print("<br>");
	print("password: ". $_SESSION['password']);
	print("<br>");	
}
else
{
	print("El usuario NO esta conectado");
}
?>


