<?php
session_start();
require 'conexion.php';
require "profesor_validar.php";
require "encabezado_profesor.php";
// TimeZona America_Lima
date_default_timezone_set("America/Lima");

$registro = isset($_POST['registro']) ? $_POST['registro'] : "";
$carrera_elegida = isset($_GET["carrera"]) ? $_GET["carrera"] : "";
$modulo_elegido = isset($_GET["modulo"]) ? $_GET["modulo"] : "";
if ($carrera_elegida == "") {
    $carrera_elegida = "%";
}
if ($modulo_elegido == "") {
    $modulo_elegido = "%";
}
$registross = isset($_SESSION['registro']) ? $_SESSION['registro'] : "";
$consulta_registro = "SELECT rd.cod_registro_detalle,a.Cod_persona,a.Paterno,a.Materno,a.Nombres,r.cod_registro,
s.Descripcion as Carrera,m.Descripcion as Modulo ,r.Fecha_inicio,r.Fecha_fin,rf.Descripcion,h.descripcion as Hora
FROM alumno a,registro r,registro_detalle rd,modulo m,sub_linea s,registro_frecuencia rf,horario h
where a.Cod_Persona=rd.Cod_Persona
and r.Cod_Registro=rd.Cod_registro and rd.Cod_Modulo=m.Cod_Modulo and s.cod_linea='001' and s.cod_marca ='01'
and r.cod_frecuencia=rf.cod_frecuencia
and h.cod_horario=r.cod_horario
and s.cod_sublinea=rd.cod_sublinea
 and r.Cod_Registro ='$registross' and s.Descripcion like'$carrera_elegida' and m.Descripcion like'$modulo_elegido'
 order by a.Paterno asc;
 ";

// GUARDA LA CONSULTA GENERADA PARA ELABORAR EL REPORTE DE REGISTROS
$_SESSION["modulo"] = $modulo_elegido;
$_SESSION["carrera"] = $carrera_elegida;
$_SESSION["consulta_registro"] = $consulta_registro;
// GUARDA LA CONSULTA GENERADA PARA ELABORAR EL REPORTE DE REGISTROS
$resultado2 = mysqli_query($conn, $consulta_registro);
$fila2 = mysqli_num_rows($resultado2);
$z2 = 0;
?>
<div class="container">
    <?php

    $fecha_actual = date('d/m/Y');

    // REGISTRO
    $registro_ = mysqli_query($conn, "select c.descripcion from registro r,curso c where cod_registro='$registross' and c.cod_curso=r.cod_curso");
    $datos = mysqli_fetch_assoc($registro_);
    $curso = $datos['descripcion'];
    echo "";
    echo "<h3 class='responsive'><b>$curso</b></h3>";
    echo "<h5>Registro<b>       : $registross</b></h5>";
    echo "<h5>N° de Alumnos<b>  : $fila2</b></h5>";
    echo "";

    ?>
    <!-- Modal Trigger -->
    <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Agregar Alumno</a>

    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">

            <form method="post" action="registro_mantenimiento.php" name="registro_alumno">

                <h6>Registro de Alumno en Curso</h6>

                <!-- AUTOCOMPLETADO BUSQUEDA DE ALUMNO -->
                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field col s12">

                                <input type="text" id="autocomplete-input" class="autocomplete" name="Cod_persona" requerid>
                                <label for="autocomplete-input">Busqueda de Alumno</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- AUTOCOMPLETADO BUSQUEDA DE ALUMNO -->

                <p></p>
                <p>Seleccione Carrera Profesional</p>
                <select name="carrera" class="browser-default">
                    <?php
                    $j3 = 0;
                    $select99 = "SELECT Cod_sublinea,Descripcion from sub_linea WHERE cod_linea='001' and cod_marca ='01'";
                    $query3 = (mysqli_query($conn, $select99));
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
                <p>Seleccione Modulo
                    <select name="modulo" class="browser-default">
                        <?php
                        $j3 = 0;
                        $select999 = "SELECT Cod_modulo,Descripcion from modulo;";
                        $query39 = (mysqli_query($conn, $select999));
                        $registro39 = mysqli_num_rows($query39);
                        while ($j3 < $registro39) {
                            $row39 = mysqli_fetch_array($query39);
                            $Cod_sublinea9 = $row39[0];
                            $Descripcion39 = $row39[1];
                            echo "<option value='$Cod_sublinea9'>$Descripcion39</option>";
                            $j3++;
                        }
                        ?>
                    </select>
                </p>
                <input type="submit" name="btn" value="Agregar" class="btn">
            </form>
        </div>
    </div>
    <script>
        // Or with jQuery
        $(document).ready(function() {
            $('.modal').modal();
        });
    </script>


    <a class="waves-effect red btn" href="../reportes/registro_reporte.php" target="_blank">Reporte Registro</a>
    <?php

    // GENERAR REPORTE PDF -->
    // REPORTE ASISTENCIA
    echo "<a  onclick='reporte_asistencia_actual($registross)'  href='../reportes/rp_asistencia_actual.php' target='_blank' class='waves-effect lightblue darken-4 btn-small'>
Emitir Reporte de Asistencia del día $fecha_actual</a>";
    $cod_registro = isset($_GET['registro']) ? $_GET['registro'] : "";
    echo "<table border='1' class='striped responsive-table'>";

    ?>
    <p></p>
    <th bgcolor="#D8D8D8">Codigo Detalle</th>
    <th bgcolor="#D8D8D8">Codigo Alumno</th>
    <th bgcolor="#D8D8D8">Paterno</th>
    <th bgcolor="#D8D8D8">Materno</th>
    <th bgcolor="#D8D8D8">Nombres</th>

    <th bgcolor="#D8D8D8">
        <form name="listar_registro">
            <select name="modulo" class="browser-default" onchange="elegir_modulo()">
                <option value="%">Modulo I y II -</option>
                <?php
                $j3 = 0;
                $selected = "";
                $select999 = "SELECT Descripcion from modulo;";
                $query39 = (mysqli_query($conn, $select999));
                $registro39 = mysqli_num_rows($query39);
                while ($j3 < $registro39) {
                    $row39 = mysqli_fetch_array($query39);
                    $Cod_sublinea9 = $row39[0];
                    // HACE QUE PERMANESCA LA OPCION SELECCIONADA EN EL SELECT
                    if ($Cod_sublinea9 == $modulo_elegido) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    echo "<option $selected value='$Cod_sublinea9'>$Cod_sublinea9</option>";
                    $j3++;
                }
                ?>
            </select>

    </th>
    <th bgcolor="#D8D8D8">

        <select name="carrera" class="browser-default" onchange="elegir_carrera()">
            <option value="%">Todas las Carreras</option>
            <?php
            $j3 = 0;
            $select99 = "SELECT s.Descripcion as Carrera
      FROM alumno a,registro r,registro_detalle rd,modulo m,sub_linea s,registro_frecuencia rf,horario h
      where a.Cod_Persona=rd.Cod_Persona
      and r.Cod_Registro=rd.Cod_registro and rd.Cod_Modulo=m.Cod_Modulo and s.cod_linea='001' and s.cod_marca ='01'
      and r.cod_frecuencia=rf.cod_frecuencia
      and h.cod_horario=r.cod_horario
      and s.cod_sublinea=rd.cod_sublinea
       and r.Cod_Registro ='$registross'
      group by s.Descripcion";
            $query3 = (mysqli_query($conn, $select99));
            $registro3 = mysqli_num_rows($query3);
            while ($j3 < $registro3) {
                $row3 = mysqli_fetch_array($query3);
                $Cod_sublinea = $row3[0];
                // HACE QUE PERMANESCA LA OPCION SELECCIONADA EN EL SELECT
                if ($Cod_sublinea == $carrera_elegida) {
                    $marcaropcion = "selected";
                } else {
                    $marcaropcion = "";
                }
                echo "<option $marcaropcion value='$Cod_sublinea'>$Cod_sublinea</option>";
                $j3++;
            }
            ?>
        </select>
        </form>
    </th>
    <th bgcolor="#D8D8D8">Asistencia</th>
    <th bgcolor="#D8D8D8">Llenar Notas</th>
    <th bgcolor="#D8D8D8">Opción</th>

    <?php
    while ($z2 < $fila2) {

        $r2 = mysqli_fetch_array($resultado2);
        echo "<tr>";
        $cod__ = $r2[1];
        $registro_detalle = $r2[0];
        $datito = "<td>" . $registro_detalle . "</td>" . "<td>" . $cod__ . "</td>" . "<td><b>" . $r2["Paterno"] . "</b></td>" . "<td>" . $r2["Materno"] . "</td>" . "<td>" . $r2["Nombres"] . "</td>" . "<td>" . $r2["Modulo"] . "</td>" . "<td>" . $r2["Carrera"] . "</td>";
        echo strtoupper($datito);
        //  MODAL1 VENTANA
        echo " <td><a href='#calificaciones'  class='waves-effect blue darken-4 btn-small' onclick='llenar_notas($registro_detalle)'>Calificaciones</a></td>";
        echo " <td><a href='#' onclick='eliminar($registro_detalle)' class='waves-effect red darken-4 btn-small'>Eliminar</a></td>";
        echo "</tr>";
        $z2++;
    }
    echo "</table>";
    ?>


    <?php
    // ELIMINAR ALUMNO
    $id = isset($_GET['del']) ? $_GET['del'] : "";
    if ($id != "") {
        $quety = "call registro_alumno_delete('$id');";
        if (mysqli_query($conn, $quety)) {
            echo "<script>
 alert('Eliminado correctamente');
 window.location.href='registro_mantenimiento.php';
  </script>";
        } else {
            echo "<script>
  alert('Error al Eliminar');
   </script>";
        }
    }
    // MARCAR ASISTENCIA
    $as = isset($_GET['asistencia']) ? $_GET['asistencia'] : "";
    // TimeZona America_Lima
    date_default_timezone_set("America/Lima");
    $fecha_actual = date('Y-m-d');
    if (isset($_GET["asistencia"])) {
        $asistencia_query = "call asistencia_marcar($as);";


        //  $asistencia_query="UPDATE asistencia set estado='A' where cod_registro_detalle='$as' and fec_reg='$fecha_actual';";
        if (mysqli_query($conn, $asistencia_query)) {
            echo "<script>
 //alert('Marcado correctamente');
 window.location.href='registro_mantenimiento.php';
  </script>";
        } else {
            echo "
            <script>

  alert('Error al Marcar Asistencia');
   </script>";
        }
    }

    $registro_detalle = isset($_GET['registro_detalle']) ? $_GET['registro_detalle'] : "";
    $n1 = "";
    $n2 = "";
    $n3 = "";
    $n4 = "";
    $n5 = "";
    $ex1 = "";
    $p1 = "";

    if ($registro_detalle != "") {
        $_SESSION['cod_registro_detalle'] = $registro_detalle;
        $quety = "select a.cod_persona,a.paterno,a.materno,a.nombres,n.n1,n.n2,n.n3,n.n4,n.n5,n.ex1,n.p1,n.n7,n.n8,n.n9,n.n10,n.n11,n.ex2,n.p2,n.pfinal,rd.cod_registro_detalle from alumno a,notas n,registro_detalle rd
  where  a.cod_persona=rd.cod_persona and  rd.cod_registro_detalle=n.cod_registro_detalle
  and rd.cod_registro='$registross' and  rd.cod_registro_detalle='$registro_detalle' ;";
        $data = mysqli_query($conn, $quety);

        $rf = mysqli_fetch_assoc($data);
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
        $pfinal = $rf['pfinal'];
        $cod_registro_detalle = $rf['cod_registro_detalle'];
        $_SESSION['profesor_promedio_final'] = $pfinal;

        // /////////////////////////////////////////////////////////////////////////FORMULARIO
        echo "
  <div id='calificaciones'>
<h5><b>Calificaciones - <span> $paterno $materno $nombres</span></b></h5>
<form action='registro_mantenimiento.php' method='post'>
<h6>Unidad Formativa 1</h6>
  <table border='1'>
      <th>Nota 1</th><th>Nota 2</th><th>Nota 3</th><th>Nota 4</th>
      <th>Nota 5</th><th>Examen 1</th><th><h7 class='red-text text-darken-2'>1 Promedio</h7></th>

      <tr>
      <td> <input type='text' value='$n1' name='n1'></td>
      <td> <input type='text' value='$n2' name='n2'></td>
      <td> <input type='text' value='$n3' name='n3'></td>
      <td> <input type='text' value='$n4' name='n4'></td>
      <td> <input type='text' value='$n5' name='n5'></td>
      <td> <input type='text' value='$ex1'name='ex1'></td>
      <td> <h6>$p1</h6></td>
      </tr>

  </table>

  <h6>Unidad Formativa 2</h6>
<table border='1' class='striped'>
  <th>Nota 7</th><th>Nota 8</th><th>Nota 9</th><th>Nota 10</th>
  <th>Nota 11</th><th>Examen 2</th><th><h7 class='red-text text-darken-2'>2 Promedio</h7></th>
 <th> <h7 class='blue-text text-darken-2'>Prom Final</h7></th>

  <tr>
  <td> <input type='text' value='$n7' name='n7'></td>
  <td> <input type='text' value='$n8' name='n8'></td>
  <td> <input type='text' value='$n9' name='n9'></td>
  <td> <input type='text' value='$n10' name='n10'></td>
  <td> <input type='text' value='$n11' name='n11'></td>
  <td> <input type='text' value='$ex2'name='ex2'></td>
  <td> <h6>$p2</h6></td>
  <td> <h6>$pfinal</h6></td>
  </tr>

</table>
  <input type='submit' class='btn' name='btnnota' value='Guardar'>

</form>
</div>
  ";
        /////////////////////

        $k3 = 1;
        $query3k = (mysqli_query($conn, "select * from asistencia where cod_registro_detalle='$cod_registro_detalle' and fec_reg <= curdate();"));
        $registro3k = mysqli_num_rows($query3k);

     
        echo "<h4>Asistencia</h4>";
        echo "<table class='striped responsive-table'>";
        echo "<thead>
        <th>Marcar</th>
        <th>Codigo</th>
<th>Semana</th><th>Estado</th><th>Hora de Marcación</th><th>Fecha</th>

</thead>";

        while ($k3 <= $registro3k) {
            $rk = mysqli_fetch_array($query3k);
            $cod_asistencia = $rk[0];
            $fecha = $rk[3];
            $hora = $rk[4];
            $estado = $rk[2];
            if ($estado == "F") {
                $estado = "<font color='red'>" . $estado . "</font>";
            }
            if ($estado == "A") {
                $estado = "<font color='blue'>" . $estado . "</font>";
            }
            echo "<tr>";
            echo " <td><a href='#'  class='waves-effect blue darken-4 btn-small' onclick='change_asistencia($cod_asistencia)'>Asistencia</a></td>";
            echo "<td>$cod_asistencia</td>
            <td>$k3</td><td><h5>" . $estado . "</h5></td>" . "<td><input type='time' value='$hora'></td>" . "<td><input type='date' value='$fecha'></td>";
            echo "</tr>";
            $k3++;
        }

        echo "</table>";
    }

    $btnnota = isset($_POST['btnnota']) ? $_POST['btnnota'] : "";
    $n1_ = isset($_POST['n1']) ? $_POST['n1'] : "";
    $n2_ = isset($_POST['n2']) ? $_POST['n2'] : "";
    $n3_ = isset($_POST['n3']) ? $_POST['n3'] : "";
    $n4_ = isset($_POST['n4']) ? $_POST['n4'] : "";
    $n5_ = isset($_POST['n5']) ? $_POST['n5'] : "";
    $ex1_ = isset($_POST['ex1']) ? $_POST['ex1'] : "";
    $n7_ = isset($_POST['n7']) ? $_POST['n7'] : "";
    $n8_ = isset($_POST['n8']) ? $_POST['n8'] : "";
    $n9_ = isset($_POST['n9']) ? $_POST['n9'] : "";
    $n10_ = isset($_POST['n10']) ? $_POST['n10'] : "";
    $n11_ = isset($_POST['n11']) ? $_POST['n11'] : "";
    $ex2_ = isset($_POST['ex2']) ? $_POST['ex2'] : "";

    $pfinal_ = isset($_SESSION['profesor_promedio_final']) ? $_SESSION['profesor_promedio_final'] : "";

    if ($btnnota == "Guardar" && $pfinal_ == "") {
        $rd = $_SESSION['cod_registro_detalle'];
        $quer12 = "insert into notas (cod_registro_detalle,n1,n2,n3,n4,n5,ex1,n7,n8,n9,n10,n11,ex2) values('$rd','$n1_','$n2_','$n3_','$n4_','$n5_','$ex1_','$n7_','$n8_','$n9_','$n10_','$n11_','$ex2_')";
        if (mysqli_query($conn, $quer12)) {
            echo "<script>
 alert('Guardado correctamente');

  </script>";
        } else {
            echo "<script>
  alert('Error al Guardar');
   </script>";
        }
    }

    if ($btnnota == "Guardar" && $pfinal_ != "") {
        $rd = $_SESSION['cod_registro_detalle'];
        $quer122 = "call notas_update('$rd','$n1_','$n2_','$n3_','$n4_','$n5_','$ex1_','$n7_','$n8_','$n9_','$n10_','$n11_','$ex2_');";

        if (mysqli_query($conn, $quer122)) {
            echo "<script>
 alert('Modificado correctamente');

  </script>";
        } else {
            echo "<script>
  alert('Error al Modificar');
   </script>";
        }
    }

    // REGISTRO DE ALUMNO
    $Cod_persona = isset($_POST['Cod_persona']) ? $_POST['Cod_persona'] : "";
    // extrae solo el codigo del alumno
    $Cod_persona = substr($Cod_persona, 0, 11);
    $cod_registro = isset($_SESSION['registro']) ? $_SESSION['registro'] : "";
    $btn = isset($_POST['btn']) ? $_POST['btn'] : "";
    $carrera = isset($_POST['carrera']) ? $_POST['carrera'] : "";
    $modulo = isset($_POST['modulo']) ? $_POST['modulo'] : "";
    if ($btn == "Agregar") {
        $query__ = (mysqli_query($conn, "call registro_detalle_insert($cod_registro, '$Cod_persona', '$modulo', '$carrera');"));
        if (!$query__) {
            echo "<script type='text/javascript'>alert('$Cod_persona');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Registrado Correctamente');
    window.location.href='registro_mantenimiento.php';
    </script>";
        }
    }

    ?>

    <script type="Text/Javascript">
        function eliminar(id){
     if (confirm('¿Estas seguro de eliminar este Alumno?'))
{
        window.location.href ="registro_mantenimiento.php?del=" + id;
     }
}
function llenar_notas(idd){


        window.location.href ="registro_mantenimiento.php?registro_detalle=" + idd+"#calificaciones";

}
function reporte_asistencia_actual(registro){


    window.location.href ="registro_mantenimiento.php?registro=" + registro;

}

</script>

    <?php
    if ($carrera_elegida != "") {
        echo "<script>
  listar_registro.carrera.value= '$carrera_elegida';
  </script>";
    }

    ?>

    <p>
    </p>







</div>
<pre>


</pre>

<script>
    // Or with jQuery
    $(document).ready(function() {
        $('input.autocomplete').autocomplete({
            data: {
                "Apple": null,
                "Microsoft": null,
                "Google": 'https://placehold.it/250x250',
                <?php
                $query_alumno = mysqli_query(
                    $conn,
                    "select cod_persona, paterno, materno, nombres from alumno;"
                );
                while ($rrr = mysqli_fetch_array($query_alumno)) {
                    echo "'" . $rrr[0] .
                        " " . $rrr[1] .
                        " " . $rrr[2] .
                        " " . $rrr[3] .
                        " " .
                        "' : null,";
                }
                echo "ultimo: null"; ?>

            }
        });
    });
</script>
<script>
    function elegir_carrera() {
        carrera = listar_registro.carrera.value;
        modulo = listar_registro.modulo.value;
        window.location.href = "registro_mantenimiento.php?carrera=" + carrera + "&modulo=" + modulo;
    }

    function elegir_modulo() {
        modulo = listar_registro.modulo.value;
        carrera = listar_registro.carrera.value;
        window.location.href = "registro_mantenimiento.php?modulo=" + modulo + "&carrera=" + carrera;

    }

    function change_asistencia(a) {
        window.location.href = "registro_mantenimiento.php?asistencia=" + a;

    }
</script>

<?php
include "pie.php";
?>