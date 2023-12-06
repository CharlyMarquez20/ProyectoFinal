<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
    function generateCaptcha() {
        $possible = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $string = '';
        $length = 6;
        for($i=0; $i<$length; $i++) {
            $string .= $possible[rand(0, strlen($possible)-1)];
        }
        return $string;
    }

    $text = generateCaptcha();
    function create_captcha($text) {
        $width = 100;
        $height = 50; 

        $image = imagecreatetruecolor($width, $height);

        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);
        $text_color = imagecolorallocate($image, 0, 0, 255);
        imagefill($image, 0, 0, $white);

        $warped_image = imagecreatetruecolor($width, $height);
        imagefill($warped_image, 0, 0, $white);
        imagestring($image, 5, 25, 25, $text, $text_color);
        for ($x=0; $x < $width; $x++) {
            for ($y=0; $y < $height; $y++) {
                $color = imagecolorat($image, $x, $y);
                imagesetpixel($warped_image, $x, $y, $color);
            }
        }
        // Agrega los puntos en el captcha
        for($i=0; $i<rand(120,200); $i++) {
            imagesetpixel($warped_image, rand(0,$width), rand(0,$height), $black);
        }
        // Agrega las lineas en el captcha
        for($i=0; $i<rand(8,15); $i++) {
            imageline($warped_image, rand(0,$width), rand(0,$height), rand(0,$width), rand(0,$height), $black);
        }
        $path = "captcha.jpg";
        imagejpeg($warped_image,$path);

        imagedestroy($warped_image);
        imagedestroy($image);

        return $path;

    }

    if(isset($_POST['submit'])) {
        $possible = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $captcha = substr(str_shuffle($possible),0,5);  
        $myimage = create_captcha($captcha);
    }else{
        $possible = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $captcha = substr(str_shuffle($possible),0,5);  
        $myimage = create_captcha($captcha);
    }

    //echo $captcha;
?>
    <form action="login.php" method="post" onsubmit="return validarCaptcha()">
        <label for="email" name="correo">Email:</label>
        <input type="email" name="correo" id="emailVerifica" value="<?php if(isset($_COOKIE["correo"])) {echo $_COOKIE["correo"];}?>" required>

        <br>

        <label for="password" name="contra">Contraseña:</label>  
        <input type="password" name="contra" id="contraVerifica" value="<?php if(isset($_COOKIE["contra"])) {echo $_COOKIE["contra"];}?>" required>
        
        <input type="checkbox" name="remember" style="position: relative; right: 220px; top: 20px;"/>
        <label style="position: relative; left: 35px; top: 2px;">Recordar mis datos</label>
        
        <br>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-6">
                    <img src="captcha.jpg" alt="nada" style="width: 230px; height: 120px;">
                </div>
                <div class="col-md-6">
                    <input type="text" name="captcha" id="captcha" placeholder="Ingresa el captcha" style="position: relative; top:30px;">
                </div>
            </div>
            
        </div>
        
        <br>
        <input type="hidden" name="tipo" value="inicioSesion">
        <button type="submit" name="submit" class="btn btn-success">Enviar</button>
    </form>
    <script>
        function validarCaptcha(){
            let captchagenerado = "<?php echo $captcha; ?>";
            let captchaInput = document.getElementById("captcha").value;
            if(captchagenerado == captchaInput){
                return true;
            }else{
                Swal.fire({
                    title: "¡Error!",
                    text: "¡¡Captcha incorrecto, favor de volver a intentarlo!!",
                    icon: "error"
                });
                return false;
            }
        }
    </script>
</body>
</html>
