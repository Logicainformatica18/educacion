<?php
session_start();
include "conexion.php";
include 'profesor_validar.php';
include "encabezado_profesor.php";
$dni=$_SESSION['profesor_dni']; 
$action=isset($_POST['action'])? $_POST['action']:"";
$semana=isset($_POST['semana'])? $_POST['semana']:"";
$curso=isset($_POST['curso'])? $_POST['curso']:"";
$titulo=isset($_POST['titulo'])? $_POST['titulo']:"";
$mensaje=isset($_POST['mensaje'])? $_POST['mensaje']:"";
$url_pdf=isset($_POST['pdf'])? $_POST['pdf']:"";
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
    <form action="publicar.php" method="post">
        <h6 class="title"><b>Publicación Docente</b></h6>
        <input id="text" type="text" placeholder="Titulo" name="titulo">

        <label>Seleccione Curso</label>
        <select class="browser-default" name="curso">
            <?php
     $select3="Select c.cod_curso,c.Descripcion,s.descripcion from curso c,sub_linea s where c.Cod_sublinea = s.Cod_sublinea and s.cod_linea='001' and s.cod_marca ='01' order by c.descripcion asc";
     $query3=(mysqli_query($conn,$select3));
     $registro3=mysqli_num_rows($query3);
     while($j3 < $registro3)
          {
             $row3 = mysqli_fetch_array($query3);
             $Cod3=$row3[0];
             $Descripcion3=$row3[1]." ".$row3[2];
             echo "<option value='$Cod3'>$Descripcion3</option>";
             $j3++;
         }
     ?>
        </select>
        <label>Seleccione Semana</label>
        <select class="browser-default" name="semana">
            <option value='1'>Semana 1</option>
            <option value='2'>Semana 2</option>
            <option value='3'>Semana 3</option>
            <option value='4'>Semana 4</option>
            <option value='5'>Semana 5</option>
            <option value='6'>Semana 6</option>
            <option value='7'>Semana 7</option>
            <option value='8'>Semana 8</option>
            <option value='9'>Semana 9</option>
            <option value='10'>Semana 10</option>
            <option value='11'>Semana 11</option>
            <option value='12'>Semana 12</option>
        </select>
        <p>Inserte url pdf google drive
            <input type="text" name="pdf" class="txt">
        </p>
        <textarea id="materialnote" name="mensaje"></textarea>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#materialnote').materialnote({
                height: 250
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
        <button class="btn waves-effect waves-light" type="submit" name="action" value="Publicar">Publicar
            <i class="material-icons right">send</i>
        </button>
    </form>

    <div id="publicaciones">
        <h5><b>Publicaciones</b></h5>

    </div>

    <div class="container">



        <?php



            if($action=="Publicar")
            {
                if($titulo == "")
                {
                    echo "<script>alert('Error de Registro')</script>";
                    exit;
                
                }
$consulta="call publicacion_insert('$dni','$curso','$titulo','$semana','$mensaje','','$url_pdf')";
                if (mysqli_query($conn, $consulta)) {
                    echo "<script type='text/javascript'>alert('Registrado Correctamente')
                    window.location='publicar.php';</script>";
            
                    }
                else
                    {
                        echo "<script type='text/javascript'>alert('Error de Registro');

                        </script>";
                    }
            }


            ?>


    </div>
    <p></p>
</div>
<?php
include "pie.php";
?>