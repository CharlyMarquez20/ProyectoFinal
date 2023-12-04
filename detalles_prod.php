<?php
    if (isset($_POST["submit"])){
        $id=$_POST["id"];
        $nombre=$_POST["nombre"];
        $descripcion=$_POST["descripcion"];
        $precio=$_POST["precio"];
        $descuento=$_POST["descuento"];
        $existencia=$_POST["existencia"];

        $precioOriginal=$precio;
        $aplicar="0.".$descuento;
        $precioDescuento=$precioOriginal*$aplicar;

        $precioFinal=$precioOriginal-$precioDescuento;

        $imagen1=$_POST["imagen1"];
        $imagen2=$_POST["imagen2"];
        $imagen3=$_POST["imagen3"];
        $imagen4=$_POST["imagen4"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/logo/Logo.png">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/catalogo.css">
    <title>Detalles</title>
</head>
<body class="fondo">
    <?php
        include "encabezado.php";
    ?>

    <section id="detalles-producto" class="section-1">
        <div class="img-producto">
            <img src="images/productos/<?php echo $imagen1 ?>" width="100%" alt="">
            <div class="grupo-img">
                <div class="img-peque-col">
                    <img src="images/productos/<?php echo $imagen2 ?>" width="100%" class="img-peque" alt="">
                </div>
                <div class="img-peque-col">
                    <img src="images/productos/<?php echo $imagen3 ?>" width="100%" class="img-peque" alt="">
                </div>
                <div class="img-peque-col">
                    <img src="images/productos/<?php echo $imagen4 ?>" width="100%" class="img-peque" alt="">
                </div>
            </div> 
        </div>

        <div class="descripcion-producto">
            <h6><a href="index.php" style="text-decoration: none; color: black;">Home</a> / <a href="catalogo.php" style="text-decoration: none; color: black;">Tenis</a></h6>
            <h6>Id: <?php echo $id ?></h6>
            <h1><?php echo $nombre ?></h1>
            <h2>
                $<?php 
                    if($descuento!=0){
                        ?>
                        <s><?php echo $precioOriginal; ?></s>
                        <?php
                        if($descuento!=0){
                            echo "$".$precioFinal;
                        }else{
                            echo $precioFinal;
                        }
                    }else{
                        echo $precioFinal;
                    }
                ?>
            </h2>
            <?php
                if($descuento!=0){
                    ?>
                        <h6 style="color: red;">Descuento: <?php echo $descuento ?>%</h6>
                    <?php
                }
            ?>
            <h4>Descripción</h4>
            <p><?php echo $descripcion ?></p>
            <form action="#" method="post">
                <label for="talla">Talla</label>
                <div class="talla-container">
                    <label class="talla-option" for="talla_23">
                        <input type="radio" id="talla_23" name="talla" value="23" onclick="seleccionarTalla(this)">
                        23 cm
                    </label>
                    <label class="talla-option" for="talla_24">
                        <input type="radio" id="talla_24" name="talla" value="24" onclick="seleccionarTalla(this)">
                        24 cm
                    </label>
                    <label class="talla-option" for="talla_25">
                        <input type="radio" id="talla_25" name="talla" value="25" onclick="seleccionarTalla(this)">
                        25 cm
                    </label>
                    <label class="talla-option" for="talla_26">
                        <input type="radio" id="talla_26" name="talla" value="26" onclick="seleccionarTalla(this)">
                        26 cm
                    </label>
                    <label class="talla-option" for="talla_27">
                        <input type="radio" id="talla_27" name="talla" value="27" onclick="seleccionarTalla(this)">
                        27 cm
                    </label>
                    <input type="hidden" id="tallaSeleccionada" name="tallaSeleccionada" value="">                    
                </div>
                <h6>Estilo</h6>
                <h6 id="estilo">Casual</h6>

                <h6>Existencia:</h6>
                <h6 class="talla-option">
                    <?php
                        if($existencia==0){
                           echo "Producto agotado";
                        }else{
                           echo $existencia;
                        }
                     ?>
                </h6>

                <h6>Cantidad</h6>
                <?php
                    if($existencia==0){
                        ?>
                        <input type="number" value="0" id="cantidad" min="0" max="<?php echo $existencia ?>" disabled>
                        <button type="submit" id="carrito-btn" disabled>Añadir al carrito</button>
                        <?php
                    }else{
                        ?>
                        <input type="number" value="1" id="cantidad" min="1" max="<?php echo $existencia ?>">
                        <button type="submit" id="carrito-btn" disabled>Añadir al carrito</button>
                        <?php
                    }
                ?>
            </form>
        </div>

    </section>


    <script>
        function seleccionarTalla(radio) {
            var tallaSeleccionada = document.getElementById('tallaSeleccionada');
            tallaSeleccionada.value = radio.value;

            var todasLasTallas = document.querySelectorAll('.talla-option');
            todasLasTallas.forEach(function(talla) {
                talla.classList.remove('selected');
            });

            radio.parentElement.classList.add('selected');
        }
    </script>
</body>
</html>