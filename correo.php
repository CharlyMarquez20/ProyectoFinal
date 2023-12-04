<?php

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'mqzcarlos3@gmail.com';                     //SMTP username
        $mail->Password   = 'yzbydnnzhinnokrx';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('mqzcarlos3@gmail.com', 'OASIS GROUP');
        $mail->addAddress($correo, $nombre);     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'OASIS';
        $mail->Body = '<h2>!!Gracias por confiar en nosotros, pronto te daremos una respuesta!!</h2>';
        $mail->Body .= '<h4>Somos la empresa mejor ubicada y buscamos lo mejor para nuestros clientes</h4>';
        $mail->Body .= '<b>Nombre: </b>'.$nombre.'<br>';
        $mail->Body .= '<b>Correo al que se mando: </b>'.$correo.'<br>';
        $mail->Body .= '<b>Tu mensaje: </b>'.$mensaje.'<br>';
    
        $mail->send();
        
        echo "<script>window.location.href = 'index.php?tipo=mandarCorreo';</script>";
    } catch (Exception $e) {
        echo "<script>window.location.href = 'index.php?tipo=error';</script>";
        //echo "El mensaje no ha podido ser enviado. Intentalo de nuevo {$mail->ErrorInfo}";
    }

?>