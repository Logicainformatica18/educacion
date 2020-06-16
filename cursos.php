<?php
session_start();
require 'conexion.php';
require "profesor_validar.php";
require "encabezado_profesor.php";

$Descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";
$ciclo = isset($_POST['ciclo']) ? $_POST['ciclo'] : "";
$carrera = isset($_POST['carrera']) ? $_POST['carrera'] : "";
$btn = isset($_POST['btn']) ? $_POST['btn'] : "";
$ciclo_ = isset($_POST['ciclo_']) ? $_POST['ciclo_'] : "";
?>
<div class="container">
    <?php
    if ($ciclo_ == "") {
        $ciclo_ = "I";
    }


    $query = "call curso_insert('$Descripcion','$ciclo','$carrera')";

    if ($btn == "Registrar" && $Descripcion != "") {
        $consulta = "SELECT Descripcion from curso where Descripcion='$Descripcion' and Cod_sublinea ='$carrera'";
        $rpta = (mysqli_query($conn, $consulta));
        $row = mysqli_num_rows($rpta);
        if ($row == 0) {
            if (mysqli_query($conn, $query)) {
                echo "<script type='text/javascript'>alert('Registrado Correctamente'); </script>";
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "<script type='text/javascript'>alert('Ya existe');
            </script>";
        }
    }

    ?>
    <form method="post" action="cursos.php">
        <h2>Registre Cursos</h2>
        <input type="text" name="descripcion" placeholder="Ingrese Curso" style="width:500px;">
        <p>Seleccione Ciclo</p>
        <select name="ciclo" class="browser-default">
            <option value="I">I</option>
            <option value="II">II</option>
            <option value="III">III</option>
            <option value="IV">IV</option>
            <option value="V">V</option>
            <option value="VI">VI</option>
        </select>
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
        <p></p>
        <input type="submit" name="btn" value="Registrar" class="btn">
    </form>
    <p></p>
    <?php
    $resultado  = mysqli_query($conn, "Select c.cod_curso, c.Descripcion,c.ciclo,s.descripcion from curso c,sub_linea s where c.Cod_sublinea = s.Cod_sublinea and s.cod_linea='001' and s.cod_marca ='01' order by c.descripcion ;");
    $fila   = mysqli_num_rows($resultado);
    $z = 0;
    echo "<table border='1' class='striped responsive-table'>";
    echo "<tr><th bgcolor='#D8D8D8'>Código</th><th bgcolor='#D8D8D8'>Curso</th><th bgcolor='#D8D8D8'>Ciclo</th>
    <th bgcolor='#D8D8D8'>Carrera</th><th bgcolor='#D8D8D8'>Opción</th></tr>";
    while ($z < $fila) {
        $r = mysqli_fetch_array($resultado);
        $cod_curso=$r[0];
        echo "<tr>";
        echo "<td>" . $r[0] . "</td>" . "<td>" . $r[1] . "</td>". "<td>" . $r[2] . "</td><td>".$r[3]."</td>
        <td><a href='#'  class='waves-effect blue darken-4 btn-small' onclick='examen($cod_curso)'>Exámen</a></td>";
        echo "</tr>";
        $z++;
    }
    echo "</table>";


    // guarda el curso en la sesion
    $cod_curso=isset($_GET["curso"])? $_GET["curso"]:"" ;
    if($cod_curso!=""){
        $_SESSION["cod_curso"]=$cod_curso;
        echo "<script> window.location.href='examen.php'</script>";
    }
?>


</div>

<script>
        function examen(curso) {
        window.location.href = "cursos.php?curso=" + curso;

    }
</script>

<?php
include "pie.php";

?>