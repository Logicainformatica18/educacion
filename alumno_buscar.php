<?php
session_start();
include 'conexion.php';
include "profesor_validar.php";
include "encabezado_profesor.php";
?>
<body>

<div class="container">

<form method="post" action="alumno_buscar.php">
<h2>Buscar Alumno</h2>
<input type="text" name="descripcion"  width="200px" height='50px' placeholder=" Ingrese criterio">
<p></p>	
            <label>
            <input type="radio" name="tipo" value="2"checked class="with-gap"><span>Apellidos y Nombres</span>
			</label>
            <label>
            <input type="radio" name="tipo" value="1"class="with-gap" ><span>Código</span>
			</label>
            

<p></p>
<input type="submit" name="btn" value="Listar" class="btn">
</form> 
            
<?php
///////////////////////////////////////////////////////////////////////////////////////////////////
$btn=isset($_POST['btn'])?$_POST['btn']:"";
if($btn=="Listar")
{
    $Descripcion= isset($_POST['descripcion'])?$_POST['descripcion']:"";
    $tipo=isset($_POST['tipo'])?$_POST['tipo']:"";
    
     $query="call alumno_search('$Descripcion','$tipo');";
     $resultado  = mysqli_query($conn,$query);
     $fila   = mysqli_num_rows($resultado);
    $z=0;
     echo "<table border='1'>";
     echo "<td>Codigo</td><td>Paterno</td><td>Materno</td><td>Nombres</td>";
     while($z < $fila)
     {
         $r = mysqli_fetch_array($resultado);
         
         echo "<tr>";
         
         echo "<td>".$r[0]."</td>"."<td>".$r[1]."</td>"."<td>".$r[2]."</td>"."<td>".$r[3]."</td>";
         echo "</tr>";
         $z++;
     }
     echo "</table>";
}

?>
</div>
<pre>



</pre>

<?php
include "pie.php";

?>