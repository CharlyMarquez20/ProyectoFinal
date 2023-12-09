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
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/personales.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Datos personales</title>
</head>
<body>
    <?php
        $producto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        $precio = $_POST['precio'];
        
         //Agrega el producto al carrito (almacenado en la variable de sesión)
         $_SESSION['carrito'][] = [
            'producto' => $producto,
            'cantidad' => $cantidad,
            'precio' => $precio
        ];
        
    ?>
    <section class="section-1"> 
        <div class="formulario-personal">
            <form action="post">
                <h4 style="letter-spacing: 3px;">Contacto</h4>
                <input type="email" id="email" name="email" placeholder="Email" required>

                <div class="inline-inputs">
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
                    <input type="text" id="apellido" name="apellido" placeholder="Apellido" required>
                </div>

                <h4 style="letter-spacing: 3px;">Dirección de Envío</h4>

                <select id="pais" name="pais" required>
                    <option value="">País</option>
                    <option value="usa">Estados Unidos</option>
                    <option value="mexico">México</option>
                    <option value="espana">Colombia</option>
                </select>

                <input type="text" id="direccion" name="direccion" placeholder="Dirección" required>

                <div class="inline-inputs">
                    <input type="text" id="codigo_postal" name="codigo_postal" placeholder="Código Postal" required>

                    <input type="text" id="ciudad" name="ciudad" placeholder="Ciudad" required>

                    <input type="text" id="estado" name="estado" placeholder="Estado" required>
                </div>

                <input type="number" id="telefono" name="telefono" placeholder="Número de Teléfono" required>

                <button type="submit">Continuar con el pago</button>
            </form>
        </div>

        <div class="carrito-productos">
            <h4 style="letter-spacing: 3px; text-align:center;">Tu carrito</h4>
            <div class="carrito-contenido">
                <div class="box-carrito">
                <?php
                // Muestra los productos en el carrito (recuperados de la variable de sesión)
                if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                    foreach ($_SESSION['carrito'] as $producto) {
                        echo '<div class="producto">';
                        // echo '<img src="' . $producto['imagen'] . '" alt="' . $producto['producto'] . '">';
                        echo '<span class="nombre">' . $producto['producto'] . '</span>';
                        echo '<span class="cantidad">' . $producto['cantidad'] . '</span>';
                        echo '<span class="precio">$' . $producto['precio'] . '</span>';
                        // Puedes agregar más información del producto según tus necesidades
                        echo '</div>';
                    }
                } else {
                    echo "Tu carrito está vacío.";
                }
                ?>
                </div>
            </div>
            <div class="descuento">
                <input type="text" name="descuento" id="descuento" placeholder="Código de descuento">
                <button type="submit">Aplicar</button>
            </div>
            <div class="total">
                <div class="total-titulo">Total</div>
                <div class="precio-total">
                    <?php
                    // Calcula y muestra el total de la compra
                    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                        $total = 0;
                        foreach ($_SESSION['carrito'] as $producto) {
                            $total += $producto['precio'] * $producto['cantidad'];
                        }
                        echo '$' . $total;
                    } else {
                        echo '$0';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</body>
</html>