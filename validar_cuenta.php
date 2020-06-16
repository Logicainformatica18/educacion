<?php
session_start();
?>

<?php

	// archivo donde esta las variables para la conexion
	include 'conexion.php';	

	//datos enviados desde el formulario login.html
	$Cod_persona = $_POST['Cod_persona']; 
	$password = $_POST['password'];
	
	// Consulta enviada a la base de datos
	$result = mysqli_query($conn, "SELECT * FROM alumno WHERE  Numero_Documento  = '$Cod_persona'");
	
	// Que la Variable $row mantenga el resultado de la consulta
	$row = mysqli_fetch_assoc($result);
	
	// que la Variable $hash mantenga el hash de contraseña en la base de datos
	$hash = $row['Clave'];
	/* 
	password_Verify()
Función de verificación si la contraseña introducida por el usuario.
coincide con el hash de contraseña en la base de datos. Si todo esta bien la sesion
Se crea por un minuto. Cambie 1 en $ _SESSION [inicio] a 5 para una sesión de 5 minutos.
	*/
	if ($_POST['password'] == $hash) {	
		$_SESSION['loggedin'] = true;
		$_SESSION['Cod_persona']= $row['Cod_Persona'];
		$_SESSION['name'] = $row['Nombres'];
		$_SESSION['paterno'] = $row['Paterno'];
		$_SESSION['materno'] = $row['Materno'];
		$_SESSION['start'] = time();
		$_SESSION['expire'] = $_SESSION['start'] + (100 * 60);						
		$_SESSION['alumno_clave'] = $row['Clave'];
		$_SESSION['Numero_Documento'] = $row['Numero_Documento'];
		echo "<script type='text/javascript'>
		window.location.href='alumno.php';
		</script>";
   
	
	} else {
		echo "<div class='alert alert-danger' role='alert'>Codigo o contraseña Incorrecta!
		<p><a href='../alumno_login.php'><strong>Intente de nuevo!</strong></a></p></div>";	
			
	}	
?>
