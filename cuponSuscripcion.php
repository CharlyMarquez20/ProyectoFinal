<?php

    $correo = $_POST['correo'];

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
        $mail->addAddress($correo);     //Add a recipient
        $imagePath = 'images/cupones/cupon.png';
        $mail-> addEmbeddedImage($imagePath, 'cupon', 'cupon.png');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'OASIS';
        $mail->Body = '<h2>!!Gracias por formar parte de nosotros!!</h2>';
        $mail->Body .= '<h4>Como agradecimiento te regalamos un cupon de compra.</h4>';
        $mail->Body .=  '<img src="cid:cupon" alt="Imagen" >';
        $mail->Body .= '<h4>Visita nuestra tienda en linea y descubre la mejor opcion para ti</h4>';
        $mail->Body .= '<h4>Encuentra tu paraiso en cada paso: Oasis, donde los tenis son tu escape </h4>';
        
    
        $mail->send();
        
        echo "<script>window.location.href = 'index.php?tipo=mandarCorreo';</script>";
    } catch (Exception $e) {
        echo "<script>window.location.href = 'index.php?tipo=error';</script>";
        //echo "El mensaje no ha podido ser enviado. Intentalo de nuevo {$mail->ErrorInfo}";
    }

?>