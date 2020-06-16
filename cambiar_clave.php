<?php
session_start();
include 'edit-profile.php';
// archivo donde esta las variables para la conexion
include 'conexion.php';	
require "alumno_encabezado.php";
    // OBTENER EL COD_PERSONA DEL ARRAY SESSION AL HABER INICIADO SESION
    $Cod_persona    = $_SESSION['Cod_persona'];
	// Consulta enviada a la base de datos
    $result = mysqli_query($conn, "SELECT clave FROM alumno WHERE Cod_persona = '$Cod_persona'");
	// Que la Variable $row mantenga el resultado de la consulta
	$row = mysqli_fetch_assoc($result);
    // OBTENER LA CLAVE  DEL ALUMNO QUE ESTA EN LA BD
    $clave_sesion= $row['clave'];
////////////////////////////////////////////////////////////////////
$clave_actual   =isset($_POST['clave_actual'])? $_POST['clave_actual'] :"";
$clave          =isset($_POST['clave'])? $_POST['clave'] :"";
$repetir_clave  =isset($_POST['repetir_clave'])? $_POST['repetir_clave'] :"";
$btn=isset($_POST['btn'])? $_POST['btn'] :"";

if($btn=="Guardar")
{
    if($clave_actual==$clave_sesion)
    {
        if($clave==$repetir_clave && strlen($clave)>3)
        {
                $query="UPDATE alumno SET clave = '$clave' WHERE Cod_persona ='$Cod_persona';";
                if(mysqli_query($conn,$query))
                {
                 
                    $_SESSION['habitante_clave']=$clave;
    
                    include("../enviar_email/cambiar_clave.php");
                    echo "<script type='text/javascript'>alert('Contraseña ha cambiado'); window.location='../alumno.php'; </script>";
              
                 
                }
            else
                {
                echo "<script type='text/javascript'>
                alert('Error de cambio de contraseña');
                </script>";
                } 
        }
        else
        {
        echo "<script type='text/javascript'>
        alert('error de repetir clave  o el tamaño de contraseña es muy corto');
        </script>";
        } 
      
    }
    else
    {
        echo "<script type='text/javascript'>
        alert('Error de clave actual');
        </script>";
    }
}
?>
<head><link rel="stylesheet" type="text/css" href="../css/cambiar_clave.css" /></head>
<form  action="cambiar_clave.php" method="post">
 
    <img src="../imagenes/messenger.png" alt="messenger">
    <h2>Cambiar Contraseña</h2>
    <input type="password" class="txt" name="clave_actual" placeholder="  Clave Actual" class="txt" requerid>
    <p></p>
    <input type="password" class="txt" name="clave" placeholder="  Contraseña"class="txt"requerid>
    <p></p>
    <input type="password" class="txt" name="repetir_clave" placeholder="  Repetir Contraseña"class="txt"requerid>
    <p></p>
    <p></p>
    <input type="submit" value="Guardar" name="btn"class="btn">
 

</form>