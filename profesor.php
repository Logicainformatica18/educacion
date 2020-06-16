<?php
session_start();
require 'conexion.php';
require "profesor_validar.php";
require "encabezado_profesor.php";
// OBTENER EL COD_PERSONA DEL ARRAY SESSION AL HABER INICIADO SESION
$Cod_persona= $_SESSION['profesor_dni'];	
////////////////////////////////////////////////////////////////////
$direccion        =isset($_POST['direccion'])? $_POST['direccion'] :"";
$civil            =isset($_POST['cbcivil'])? $_POST['cbcivil'] :"";
$celular          =isset($_POST['celular'])? $_POST['celular'] :"";
$email            =isset($_POST['email'])? $_POST['email'] :"";
$btn              =isset($_POST['btn'])? $_POST['btn'] :"";

?>

<div class="container center">
    <h3>Bienvenido :<p class="blue-text"> <?php echo $_SESSION['profesor_nombres'];?></p>
    </h3>

    <?php
	// Consulta enviada a la base de datos
  $result = mysqli_query($conn, "SELECT * FROM profesorist WHERE dni = '$Cod_persona'");

	// Que la Variable $row mantenga el resultado de la consulta
	$row = mysqli_fetch_assoc($result);
?>


    <h3 class="titulo">DOCENTE</h3>
    <form action="profesor.php" method="post" enctype="multipart/form-data">
        <?php
  ////////////////////////////////////////////////////////////
  if ($row['Foto']!="")
  {
   $img=base64_encode($row['Foto']);
   echo  "<img src='data:image/jpg;base64,$img'class='circle' width='200'>"."<br>";
  }
    //////////////////////////////////////////////////////////////////////////
    if($row["Sexo"]=="M" && $row['Foto']=="")
    {
        echo "<img src='imagenes/perfil_masculino.png' class='circle' width='200' >";
    }
    else if($row["Sexo"]=="F" && $row['Foto']=="")
    {
        echo "<img src='imagenes/perfil_femenino.png' class='circle' width='200' >";
    }
?>
        <p></p>

        <?php
    ///////////////////////////////////////////////////////////////////////////////////
    echo "<h2><b>".$row["Paterno"]."</b></h2>";
    echo "<h2><b>".$row["Materno"]."</b></h2>";
    echo "<h2><b>".$row["Nombres"]."</b></h2>";
    echo "<img src='imagenes/dni.png' alt='celular' width='50px' height='30px'> ";
    echo $row["Dni"]."<p></p>";
    echo "<img src='imagenes/cumpleaños.png' alt='celular' width='50px' height='30px'> ";
    echo $row["Fec_Nacimiento"]."<p></p>";
    echo "<img src='imagenes/celular.png' alt='celular' width='35px' height='30px'> ";
    echo $row["Celular"]."<p></p>";
    echo "<img src='imagenes/email.png' alt='email' width='35px' height='20px'> ";
    echo $row["Email"];
/////////////////////////////////////////////////////////////////////////////////////////////
$btn=isset($_POST['btn'])? $_POST['btn']:"";
$imagen=isset($_FILES['imagen']['tmp_name'])? $_FILES['imagen']['tmp_name'] :"";

if($btn=="Guardar" && $imagen!="")
{
    $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
    ////////////////////////////////////////////////////////////////////////////
    $query="call profesorist_foto_update('$Cod_persona', '$imagen')";
    ///////////////////////////////////////////////////////////////////////////
    $resultado=$conn->query($query);
    if($resultado)
    {
        echo "<script type='text/javascript'>
		window.location='profesor.php';
		</script>";
    }
    else
    {
        echo "<script>  alert('No se Inserto la imagen');</script> ";
    }
}
///////////////////////////////////////////////////
if($btn=="Eliminar foto")
{
    $query="call profesorist_foto_delete('$Cod_persona')";
    $resultado=$conn->query($query);
    if($resultado)
    {
        echo "<script type='text/javascript'>
		window.location='profesor.php';
		</script>";
    }
    else
    {
        echo "<script>  alert('No se elimino la imagen');</script> ";
    }
}

?>
        <p></p>
        <!-- Modal Trigger -->
        <a class="waves-effect waves-light btn modal-trigger red" href="#modal2">Cambiar Contraseña</a>
        <p></p>
        <p>Inserte fotografia:</p>
        <input type="file" name="imagen" accept="image/png, .jpeg, .jpg, image/gif" class="file" />
        <p></p>



        <!-- Modal Trigger -->
        <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Editar Datos</a>

  


        <p></p>
        <input type="submit" value="Guardar" name="btn" class="btn green" />
        <input type="submit" value="Eliminar foto" name="btn" class="btn black" />
        <pre>

</pre>
    </form>

</div>


      <!-- Modal Structure -->
        <div id="modal1" class="modal">
            <div class="container">

                <?php

if($btn=="Guardar")
{
// Consulta enviada a la base de datos
$result = (mysqli_query($conn, "call profesorist_update('$Cod_persona', '$direccion', '$civil', '$celular', '$email');"));

        if($result)
        {
                  echo "<script type='text/javascript'> alert('Guardado Correctamente.');
                  window.location.href='profesor.php';
                  </script>";
        }
        else {
                 echo "<script type='text/javascript'> alert('Error de modificacion.');</script>";
              }
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////

$e_civil=$row['Te_Estado_Civil'];
$S="";
$D="";
$C="";
$V="";
if($e_civil=="S"){$S="selected";}elseif($e_civil=="C") {$C="selected";}elseif($e_civil=="D") {$D="selected";}elseif($e_civil=="V") {$V="selected";}
?>
                <form action="profesor.php" method="post">
                  <p></p>
            
                    Direccion :
                    <input type="text" name="direccion" placeholder="  Direccion" class="txt"
                        value="<?php echo $row['Direccion'];?>" requerid>
                    <p></p>
                    Estado Civil :

                    <select name="cbcivil" class="browser-default">
                        <option <?php echo $S;?> value="S">Soltero</option>
                        <option <?php echo $C;?> value="C">Casado</option>
                        <option <?php echo $D;?> value="D">Divorsiado</option>
                        <option <?php echo $V;?> value="V">Viudo</option>
                    </select>
                    <p></p>
                    Celular :
                    <input type="number" name="celular" placeholder="  Celular" class="txt"
                        value="<?php echo $row['Celular'];?>" requerid>
                    <p></p>
                    Email :
                    <input type="email" name="email" placeholder="  Email" class="txt" value="<?php echo $row['Email'];?>"
                        requerid>
                    <p></p>
                    <input type="submit" value="Guardar" name="btn" class="btn">
                    <p></p>
                </form>

            </div>
        </div>
        <script>
        // Or with jQuery

        $(document).ready(function() {
            $('.modal').modal();
        });
        </script>


      <!-- Modal Structure -->
        <div id="modal2" class="modal">
            <div class="container">
                <?php
            // OBTENER LA CLAVE  DEL ALUMNO QUE ESTA EN LA BD
    $clave_sesion= $row['Clave'];
////////////////////////////////////////////////////////////////////
$clave_actual   =isset($_POST['clave_actual'])? $_POST['clave_actual'] :"";
$clave          =isset($_POST['clave'])? $_POST['clave'] :"";
$repetir_clave  =isset($_POST['repetir_clave'])? $_POST['repetir_clave'] :"";
$btn3=isset($_POST['btn3'])? $_POST['btn3'] :"";

if($btn3=="Guardar")
{
    if($clave_actual==$clave_sesion)
    {
        if($clave==$repetir_clave && strlen($clave)>3)
        {
                $query="call profesorist_cambiar_clave('$Cod_persona','$clave')";
                if(mysqli_query($conn,$query))
                {
                 
                    $_SESSION['profesor_clave']=$clave;
    
                    include("enviar_email/profesor_cambiar_clave.php");
                    echo "<script type='text/javascript'>alert('Contraseña ha cambiado'); window.location='profesor.php'; </script>";
              
                 
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////


?>
<form  action="profesor.php" method="post">
 <div class="center">
 <img src="imagenes/messenger.png" alt="messenger" width="100">
    <h6>Cambiar Contraseña</h6>
    <input type="password" class="txt" name="clave_actual" placeholder="  Clave Actual" class="txt" requerid>
    <p></p>
    <input type="password" class="txt" name="clave" placeholder="  Contraseña"class="txt"requerid>
    <p></p>
    <input type="password" class="txt" name="repetir_clave" placeholder="  Repetir Contraseña"class="txt"requerid>
    <p></p>
    <p></p>
    <input type="submit" value="Guardar" name="btn3"class="btn">
</div>
  
 
<p></p>
</form>
             </div>
        </div>

<?php
include "pie.php";
?>