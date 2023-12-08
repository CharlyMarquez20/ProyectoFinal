<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/logo/Logo.png">
    <link rel="stylesheet" href="css/general.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>OASIS</title>
</head>
<body class="fondo">
    <header>
        <?php
            //require("index.php");
        ?>
    </header>

    <template id="recuperarContra">
        <swal-html>
            <h6>Para poder recuperar tu contraseña, deberás de introducir la respuesta a
                tu pregunta de seguridad</h6>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <label name="correo">Email: </label>
                <br>
                <input type="email" name="correo" required>

                <hr>

                <label name="contra">¿Cuál es tu comida favorita? </label> 
                <br>
                <input type="text" name="respuesta" required>

                <input type="hidden" name="tipo" value="recuperar">
                <hr>
                <button type="submit" name="submit" class="btn btn-success">Enviar</button>
            </form>
        </swal-html>
    </template>

</body>
</html>
<?php
    $servidor='localhost:33065';
    $cuenta='root';
    $password='';
    $bd='oasis';
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);

    if ($conexion->connect_errno){
         die('Error en la conexion');
    }
    
    if(isset($_POST["submit"])){
        session_start();
        $tipo=$_POST['tipo'];
        if($tipo == "inicioSesion"){
            $correo=$_POST['correo'];
            $contra=$_POST['contra'];
            $encriptado=md5($contra);
            include ('formularios/cookies.php');

            $sql = "SELECT Correo, Contrasena, Cuenta, Administrador, Bloqueada FROM usuarios WHERE Correo='$correo'";
            $resultado=$conexion->query($sql);
            if ($resultado -> num_rows){
                while( $fila = $resultado -> fetch_assoc()){
                    $bloqueado=$fila['Bloqueada'];
                    $admin=$fila['Administrador'];
                    if($fila['Contrasena']==$encriptado){
                        if($bloqueado==4){
                            session_destroy();
                            require("index.php");
                            ?>
                            <script>
                                Swal.fire({
                                icon: "warning",
                                title: "¡Tu cuenta ha sido bloqueda!",
                                template: "#recuperarContra",
                                showConfirmButton: false, //hide OK button
                                });
                            </script>
                            <?php
                        }else{
                            if($admin==1){
                                $_SESSION['sesion_abierta']=1;
                                $_SESSION['admin']=1;
                                $_SESSION['cuenta']=$fila['Cuenta'];
                                echo "<script>window.location.href = 'index.php';</script>";
                            }else{
                                $sumaCarrito=0;
                                $_SESSION['cuenta']=$fila['Cuenta'];
                                $sql = "SELECT Correo, Cantidad, IdProducto FROM carrito WHERE Correo='$correo'";
                                $resultado=$conexion->query($sql);
                                if ($resultado -> num_rows){
                                    while( $fila = $resultado -> fetch_assoc()){
                                        $sumaCarrito+=$fila['Cantidad'];
                                    }
                                    $_SESSION['carrito']=$sumaCarrito;
                                }else{
                                    $_SESSION['carrito']=0;
                                }
                                $_SESSION['sesion_abierta']=1;
                                $_SESSION['correo']=$correo;
                                echo "<script>window.location.href = 'index.php';</script>"; 
                            }
                              
                        }
                    }else{
                        if($bloqueado==4){
                            session_destroy();
                            require("index.php");
                            ?>
                            <script>
                                Swal.fire({
                                icon: "warning",
                                title: "¡Tu cuenta ha sido bloqueda!",
                                template: "#recuperarContra",
                                showConfirmButton: false, //hide OK button
                                });
                            </script>
                            <?php
                        }else{
                            $cont=$bloqueado+1;
                            $sql = "UPDATE usuarios SET Bloqueada='$cont' WHERE Correo='$correo'";
                            $conexion->query($sql);
                            if($bloqueado==3){
                                session_destroy();
                                require("index.php");
                                ?>
                                <script>
                                    Swal.fire({
                                    icon: "warning",
                                    title: "¡Tu cuenta ha sido bloqueda!",
                                    template: "#recuperarContra",
                                    showConfirmButton: false, //hide OK button
                                    });
                                </script>
                                <?php
                                $sql = "UPDATE usuarios SET Bloqueada='4' WHERE Correo='$correo'";
                                $conexion->query($sql);
                            }else{
                                session_destroy();
                                require("index.php");
                                echo '<script>Swal.fire({
                                    title: "¡Ups!",
                                    text: "Parece que la contraseña es incorrecta",
                                    icon: "error"
                                });</script>'; 
                            }
                        }
                    }
                }
            }else{
                session_destroy();
                require("index.php");
                echo '<script>Swal.fire({
                    title: "¡Ups!",
                    text: "Parece que la cuenta no existe",
                    icon: "error"
                });</script>';
            }

        }elseif($tipo=="registro"){
            $_SESSION['sesion_abierta']=1;
            $nombre=$_POST['nombre'];
            $cuenta=$_POST['cuenta'];
            $correo=$_POST['correo'];
            $pregunta=$_POST['pregunta'];
            $contra=$_POST['contra'];
            $encriptado=md5($contra);

            $sql = "SELECT Correo FROM usuarios WHERE Correo='$correo'";
            $resultado = $conexion -> query($sql);
            if($resultado -> num_rows){
                $_SESSION['sesion_abierta'] = null;
                $_SESSION['admin']='';
                $_SESSION['cuenta'] = '';
                session_destroy();
                require("index.php");
                ?>
                <script>
                    Swal.fire({
                    icon: "error",
                    title: "¡Ups!",
                    text: "Parece que el correo ya está registrado, intenta con uno nuevo"
                    });
                </script>
                <?php
            }else{
                $sql = "INSERT INTO usuarios (Nombre, Cuenta, Correo, Pregunta, Contrasena) VALUES('$nombre', '$cuenta', '$correo', '$pregunta', '$encriptado');";
                $conexion->query($sql);

                $sql = "SELECT Cuenta FROM usuarios WHERE Nombre='$nombre'";
                $resultado = $conexion->query($sql);
                if ($conexion->affected_rows >= 1){ //revisamos que se inserto un registro
                    while( $fila = $resultado -> fetch_assoc()){
                        $_SESSION['cuenta']=$fila['Cuenta'];
                        echo "<script>window.location.href = 'index.php';</script>";
                    }
                }
            }

        }elseif($tipo=="recuperar"){
            session_destroy();
            $correo=$_POST['correo'];
            $respuesta=$_POST['respuesta'];
            require("index.php");

            $sql = "SELECT Pregunta FROM usuarios WHERE Correo='$correo'";
            $resultado = $conexion->query($sql);
            if ($conexion->affected_rows >= 1){
                while( $fila = $resultado -> fetch_assoc()){
                    $respuestaBase=$fila['Pregunta'];
                    if($respuestaBase===$respuesta){
                        ?>
                        <script>
                            Swal.fire({
                            icon: "success",
                            title: "¡Genial!",
                            text: "Tu cuenta ha sido desbloqueada, puedes reestablecer tu contraseña en el apartado de iniciar sesion."
                            });
                        </script>
                        <?php
                        $sql = "UPDATE usuarios SET Recuperar='1' WHERE Correo='$correo'";
                        $conexion->query($sql);
                    }else{
                        ?>
                        <script>
                            Swal.fire({
                            icon: "error",
                            title: "¡Respuesta incorrecta!",
                            text: "La respuesta no coincide con la respuesta correcta"
                            });
                        </script>
                        <?php
                    }
                }
            }
        }elseif($tipo=="cambiarContra"){
            session_destroy();
            require("index.php");
            $correoRecibido=$_POST['correo'];
            $contra=$_POST['contra'];
            $encriptado=md5($contra);

            $sql = "SELECT Correo, Recuperar FROM usuarios WHERE Recuperar='1'";
            $resultado=$conexion->query($sql);
            if ($conexion->affected_rows >= 1){
                while( $fila = $resultado -> fetch_assoc()){
                    $correoBase=$fila['Correo'];
                }
                if($correoBase===$correoRecibido){
                    $sql = "UPDATE usuarios SET Contrasena='$encriptado' WHERE Correo='$correoRecibido'";
                    $conexion->query($sql);
                    $sql = "UPDATE usuarios SET Bloqueada='1' WHERE Correo='$correoRecibido'";
                    $conexion->query($sql);
                    $sql = "UPDATE usuarios SET Recuperar='0' WHERE Correo='$correoRecibido'";
                    $conexion->query($sql);
                    ?>
                    <script>
                        Swal.fire({
                        icon: "success",
                        title: "¡Cambio exitoso!",
                        text: "Tu contraseña ha sido restablecida"
                        });
                    </script>
                    <?php
                }else{
                    ?>
                    <script>
                        Swal.fire({
                        icon: "error",
                        title: "¡Ups!",
                        text: "El correo no tiene permisos para cambiar contraseña o no existe"
                        });
                    </script>
                    <?php
                }
            }else{
                ?>
                <script>
                    Swal.fire({
                    icon: "error",
                    title: "¡Ups!",
                    text: "El correo no tiene permisos para cambiar contraseña o no existe"
                    });
                </script>
                <?php
            }
        }
    }

?>