<?php
    session_start();
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

    $correo=$_POST['email'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $nombreCompleto=$nombre." ".$apellido;
    $pais=$_POST['pais'];
    $direccion=$_POST['direccion'];
    $cp=$_POST['codigo_postal'];
    $ciudad=$_POST['ciudad'];
    $estado=$_POST['estado'];
    $telefono=$_POST['telefono'];
    $precio=$_POST['descuentoAplicar'];
    $tipo=$_POST['pago'];
    $valorDescuento=$_SESSION['descuento']*100;

    $usa=300;
    $colombia=150;
    $mexico=50;
?>
<?php 
    $impuesto=0;
    if($pais=="usa"){
        $impuesto=$usa;
    }elseif($pais=="colombia"){
        $impuesto=$colombia;
    }elseif($pais=="mexico"){
        $impuesto=$mexico;
    }
?>
<?php 
    if($precio>=3000){
        $envio=0;
    }elseif($precio<3000){
        $envio=100;
    }
?>
<?php 
    $precioFinal=$_SESSION['precio']+$impuesto+$envio;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/logo/Logo.png">

    <link rel="stylesheet" href="css/pago1.css">
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
    
    <?php
        if($tipo=="bbva"){
            ?>
                <!------------------------------------BANCO------------------------------------>
                <section class="section-1">
                    <div class="contenidoInterno">
                        <div class="form-container">
                            <div class="banco">
                                <img src="images/pagos/bbva.png" alt="" class="logoBanco">
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

                    <div class="carrito-productos">
                        <h4 style="text-align:center;">Tu carrito</h4>
                        <div class="carrito-contenido">
                            <div class="box-carrito">
                                <table id="productos">
                                    <tr>
                                        
                                        <th>#</th>
                                        <th>Producto</th>
                                        <th>$</th>
                                        <th>Imagen</th>
                                    </tr>
                                    <?php
                                        for ($i = 0; $i < count($carrito); $i++){
                                            $mostrarProducto = $carrito[$i];
                                            $total+=($mostrarProducto["Precio"]*$mostrarProducto["Cantidad"]);
                                            ?>
                                            <tr>
                                                
                                                <td><?php print_r($mostrarProducto["Cantidad"]); ?></td>
                                                <td><?php print_r($mostrarProducto["Nombre"]); ?></td>
                                                <td><?php print_r($mostrarProducto["Precio"]); ?></td>
                                                <?php
                                                    $sql = "SELECT Imagen1 FROM productos WHERE Id='$mostrarProducto[Producto]'";
                                                    $resultado=$conexion->query($sql);
                                                    if ($resultado -> num_rows){
                                                        while( $fila = $resultado -> fetch_assoc()){
                                                            $imagen=$fila['Imagen1'];
                                                        }
                                                    }
                                                ?>
                                                <td><img src="images/productos/<?php echo $imagen; ?>" alt="" width="100"></td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                    <tr>
                                        <td colspan="2" style="padding-top: 30px;">
                                            <b>Subtotal:</b>
                                        </td>
                                        <td style="padding-top: 30px;">
                                            <?php echo "$".$precio; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <b>Impuestos <?php echo "(".$pais.")"; ?>:</b>
                                        </td>
                                        <td >
                                            <?php 
                                                $impuesto=0;
                                                if($pais=="usa"){
                                                    echo "$".$usa;
                                                    $impuesto=$usa;
                                                }elseif($pais=="colombia"){
                                                    echo "$".$colombia;
                                                    $impuesto=$colombia;
                                                }elseif($pais=="mexico"){
                                                    echo "$".$mexico;
                                                    $impuesto=$mexico;
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <b>Envío:</b>
                                        </td>
                                        <td >
                                            <?php 
                                                if($precio>=3000){
                                                    echo "Gratis";
                                                    $envio=0;
                                                }elseif($precio<3000){
                                                    $envio=100;
                                                    echo "$".$envio;
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <b>Descuento aplicado:</b>
                                        </td>
                                        <td >
                                            <?php 
                                                echo $valorDescuento."%";
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <b>Total:</b>
                                        </td>
                                        <td id="Total">
                                            <?php 
                                                $precioFinal=$_SESSION['precio']+$impuesto+$envio;
                                                echo "$".$precioFinal;
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </section>
                <!------------------------------------BANCO------------------------------------>
            <?php
        }elseif($tipo=="oxxo"){
            ?>
                <!------------------------------------OXXO------------------------------------>
                <section class="section-1">
                    <div class="contenidoInterno">
                        <div class="padre">
                            <div class="ticket-container">
                                <h2 class="form-title">Pago en OXXO</h2>
                                <div id="pagoOxxo">
                                    <table id="oxxo" style="text-align: center;">
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
                                                <h4>Total a pagar: $<?php echo $precioFinal; ?></h4>
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
                                                <p><b>Descripción: </b>Compra de par de tenis</p>
                                                <p><b>Número de la transaccion: </b>1058963248</p>
                                            </td>
                                            <td>
                                                <p><b>Email: </b><?php echo $correo; ?></p>
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

                    <div class="carrito-productos">
                        <h4 style="text-align:center;">Tu carrito</h4>
                        <div class="carrito-contenido">
                            <div class="box-carrito">
                                <table id="productos">
                                    <tr>
                                        
                                        <th>#</th>
                                        <th>Producto</th>
                                        <th>$</th>
                                        <th>Imagen</th>
                                    </tr>
                                    <?php
                                        for ($i = 0; $i < count($carrito); $i++){
                                            $mostrarProducto = $carrito[$i];
                                            $total+=($mostrarProducto["Precio"]*$mostrarProducto["Cantidad"]);
                                            ?>
                                            <tr>
                                                
                                                <td><?php print_r($mostrarProducto["Cantidad"]); ?></td>
                                                <td><?php print_r($mostrarProducto["Nombre"]); ?></td>
                                                <td><?php print_r($mostrarProducto["Precio"]); ?></td>
                                                <?php
                                                    $sql = "SELECT Imagen1 FROM productos WHERE Id='$mostrarProducto[Producto]'";
                                                    $resultado=$conexion->query($sql);
                                                    if ($resultado -> num_rows){
                                                        while( $fila = $resultado -> fetch_assoc()){
                                                            $imagen=$fila['Imagen1'];
                                                        }
                                                    }
                                                ?>
                                                <td><img src="images/productos/<?php echo $imagen; ?>" alt="" width="100"></td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                    <tr>
                                        <td colspan="2" style="padding-top: 30px;">
                                            <b>Subtotal:</b>
                                        </td>
                                        <td style="padding-top: 30px;">
                                            <?php echo "$".$precio; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <b>Impuestos <?php echo "(".$pais.")"; ?>:</b>
                                        </td>
                                        <td >
                                            <?php 
                                                $impuesto=0;
                                                if($pais=="usa"){
                                                    echo "$".$usa;
                                                    $impuesto=$usa;
                                                }elseif($pais=="colombia"){
                                                    echo "$".$colombia;
                                                    $impuesto=$colombia;
                                                }elseif($pais=="mexico"){
                                                    echo "$".$mexico;
                                                    $impuesto=$mexico;
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <b>Envío:</b>
                                        </td>
                                        <td >
                                            <?php 
                                                if($precio>=3000){
                                                    echo "Gratis";
                                                    $envio=0;
                                                }elseif($precio<3000){
                                                    $envio=100;
                                                    echo "$".$envio;
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <b>Descuento aplicado:</b>
                                        </td>
                                        <td >
                                            <?php 
                                                echo $valorDescuento."%";
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <b>Total:</b>
                                        </td>
                                        <td id="Total" style="margin-bottom: 30px;">
                                            <?php 
                                                $precioFinal=$_SESSION['precio']+$impuesto+$envio;
                                                echo "$".$precioFinal;
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                                <input type="button" value="Finalizar compra">
                            </div>
                        </div>
                    </div>
                    
                </section>
                <!------------------------------------OXXO------------------------------------>
            <?php
        }elseif($tipo=="santander"){
            ?>
                <!------------------------------------BANCO------------------------------------>
                <section class="section-1">
                    <div class="contenidoInterno">
                        <div class="form-container">
                            <div class="banco">
                                <img src="images/pagos/santander.png" alt="" class="logoBanco">
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

                    <div class="carrito-productos">
                        <h4 style="text-align:center;">Tu carrito</h4>
                        <div class="carrito-contenido">
                            <div class="box-carrito">
                                <table id="productos">
                                    <tr>
                                        
                                        <th>#</th>
                                        <th>Producto</th>
                                        <th>$</th>
                                        <th>Imagen</th>
                                    </tr>
                                    <?php
                                        for ($i = 0; $i < count($carrito); $i++){
                                            $mostrarProducto = $carrito[$i];
                                            $total+=($mostrarProducto["Precio"]*$mostrarProducto["Cantidad"]);
                                            ?>
                                            <tr>
                                                
                                                <td><?php print_r($mostrarProducto["Cantidad"]); ?></td>
                                                <td><?php print_r($mostrarProducto["Nombre"]); ?></td>
                                                <td><?php print_r($mostrarProducto["Precio"]); ?></td>
                                                <?php
                                                    $sql = "SELECT Imagen1 FROM productos WHERE Id='$mostrarProducto[Producto]'";
                                                    $resultado=$conexion->query($sql);
                                                    if ($resultado -> num_rows){
                                                        while( $fila = $resultado -> fetch_assoc()){
                                                            $imagen=$fila['Imagen1'];
                                                        }
                                                    }
                                                ?>
                                                <td><img src="images/productos/<?php echo $imagen; ?>" alt="" width="100"></td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                    <tr>
                                        <td colspan="2" style="padding-top: 30px;">
                                            <b>Subtotal:</b>
                                        </td>
                                        <td style="padding-top: 30px;">
                                            <?php echo "$".$precio; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <b>Impuestos <?php echo "(".$pais.")"; ?>:</b>
                                        </td>
                                        <td >
                                            <?php 
                                                $impuesto=0;
                                                if($pais=="usa"){
                                                    echo "$".$usa;
                                                    $impuesto=$usa;
                                                }elseif($pais=="colombia"){
                                                    echo "$".$colombia;
                                                    $impuesto=$colombia;
                                                }elseif($pais=="mexico"){
                                                    echo "$".$mexico;
                                                    $impuesto=$mexico;
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <b>Envío:</b>
                                        </td>
                                        <td >
                                            <?php 
                                                if($precio>=3000){
                                                    echo "Gratis";
                                                    $envio=0;
                                                }elseif($precio<3000){
                                                    $envio=100;
                                                    echo "$".$envio;
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <b>Descuento aplicado:</b>
                                        </td>
                                        <td >
                                            <?php 
                                                echo $valorDescuento."%";
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <b>Total:</b>
                                        </td>
                                        <td id="Total">
                                            <?php 
                                                $precioFinal=$_SESSION['precio']+$impuesto+$envio;
                                                echo "$".$precioFinal;
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </section>
                <!------------------------------------BANCO------------------------------------>
            <?php
        }
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>