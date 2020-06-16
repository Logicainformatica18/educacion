<?php
$dbhost	= "localhost";	   // localhost o IP
$dbuser	= "root";		  // database nombre de usuario
$dbpass	= "";		     // database contraseña
$dbname	= "administrativo";    // database nombre
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
mysqli_set_charset($conn,'utf8');  
	// chequea la conexion si es que da error
	// mysqli_connect_error => Devuelve una cadena con la descripción del último error de conexión
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
?>
