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

    $datos = array(
        "success" => false,
        "contadorProductos" => 0
    );

    if(isset($_POST['tipo'])){
        $sumaCarrito=0;
        $sql = "SELECT Cantidad FROM carrito WHERE Correo='$_SESSION[correo]'";
        $resultado=$conexion->query($sql);
        if ($resultado -> num_rows){
            while( $fila = $resultado -> fetch_assoc()){
                $sumaCarrito+=$fila['Cantidad'];
            }
            $_SESSION['carrito']=$sumaCarrito;
            $datos["success"] = true;
            $datos["contadorProductos"] = $_SESSION['carrito'];
        }else{
            $_SESSION['carrito']=0;
        }
    }else{
        $cantidad=0;
        $existencia=0;
        $contadorPar=0;
        $cantidad=$_POST['cantidad'];
        for($i=0; $i<$cantidad; $i++){
            $idProducto = $_POST['id'];
            $nombreProducto = $_POST['nombre'];
            $precioProducto = $_POST['precio'];

            $sql = "SELECT Existencia FROM productos WHERE Id='$idProducto'";
            $resultado=$conexion->query($sql);
            $fila = $resultado->fetch_assoc();
            $existencia = intval($fila['Existencia']);

            $sql = "SELECT IdProducto, SUM(Cantidad) AS Cantidad FROM carrito 
                WHERE Correo='$_SESSION[correo]' AND IdProducto='$idProducto' GROUP BY(IdProducto);";
            $resultado=$conexion->query($sql);
            if ($resultado -> num_rows){
                $fila = $resultado->fetch_assoc();
                $contadorPar = intval($fila['Cantidad']);
            }else{
                $contadorPar=0;
            }
            
            if($contadorPar==$existencia){
                $datos["success"] = false;
                break;
            }else{
                $_SESSION['carrito']++;
                $sql = "INSERT INTO carrito (Correo, IdProducto, Nombre ,Cantidad, Precio) VALUES ('$_SESSION[correo]','$idProducto',
                    '$nombreProducto','1', '$precioProducto');";
                $resultado=$conexion->query($sql);
                $datos["success"] = true;
            }
        }
        $datos["contadorProductos"] = $_SESSION['carrito'];
    }
    echo json_encode($datos);
?>

