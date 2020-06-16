<?php
session_start();
include 'conexion.php';
include 'edit-profile.php';
require "alumno_encabezado.php";
$j1=0;
?>

  <div class="container"> 

<form  action="boleta_notas.php" method="POST">  
        	<h1>CONSULTAR NOTAS</h1>
     <p>Seleccione Ciclo</p>   
	<select name="ciclo" class="browser-default">
    <option value="00020">I</option>
    <option value="00030">II</option>
    <option value="00040">III</option>
    <option value="00050">IV</option>
    <option value="00060">V</option>
    <option value="00070">VI</option>
    </select>
    <p>Seleccione Linea</p>   
	<select name="linea" class="browser-default">
    <option value="001">Superior</option>
    <option value="002">Tecnico</option>
    </select>
    <p>Seleccione Instituto</p>   
	<select name="marca" class="browser-default">
        <?php
        $select1="SELECT Cod_marca,Descripcion from marca";
        $query1=(mysqli_query($conn,$select1));
        $registro1=mysqli_num_rows($query1);
        while($j1 < $registro1)
             {
                $row1 = mysqli_fetch_array($query1);
                $Cod_marca=$row1[0];
                $Descripcion1=$row1[1];
                echo "<option value='$Cod_marca'>$Descripcion1</option>";
                $j1++;
            }
        ?>
    </select>
    <p>Seleccione Sede</p>   
    <select name="sede" class="browser-default">
        <?php
        $j2=0;
        $query2=(mysqli_query($conn,"SELECT Cod_local,Descripcion from sucursal"));
        $registro2=mysqli_num_rows($query2);
        while($j2 <$registro2)
        {
       $row2 = mysqli_fetch_array($query2);
       $Cod_local=$row2[0];
       $Descripcion2=$row2[1];
       echo "<option value='$Cod_local'>$Descripcion2</option>";
       $j2++;
        }
        ?>
    </select>
    
    <p>Seleccione Carrera Profesional</p>   
    <select name="carrera" class="browser-default">
        <?php
        $j3=0;
        $query3=(mysqli_query($conn,"SELECT Cod_sublinea,Descripcion from sub_linea WHERE cod_linea='001' and cod_marca ='01'"));
        $registro3=mysqli_num_rows($query3);
        while($j3 <$registro3)
        {
       $row3 = mysqli_fetch_array($query3);
       $Cod_sublinea=$row3[0];
       $Descripcion3=$row3[1];
       echo "<option value='$Cod_sublinea'>$Descripcion3</option>";
       $j3++;
        }
        ?>
    </select>
    <p></p>	
    <input type="submit" name="btn" value="Aceptar"class="btn">
</form>
</div>



<p></p>	
<?php
// OBTENER EL COD_PERSONA DEL ARRAY SESSION AL HABER INICIADO SESION
$Cod_persona= $_SESSION['Cod_persona'];
// OBTENER LOS DATOS DEL FORMULARIO
$ciclo=isset($_POST['ciclo'])? $_POST['ciclo'] :"";
$linea=isset($_POST['linea'])? $_POST['linea'] :"";
$marca=isset($_POST['marca'])? $_POST['marca'] :"";
$sede=isset($_POST['sede'])? $_POST['sede'] :"";
$carrera=isset($_POST['carrera'])? $_POST['carrera'] :"";
$z=0;
$btn=isset($_POST['btn'])? $_POST['btn'] :"";

if($btn=="Aceptar")
{ 
    
    // OBTENER EL NOMBRE DE LA CARRERA QUE SELECCIONO
    $aaa="SELECT Descripcion from sub_linea WHERE cod_linea='001' and cod_marca ='01' and cod_sublinea ='$carrera'"; 
   $query_esp=(mysqli_query($conn,$aaa));
    $rpta=mysqli_fetch_assoc($query_esp);
    $_SESSION['nombre_carrera'] =  $rpta['Descripcion'];

    
    //especialidad
    $_SESSION['ciclo']   =  $ciclo;
    $_SESSION['linea']   =  $linea;
    $_SESSION['marca']   =  $marca;
    $_SESSION['sede']    =  $sede;
    $_SESSION['carrera']    =  $carrera;
    
    echo "<div class='container'>";
    echo "<a href='../reportes/boleta_n.php' target='_blank'>Descargar pdf</a>";
    echo "</div>";

}




echo "<p></p>";

include "pie.php";

?>




