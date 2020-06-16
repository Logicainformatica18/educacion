<?php
session_start();
	// archivo donde esta las variables para la conexion
	include 'conexion.php';	

	//datos enviados desde el formulario login.html
	$Codigo = isset($_POST['codigo'])? $_POST['codigo']:""; 
	$password_ = isset($_POST['password'])? $_POST['password']:""; 
	
	// Consulta enviada a la base de datos
	$result = mysqli_query($conn, "call profesorist_login('$Codigo', '$password_');");
	
	// Que la Variable $row mantenga el resultado de la consulta
	$row = mysqli_fetch_assoc($result);
	
	if ($row['Clave'] != "") {	
		$_SESSION['loggedin_profesor'] = true;
		$_SESSION['profesor_dni']= $row['Dni'];
		$_SESSION['profesor_nombres']=$row['Nombres'];
		$_SESSION['profesor_clave']=$row['Clave'];

	echo "<script type='text/javascript'>window.location='profesor.php';</script>";
	} else {
		echo "<div class='alert alert-danger' role='alert'>Email or Password are incorrects!
		<p><a href='profesor_login.php'><strong>Please try again!</strong></a></p></div>";	
			
	}	
?>