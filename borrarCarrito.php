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

    unset($_SESSION['pdf']); 
    $_SESSION['carrito']=0;
    for ($i = 0; $i < count($carrito); $i++){
        $mostrarProducto = $carrito[$i];
        $sql="DELETE FROM carrito WHERE Nombre='$mostrarProducto[Nombre]'";
        $resultado=$conexion->query($sql);
        $sql = "UPDATE productos SET Existencia = Existencia - $mostrarProducto[Cantidad] WHERE Id = '$mostrarProducto[Producto]'";
        $resultado=$conexion->query($sql);
    }

    echo "<script>window.location.href = 'index.php';</script>";
?>