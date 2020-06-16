<?php
session_start();
include "../conexion.php";
  //////////////////////////
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$columna1="UNIDAD DIDÁCTICA";
$columna2="NOTA";

$web="<!DOCTYPE html>
<html lang='es'>
  <head>
  <meta charset='utf-8'> vs <meta http-equiv='Content-Type'>
    <title>Reporte de Notas</title>
    <link rel='stylesheet' href='style.css' media='all' />
  </head>
  <body>
  <div class='marco'>
    <header class='clearfix'>
      <div id='logo'>
        <img src='cesca.png'>
      </div>
      <h1>RECORD ACADÉMICO DE NOTAS POR ALUMNO</h1>";

      $Cod_persona=$_SESSION['Cod_persona'];
      $ciclo=  $_SESSION['ciclo']   ;
      $linea=  $_SESSION['linea']   ;
      $marca=  $_SESSION['marca']   ;
      $sede=   $_SESSION['sede']    ;
      $carrera=$_SESSION['carrera'] ;
      $nombre_carrera=$_SESSION['nombre_carrera'] ;
      $name=$_SESSION['name']." ".$_SESSION['paterno']." ".$_SESSION['materno'];

      if($ciclo=="00020"){$ciclo_="Primer Ciclo";}elseif($ciclo=="00030"){$ciclo_="Segundo Ciclo";}elseif($ciclo=="00040"){$ciclo_="Tercer Ciclo";}elseif($ciclo=="00050"){$ciclo_="Cuarto Ciclo";}elseif($ciclo=="00060"){$ciclo_="Quinto Ciclo";}elseif($ciclo=="00070"){$ciclo_="Septimo Ciclo";}
      ;

      $web=$web."<pre class='detalle'>
  Codigo              : $Cod_persona   
  Apellidos y Nombres : $name
  Especialidad        : $nombre_carrera
  Ciclo               : $ciclo_
   </pre>";
      $web=$web."
      </header>
    <main>
      <table border='1'>
        <thead>
          <tr>
            <th>".$columna1."</th>
            <th>".$columna2."</th>

          </tr>
        </thead>
      <tbody>";
        $query="call Habitante_ver_nota('$Cod_persona', '$ciclo', '$linea', '$marca', '$sede', '$carrera');";
        $resultado=mysqli_query($conn,$query);
        $fila=mysqli_num_rows($resultado);
        $j1=0;
         while($j1<$fila)
           {
                $r=mysqli_fetch_array($resultado);
                $web=$web."<tr>";
                $web=$web."<td class='columna1'>".$r[0]."</td>";
                $web=$web."<td class='columna2'>".$r[1]."</td>";
              
                $web=$web."</tr>";
             $j1++;
             }
           $web=$web."
          </tbody>
      </table>
    </main>
    </div>
<footer>
Proyecto Informático desarrollado por Cardenas Aquino Anthony.
</footer>

</body></html> 
";
$mpdf->WriteHTML($web);
$mpdf->Output();
?>

