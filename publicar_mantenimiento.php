<?php
session_start();
include "conexion.php";
include 'profesor_validar.php';
include "encabezado_profesor.php";
$dni = $_SESSION['profesor_dni'];
$action = isset($_POST['action']) ? $_POST['action'] : "";
$semana = isset($_POST['semana']) ? $_POST['semana'] : "";
$curso = isset($_POST['curso']) ? $_POST['curso'] : "";
$titulo = isset($_POST['titulo']) ? $_POST['titulo'] : "";
$mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : "";

if (isset($_GET['up'])) {
    $_SESSION['cod_publicacion']=$_GET['up'];
}

$cod_publicacion=$_SESSION['cod_publicacion'];


if($action=="guardar"){
    if(mysqli_query($conn,"update  publicacion set semana='$semana',titulo='$titulo',mensaje='$mensaje',dni='$dni',cod_curso= '$curso' where cod_publicacion='$cod_publicacion'")){
            echo "<script> alert('Modificado Correctamente');</script>";
    }
    else {
        echo "<script> alert('Error al Modificar');</script>";
    }
}

$query = mysqli_query($conn, "SELECT * FROM publicacion p ,curso c where p.cod_curso=c.Cod_curso and cod_publicacion='$cod_publicacion';");
$re3 = mysqli_fetch_assoc($query);

?>
<!-- jQuery -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>

<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- MaterializeCSS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>

<!-- include skelenote css/js-->
<link href="publicaciones/dist/materialnote.css" rel="stylesheet" type="text/css">
<script src="publicaciones/dist/materialnote.js"></script>


<div class="container">
    <?php
    $query_espe = (mysqli_query($conn, "SELECT pu.cod_publicacion,pu.titulo,c.descripcion,pu.semana,pu.fec_reg,pu.url_youtube,pu.url_pdf
 FROM publicacion pu,profesorist p,curso c where pu.dni=p.dni and c.cod_curso=pu.cod_curso and p.dni='$dni'
 order by pu.fec_reg desc;"));
    $fila2e = mysqli_num_rows($query_espe);
    echo "<p></p>";
    $z2e = 0;

    echo "<table border='1' class='striped'>";
    echo "<thead>";
    echo "<th>Codigo de Publicación</th><th>Titulo</th><th>Curso</th><th>Semana</th><th>Fecha</th><th>Opcion</th><th>Opcion</th>";
    echo "</thead>";
    echo "<tbody>";
    while ($z2e < $fila2e) {
        $re2 = mysqli_fetch_array($query_espe);

        echo "<tr>";
        $codigo__ = $re2[0];
        echo "<td>" . $re2[0] . "</td>";
        echo "<td>" . $re2[1] . "</td>";
        echo "<td>" . $re2[2] . "</td>";
        echo "<td>" . $re2[3] . "</td>";
        echo "<td>" . $re2[4] . "</td>";
        echo " <td><a href='#dir' onclick='update($codigo__)' class='btn blue' >Seleccionar</a></td>";

        echo " <td><a href='#' onclick='eliminar($codigo__)' class='btn red' >Eliminar</a></td>";


        echo "</tr>";

        $z2e++;
    }
    echo "</tbody>";
    echo "</table>";
    echo "<p></p>";
    ?>


    <!-- Modal Structure -->

  
        <div id="dir">




                <form action="publicar_mantenimiento.php" method="post">
                    <h6 class="title"><b>Publicación Docente</b></h6>
                    <input id="text" type="text" placeholder="Titulo" name="titulo" value='<?php echo $re3['titulo']; ?>'>

                    <label>Seleccione Curso</label>
                    <select class="browser-default" name="curso">
                        <?php
                        $select3 = "Select c.cod_curso,c.Descripcion,s.descripcion,s.cod_sublinea from curso c,sub_linea s where c.Cod_sublinea = s.Cod_sublinea and s.cod_linea='001' and s.cod_marca ='01' order by c.descripcion asc";
                        $query3 = (mysqli_query($conn, $select3));
                        $registro3 = mysqli_num_rows($query3);
                        $selectede="";$j3=0;    
                        while ($j3 < $registro3) {
                            $row3 = mysqli_fetch_array($query3);
                            $Cod3 = $row3[0];
                            if ($re3['cod_curso'] == $row3[0]) {
                                $selectede = "selected";
                            }
                            $Descripcion3 = $row3[1] . " " . $row3[2];
                            echo "<option value='$Cod3' $selectede>$Descripcion3</option>";
                            $selectede="";
                            $j3++;
                        }
                        ?>
                    </select>
                    <label>Seleccione Semana</label>
                    <select class="browser-default" name="semana">
    <?php
    $j=1;$selected="";
    while($j<13){
        if ($j == $re3['semana']) {
            $selected = "selected";
        }
        echo "<option value='$j' $selected>".$j."</option>";
        $selected = "";
        $j++;
    }
    ?>
                    </select>
                    <p>Inserte url pdf google drive
                        <input type="text" name="pdf" class="txt" value='<?php echo $re3['url_pdf'];  ?>'>
                    </p>
                    <textarea id="materialnote" name="mensaje">

        <?php
        echo $re3['mensaje'];
        ?>
        </textarea>
                    <script type="text/javascript">
                    $(document).ready(function() {
                        $('#materialnote').materialnote({
                            height: 1200
                        });
                    });
                    </script>
                    <!--
    <div id="materialnote">
        MaterialNote v2.0.5
    </div>



<p>
    ddd
</p>

<script type="text/javascript">
$(document).ready(function() {
    $('#materialnote').materialnote({
        height: 350
    });
});
</script>
-->
                    <button class="btn waves-effect waves-light" type="submit" name="action" value="guardar">Guardar                      <i class="material-icons right">send</i>
                    </button>
                </form>


    </div>



    <?php



    if (isset($_GET['del'])) {
        $idd = $_GET['del'];
        if (mysqli_query($conn, "delete from publicacion where cod_publicacion='$idd';")) {
            echo "<script type='text/javascript'>alert('Publicación eliminada Correctamente')
    window.location='publicar_mantenimiento.php';</script>";
        } else {

            echo "<script type='text/javascript'>alert('Error de Borrado');

        </script>";
        }
    }


    ?>

    <script type="Text/Javascript">

        // Or with jQuery

  $(document).ready(function(){
    $('.modal').modal();
  });

        function eliminar(id){
     if (confirm('¿Estas seguro de eliminar esta publicación?'))
{
        window.location.href ="publicar_mantenimiento.php?del=" + id;
     }
}
function update(id){   
        window.location.href ="publicar_mantenimiento.php?up=" + id;

}


</script>
    <p></p>
</div>
<?php
include "pie.php";
?>