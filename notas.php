<?php
session_start();
include 'conexion.php';
include 'edit-profile.php';
require "alumno_encabezado.php";
// OBTENER EL COD_PERSONA DEL ARRAY SESSION AL HABER INICIADO SESION
$Cod_persona = $_SESSION['Cod_persona'];
// OBTENER LOS DATOS DEL FORMULARIO
$registro = isset($_POST['registro']) ? $_POST['registro'] : "";
$z = 0;
$btn = isset($_POST['btn']) ? $_POST['btn'] : "";
$asistencia = isset($_GET['asistencia']) ? $_GET['asistencia'] : "";
?>

<div class="container">
  <form action="notas.php" method="POST">
    <h3><b>CONSULTAR NOTAS</b></h3>
    <select name="registro" class="browser-default">
      <?php
      $j3 = 0;

      $query3 = (mysqli_query($conn, "select r.cod_registro,c.descripcion,p.paterno,p.materno,p.nombres from registro_detalle rd,registro r,alumno a,curso c,profesorist p where  rd.Cod_Persona='$Cod_persona'  and r.cod_registro = rd.cod_registro
        and a.cod_persona=rd.cod_persona and r.cod_curso=c.cod_curso and r.cod_profesorist=p.dni;"));
      $registro3 = mysqli_num_rows($query3);
      while ($j3 < $registro3) {
        $row3 = mysqli_fetch_array($query3);
        $Cod_sublinea = $row3[0];
        $Descripcion3 = $row3[1];
        echo "<option value='$Cod_sublinea'>$Descripcion3</option>";
        $j3++;
      }
      ?>
    </select>
    <p></p>
    <input type="submit" name="btn" value="Aceptar" class="btn">
  </form>

  <p></p>
  <?php
  if ($btn == "Aceptar") {

    // OBTENER EL NOMBRE DE LA CARRERA QUE SELECCIONO

    $aaa = "select a.cod_persona,a.paterno,a.materno,a.nombres,c.descripcion,c.cod_curso,n.n1,n.n2,n.n3,n.n4,n.n5,n.ex1,n.p1,n.n7,n.n8,n.n9,n.n10,n.n11,n.ex2,n.p2,n.pfinal,rd.cod_registro_detalle from alumno a,notas n,registro_detalle rd,curso c,
    registro r
      where  a.cod_persona=rd.cod_persona and  rd.cod_registro_detalle=n.cod_registro_detalle and c.cod_curso=r.cod_curso and rd.cod_registro=r.cod_registro
      and rd.cod_registro=$registro and  rd.cod_persona='$Cod_persona';";
    $query_esp = (mysqli_query($conn, $aaa));
    echo "<p></p>";
    echo "<h4>Registro N° $registro</h4>";

    $rf = mysqli_fetch_assoc($query_esp);
    $cod_curso=$rf["cod_curso"];
    $cod_persona = $rf['cod_persona'];
    $paterno = $rf['paterno'];
    $materno = $rf['materno'];
    $nombres = $rf['nombres'];
    $n1 = $rf['n1'];
    $n2 = $rf['n2'];
    $n3 = $rf['n3'];
    $n4 = $rf['n4'];
    $n5 = $rf['n5'];
    $ex1 = $rf['ex1'];
    $p1 = $rf['p1'];

    $n7 = $rf['n7'];
    $n8 = $rf['n8'];
    $n9 = $rf['n9'];
    $n10 = $rf['n10'];
    $n11 = $rf['n11'];
    $ex2 = $rf['ex2'];
    $p2 = $rf['p2'];
    $cod_registro_detalle = $rf['cod_registro_detalle'];
    $_SESSION['notas_cod_registro_detalle'] = $cod_registro_detalle;
    $pfinal = $rf['pfinal'];

    if ($pfinal != "") { }
    echo "<div class='row'>";
    // FORMULARIO
    ?>
    <a class="waves-effect waves-light btn red modal-trigger" href="#" onclick='evaluacion(<?php echo $cod_curso ?>)'>Dar Exámen</a>
    <?php
    echo "
 

  <h6>Unidad Formativa 1</h6>
    <table border='1' class='striped responsive-table'>
        <th>Nota 1</th><th>Nota 2</th><th>Nota 3</th><th>Nota 4</th>
        <th>Nota 5</th><th>Examen 1</th><th><h7 class='red-text text-darken-2'>Primer Promedio</h7></th>
  
        <tr>
        <td>$n1</td>
        <td>$n2</td>
        <td>$n3</td>
        <td>$n4</td>
        <td>$n5</td>
        <td>$ex1</td>
        <td> <h6>$p1</h6></td>
        </tr>
  
    </table>
  
    <h6>Unidad Formativa 2</h6>
  <table border='1' class='striped responsive-table'>
    <th>Nota 7</th><th>Nota 8</th><th>Nota 9</th><th>Nota 10</th>
    <th>Nota 11</th><th>Examen 2</th><th><h7 class='red-text text-darken-2'>Segundo Promedio</h7></th>
   <th> <h7 class='blue-text text-darken-2'>Promedio Final</h7></th>
  
    <tr>
    <td>$n7</td>
    <td>$n8</td>
    <td>$n9</td>
    <td>$n10</td>
    <td>$n11</td>
    <td>$ex2</td>
    <td><h6>$p2</h6></td>
    <td><h6>$pfinal</h6></td>
    </tr>
  
  </table>
  <p></p>";



    // $k3 = 1;
    // $query3k = (mysqli_query($conn, "select * from asistencia where cod_registro_detalle='$cod_registro_detalle' and fec_reg <= curdate();"));
    // $registro3k = mysqli_num_rows($query3k);



    // MARCADOR DE ASISTENCIA ////////////
    // echo "<h3>La Marcación de la Asistencia sólo podrá ser marcado el día de clases..</h3>";
    // echo "<form action='notas.php'>
    //   <button type='submit' class='btn-large' value='Marcar_Asistencia' name='asistencia'>Marcar Asistencia</button>
    //   </form>";
    // ///////////////////////////////

    // //// ASISTENCIA /////
    // echo "<table class='striped responsive-table'>";
    // echo "<thead><th>Semana</th><th>Estado</th><th>Hora de Marcación</th><th>Fecha</th></thead>";
    // echo "<tbody>";
    // while ($k3 <= $registro3k) {
    //   $rk = mysqli_fetch_array($query3k);
    //   $fecha = $rk[3];
    //   $hora = $rk[4];
    //   $estado = $rk[2];
    //   if ($estado == "F") {
    //     $estado = "<font color='red'>" . $estado . "</font>";
    //   }
    //   if ($estado == "A") {
    //     $estado = "<font color='blue'>" . $estado . "</font>";
    //   }
    //   echo "<tr>";
    //   echo "<td>$k3</td><td><h5>" . $estado . "</h5></td>" . "<td><input type='time' value='$hora'></td>" . "<td><input type='date' value='$fecha'></td>";
    //   echo "</tr>";
    //   $k3++;
    // }
    // echo "</tbody>";
    // echo "</table>";
  }

  /////////////////////////////////////////////// marcador de asistencia evalua por dia de clases
  // if ($asistencia == "Marcar_Asistencia") {
  //   $cod_registro_detalle = $_SESSION['notas_cod_registro_detalle'];
  //   // TimeZona America_Lima
  //   date_default_timezone_set("America/Lima");

  //   $fecha_actual = date('Y-m-d');
  //   //$fecha_actual=date('Y-m-d', strtotime('-6 day')) ;


  //   if (mysqli_query($conn, "call asistencia_insert('$cod_registro_detalle','$fecha_actual')")) {
  //     echo "<script> 
  //  alert('Marcación de Asistencia almacenado correctamente');
  //   </script>";
  //   } else {
  //     echo "<script> 
  //   alert('Error al Marcar Asistencia');
  //    </script>";
  //   }
  // }
  $cod_curso = isset($_GET["id"]) ? $_GET["id"] : "";
  if($cod_curso!=""){
    $_SESSION["cod_curso"]=$cod_curso;
    mysqli_query($conn,"delete from evaluacion where cod_persona='$Cod_persona' and cod_curso='$cod_curso'");
    echo "<script> window.location.href='evaluacion.php'</script>";
  }

  ?>
</div>
</div>
<pre>


</pre>

<script>
 function evaluacion(id) {
        if (confirm('¿Estás seguro de evaluarte?')) {
            window.location.href = "notas.php?id=" + id;
        }
    }
</script>

<?php
include "pie.php";

?>