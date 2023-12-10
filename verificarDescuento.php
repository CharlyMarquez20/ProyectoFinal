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

    $datos = array(
        "success" => false,
        "descuento" => 0,
        "valueCampo" => 0,
        "desactivar" => false,
        "valorDescuento" => 0
    );

    $descuentoObtenido = $_POST['descuento'];
    $descuentoCupon="";
    $sql = "SELECT Descuento FROM cupones WHERE Codigo='$descuentoObtenido'";
    $resultado=$conexion->query($sql);
    if ($resultado -> num_rows){
        while( $fila = $resultado -> fetch_assoc()){
            $descuentoCupon=$fila['Descuento'];
        }
        $descuento_Aplicar=$_SESSION['precio']*$descuentoCupon;
        $precioFinal=$_SESSION['precio']-$descuento_Aplicar;
        $datos['success']=true;
        $datos['desactivar']=true;
        $redondeado = round($precioFinal);
        $_SESSION['precio']=$redondeado;
        $_SESSION['descuento']=$descuentoCupon;
        $datos['descuento']="$".$redondeado;
        $datos['valueCampo']=$redondeado;
        $datos['valorDescuento']=$descuentoCupon;
    }else{
        $datos['descuento']="$".$_SESSION['precio'];
        $datos['valueCampo']=$_SESSION['precio'];
        $datos['success']=false;
        $datos['desactivar']=false;
    }
    
    echo json_encode($datos);
?>