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

    $fecha = $_POST['fecha'];
    $direccion =$_POST['direccion'];
    $cp = $_POST['cp'];
    $ciudad=$_POST['ciudad'];
    $estado=$_POST['estado'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];


    $subtotal = $_POST['subtotal'];
    $costEnvio = $_POST['envio'];
    $impuesto = $_POST['impuesto'];
    $total = $_POST['total'];
    $metodo = $_POST['tipo'];
    
    $_SESSION['pdf']=array($fecha, $direccion, $cp, $ciudad, $estado, $nombre, $telefono, $correo, $subtotal, $costEnvio,
        $impuesto, $total, $metodo);

    include("correoNota.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/logo/Logo.png">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Nota</title>
</head>
<body>
    <template id="notaCompra">
        <swal-html>
            <h5>A continuacion un resumen de tus compras:</h5>
            <div>
                <table>
                    <tr>
                        <th style="width: 10px;">#</th>
                        <th>Producto</th>
                        <th>$</th>
                    </tr>
                    <?php
                        for ($i = 0; $i < count($carrito); $i++){
                            $mostrarProducto = $carrito[$i];
                            ?>
                            <tr>
                                <td><?php print_r($mostrarProducto["Cantidad"]); ?></td>
                                <td><?php print_r($mostrarProducto["Nombre"]); ?></td>
                                <td><?php print_r($mostrarProducto["Precio"]); ?></td>
                            </tr>
                            <?php
                        }
                    ?>
                    <tr>
                        <td colspan="2" style="padding-top: 30px;">
                            <b>Subtotal:</b>
                        </td>
                        <td style="padding-top: 30px;">
                            <?php echo "$".$_SESSION['pdf'][8]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Impuestos:</b>
                        </td>
                        <td >
                            <?php 
                                echo "$".$_SESSION['pdf'][10];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Envío:</b>
                        </td>
                        <td >
                            <?php 
                                echo "$".$_SESSION['pdf'][9];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Total:</b>
                        </td>
                        <td>
                            <?php 
                                echo "$".$_SESSION['pdf'][11];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Modo de pago:</b>
                        </td>
                        <td>
                            <?php 
                                echo $_SESSION['pdf'][12];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Direccion:</b>
                        </td>
                        <td>
                            <?php 
                                $direccion=$direccion.". C.P. ".$cp.", ".$ciudad.", ".$estado;
                                echo $direccion;
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
            <a href="pdf.php">Da clic aquí para generar tu nota en PDF</a>
        </swal-html>
    </template>

    <section>
        <?php
            include("index.php");
        ?>
        <script>
            Swal.fire({
            icon: "success",
            title: "¡Nota de compra!",
            template: "#notaCompra"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'borrarCarrito.php';
                }
            });
        </script>
    </section>

</body>
</html>