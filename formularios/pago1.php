<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/Logo.png">
    <link rel="stylesheet" href="../css/pago1.css">
    <link rel="stylesheet" href="../css/general.css">

    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Pago Banco</title>
</head>

<body class="fondo">
    <header>
        <div class="header">
            <div id="logoTienda">
                <img class="logo" src="../images/Logo2.png" alt="">
            </div>
        </div>
    </header>
    
    <section class="section-1">
        <div class="contenidoInterno">
            <div class="form-container">
                <div class="banco">
                    <!-- <img src="images/pagos/bbva.png" alt="" class="logoBanco"> -->
                    <img src="../images/pagos/santander.png" alt="" class="logoBanco">
                </div>
                <br>
                <h3 class="form-title">Pago con tarjeta de crédito</h3>
                <form action="" class="checkout-form">
                    <div class="input-line">
                        <label for="name">Nombre en la tarjeta</label>
                        <input type="text" name="name" id="name" placeholder="Nombre completo">
                    </div>
                    <div class="input-line">
                        <label for="tarjeta">Número de tarjeta</label>
                        <input type="text" name="tarjeta" id="tarjeta" placeholder="XXXX-XXXX-XXXX-XXXX" maxlength="16">
                    </div>
                    <div class="input-container">
                        <div class="input-line">
                            <label for="name">Fecha de vencimiento</label>
                            <span class="expiration">
                                <div>
                                    <input type="text" name="month" id="month" placeholder="MM" maxlength="2">
                                </div>
                                <div>
                                    <input type="text" name="year" id="year" placeholder="AA" maxlength="2">
                                </div>
                            </span>
                        </div>
                        <div class="input-line">
                            <label for="cvv">CVV</label>
                            <input type="text" name="name" id="cvv" placeholder="***" maxlength="3" size="3">
                        </div>
                    </div>
                    <input type="button" value="Confirmar pago y pedido">
                </form>
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
            </div>
        </div>
         
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>