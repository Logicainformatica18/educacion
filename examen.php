<?php
session_start();
require 'conexion.php';
require "profesor_validar.php";
$dni = $_SESSION['profesor_dni'];
require "encabezado_profesor.php";
$cod_curso = isset($_SESSION["cod_curso"]) ? $_SESSION["cod_curso"] : "";
$resultado = mysqli_query($conn, "select cod_curso,descripcion from curso where cod_curso='$cod_curso'");
$r = mysqli_fetch_assoc($resultado);

//INSERT
if (isset($_POST["btn"]) == "guardar") {
    $pregunta = isset($_POST["pregunta"]) ? $_POST["pregunta"] : "";
    $alternativaa = isset($_POST["alternativaa"]) ? $_POST["alternativaa"] : "";
    $alternativab = isset($_POST["alternativab"]) ? $_POST["alternativab"] : "";
    $alternativac = isset($_POST["alternativac"]) ? $_POST["alternativac"] : "";
    $alternativad = isset($_POST["alternativad"]) ? $_POST["alternativad"] : "";
    $alternativae = isset($_POST["alternativae"]) ? $_POST["alternativae"] : "";
    $respuesta = isset($_POST["respuesta"]) ? $_POST["respuesta"] : "";
    $query = "INSERT INTO `examen`(`dni`,`cod_curso`,`pregunta`,`a`,`b`,`c`,`d`,`e`,`respuesta`)values ('$dni','$cod_curso','$pregunta','$alternativaa','$alternativab','$alternativac','$alternativad','$alternativae','$respuesta')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Registrado Correctamente')</script>";
    } else {
        echo "<script>alert('Error de registro')</script>";
    }
}


// ELIMINAR PREGUNTA
$cod_examen_ = isset($_GET["id"]) ? $_GET["id"] : "";
if ($cod_examen_ != "") {
    if (mysqli_query($conn, "delete from examen where cod_examen='$cod_examen_'")) {
        echo "<script>alert('Eliminado Correctamente'); window.location.href='examen.php'</script>";
    } else {
        echo "<script>alert('Error de eliminación');</script>";
    }
}
?>

<div class="container">
    <b>
        <h4>Preguntas de exámen :<b> <?= $r["descripcion"]; ?></b></h4>
    </b>
    <a class="waves-effect waves-light btn modal-trigger" href="#modal2">Registrar pregunta</a>
    <div id="modal2" class="modal">
        <div class="modal-content">

            <form action="examen.php" method="post">
                <span>Escriba la pregunta :</span>

                <input type="text" name="pregunta">
                <h5>Alternativa A</h5>
                <input type="text" name="alternativaa">
                <h5>Alternativa B</h5>
                <input type="text" name="alternativab">
                <h5>Alternativa C</h5>
                <input type="text" name="alternativac">
                <h5>Alternativa D</h5>
                <input type="text" name="alternativad">
                <h5>Alternativa E</h5>
                <input type="text" name="alternativae">
                <h5> Marque la alternativa Correcta</h5>
                <label>
                    <input class="with-gap" name="respuesta" type="radio" value="A" /><span>A</span>
                </label>
                <label>
                    <input class="with-gap" name="respuesta" type="radio" value="B" /><span>B</span>
                </label>
                <label>
                    <input class="with-gap" name="respuesta" type="radio" value="C" /><span>C</span>
                </label>
                <label>
                    <input class="with-gap" name="respuesta" type="radio" value="D" /><span>D</span>
                </label>
                <label>
                    <input class="with-gap" name="respuesta" type="radio" value="E" /><span>E</span>
                </label>
                <p></p>
                <button type="submit" class="btn" name="btn" value="guardar">Guardar</button>
            </form>
        </div>
    </div>

    <p></p>

    <div id="contenido">
        <table class="responsive striped">
            <table border='1' class='striped responsive-table'>
                <tr>
                    <th bgcolor='#D8D8D8'>Código</th>
                    <th bgcolor='#D8D8D8'>Pregunta</th>
                    <th bgcolor='#D8D8D8'>Alternativa A</th>
                    <th bgcolor='#D8D8D8'>Alternativa B</th>
                    <th bgcolor='#D8D8D8'>Alternativa C</th>
                    <th bgcolor='#D8D8D8'>Alternativa D</th>
                    <th bgcolor='#D8D8D8'>Alternativa E</th>
                    <th bgcolor='#D8D8D8'>Respuesta</th>
                    <th bgcolor='#D8D8D8'>Opción</th>
                    <th bgcolor='#D8D8D8'>Opción</th>
                </tr>
                <?php
                $result = mysqli_query($conn, "select * from examen where cod_curso =$cod_curso");
                while ($r = mysqli_fetch_array($result)) {
                    $cod_examen = $r[0];
                    echo "<tr>";
                    echo "</td>" . "<td>" . $r[0] . "</td>" .
                        "<td>" . $r[3] . "</td>" . "<td>" . $r[4] . "</td>" . "<td>" . $r[5] . "</td>"
                        . "<td>" . $r[6] . "</td>" . "<td>" . $r[7] . "</td>" . "<td>" . $r[8] . "</td>"
                        . "<td>" . $r[9] . "</td>";
                    ?>
                    <!-- Modal Trigger -->
                    <td><a class="waves-effect waves-light btn modal-trigger" href="#modal1" onclick='examen(<?php echo $cod_examen ?>)'>Modificar</a></td>
                <?php
                    //   echo "<td><a  class='waves-effect waves-light btn modal-trigger' href='#modal1'  >Modificar</a></td>";
                    echo "<td><a href='#'  class='waves-effect red darken-4 btn-small' onclick='pregunta_examen_delete($cod_examen)'>Eliminar</a></td>";
                    echo "</tr>";
                }
                ?>

            </table>
            <!-- Modal Structure -->

            <div id="modal1" class="modal">
                <div class="modal-content">
                    <?php
                    // ELIMINAR PREGUNTA
                    $examen = isset($_GET["examen"]) ? $_GET["examen"] : "";
                    $query_examen = mysqli_query($conn, "select * from examen where cod_examen='$examen'");
                    $r = mysqli_fetch_assoc($query_examen);
                    ?>
                    <form action="examen.php" method="post">
                        <span>Escriba la pregunta :</span>

                        <input type="text" name="pregunta" value="<?php echo $r['pregunta'] ?>">
                        <h5>Alternativa A</h5>
                        <input type="text" name="alternativaa" value="<?php echo $r['a'] ?>">
                        <h5>Alternativa B</h5>
                        <input type="text" name="alternativab" value="<?php echo $r['b'] ?>">
                        <h5>Alternativa C</h5>
                        <input type="text" name="alternativac" value="<?php echo $r['c'] ?>">
                        <h5>Alternativa D</h5>
                        <input type="text" name="alternativad" value="<?php echo $r['d'] ?>">
                        <h5>Alternativa E</h5>
                        <input type="text" name="alternativae" value="<?php echo $r['e'] ?>">
                        <h5> Marque la alternativa Correcta</h5>
                        
                        <?php
                        $a="";$b="";$c="";$d="";$e="";
                        if($r["respuesta"]=="A"){$a="checked";}elseif($r["respuesta"]=="B"){$b="checked";}
                        elseif($r["respuesta"]=="C"){$c="checked";} elseif($r["respuesta"]=="D"){$d="checked";}
                        elseif($r["respuesta"]=="E"){$e="checked";}
                        ?>
                        <label>
                            <input class="with-gap" name="respuesta" type="radio" value="A" <?= $a ?>/><span>A</span>
                        </label>
                        <label>
                            <input class="with-gap" name="respuesta" type="radio" value="B"<?= $b ?> /><span>B</span>
                        </label>
                        <label>
                            <input class="with-gap" name="respuesta" type="radio" value="C"<?= $c ?> /><span>C</span>
                        </label>
                        <label>
                            <input class="with-gap" name="respuesta" type="radio" value="D"<?= $d ?> /><span>D</span>
                        </label>
                        <label>
                            <input class="with-gap" name="respuesta" type="radio" value="E"<?= $e ?> /><span>E</span>
                        </label>
                        <p></p>
                        <button type="submit" class="btn" name="btn" value="modificar">Guardar</button>
                    </form>

                </div>
            </div>
    </div>
</div>







<script>
    function examen(examen) {
        window.location.href = "examen.php?examen=" + examen + "#contenido";
    }

    function pregunta_examen_delete(id) {
        if (confirm('¿Estas seguro de eliminar?')) {
            window.location.href = "examen.php?id=" + id;
        }
    }
    // Or with jQuery

    $(document).ready(function() {
        $('.modal').modal();
    });
</script>
<?php

require_once('pie.php');
?>