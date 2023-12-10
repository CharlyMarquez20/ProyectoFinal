<?php
    $servername = "localhost:33065";
    $username = "root";
    $password = "";
    $database = "oasis";

    $conexion = new mysqli($servername, $username, $password, $database);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql="SELECT * FROM productos WHERE '1'='1'";
    if(isset($_POST['submit'])){
        $precioMin=$_POST['rango-min'];
        $precioMax=$_POST['rango-max'];
        if(!empty($_POST['categoria-mujer'])){
            $categoriaMujer=$_POST['categoria-mujer'];
        }
        if(!empty($_POST['categoria-hombre'])){
            $categoriaHombre=$_POST['categoria-hombre'];
        }
        if(!empty($_POST['marca-nike'])){
            $marcaNike=$_POST['marca-nike'];
        }
        if(!empty($_POST['marca-adidas'])){
            $marcaAdidas=$_POST['marca-adidas'];
        }
        
        if(!empty($precioMin) && !empty($precioMax)){
            $sql .= " AND (Precio>='$precioMin' AND Precio<='$precioMax')";
        }else{
            if (!empty($precioMin)){
                $sql .= " AND (Precio>='$precioMin')";
            }
            if(!empty($precioMax)){
                $sql .= " AND (Precio<='$precioMax')";
            }
        }
        
        if(!empty($categoriaMujer) && !empty($categoriaHombre)){
            $sql .= " AND (Categoria = 'Mujer' OR Categoria = 'Hombre')";
        }else{
            if(!empty($categoriaMujer)){
                $sql .= " AND (Categoria = 'Mujer')";
            }
            if(!empty($categoriaHombre)){
                $sql .= " AND (Categoria = 'Hombre')";
            }
        }
        
        if(!empty($marcaNike) && !empty($marcaAdidas)){
            $sql .= " AND (Marca = 'Nike' OR Marca = 'Adidas')";
        }else{
            if(!empty($marcaNike)){
                $sql .= " AND (Marca = 'Nike')";
            }
            if(!empty($marcaAdidas)){
                $sql .= " AND (Marca = 'Adidas')";
            }
        }
        
        
        
    }
    
    $productos=array();
    $contando=0;
    $existe=0;
    $resultado=$conexion->query($sql);
    if ($resultado -> num_rows){
        while( $fila = $resultado -> fetch_assoc()){
            $producto=array(
                "Id"=>"$fila[Id]",
                "Marca"=>"$fila[Marca]",
                "Nombre"=>"$fila[Nombre]",
                "Categoria"=>"$fila[Categoria]",
                "Encabezado"=>"$fila[Encabezado]",
                "Descripcion"=>"$fila[Descripcion]",
                "Existencia"=>"$fila[Existencia]",
                "Precio"=>"$fila[Precio]",
                "Imagen1"=>"$fila[Imagen1]",
                "Imagen2"=>"$fila[Imagen2]",
                "Imagen3"=>"$fila[Imagen3]",
                "Imagen4"=>"$fila[Imagen4]",
                "Descuento"=>"$fila[Descuento]"
            );
            array_push($productos, $producto);
            $contando++;
        }
    }else{
        $existe=1;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/logo/Logo.png">
    <link rel="stylesheet" href="css/catalogo.css">
    <link rel="stylesheet" href="css/general.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Catalogo</title>
</head>
<body class="fondo">
    <header>
       <?php
        require "encabezado.php";
        ?> 
    </header>
    
    <!-- aside -->
    <div class="filtro-container">
        <br>
        <div class="h2-aside" >
            <h2>Productos</h2> 
        </div>
        <aside>
            <form id="formulario-filtrar" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="mostrar-productos" >
                    <h6>Mostrando <?php echo $contando ?> productos</h6>
                </div>
                <div class="rango-precio" >
                    <h6>Precio</h6>
                    <input type="number" id="rango-min" min="0" max="10000" name="rango-min" placeholder="Min">
                    <label >-</label>
                    <input type="number" id="rango-max" min="0" max="10000" name="rango-max" placeholder="Max">
                </div>
                <div class="categoria-check" >
                    <h6>Categoría</h6>
                    <input type="checkbox" id="categoria-mujer" name="categoria-mujer"> 
                    <label for="categoria-mujer">Mujer</label>
                    <br>
                    <input type="checkbox" id="categoria-hombre" name="categoria-hombre"> 
                    <label for="categoria-hombre">Hombre</label>
                </div>
                <div class="marca-check" >
                    <h6>Marca</h6>
                    <input type="checkbox" id="marca-nike" name="marca-nike"> 
                    <label for="marca-nike">Nike</label>
                    <br>
                    <input type="checkbox" id="marca-adidas" name="marca-adidas"> 
                    <label for="marca-adidas">Adidas</label>
                </div>
                <button type="submit" name="submit" id="filtrar-btn">Filtrar</button>
            </form>
        </aside>
    </div>

    <section class="catalogo">
        <!-- lista de productos -->
        <div class="containerP " id="productos-container">
            <?php
            if($existe==0){
                for ($i = 0; $i < count($productos); $i++) {
                    $producto = $productos[$i];
                    ?>
                    <div class="producto">
                        <div class="img_contenedor">
                            <img class="img_tenis" src="images/productos/<?php print_r($producto["Imagen1"]); ?>" alt="" width="840" height="840">
                            <div class="overlay">
                                <div class="texto">
                                    <?php print_r($producto["Encabezado"]); ?>
                                </div>
                            </div>
                        </div>
                        <h5 class="p-nombre"><?php print_r($producto["Nombre"]); ?></h5>
                        <h6 class="p-precio">
                            $<?php
                                $precioOriginal=$producto["Precio"];
                                $descuento=$producto["Descuento"];
                                if($descuento!=0){
                                    ?>
                                    <s><?php echo $precioOriginal; ?></s>
                                    <?php
                                }
                                $aplicar="0.".$descuento;
                                $precioDescuento=$precioOriginal*$aplicar;

                                $precioFinal=$precioOriginal-$precioDescuento;

                                if($descuento!=0){
                                    echo "$".$precioFinal;
                                }else{
                                    echo $precioFinal;
                                }
                                
                            ?>
                        </h6>
                        <form action="detalles_prod.php" method="post">
                            <input type="number" name="id" value="<?php echo $producto["Id"]; ?>" hidden>
                            <input type="text" name="nombre" value="<?php echo $producto["Nombre"]; ?>" hidden>
                            <input type="number" name="precio" value="<?php echo $producto["Precio"]; ?>" hidden>
                            <input type="text" name="descripcion" value="<?php echo $producto["Descripcion"]; ?>" hidden>
                            <input type="number" name="existencia" value="<?php echo $producto["Existencia"]; ?>" hidden>
                            <input type="number" name="descuento" value="<?php echo $producto["Descuento"]; ?>" hidden>

                            <input type="text" name="imagen1" value="<?php echo $producto["Imagen1"]; ?>" hidden>
                            <input type="text" name="imagen2" value="<?php echo $producto["Imagen2"]; ?>" hidden>
                            <input type="text" name="imagen3" value="<?php echo $producto["Imagen3"]; ?>" hidden>
                            <input type="text" name="imagen4" value="<?php echo $producto["Imagen4"]; ?>" hidden>
                            <button type="submit" name="submit" class="buy-btn">Detalles</button>
                        </form>
                        <?php
                            if(!empty($_SESSION['sesion_abierta'])){
                                if($producto['Existencia']==0){
                                    ?>
                                    <button class="buy-btn" onclick="agregarCarrito('<?php echo $producto['Id']; ?>', 
                                        '<?php echo $producto['Nombre']; ?>', '<?php echo $precioFinal; ?>')" disabled>Producto agotado</button>
                                    <?php
                                }else{
                                    ?>
                                    <button class="buy-btn" onclick="agregarCarrito('<?php echo $producto['Id']; ?>', 
                                        '<?php echo $producto['Nombre']; ?>', '<?php echo $precioFinal; ?>')">Agregar al carrito</button>
                                    <?php
                                }
                                
                            }
                        ?>
                        
                    </div>
                    <?php
                }
            }else{
                ?>
                <h5>No se encontraron productos con dichas caracteristicas</h5>
                <?php
            }
            
            ?>
        </div>
    </section>

    <footer>
        <?php
            include("piePagina.php");
        ?>
    </footer>

    <script>
        function validarFormulario() {
            var categoriaMujer = document.getElementById("categoria-mujer").checked;
            var categoriaHombre = document.getElementById("categoria-hombre").checked;
            var marcaNike = document.getElementById("marca-nike").checked;
            var marcaAdidas = document.getElementById("marca-adidas").checked;

            if (!(categoriaMujer || categoriaHombre || marcaNike || marcaAdidas)) {
                Swal.fire({
                    icon: "warning",
                    title: "¡Ups!",
                    text: "Selecciona al menos una categoría o marca"
                });
                return false;
            }
            return true;
        }
    </script>

    <script src="js/carrito.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>
</html>