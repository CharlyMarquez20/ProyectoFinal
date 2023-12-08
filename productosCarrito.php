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

    $carrito=array();
    $mensaje="";
    $sql = "SELECT IdProducto, Nombre, Precio, SUM(Cantidad) AS Cantidad FROM carrito WHERE Correo='$_SESSION[correo]' GROUP BY(IdProducto);";
    $resultado=$conexion->query($sql);
    if (mysqli_num_rows($resultado) > 0){
        while( $fila = mysqli_fetch_assoc($resultado)){
            $productoBase=array(
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
                        ?>
                        <tr>
                        <td><?php print_r($mostrarProducto["Cantidad"]); ?></td>
                        <td><?php print_r($mostrarProducto["Nombre"]); ?></td>
                        <td><?php print_r($mostrarProducto["Precio"]); ?></td>
                        <td>X</td>
                        </tr>
                        <?php
                    }
                    ?>
                <?php
            }
        ?>
        <tr>
            <td colspan="3">
                <br>
                <button class="buy-btn">Proceder al pago</button>
            </td>
        </tr>
    </table>
    <?php
?>