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

    $precioOriginal=$_SESSION['precio'];

    $carrito=array();
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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/logo/Logo.png">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/personales.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
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
            <form action="pago1.php" method="post">
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

                <label for="pago">Método de pago</label>
                <select id="pago" name="pago" required>
                    <option value="">Eliga un opción</option>
                    <option value="bbva">Pago con tarjeta (BBVA)</option>
                    <option value="santander">Pago con tarjeta(Santander)</option>
                    <option value="oxxo">Pago en OXXO</option>
                </select>

                <input type="number" name="descuentoAplicar" value="<?php echo $_SESSION['precio']; ?>" hidden>
                <input type="text" name="valorDescuento" value="<?php echo $_SESSION['descuento']; ?>" hidden>
                <input type="submit" value="Continuar con el pago">
            </form>
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
                                <?php echo "$".$total; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>Total:</b>
                            </td>
                            <td id="Total">
                                <?php echo "$".$_SESSION['precio']; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div>
                <label for="">Si tienes un cupón, es momento de usarlo</label>
                <div class="col-12 descuento">
                    <div class="col-6">
                        <input type="text" id="descuento" placeholder="Código de descuento">
                    </div>
                    <div class="col-6">
                        <input type="button" name="desactivar" value="Aplicar" onclick="verificarDescuento()">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/descuento.js"></script>
</body>
</html>