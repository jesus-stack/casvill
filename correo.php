<?php
$nombre=$_REQUEST["nombre"];
$email=$_REQUEST["email"];
$fecha=new Datetime($_REQUEST["fecha"]);
$hoy=new DateTime('now');
$genero=$_REQUEST["genero"];
$grado=''; 
foreach($_REQUEST["grado"] as $option){
   $grado=$grado.','.$option;
}

$mensaje=$_REQUEST["mensaje"];

$interval=$fecha->diff($hoy);
$edad=$interval->format('%y');
       
$body="Nombre: ".$nombre."<br>Email: ".$email.
    "<br>fecha de nacimiento: ".$fecha->format('d-m-Y')."<br>Edad:  ".$edad."<br>Genero: ".$genero.
    "<br>Grado Academico: ".$grado."<br><br>Mensaje<br>".$mensaje;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug =0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'floristeriacastilla13@gmail.com';                     // SMTP username
    $mail->Password   = 'quiroz13';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('floristeriacastilla13@gmail.com', $nombre);
    $mail->addAddress('jisusquiros2001@gmail.com');     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Prueba';
    $mail->Body    = $body;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo '<script> 
    alert("Mensaje Enviado");
    //window.history.go(-1);
    </script>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}