
<?php
require_once __DIR__ . 'vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();


$mpdf->AddPage('L'); // Adds a new page in Landscape orientation



$mpdf->WriteHTML("sdsd");

$mpdf->Output();

?>

