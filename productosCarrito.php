<?php
    session_start();
    $servidor='localhost:33065';
    $cuenta='root';
    $password='';
    $bd='oasis';
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);

    if ($conexion->connect_errno){
        die('Error en la conexion');
    }

    if(isset($_POST['id'])){
        $id=$_POST['id'];
        $sql = "DELETE FROM carrito WHERE Id = '$id'";
        $resultado=$conexion->query($sql);
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
    }else{
        $mensaje="El carrito está vacío";
    }

    ?>

    <table id="ProductosTabla">
        <?php
            if(!empty($mensaje)){
                ?>
                <h5>El carrito está vacío</h5>
                <?php
            }else{
                ?>
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>$</th>
                    <th></th>
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
                        <td>
                            <button onclick="eliminarProducto('<?php echo $mostrarProducto['Id']; ?>')" style="border: none; background-color: white;">
                                <img src="images/encabezado/borrar.png" alt="">
                            </button>
                        </td>
                        </tr>
                        <?php
                    }
                    $_SESSION['precio']=$total;
                    $_SESSION['descuento']=0;
                    ?>
                    <tr>
                        <td colspan="2">
                            <b>Total:</b>
                        </td>
                        <td>
                            <?php echo "$".$total; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <br>
                            <form action="datosPersonales.php" method="post">
                                <button class="buy-btn">Proceder al pago</button>
                            </form>
                        </td>
                    </tr>
                <?php
            }
        ?>
    </table>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/carrito.js"></script>
    <script src="js/productosCarrito.js"></script>

    
    <?php
?>