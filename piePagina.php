<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/piePagina.css">
</head>
<body>
    <footer id="footer">
        <div class="Padre_piePagina">
            <div id="leyenda">
                <h4>Proyecto académico</h4>
                <hr>
            </div>
            <div id="suscripcion">
                <div class="col-lg-12" id="contenidoPie">
                    <div class="col-md-6">
                        <form action="cuponSuscripcion.php" method="post">
                            <label for=""><i>Suscribete para recibir un código de descuento exclusivo</i></label>
                            <br>
                            <input type="email" name="correo" class="input-correo" placeholder="Correo electrónico">
                            <span id="boton"><button type="submit" id="enviarCorreo"><img src="images/piePagina/flecha.png"></button></span>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <h5><i>Nuestras redes sociales</i></h5>
                        <a href="https://instagram.com" target="_blank"><img src="images/piePagina/instagram.png" alt=""></a>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <div class="col-lg-12" id="contenidoPie">
                    <div class="col-md-6">
                        <h5>OASIS MX ©</h5>
                    </div>
                    <div class="col-md-6">
                        <h5>Fecha de actualización</h5>
                        <?php
                            date_default_timezone_set("America/Mexico_City");
                            $archivo="index.php";
                            $fecha_actualizacion = filemtime($archivo);
                            $fecha_actualizacion = date("d-m-Y H:i:s", $fecha_actualizacion);
                            ?>
                                <h6><?php echo $fecha_actualizacion; ?></h6>
                            <?php
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>