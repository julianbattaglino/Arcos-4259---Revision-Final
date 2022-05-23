<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer/PHPMailer.php';
require 'PHPMailer/PHPMailer/SMTP.php';

//Declarando los fields para incluirlos en el Body
    $nombre = $_POST['nombre'];
	$email = $_POST['email'];
    $mensaje = $_POST['mensaje'];
	$body = "
            <head>  
              <style> 
                body { 
                    height: 100%; width: 100%; max-width: 100%;
                    font-family: 'Montserrat', sans-serif; 
                    font-weight: 400;
                    background-color: #FAFAFA;
                    overflow: hidden;
                }   
                p { font-size: 14px; font-family: 'Montserrat', sans-serif; font-weight: 400; color: #233645; }
            
                .blue { color: #233645; font-family: 'Montserrat', sans-serif; font-weight: 400; }
                .bold { font-weight: bold; }
                .title { font-size: 36px; }
              </style>
            </head>
            
            <body>
                <div>
                <div>
                    <h1 class='blue title'><b>Formulario de Contacto</b></h1>
                
            
                    <p>Nombre: <span class='bold'> $nombre</span></p>
                    <p>Email: <span class='bold'> $email</span></p>
                    <p>Mensaje: <span class='bold'> $mensaje</span></p>
                    
                </div>
                </div>  
                <footer>
                    <h4 class=bold></h4>
                    <span class=grey>Este formulario a sido completado Desde el sitio web https://www.arcos4259.com.ar</span><br/><br/>
                    <img src='https://arcos4259.com.ar/assets/img/iso.png' style='width: 75px' />
                </footer>

            </body>
            ";  
                


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                                    //Enable verbose debug output
    $mail->isSMTP();                                                            //Send using SMTP
    $mail->Host       = 'mail.arcos4259.com.ar';                                //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                                   //Enable SMTP authentication
    $mail->Username   = 'info@arcos4259.com.ar';                                //SMTP username
    $mail->Password   = 'k39nW8Czc69vThl';                                        //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                            //Enable implicit TLS encryption
$mail->Port       = 465;                                                        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->addReplyTo($email);
    $mail->setFrom('info@arcos4259.com.ar', 'Arcos 4259 - Urbanar S.A');
    $mail->addAddress('info@arcos4259.com.ar', 'Info Arcos');                   //Add a recipient
    $mail->addAddress('julianbattaglino@gmail.com', 'Julian Battaglino');       //Add a recipient


 
    //$mail->addAddress('ellen@example.com');                                   //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('santiago.battaglino@gmail.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');                             //Add attachments
    //$mail->addAttachment('assets/iso-number.png', 'Logo Arcos');    

    //Content
    $mail->isHTML(true);                                                         //Set email format to HTML
    $mail->Subject = 'Arcos4259 Formulario completado';
    $mail->Body    = $body;
    $mail->AltBody = $mensaje;

    $mail->send();
    
    /// Alerta Javascript luego del envio exitoso, y redirección al index.html
     echo "
    <script> alert('Gracias por contactarte con nosotros. responderemos lo antes posible.');
    window.location.href = 'index.html';
    </script>";

} catch (Exception $e) {
    echo "
    <script> alert('Hubo un error, no se pudo enviar el mensaje, intentalo nuevamente.');
    window.location.href = 'index.html';
    </script>";
}