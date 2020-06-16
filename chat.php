<?php
session_start();
include 'edit-profile.php';
include 'conexion.php';
require "alumno_encabezado.php";
// OBTENER EL COD_PERSONA DEL ARRAY SESSION AL HABER INICIADO SESION
$Cod_persona= $_SESSION['Cod_persona'];
$j=0;
// LISTAR MENSAJES ///////////////////////////////////////////
$select="SELECT Nombres,FECHA,MENSAJE,imagen,url_youtube,url_pdf FROM alumno_mensaje , alumno WHERE alumno_mensaje.Cod_persona=alumno.Cod_persona ORDER BY alumno_mensaje.FECHA DESC;";
$registro=(mysqli_query($conn,$select));
$fila= mysqli_num_rows($registro);
///////////////////////////////////////////////////////////////
?>

<head>

</head>

<?php
///////////////////////////////ENVIAR MENSAJE
$boton=isset($_POST['btnenviar'])? $_POST['btnenviar'] :"";
$mensaje=isset($_POST['txtmensaje'])? $_POST['txtmensaje'] :"";
$imagen=isset($_FILES['imagen']['tmp_name'])? $_FILES['imagen']['tmp_name']:"";
$url=isset($_POST['url'])? $_POST['url'] :"";
$pdf=isset($_POST['pdf'])? $_POST['pdf'] :"";;
if($boton=="enviar" && $mensaje!="")
{
    if($imagen!="")
{
    $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
}
    
    $insert="call Alumno_mensaje_insert('$Cod_persona','$mensaje', '$imagen','$url','$pdf');";
    
    if((mysqli_query($conn,$insert)))
    {
        echo "<script>
        location.href ='chat.php';
      </script> ";
   
    }
    else
    {
        echo "<script>
        alert('error de envio');
        </script>";
    };
}

///////////////////////////////////////////////////////////////
?>

<div class="container">
<p></p>
    <!-- Modal Trigger -->
    <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Crear Publicación</a>

    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <form action="chat.php" method="post" class="enviar_mensaje" enctype="multipart/form-data">
                <h6>Escriba un publicación</h6>
                <textarea name="txtmensaje" cols="100%" rows="4">
                </textarea>
                <p></p>
                <input type="file" name="imagen" accept="image/png, .jpeg, .jpg, image/gif" />
                <p>Inserte url youtube
                    <input type="text" name="url" class="txt">
                </p>
                <p>Inserte url pdf google drive
                    <input type="text" name="pdf" class="txt">
                </p>
                <input type="submit" name="btnenviar" value="enviar" class="btn">
            </form>
        </div>
    </div>

    <script>
          // Or with jQuery

  $(document).ready(function(){
    $('.modal').modal();
  });
    </script>


    <?php
     while ($j<=$fila)
    {
        $r = mysqli_fetch_array($registro);
 //Los nombres de los campos deben de ir en Mayuscula o Minuscula según
 //se hayan creado
 echo "<div align='left'><hr>".$r[0]." </hr><font color='red'>".$r[1]."</font>          </div>";
 echo "<font color='blue' size='5'>".$r[2]."</font> ";
 $img=base64_encode($r['imagen']);

 if($img!="")
 {
    echo "<p></p>";
    echo  "<img src='data:image/jpg;base64,$img' width='200px'  alt='' class='materialboxed'>"."<br>";
 }
$url_youtube=$r['url_youtube'];
if($url_youtube!="")
{
    echo "<p></p>";
    // str_replace FUNCION QUE REEMPLAZA UNA CADENA DE TEXTO
$url_youtube = str_replace('/watch?v=', "/embed/", $url_youtube);
    echo "<iframe width='460' height='215' src='$url_youtube' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
}  
$url_pdf=$r['url_pdf'];
if($url_pdf!="")
{
    echo "<p></p>";
 // str_replace FUNCION QUE REEMPLAZA UNA CADENA DE TEXTO
$url_pdf = str_replace('/view', "/preview", $url_pdf);
 echo "<iframe src='$url_pdf' width='100%' height='580'></iframe>";
} 
 $j++;
}
?>
<script>
      // Or with jQuery

  $(document).ready(function(){
    $('.materialboxed').materialbox();
  });
    </script>
</div>
<?php
include "pie.php";
?>