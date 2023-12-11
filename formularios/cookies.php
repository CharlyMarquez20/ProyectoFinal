<?php
    $servidor='localhost:33065';
    $cuenta='root';
    $password='';
    $bd='oasis';
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);

    if ($conexion->connect_errno){
         die('Error en la conexion');
    }

    $sql="SELECT Correo, Contrasena FROM usuarios WHERE Correo='$correo' AND Contrasena='$encriptado'";
    $resultado=$conexion->query($sql);
    if ($conexion->affected_rows >= 1){
        if(!empty($_POST["remember"])){
            setcookie("correo", $_POST["correo"], time()+3600);
            setcookie("contra", $_POST["contra"], time()+3600);
        }
    }else{
        setcookie("correo", "");
        setcookie("contra", "");
    }
?>