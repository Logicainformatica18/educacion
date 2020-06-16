<?php
session_start();
require 'conexion.php';
require "profesor_validar.php";
require "encabezado_profesor.php";

$dni=$_SESSION['profesor_dni']; 
$instituto=isset($_POST['instituto'])? $_POST['instituto']:"";
$curso=isset($_POST['curso'])? $_POST['curso']:"";
$hora=isset($_POST['hora'])? $_POST['hora']:"";
$fecha_inicio=isset($_POST['dtfecha_inicio'])? $_POST['dtfecha_inicio']:"";
$fecha_fin=isset($_POST['dtfecha_fin'])? $_POST['dtfecha_fin']:"";
$frecuencia=isset($_POST['frecuencia'])? $_POST['frecuencia']:"";
$btn=isset($_POST['btn'])? $_POST['btn']:"";
$id=isset($_GET["r"])? $_GET["r"]:"";
$ide=isset($_GET["re"])? $_GET["re"]:"";


 // GESTION DE ENTREGADO 

 $r_estado=isset($_GET["r_estado"])? $_GET["r_estado"]:"";

     /////////////////////////////////////
     if($r_estado!="")
     {
       if(mysqli_query($conn,"call registro_entregado('$r_estado','$dni')"))
       {
    echo "<script>window.location.href='registro.php';</script>";
       }
       else
       {
        echo "<script> alert('Error de marcar entregado');</script>";
       }
     
     }
//
?>

<div class="container">

<?php
if($btn=="Guardar")
{
    $query="call registro_insert('$dni','$instituto','$curso','$hora','$frecuencia','$fecha_inicio','$fecha_fin')";

        if (mysqli_query($conn, $query)) {
            echo "<script type='text/javascript'>alert('Registrado Correctamente');
            </script>";
            }
        else
            {
                echo "<script type='text/javascript'>alert('Error de Registro');
                </script>";
            }
}



?>
<h2>Registros</h2>
<p></p>

 <!-- Modal Trigger -->
 <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Programar Registro</a>

<!-- Modal Structure -->
<div id="modal1" class="modal">
  <div class="modal-content">
  <h4>Programar Registro</h4>
<form method="post" action="registro.php" name="formulario">
Seleccione Instituto 
	<select name="instituto"class="browser-default">
        <?php
     
        $select3="SELECT Cod_marca,Descripcion from marca";
        $query3=(mysqli_query($conn,$select3));
        $registro3=mysqli_num_rows($query3);
        while($j3 < $registro3)
             {
                $row3 = mysqli_fetch_array($query3);
                $Cod3=$row3[0];
                $Descripcion3=$row3[1];
                echo "<option value='$Cod3'>$Descripcion3</option>";
                $j3++;
            }
        ?>
    </select>
Seleccione Curso  
	<select name="curso"class="browser-default">
        <?php
        $select1="Select c.cod_curso,c.Descripcion,s.descripcion from curso c,sub_linea s where c.Cod_sublinea = s.Cod_sublinea and s.cod_linea='001' and s.cod_marca ='01'  order by c.Descripcion;";
        $query1=(mysqli_query($conn,$select1));
        $registro1=mysqli_num_rows($query1);
        while($j1 < $registro1)
             {
                $row1 = mysqli_fetch_array($query1);
                $Cod_marca=$row1[0];
                $Descripcion1=$row1[1]." - ".$row1[2];
                echo "<option value='$Cod_marca'>$Descripcion1</option>";
                $j1++;
            }
        ?>
    </select>
    INICIO :  <input type="date" name="dtfecha_inicio" oninput="calcular_fecha()"class="datepicker"> 
    FIN : <input type="date" name="dtfecha_fin"class="datepicker"> 

<p></p>
    Seleccione Hora 
	<select name="hora"class="browser-default">
        <?php
     
        $select2="SELECT Cod_horario,Descripcion from horario";
        $query2=(mysqli_query($conn,$select2));
        $registro2=mysqli_num_rows($query2);
        while($j2 < $registro2)
             {
                $row2 = mysqli_fetch_array($query2);
                $Cod2=$row2[0];
                $Descripcion2=$row2[1];
                echo "<option value='$Cod2'>$Descripcion2</option>";
                $j2++;
            }
        ?>
    </select>

    Seleccione Frecuencia 
	<select name="frecuencia"class="browser-default">
        <?php
     
        $select3="SELECT Cod_frecuencia,Descripcion from registro_frecuencia";
        $query3=(mysqli_query($conn,$select3));
        $registro3=mysqli_num_rows($query3);
        while($j3 < $registro3)
             {
                $row3 = mysqli_fetch_array($query3);
                $Cod3=$row3[0];
                $Descripcion3=$row3[1];
                echo "<option value='$Cod3'>$Descripcion3</option>";
                $j3++;
            }
        ?>
    </select>
<p></p>
<input type="submit" name="btn" value="Guardar" class="btn">
</form>
  </div>
</div>
<script>
// Or with jQuery
 $(document).ready(function(){
    $('.modal').modal();
  });
</script>

</div>
</div>

<?php
// ELIMINAR REGISTRO

if($id!="")
{
  $query20="call registro_profesor_delete('$id','$dni')";
  
    $delete_reg=(mysqli_query($conn,$query20));
    if($delete_reg)
{
    echo "<script type='text/javascript'>alert('Eliminado correctamente');</script>";
}    
else
{
    echo "<script type='text/javascript'>alert('No fue posible eliminar');
    window.location.href='registro.php';
    </script>";
}

}
//mostrar registro
if($ide!="")
{
  $_SESSION['registro']=$ide;
  echo "<script type='text/javascript'>
  window.location.href='registro_mantenimiento.php';
  </script>";
}
?>
<div class="container">
<?php
 $select="  SELECT
 r.Cod_registro,
 m.descripcion,
 rf.descripcion,
 h.Descripcion,
 c.Descripcion,
 r.Fecha_inicio,
 r.Fecha_fin,
 r.entregado
FROM registro r,
    curso c,
    horario h,
    registro_frecuencia rf,
    marca m
WHERE c.Cod_curso = r.Cod_curso
AND h.Cod_horario = r.Cod_horario
AND r.Cod_frecuencia = rf.Cod_Frecuencia
AND m.cod_marca = r.Cod_marca
AND r.cod_profesorist = '$dni'
ORDER BY r.Fecha_fin DESC;;";
 $resultado  = mysqli_query($conn,$select);
 $fila   = mysqli_num_rows($resultado);
$z=0;




 echo "<table class='striped responsive-table'>";
 echo "<th>Codigo</th><th>Instituto</th><th>Frecuencia</th><th>Horario</th><th>Curso</th><th>Fecha Inicio</th><th>Fecha Fin</th><th> - Entregado - </th><th>Mostrar</th><th>Eliminar</th>";
 while($r = mysqli_fetch_array($resultado))
 {
     
     
     $id_registro=$r[0];
  
       //evalua estado del registro.
       $estado__=$r[7];
       if($estado__=="si"){ $checked="SI";  $color=" bgcolor='lightblue'";} else{ $checked="NO";$color="";}
         
     echo "<tr>";
     echo "<td $color>".$id_registro."</td>"."<td$color>".$r[1]."</td>"."<td$color>".$r[2]."</td>"."<td$color>".$r[3]."</td>"."<td$color>".$r[4]."</td>"."<td$color>".$r[5]."</td>"."<td$color>".$r[6]."</td>"."
     <td$color>
     
     <a onclick='change_estado_entregado($id_registro)' class='waves-effect indigo darken-3 btn-small'>$checked</a>
   </td>";
     echo " <td$color><a  onclick='registro_select($id_registro)' class='waves-effect green darken-4 btn-small'>Mostrar</a></td>";
     echo " <td$color><a  onclick='registro_delete($id_registro)' class='waves-effect red darken-4 btn-small'>Eliminar</a></td>";
     echo "</tr$color>";



 }
 echo "</table>";




 ?>

 

 <p></p>
 <script>
 function registro_select(ide){
   
   window.location.href ="registro.php?re=" + ide;

}
function calcular_fecha()
{
    var hoy =formulario.dtfecha_inicio.value;

    var a=Date.parse(hoy);
    fecha =  new Date(a);
fecha.setDate(fecha.getDate()+77);
var anio=fecha.getFullYear();
var mes=(fecha.getMonth() + 1);
var dia=(fecha.getDate()+1 );
if(parseInt(dia)<=9)
{
    dia="0"+dia;
}
if(parseInt(mes)<=9)
{
    mes="0"+mes;
}
var ff=anio+"-"+mes+"-"+dia;
   formulario.dtfecha_fin.value=ff;
}

function change_estado_entregado(r)
{
  window.location.href="registro.php?r_estado=" + r;
 
}


 </script>

<script src="js/funciones.js"></script>

</div>
<?php
include "pie.php";
?>