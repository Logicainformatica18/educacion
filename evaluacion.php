<?php
session_start();
include 'conexion.php';
include 'edit-profile.php';
require "alumno_encabezado.php";
$cod_curso = isset($_SESSION["cod_curso"]) ? $_SESSION["cod_curso"] : "";
?>
<div class="container">
    <h3>Tiempo :</h3>
    <a class="waves-effect waves-light btn black modal-trigger" onclick="nota_evaluacion(<?= $cod_curso ?>)" href="#">Obtener Nota</a>
    <p><b>Nota : </b> Al finalizar el tiempo, el formulario se guardará automáticamente.</p>
    <?php
    if ($cod_curso != "") {
        $respuesta = isset($_POST["respuesta"]) ? $_POST["respuesta"] : "";
        $cod_examen_ = isset($_POST["cod_examen_"]) ? $_POST["cod_examen_"] : "";
        $cod_persona = $_SESSION["Cod_persona"];
        $btn = isset($_POST["btn"]) ? $_POST["btn"] : "";
        if ($btn == "marcar") {
            $procedure="call evaluacion_insert('$cod_persona','$cod_curso','$cod_examen_','$respuesta')";
            if (mysqli_query($conn, $procedure)) {
                echo "<script> alert('MARCADO Y GUARDADO CORRECTAMENTE'); </script>";
            }
            else{
                echo "<script> alert('ESTA PREGUNTA YA HA SIDO MARCADA'); </script>";
            }
        }
        echo "<table border='1' class='striped responsive-table'>";
        ?><tr>
            <th bgcolor='#D8D8D8'>Código</th>
            <th bgcolor='#D8D8D8'>Pregunta</th>
            <th bgcolor='#D8D8D8'>Responder</th>
            
        </tr>
        <?php
            $resultado  = mysqli_query($conn, "SELECT * FROM examen where cod_curso='$cod_curso';");
            while ($r = mysqli_fetch_array($resultado)) {
                $cod_examen = $r[0];
                echo "<tr>";
                echo "<td>" . $r[0] . "</td>" . "<td>" . $r[3] . "</td> ";
                ?>
            <td>
                <!-- Modal Trigger -->
                <a class="waves-effect waves-light btn red modal-trigger" onclick="evaluacion(<?= $cod_examen ?>)" href="#modal1">Reponder</a></td>
            </tr>"
    <?php
        }
        echo "</table>";
    }
    ?>
</div>
<script>
    function evaluacion(examen) {
        window.location.href = "evaluacion.php?examen=" + examen + "#modal1";
    }
    function nota_evaluacion(nota_eval) {
        if (confirm('¿Estás seguro de obtener tu nota?')) {
            window.location.href = "evaluacion.php?nota_eval=" + nota_eval;
        }
    }
    // Or with jQuery
    $(document).ready(function() {
        $('.modal').modal();
    });
</script>
<?php
$cod_examen = isset($_GET["examen"]) ? $_GET["examen"] : "";
if ($cod_examen != "") {
    $quer = mysqli_query($conn, "select * from examen where cod_examen='$cod_examen'");
    $r = mysqli_fetch_assoc($quer);
    // <!-- Modal Structure -->
    echo "<div id='modal1' class='modal'><div class='modal-content'>";
    echo "<form action='evaluacion.php' method='post'>";
    echo  "<h3>" . $r["pregunta"] . "<input type='hidden' name='cod_examen_' value='" . $cod_examen . "'></h3>";
    echo "<label><input class='with-gap' name='respuesta' type='radio' value='A'/><span>" . $r["a"] . "</span></label><br>";
    echo "<label><input class='with-gap' name='respuesta' type='radio' value='B'/><span>" . $r["b"] . "</span></label><br>";
    echo "<label><input class='with-gap' name='respuesta' type='radio' value='C'/><span>" . $r["c"] . "</span></label><br>";
    echo "<label><input class='with-gap' name='respuesta' type='radio' value='D'/><span>" . $r["d"] . "</span></label><br>";
    echo "<label><input class='with-gap' name='respuesta' type='radio' value='E'/><span>" . $r["e"] . "</span></label><br>";
    echo "<button type='submit' class='btn' value='marcar' name='btn'>Marcar</button>";
    echo "</form>";
    echo "</div></div>";
}
$nota_eval=isset($_GET["nota_eval"])? $_GET["nota_eval"]:"";
$cod_registro_detalle=$_SESSION['notas_cod_registro_detalle'];
if($nota_eval!=""){
    $procedure_="call evaluacion_examen('$cod_persona','$cod_curso','$cod_registro_detalle')";
    if (mysqli_query($conn, $procedure_)) {
        echo "<script> window.location.href='resultado.php'; </script>";
    }
    else{
        echo "<script> alert('Error de procedimiento'); </script>";
    }
    
}
require_once('pie.php');
?>