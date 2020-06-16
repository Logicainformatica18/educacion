<?php
session_start();
//OBTENER CONSULTA DE  REGISTRO
$select = $_SESSION["consulta_registro"];
$cod_registro=$_SESSION['registro'];
$dni=$_SESSION["profesor_dni"];
$modulo=$_SESSION["modulo"];
$carrera=$_SESSION["carrera"];
if($modulo=="%"){$modulo="I y II";}
if($carrera=="%"){$carrera="Todos";}
// TimeZona America_Lima
date_default_timezone_set("America/Lima");
//////////////////////////////////////////////////////////////////////
include "../conexion.php";
////////////////////////////////////////////////////////////////////////
require_once __DIR__ . '/vendor/autoload.php'; 
//VERTICAL
//$mpdf = new \Mpdf\Mpdf();
// HORIZONTAL
$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

$rp="<html><body><div class='marco'>";
$rp=$rp."
<header class='clearfix'>
  <div id='logo'>
    <img src='cesca.png' width='150'>
  </div>";
  $rp=$rp."<h1 class='center'>Reporte de Notas</h1>
  ";
//////////////////////////////////////////////////////////////////////////////////////////////////////////
// consulta registro
// REGISTRO
$consulta1="select p.paterno,p.materno,p.nombres,c.descripcion,h.descripcion as horario, r.fecha_inicio,r.fecha_fin
from registro r,curso c,profesorist p, horario h where cod_registro='$cod_registro' and c.cod_curso=r.cod_curso and r.cod_profesorist=p.dni
and r.cod_horario=h.cod_horario and p.dni='$dni' 
";
$registro_= (mysqli_query($conn,$consulta1));
$datos=mysqli_fetch_assoc($registro_);
$curso=$datos['descripcion'];
$profesor=$datos['paterno']." ".$datos['materno']." ".$datos['nombres'];
$horario=$datos['horario'];
$fecha_inicio= $datos['fecha_inicio'];
$fecha_fin= $datos['fecha_fin'];
//$fecha_actual= date('d/m/Y', strtotime('+5 day')); 
      $rp=$rp."<pre class='detalle'>
Curso           : $curso
Profesor        : $profesor
Inicio          : $fecha_inicio  Fin : $fecha_fin
Horario         : $horario
Modulo          : $modulo
Especialidad    : $carrera
</pre>
</header>";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

$consulta=mysqli_query($conn,$select);
$filas=mysqli_num_rows($consulta);
$rp= $rp."
<main>
<table>";
$rp= $rp."<thead>";
$rp=$rp. "<tr class='grey lighten-2'><th>N°</th><th>Código</th><th>Paterno</th><th>Materno</th><th>Nombres</th><th>n1</th><th>n2</th><th>n3</th><th>n4</th><th>n5</th>
<th>ex1</th><th>n7</th><th>n8</th><th>n9</th><th>n10</th><th>n11</th><th>ex2</th><th>Promedio 1</th><th>Promedio 2</th><th>Promedio final</th></tr>";
$rp= $rp."</thead>";
$rp= $rp."<tbody>"; 
$n=1;
while($row=mysqli_fetch_array($consulta))
{
    $rp=$rp. "<tr>";
    $datito= "<td>$n</td><td align='left'>".$row[1]."</td>"."<td align='left'>".$row[2]."</td>"."<td align='left'>".$row[3]."</td>"."<td align='left'>".$row[4]."</td>";
    $rp=$rp.strtoupper($datito);
    $codigo_detalle=$row[0];
    $query=mysqli_query($conn,"select * from notas where cod_registro_detalle ='$codigo_detalle';");
    $r=mysqli_fetch_assoc($query);
    $rp=$rp. "<td>".$r["n1"]."</td>"."<td>".$r["n2"]."</td>"."<td>".$r["n3"]."</td>"."<td>".$r["n4"]."</td>"."<td>".$r["n5"]."</td>".
    "<td>".$r["ex1"]."</td>"."<td>".$r["n7"]."</td>"."<td>".$r["n8"]."</td>"."<td>".$r["n9"]."</td>"."<td>".$r["n10"]."</td>".
    "<td>".$r["n11"]."</td>"."<td>".$r["ex2"]."</td>"."<td>".$r["p1"]."</td>"."<td>".$r["p2"]."</td>"."<td>".$r["pfinal"]."</td>";   
    $rp=$rp. "</tr>";
    $n++;
}
$rp= $rp."</tbody>";
$rp=$rp. "</table>
</main>
</div>
</body>
</html>
";

$mpdf->WriteHTML($rp);
$fecha_actual= date('d/m/Y');
$mpdf->setFooter("$fecha_actual - {PAGENO} of {nbpg}");
$mpdf->Output("Reporte Registro.pdf",'I');



?>