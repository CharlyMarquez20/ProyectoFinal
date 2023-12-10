<?php
    $servidor='localhost:33065';
    $cuenta='root';
    $password='';
    $bd='oasis';    
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);

    if ($conexion->connect_errno) {
        die('Error en la conexión: ' . $conexion->connect_error);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/personales.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="images/logo/Logo.png">
    <title>Haz tu pedido</title>
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
        <div class="formulario-personal">
            <form action="post">
                <h4>Contacto</h4>
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" placeholder="ejemplo@email.com" required>

                <label for="nombre">Nombre completo</label>
                <div class="inline-inputs">
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre(s)" required>
                    <input type="text" id="apellido" name="apellido" placeholder="Apellido(s)" required>
                </div>

                <h4>Dirección de envío</h4>
                <label for="pais">País</label>
                <select id="pais" name="pais" required>
                    <option value="">Eliga un opción</option>
                    <option value="usa">Estados Unidos</option>
                    <option value="mexico">México</option>
                    <option value="colombia">Colombia</option>
                </select>
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" placeholder="Calle  #111,  Colonia/Fraccionamiento" required>

                <div class="inline-inputs2">
                    <div>
                        <label for="codigo_postal">Código postal</label>
                        <input type="text" id="codigo_postal" name="codigo_postal" placeholder="123456" maxlength="6" required>
                    </div>
                    <div>
                        <label for="ciudad">Ciudad</label>
                        <input type="text" id="ciudad" name="ciudad" placeholder="Aguascalientes" required>
                    </div>
                    <div>
                        <label for="estado">Estado</label>
                        <input type="text" id="estado" name="estado" placeholder="Aguascalientes" required>
                    </div>
                </div>
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" placeholder="1112223333" maxlength="10" required>

                <input type="button" value="Continuar con el pago">
            </form>
        </div>

        <div class="carrito-productos">
            <h4 style="text-align:center;">Tu carrito</h4>
            <div class="carrito-contenido">
                <div class="box-carrito">

                </div>
            </div>
            <div>
                <label for="">Si tienes un cupón, es momento de usarlo</label>
                <div class="col-12 descuento">
                    <div class="col-6">
                        <input type="text" name="descuento" id="descuento" placeholder="Código de descuento">
                    </div>
                    <div class="col-6">
                        <input type="button" value="Aplicar" onclick="">
                    </div>
                </div>
            </div>
            <div class="total">
                <div class="total-titulo">Total</div>
                <div class="precio-total">
                    
                </div>
            </div>
        </div>
    </section>
</body>
</html>