<?php
session_start();
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../phpMailer/Exception.php';
require '../phpMailer/PHPMailer.php';
require '../phpMailer/SMTP.php';

$id=$_SESSION["idUsuario"];
$nombre=$_SESSION["usuario"];

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'a22310401@ceti.mx';                     //SMTP username
    $mail->Password   = 'Rodrigo32#!';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //Obtener Correo y 

    //Recipients
    $mail->setFrom('a22310401@ceti.mx', 'Figure BioSpa');
    $mail->addAddress( $id, $nombre );     //Add a recipient

    //Attachments
    $ruta = 'pdf/factura.pdf';
    $mail->addAttachment($ruta);         //Add attachments

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Confirmacion de Compra';
    $mail->Body    = 'Hola '.$nombre.' gracias por tu Compra<b> Recuerda llevar tu recibo</b>';
    $mail->send();

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>