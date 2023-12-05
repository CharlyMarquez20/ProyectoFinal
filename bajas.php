<?php
    $servidor='localhost:33065';
    $cuenta='root';
    $password='';
    $bd='oasis';    
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);

if ($conexion->connect_errno) {
    die('Error en la conexión: ' . $conexion->connect_error);
}

if (isset($_POST['eliminar'])) {
    // Obtener el ID del producto a dar de baja
    $id_producto = $_POST['id_producto'];
    
    $sql = "SELECT Id FROM productos WHERE Id='$id_producto'";
    $resultado = $conexion->query($sql);

    if ($resultado -> num_rows){
       // Eliminar el producto de la base de datos
        $sql_eliminar = "DELETE FROM productos WHERE Id = '$id_producto'";
        $resultado_eliminar = $conexion->query($sql_eliminar);

        if ($resultado_eliminar) {
            echo "<script>window.location.href = 'admin.php?tipo=bajas';</script>";
        } 
    }else{
        echo "<script>window.location.href = 'admin.php?tipo=bajasMal';</script>";
    }

    
}
?>