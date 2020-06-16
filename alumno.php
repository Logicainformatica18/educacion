<?php
session_start();
include "edit-profile.php";
// archivo donde esta las variables para la conexion
include 'conexion.php';
require "alumno_encabezado.php";

// OBTENER EL COD_PERSONA DEL ARRAY SESSION AL HABER INICIADO SESION
$Cod_persona= $_SESSION['Numero_Documento'];

////////////////////////////////////////////////////////////////////
$direccion        =isset($_POST['direccion'])? $_POST['direccion'] :"";
$civil            =isset($_POST['cbcivil'])? $_POST['cbcivil'] :"";
$dni              =isset($_POST['dni'])? $_POST['dni'] :"";
$celular          =isset($_POST['celular'])? $_POST['celular'] :"";
$email            =isset($_POST['email'])? $_POST['email'] :"";
$btnguardar_datos =isset($_POST['btn'])? $_POST['btn'] :"";
////////////////////////////////////////////////////////////////////

	// Consulta enviada a la base de datos
	$result = mysqli_query($conn, "SELECT * FROM alumno WHERE  Numero_Documento  = '$Cod_persona'");
	// Que la Variable $row mantenga el resultado de la consulta
  $row = mysqli_fetch_assoc($result);
  

  
 ?>


<div class="container">
    <h3>
        <p class="blue-text"> <?php echo "Bienvenido";?></p>
    </h3>
</div>
<div class="container">



    <div class="caja">
        <div class="portada">
            <form action="alumno.php" method="post" enctype="multipart/form-data">
                <?php
  ////////////////////////////////////////////////////////////
  if ($row['Foto']!="")
  {
   $img=base64_encode($row['Foto']);
   echo  "<img src='data:image/jpg;base64,$img' class='foto_perfil' alt=''>"."<br>";
  }
    //////////////////////////////////////////////////////////////////////////
    if($row["Sexo"]=="M" && $row['Foto']=="")
    {
        echo "<img src='imagenes/perfil_masculino.png' width='400px' height='250px' alt='' >";
    }
    else if($row["Sexo"]=="F" && $row['Foto']=="")
    {
        echo "<img src='imagenes/perfil_femenino.png' width='400px' height='250px' alt='' >";
    }
?>
                <p></p>
        </div>
        <?php
    //////////    
    echo "<h4><b>".$row["Paterno"]."</b></h4>";
    echo "<h4><b>".$row["Materno"]."</b></h4>";
    echo "<h4><b>".$row["Nombres"]."</b></h4>";
    echo "<img src='imagenes/dni.png' alt='celular' width='50px' height='30px'> ";
    echo $row["Numero_Documento"]."<p></p>";
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
    $query="call alumno_foto_insert('$Cod_persona', '$imagen')";
    ///////////////////////////////////////////////////////////////////////////
    $resultado=$conn->query($query);
    if($resultado)
    {
        echo "<script type='text/javascript'>
		window.location='alumno.php';
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
    $query="call alumno_foto_delete('$Cod_persona')";
    $resultado=$conn->query($query);
    if($resultado)
    {
        echo "<script type='text/javascript'>
		window.location='alumno.php';
		</script>";
    }
    else
    {
        echo "<script>  alert('No se elimino la imagen');</script> ";
    }
}
?>
        <p></p>
        <!-- Modal Trigger cambiar contraseña -->
        <a class="waves-effect waves-light btn modal-trigger" href="#modal2">Cambiar Contraseña</a>
        <p></p>
        <p>Inserte fotografia:</p>
        <input type="file" name="imagen" accept="image/png, .jpeg, .jpg, image/gif" class="file" />
        <p></p>
        <!-- Modal Trigger  EDITAR DATOS-->
        <a class="waves-effect waves-light btn modal-trigger indigo darken-4" href="#modal1">Editar Datos</a>
        <!-- Modal Trigger EDITAR DATOS -->
        <p></p>
        <input type="submit" value="Guardar" name="btn" class="btn green darken-3" />
        <input type="submit" value="Eliminar foto" name="btn" class="btn red accent-4" />
        </form>
    </div>

</div>

<p></p>


<p></p>
<!-- Modal Structure -->
<div id="modal2" class="modal">
    <div class="modal-content">
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
                $query="UPDATE alumno SET clave = '$clave' WHERE  Numero_Documento  ='$Cod_persona';";
                if(mysqli_query($conn,$query))
                {
                 
                    $_SESSION['habitante_clave']=$clave;
    
                    
                    echo "<script type='text/javascript'>alert('Contraseña ha cambiado'); window.location='alumno.php'; </script>";
                    include "enviar_email/cambiar_clave.php";
              
                 
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
        <div class="center">
            <form action="alumno.php" method="post">

                <img src="imagenes/messenger.png" alt="messenger" width="100">
                <h6><b>Cambiar Contraseña</b></h6>
                <input type="password" class="txt" name="clave_actual" placeholder="  Clave Actual" class="txt"
                    requerid>
                <p></p>
                <input type="password" class="txt" name="clave" placeholder="  Contraseña" class="txt" requerid>
                <p></p>
                <input type="password" class="txt" name="repetir_clave" placeholder="  Repetir Contraseña" class="txt"
                    requerid>
                <p></p>
                <p></p>
                <input type="submit" value="Guardar" name="btn3" class="btn">
            </form>
        </div>
    </div>
</div>


<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <?php

if($btnguardar_datos=="Guardar Datos")
{
// Consulta enviada a la base de datos
$result = (mysqli_query($conn, "call alumno_update('$Cod_persona', '$direccion', '$civil', '$dni', '$celular', '$email');"));

        if($result)
        {
                  echo "<script type='text/javascript'> alert('Guardado Correctamente.'); window.location.href='alumno.php';</script>";
        }
        else {
                 echo "<script type='text/javascript'> alert('Error de modificacion.');window.location.href='alumno.php';</script>";
              }
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////
$resultado=(mysqli_query($conn,"call Alumno_Update_Select('$Cod_persona');"));

$r=mysqli_fetch_assoc($resultado);



$e_civil=$row['Te_Estado_Civil'];
$S="";
$D="";
$C="";
$V="";
if($e_civil=="S"){$S="selected";}elseif($e_civil=="C") {$C="selected";}elseif($e_civil=="D") {$D="selected";}elseif($e_civil=="V") {$V="selected";}
?>
        <form action="alumno.php" method="post">
            Direccion :
            <input type="text" name="direccion" placeholder="  Direccion" class="txt"
                value="<?php echo $r['direccion'];?>" requerid>

            Estado Civil :

            <select name="cbcivil" class="browser-default">
                <option <?php echo $S;?> value="S">Soltero</option>
                <option <?php echo $C;?> value="C">Casado</option>
                <option <?php echo $D;?> value="D">Divorsiado</option>
                <option <?php echo $V;?> value="V">Viudo</option>
            </select>

            Dni :
            <input type="number" name="dni" placeholder="  Dni" class="txt" value="<?php echo $r['numero_documento'];?>"
                requerid>

            Celular :
            <input type="number" name="celular" placeholder="  Celular" class="txt" value="<?php echo $r['Celular'];?>"
                requerid>

            Email :
            <input type="email" name="email" placeholder="  Email" class="txt" value="<?php echo $r['email'];?>"
                requerid>

            <input type="submit" value="Guardar Datos" name="btn" class="btn">
        </form>
    </div>
</div>


<script>
// Or with jQuery

$(document).ready(function() {
    $('.modal').modal();
});
</script>
<?php
include "pie.php";
?>