<?php
session_start();
include 'profesor_validar.php';
// archivo donde esta las variables para la conexion
include 'conexion.php';	
?>


<?php
// OBTENER EL COD_PERSONA DEL ARRAY SESSION AL HABER INICIADO SESION
$Cod_persona= $_SESSION['profesor_dni'];
	// Consulta enviada a la base de datos
  $result = mysqli_query($conn, "SELECT * FROM profesorist WHERE dni = '$Cod_persona'");

	// Que la Variable $row mantenga el resultado de la consulta
	$row = mysqli_fetch_assoc($result);
?>
<div class="caja">
<div class="portada">
<h2 class="titulo">DOCENTE</h2>
<form action="profesor.php" method="post" enctype="multipart/form-data">
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
    ///////////////////////////////////////////////////////////////////////////////////
    echo "<h1>".$row["Paterno"]."</h1>";
    echo "<h1>".$row["Materno"]."</h1>";
    echo "<h1>".$row["Nombres"]."</h1>";
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
<a href="cambiar_clave.php">Cambiar contraseña</a>
<p></p>
<p>Inserte fotografia:</p> 
<input type="file" name="imagen" accept="image/png, .jpeg, .jpg, image/gif" class="file"/>
<p></p>
<a href='profesor_modificar.php'>  Editar Datos</a>
<p></p>   
<input type="submit" value="Guardar" name="btn"class="btn"/>
<input type="submit" value="Eliminar foto" name="btn" class="btn"/> 
</form>
</div>



  
