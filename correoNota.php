<?php
    $servidor='localhost:33065';
    $cuenta='root';
    $password='';
    $bd='oasis';    
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);

    if ($conexion->connect_errno) {
        die('Error en la conexión: ' . $conexion->connect_error);
    }

    $carrito=array();
    $mensaje="";
    $total=0;
    $sql = "SELECT Id, IdProducto, Nombre, Precio, SUM(Cantidad) AS Cantidad FROM carrito WHERE Correo='$_SESSION[correo]' GROUP BY(IdProducto);";
    $resultado=$conexion->query($sql);
    if (mysqli_num_rows($resultado) > 0){
        while( $fila = mysqli_fetch_assoc($resultado)){
            $productoBase=array(
                "Id"=>"$fila[Id]",
                "Producto"=>"$fila[IdProducto]",
                "Nombre"=>"$fila[Nombre]",
                "Cantidad"=>"$fila[Cantidad]",
                "Precio"=>"$fila[Precio]"
            );
            array_push($carrito, $productoBase);
        }
    }

    $fecha = $_SESSION['pdf'][0];
    $direccion =$_SESSION['pdf'][1];
    $cp = $_SESSION['pdf'][2];
    $ciudad=$_SESSION['pdf'][3];
    $estado=$_SESSION['pdf'][4];
    $nombre = $_SESSION['pdf'][5];
    $telefono = $_SESSION['pdf'][6];
    $correo = $_SESSION['pdf'][7];

    $subtotal = $_SESSION['pdf'][8];
    $costEnvio = $_SESSION['pdf'][9];
    $impuesto = $_SESSION['pdf'][10];
    $total = $_SESSION['pdf'][11];
    $metodo = $_SESSION['pdf'][12];

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
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Resumen de la compra:';
        $mail->Body = '<h2>!!Gracias por tu compra!!</h2>';
        $mail->Body .= '<b>Nombre del Cliente: </b>'.$nombre.'<br>';
        $mail->Body .= '<b>Email: </b>' .$correo.'<br>';
        $mail->Body .= '<b>Telefono: </b>' .$telefono.'<br>';
        $mail->Body .= '<b>Direccion: </b><br>' .$direccion.'<br> C.P. '.$cp.'<br>'.$ciudad.', '.$estado.'<br>';
        $mail->Body .= '<h4>Aqui tienes un resumen de los productos que has adquirido</h4>';
        $mail->Body .= '
            <table>
                <tr>                       
                    <th>Producto</th>
                    <th>$</th>
                    <th>#</th>
                </tr>';

            for ($i = 0; $i < count($carrito); $i++){
                $mostrarProducto = $carrito[$i];
                $mail->Body .= '
                    <tr>
                        <td>'.$mostrarProducto["Nombre"].'</td>
                        <td>'.$mostrarProducto["Precio"].'</td>
                        <td>'.$mostrarProducto["Cantidad"].'</td>
                    </tr>';
            }
        $mail->Body .= '</table><br>';
        

        $mail->Body .= '<b>Subtotal: </b>$'.$subtotal.'<br>';
        $mail->Body .= '<b>Costo de envio: </b>$'.$costEnvio.'<br>';
        $mail->Body .= '<b>Impuestos a pagar: </b>$'.$impuesto.'<br>';
        $mail->Body .= '<b>Total a pagar: </b>$'.$total.'<br>';
        $mail->Body .= '<b>Método de pago empleado: </b>'.$metodo.'<br>';
    
        $mail->send();
        
        //echo "El mensaje ha sido enviado con éxito";
    } catch (Exception $e) {
        //echo "El mensaje no ha podido ser enviado. Mailer Error: {$mail->ErrorInfo}";
    }

?>