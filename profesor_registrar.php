<?php
// include 'conexion.php';

// // Consulta para comprobar si el correo electrónico ya existe.
// $checkCod_persona = "SELECT * FROM profesorist where dni like '$_POST[txtcod_persona]'";
// // Variable $result mantiene los datos de conexión y la consulta
// 	//Ejecuta una sentencia SQL, devolviendo un conjunto de resultados como un objeto PDOStatement
//     $result = $conn-> query($checkCod_persona);
//     // Que la Variable $row mantenga el resultado de la consulta
// 	$row = mysqli_fetch_assoc($result);
// 	// Variable $count mantiene el resultado de la consulta
//     $count = mysqli_num_rows($result);
 
//     // si count == 1 ,eso significa que el correo electrónico ya está en la base de datos y el codigo no es vacio
// 	if ($count == 1) {
//         echo "<script type='text/javascript'> alert('Tu cuenta ya esta registrada');</script>";
//         } else {	

//       /*      Si el correo electrónico no existe, los datos del formulario se envían a la base de datos
// y se crea la cuenta
// 	*/
// 	$cod_persona =      $_POST['txtcod_persona'];
// 	$paterno =          $_POST['txtpaterno'];
// 	$materno =          $_POST['txtmaterno'];
//     $nombres =          $_POST['txtnombres'];
//     $direccion =        $_POST['txtdireccion'];
            
//         //FECHA
//         $dia=$_POST['Dia']; if($dia < 10) {$dia = "0".$dia;}  
//         $mes=$_POST['Mes']; if($dia < 10) {$mes="0".$mes;}
//         $año=$_POST['Año'];
//         //FECHA
//         //VALIDAR FECHA
//             if($dia <1 || $mes <1) 
//             { 
//                 echo "<script type='text/javascript'> alert('Elija correctamente su Fecha de cumpleaños');
//                 location.href ='../index.php'
//                 </script>";
//             exit;
//             }
//         //VALIDAR FECHA
//     $fec_nacimiento=    $año."-".$mes."-".$dia;
//     $sexo =             $_POST['rbsexo'];
//     $te_estado_civil =  $_POST['cbcivil'];
//     $telefono =         $_POST['txttelefono'];
//     $celular =          $_POST['txtcelular'];
//     $clave =            $_POST['txtclave'];
//     $clave2 =            $_POST['txtclave2'];
//     $email =            $_POST['txtcorreo'];
//             //VALIDAR QUE AMBAS CLAVES SEAN IGUALES AL REGISTRARSE
// if($clave!=$clave2)
// { echo "<script type='text/javascript'> alert('Ambas claves deben ser iguales.');
//     location.href ='../profesor_login.php'
//     </script>";
//     exit;
// }
//             //VALIDAR TODOS LOS CAMPOS REQUERIDOS
// if($paterno=="" || $materno==""|| $nombres==""|| $direccion=="" || $sexo =="" || $te_estado_civil==""||$celular=="" || $email=="" ||$clave==""||$clave2=="")
// {
//     echo "<script type='text/javascript'> alert('Llene todos los campos por favor.');
//                 location.href ='../profesor_login.php'
//                 </script>";
//     exit;
// } 
//             // Llamado al procedimiento almacenado
//     $query = "call profesorist_Insert('$cod_persona', '$paterno', '$materno','$nombres','$direccion','$fec_nacimiento','$sexo','$te_estado_civil','$telefono','$celular','$clave','$email')";
// 	if (mysqli_query($conn, $query)) {
//         echo "<script type='text/javascript'>alert('Registrado Correctamente');
//         location.href ='../profesor_login.php'
//         </script>";
// 		} else {
// 			echo "Error: " . $query . "<br>" . mysqli_error($conn);
// 		}	
// 	}	
// 	mysqli_close($conn);
?>