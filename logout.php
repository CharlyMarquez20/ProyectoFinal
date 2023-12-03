<?php
    if(isset($_POST['cerrarSesion'])){
        session_start();
        $_SESSION['sesion_abierta'] = null;
        $_SESSION['cuenta'] = '';
        session_destroy();  
    }
    echo "<script>window.location.href = 'index.php';</script>";
?>