<?php
// ESTA PARTE VERIFICA SI YA HA INICIADO SESION ENTONCES REDIRECCIONA A PROFESOR
session_start();
include 'conexion.php';
$sesion = isset($_SESSION['loggedin_profesor']) ? $_SESSION['loggedin_profesor'] : "";
//$password=	isset($_SESSION['alumno_clave'])? $_SESSION['alumno_clave']:"";
// Consulta enviada a la base de datos
if ($sesion == true) {

	echo "<script type='text/javascript'>window.location='profesor.php';</script>";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Sistema Educativo</title>
	<!-- CSS  -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
	<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />

	<link rel="stylesheet" type="text/css" href="css/alumno_login.css" />
	<link href="css/index.css" rel="stylesheet">

	<!--  Scripts-->
	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/materialize.js"></script>
	<script src="js/init.js"></script>
</head>
<!--/head-->

<body>

	<nav class="white" role="navigation">
		<div class="nav-wrapper container">
			<a id="logo-container" href="#" class="brand-logo">
				<img src="imagenes/cesca.png" width="150px">
			</a>
			<ul class="right hide-on-med-and-down">
				<li class="scroll"><a href="index.php">Inicio </a></li>
				<li class="scroll"><a href="alumno_login.php">Alumno </a></li>
				<li class="scroll active"><a href="profesor_login.php">Profesor</a></li>
			</ul>

			<ul id="nav-mobile" class="sidenav">
				<li class="scroll"><a href="index.php">Inicio </a></li>
				<li class="scroll"><a href="alumno_login.php">Alumno </a></li>
				<li class="scroll active"><a href="profesor_login.php">Profesor</a></li>
			</ul>
			<a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
		</div>
	</nav>


	<div class="container" align="center">
		<div class="row">

			<form action="profesor_validar_cuenta.php" method="post">

				<h1>Iniciar Sesión</h1>
				<img src="imagenes/login.jpg">

				<p></p>
				<div class="input-field col s6">
					<input id="codigo" type="text" class="validate" name="codigo" required>
					<label for="codigo">Dni</label>
				</div>
				<div class="input-field col s6">
					<input id="password" type="password" class="validate" name="password" required>
					<label for="password">Contraseña</label>
				</div>
				<p></p>
				<input type="submit" value="Iniciar Sesion" class="btn">
				<br>
			</form>
			<p></p>
			¿No tienes una cuenta?
			<a href="#registro">Registrarme</a>
		</div>
	</div>
	<p></p>


	<div class="container" align="center">

	</div>
	</div>




	<p></p>



	<?php
	include "pie.php";
	?>