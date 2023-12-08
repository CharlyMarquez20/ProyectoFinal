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
    
    $_SESSION['carrito']++;
    $idProducto = $_POST['id'];
    $nombreProducto = $_POST['nombre'];
    $precioProducto = $_POST['precio'];

    $sql = "INSERT INTO carrito (Correo, IdProducto, Nombre ,Cantidad, Precio) VALUES ('$_SESSION[correo]','$idProducto',
        '$nombreProducto','1', '$precioProducto');";
    $resultado=$conexion->query($sql);
?>

<span class="numero" id="contadorProductos"><?php echo $_SESSION['carrito']; ?></span>
