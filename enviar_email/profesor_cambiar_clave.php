<link rel="stylesheet" type="text/css" href="css/cambiar_clave.css" />
<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
include '../conexion.php';

$clave=$_SESSION['profesor_clave'];  
$Cod_persona=$_SESSION['profesor_dni'];
//////////////////////////////////////////////////////////////////////////////////////////////
// Consulta enviada a la base de datos
$result = mysqli_query($conn, "SELECT * FROM profesorist WHERE dni = '$Cod_persona'");
	
	// Que la Variable $row mantenga el resultado de la consulta
	$row = mysqli_fetch_assoc($result);

    $email=$row['Email'];
////////////////////////////////////////////////////////////////////////////////////////////////


$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Muestra detalles de la ejecucion
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Server del servicio a usar del correo
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'cmalox@gmail.com';                 // SMTP username
    $mail->Password = '';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('cmalox@gmail.com', 'Sistema Profesor');          // Emisor
    $mail->addAddress($email);     // Receptor
   // $mail->addAddress('ellen@example.com');               // Name is optional
   //  $mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    // para archivos
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Sistema Educativo: Cambio de clave';
//////////////////////////////////////////////////////////////////////////////////////////////////////

$mensaje="
<style type='text/css'>
    .mensaje_inicial {
       color:rgb(31, 101, 180)
    }
   
    .mensaje_principal {
       color:#ffff;
        height: 50px;
        background-color: rgb(41, 104, 185);
        text-align: center;
        border: 4px solid black;
        width:400px;
    }
    .mensaje_final {
      color: red;
    }
    </style>
    <div class='contenedor'>
        <pre class='mensaje_inicial'>
Recientemente, has solicitado un cambio de contraseña para ingresar a tu cuenta de Cesca. :
Te enviamos tu nueva contraseña como se muestra debajo.</pre>
     
            
            <pre class='mensaje_principal'>
                
Tu constraseña es :  $clave
            </pre>
       
            
         <pre class='mensaje_final'>
Este E-mail es automaticamente enviado por el Sistema.</pre>
<p>
    <img src='http://carrerasuniversitarias.pe/logos/original/logo-instituto-superior-tecnologico-cesca.png' width='250px'>
</p>
    </div>";
/////////////////////////////////////////////////////////////////////////////////////////////////////

   

    $mail->Body    =utf8_decode($mensaje) ;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo '';
} catch (Exception $e) {
    echo 'Error en el envio del mensaje: ', $mail->ErrorInfo;
}
?>