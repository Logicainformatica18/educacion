<?php
session_start();
include "../conexion.php";
  ///////////////////////////////////////
$cod_registro=$_SESSION['registro'];
  // TimeZona America_Lima
  date_default_timezone_set("America/Lima");
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$web="<!DOCTYPE html>
<html lang='es'>
  <head>
  <meta charset='utf-8'> vs <meta http-equiv='Content-Type'>
    <title>Reporte de Asistencia Actual</title>
    <link rel='stylesheet' href='style.css' media='all' />
  </head>
  <body>
  <div class='marco'>
    <header class='clearfix'>
      <div id='logo'>
        <img src='cesca.png'>
      </div>
      <h1>REPORTE DE ASISTENCIA ACTUAL</h1>";

     
// consulta registro
// REGISTRO
$consulta="select p.paterno,p.materno,p.nombres,c.descripcion,h.descripcion as horario
from registro r,curso c,profesorist p, horario h where cod_registro='$cod_registro' and c.cod_curso=r.cod_curso and r.cod_profesorist=p.dni
and r.cod_horario=h.cod_horario 
";
$registro_= mysqli_query($conn,$consulta);
$datos=mysqli_fetch_assoc($registro_);
$curso=$datos['descripcion'];
$profesor=$datos['paterno']." ".$datos['materno']." ".$datos['nombres'];
$horario=$datos['horario'];
$hora=date('h:i');
$fecha_actual= date('d/m/Y');
//$fecha_actual= date('d/m/Y', strtotime('+5 day')); 
      $web=$web."<pre class='detalle'>
Curso           : $curso
Profesor        : $profesor
Fecha           : $fecha_actual
Hora            : $hora
Horario         : $horario  
   </pre>";
      $web=$web."
      </header>
    <main>
      <table border='1'>
        <thead>
          <tr>
            <th>Código</th>
            <th>Paterno</th>
            <th>Materno</th>
            <th>Nombres</th>
            <th>Estado</th>
          </tr>
        </thead>
      <tbody>";
        $query="call asistencia_reporte_actual('$cod_registro');";
        $resultado=mysqli_query($conn,$query);
        $fila=mysqli_num_rows($resultado);
        $j1=0;
         while($j1<$fila)
           {
                $r=mysqli_fetch_array($resultado);
                $web=$web."<tr>";
                $web=$web."<td class='columna2'> ".$r[0]."</td>";
                $web=$web."<td class='columna2'> ".$r[1]."</td>";
                $web=$web."<td class='columna2'> ".$r[2]."</td>";
                $web=$web."<td class='columna2'> ".$r[3]."</td>";

                if($r[4]=="A")
                {
                  $estado="ASISTIÓ";
                }
                else
                {
                  $estado ="FALTÓ";
                }

                $web=$web."<td class='columna2'>".$estado."</td>";
                $web=$web."</tr>";
             $j1++;
             }
           $web=$web."
          </tbody>
      </table>
      
    </main>
   
    </div>
<footer>
Sistema Académico desarrollado por Cardenas Aquino Anthony - 997852483.
</footer>

</body></html> 
";
$mpdf->WriteHTML($web);
$mpdf->Output();
?>