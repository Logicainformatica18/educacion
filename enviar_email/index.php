<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

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
    $mail->setFrom('cmalox@gmail.com', 'anthony');          // Emisor
    $mail->addAddress('cmalox@gmail.com');     // Receptor
   // $mail->addAddress('ellen@example.com');               // Name is optional
   //  $mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    // para archivos
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'cambio de clave';
    $mail->Body    = 'Este es un mensaje desde un servidor local';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Mensaje enviado correctamente';
} catch (Exception $e) {
    echo 'Error en el envio del mensaje: ', $mail->ErrorInfo;
}
?>