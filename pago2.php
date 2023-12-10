<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/logo/Logo.png">
    <link rel="stylesheet" href="css/oxxo.css">
    <link rel="stylesheet" href="css/general.css">

    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Pago</title>
</head>

<body class="fondo">
    <header>
        <div class="header">
            <div id="logoTienda">
                <img class="logo" src="images/logo/Logo2.png" alt="">
            </div>
        </div>
    </header>
    
    <section class="section-1">
        <div class="contenidoInterno">
            <div class="padre">
                <div class="ticket-container">
                    <h2 class="form-title">Pago en OXXO</h2>
                    <div id="pagoOxxo">
                        <table>
                            <tr>
                                <td rowspan="2">
                                    <div class="oxxo-logo">
                                        <img src="images/pagos/oxxo.png" alt="" class="logo" id="oxxo">
                                    </div>
                                </td>
                                <td>
                                    <div class="codigo-barras">
                                        <img src="images/pagos/barras.png" alt="" class="logo" id="codigo">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>Total a pagar: $</h4>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h6>Dile estos números al cajero en cualquier punto Oxxo del país</h6>
                                    <h6>A nombre de <b>PayU</b></h6>
                                    <div class="col-12 numeros">
                                        <div class="col-2" id="interior">
                                            <h4>2205</h4>
                                        </div>
                                        <div class="col-2" id="interior">
                                            <h4>5805</h4>
                                        </div>
                                        <div class="col-2" id="interior">
                                            <h4>2955</h4>
                                        </div>
                                        <div class="col-2" id="interior">
                                            <h4>2175</h4>
                                        </div>
                                        <div class="col-2" id="interior">
                                            <h4>9605</h4>
                                        </div>
                                        <div class="col-2" id="interior">
                                            <h4>4505</h4>
                                        </div>
                                    </div>
                                    <h6>O también puedes descargar e imprimir el código de barras para escanearlo</h6>
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color: rgba(128, 128, 128, 0.486);"><h6><b>Datos de la compra</b></h6></td>
                                <td style="background-color: rgba(128, 128, 128, 0.486);"><h6><b>Datos del pagador</b></h6></td>
                            </tr>
                            <tr>
                                <td>
                                    <p><b>Tienda: </b><i>OASIS MX©</i></p>
                                    <?php
                                        date_default_timezone_set("America/Mexico_City");
                                        $fecha_actualizacion = date("d-m-Y H:i:s");
                                    ?>
                                    <p><b>Fecha de la compra: </b><?php echo $fecha_actualizacion; ?></p>
                                    <p><b>Descripción: </b></p>
                                    <p><b>Número de la transaccion: </b>1058963248</p>
                                </td>
                                <td>
                                    <p><b>Email: </b></p>
                                    <p><b>Referencia: </b>5089</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div id="pie">
                    <div class="numeros">
                        <div id="imagenDuda">
                            <img src="images/pagos/dudas.png" alt="" id="dudas">
                        </div>
                        <div id="leyendaDuda">
                            <div style="width: 100%;">
                                <h6><b>Si tienes duda o reclamo</b> sobre el producto/servicio que estás adquiriendo, debes
                                    de comunicarte directamente con OASIS MX©</h6>
                                <h6><b>Teléfono: </b>4451238954 <b>Correo: </b>oasis_sneakers@gmail.com</h6> 
                            </div>
                        </div>
                    </div>
                    <div id="leyendaAdvertencia">
                        <h6>La tienda donde se efectúe el pago cobrará una comisión en concepto de recepción de cobranza.</h6>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="col-md-4 carrito-productos">
            <div>
                <h4 style="text-align:center;">Tu carrito</h4>
                <div class="carrito-contenido">
                    <div class="box-carrito">

                    </div>
                </div>
                <div class="total">
                    <div class="total-titulo">Total</div>
                    <div class="precio-total">
                        
                    </div>
                </div>
                <div>
                    <input type="button" value="Finalizar compra">
                </div>
            </div>
        </div>
         
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>