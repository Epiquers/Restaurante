<?php
/*
En este ejemplo vamos crear dos variables sesiones. La primera variable va a 
contener un nombre de usuario(Login) y la segunda va a contener la 
contraseña(password).
*/

//Con este funcion indicamos que vamos a comenzar a trabajar con sesiones
session_start();

//Creamos los dos variables que van a contener el login y el password.
$login = "pepito";
$password = "password33";

	
//guardamos las variables en la sesión
$_SESSION['login'] = $login;	
$_SESSION['password'] = $password;

/* Como este ejemplo este relacinado con el del ejercicio siguiente, me creo 
un enlace para redireccionar.*/
?>
<a href="02-Sesiones.php">Segundo Ejemplo</a>
