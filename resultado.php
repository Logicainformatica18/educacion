<?php
session_start();
include 'conexion.php';
include 'edit-profile.php';
require "alumno_encabezado.php";
$cod_curso = isset($_SESSION["cod_curso"]) ? $_SESSION["cod_curso"] : "";
$Cod_persona = isset($_SESSION["Cod_persona"]) ? $_SESSION["Cod_persona"] : "";
$query = mysqli_query($conn, "select count(pregunta) from examen where cod_curso=$cod_curso");
$r = mysqli_fetch_array($query);
$total = $r[0];
$query_ = mysqli_query($conn, "SELECT count(estado) from evaluacion where cod_persona='$Cod_persona' and cod_curso='$cod_curso' and estado='Correcto';");
$r = mysqli_fetch_array($query_);
$Correcto = $r[0];
?>
<div class="container">

    <h5><b>Resultado :</b></h5>
    <?php
    //  $Correcto=isset($Correcto)? :0;
    //  $total=isset($total)? :0;

            $condicion = $Correcto / $total;
            if ($condicion >= 0.90) {
                echo "<h3><b> Haz aprobado satisfactoriamente!!</b></h3>";
                echo "<b style='color:red;'> Dirígete a registro > selecciona el curso > y mira tu examen parcial y final </b>";
                echo "<h5>Superaste el 90% de preguntas respondidas correctamente 🥳🥳🥳!</h5>";
                echo "<img height='200' src='https://media.tenor.com/images/317765b242a398498b02c213c3297b18/tenor.gif'>";
                echo "<img height='200' src='http://media.biobiochile.cl/wp-content/uploads/2016/12/smv0vw.gif'>";
                echo "<img height='200' src='http://www.fmdos.cl/wp-content/uploads/2016/03/Felicidad-gif.gif'>";
            }
            else{
        
                echo "<h3><b> No haz cumplido con las calificación mínima!!</b></h3>";
                echo "<b style='color:red;'> No te preocupes, puedes volver a dar el exámen cuantas veces quieras!! </b>";
                echo "<h5>Tu calificación fue menos del 90%..</h5>";
            }
        
        
      
   
   
       
    


    ?>


</div>
<?php
require_once('pie.php');
?>