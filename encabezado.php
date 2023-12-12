<?php
//l'entete de la page 
    $servidor='localhost:33065';
    $cuenta='root';
    $password='';
    $bd='oasis';
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);

    if ($conexion->connect_errno){
        die('Error en la conexion');
    }

    if(!empty($_SESSION['sesion_abierta'])){
        //echo "Encabezado: ".$_SESSION['sesion_abierta'];
    }else{
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/encabezado.css">
    <link rel="stylesheet" href="css/general.css">

    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <div class="padreEncabezado">
        <div id="slogan">
            <div class="col-lg-12" id="datosTienda">
                <div class="col-md-4" style="color: #6f706c;">
                    <h6>OASIS MX ©</h6>
                </div>
                <div class="col-md-4">
                    <p style="font-weight: bold;">Encuentra tu paraíso en cada paso: Oasis, donde los tenis son tu escape.</p>
                </div>
                <div class="col-md-4" style="color: #6f706c;">
                    <?php
                        date_default_timezone_set("America/Mexico_City");
                        $archivo="index.php";
                        $fecha_actualizacion = filemtime($archivo);
                        $fecha_actualizacion = date("d-m-Y H:i:s", $fecha_actualizacion);
                        ?>
                            <h6>Ultima actualización: <?php echo $fecha_actualizacion; ?></h6>
                        <?php
                    ?>
                </div>
            </div>
        </div>

        <div id="navbar">
            <div>
                <div class="col-lg-12">
                    <div id="superior">

                        <div class="col-md-4" id="Busqueda">
                            <form class="search" action="#" method="post">
                                <div class="search__input-container">
                                    <input type="text" placeholder="Search" name="buscar" class="search__input hidden" required>
                                </div>
                                <button type="button" class="search__button" onclick="toggleBar()">
                                    <img src="images/encabezado/search.png" alt="" width="24">
                                </button>
                            </form>
                        </div>


                        <div class="col-md-4" id="Logo">
                            <a href="index.php"><img src="images/logo/Logo2.png" alt="" height="60px"></a>
                        </div>


                        <div class="col-md-4" id="Carrito">
                            <?php
                                if(empty($_SESSION['sesion_abierta'])){
                            ?>
                                <button id="usuario" data-bs-toggle="modal" data-bs-target="#Login">
                                    <img src="images/encabezado/user.png" alt="">
                                </button>
                            <?php
                                }elseif(!empty($_SESSION['sesion_abierta'])){
                                    if(!empty($_SESSION['admin'])){
                                        ?>
                                        <div class="col-lg-12" id="elementosCarrito">
                                            <div class="row">

                                                <div class="col-md-4" id="contenedorUsuario">
                                                    <i style="font-weight: bold;">ADMINISTRADOR</i>
                                                </div>

                                                <div class="col-md-4" id="contenedorUsuario">
                                                    <a href="admin.php" class="btn btn-outline-warning" id="cerrarSesion">Administrar</a>
                                                </div>

                                                <div class="col-md-4" id="contenedorUsuario">
                                                    <form action="logout.php" method="post">
                                                        <button type="submit" name="cerrarSesion" class="btn btn-outline-danger" id="cerrarSesion2">Cerrar Sesion</button> 
                                                    </form>
                                                </div> 

                                            </div>
                                            
                                        </div>
                                        
                                        <?php
                                    }else{
                                        ?>
                                        <div class="col-lg-12" id="elementosCarrito">
                                            <div class="row" style="height: 100%; width: 100%;">
                                                <div class="col-lg-3" id="contenedorUsuario">
                                                    
                                                    <?php
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

                                                    <div id="productosCarrito">
                                                        <div class="col-lg-12">
                                                            <table id="ProductosTabla">
                                                                <!-- AQUI SE IMPRIME EL CODIGO DE VER LOS PRODUCTOS DEL CARRITO -->
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <button id="usuario" onclick="mostrarOcultar()">
                                                        <img src="images/encabezado/carrito.png" alt="">
                                                        <span id="contadorCarrito">
                                                            <span class="numero" id="contadorProductos"><?php echo $_SESSION['carrito']; ?></span>
                                                        </span>
                                                    </button>

                                                </div>

                                                <div class="col-lg-5" id="contenedorUsuario">
                                                    <i style="font-weight: bold;">Hola, <?php echo $_SESSION['cuenta']; ?></i>
                                                </div>

                                                <div class="col-lg-4" id="contenedorUsuario">
                                                    <form action="logout.php" method="post">
                                                        <button type="submit" name="cerrarSesion" class="btn btn-outline-danger" id="cerrarSesion">Cerrar Sesion</button> 
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            ?>

                            <!-- --------------------INICIO DE MODAL DE INICIO DE SESION O REGISTROS-------------------- -->
                            <div class="modal fade" id="Login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button onclick="showLogin()" class="btn btn-primary" id="opcion">Iniciar Sesion</button>
                                            <button onclick="showRegister()" class="btn btn-primary">Registrarse</button>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form hidden" id="login">
                                                <h2>Inicio de Sesion</h2>
                                                <?php
                                                    include("formularios/loginForm.php");
                                                ?>
                                                <br>
                                                <button onclick="showCambiar()" class="btn btn-warning">Recuperar contraseña</button>
                                            </div>
                                            <div class="form hidden" id="register">
                                                <div>
                                                    <h2>Registrarse</h2>      
                                                    <?php
                                                        include("formularios/registro.html");
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form hidden" id="cambiarContra">
                                                <h2>Cambiar contraseña</h2>
                                                <?php
                                                    include("formularios/cambiarContra.php");
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- --------------------FIN DE MODAL DE INICIO DE SESION O REGISTROS-------------------- -->
                        </div>
                        
                    </div>
                </div>
            </div>
            <div>
                <div class="col-lg-12">
                    <div id="inferior">
                        <div id="inferiorDentro">
                            <div class="col-md-3">
                                <h6><a href="catalogo.php" style="text-decoration: none; color: #6f706c;">Catálogo</a></h6>
                            </div>
                            <div class="col-md-3">
                                <h6><a href="contactanos.php" style="text-decoration: none; color: #6f706c;">Contacto</a></h6>
                            </div>
                            <div class="col-md-3">
                                <h6><a href="acercade.php" style="text-decoration: none; color: #6f706c;">Acerca de</a></h6>
                            </div> 
                            <div class="col-md-3">
                                <h6><a href="ayuda.php" style="text-decoration: none; color: #6f706c;">Preguntas frecuentes</a></h6>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/carrito.js"></script>
    <script src="js/productosCarrito.js"></script>
    <script>
        function showLogin() {
            document.getElementById("login").classList.remove("hidden");
            document.getElementById("register").classList.add("hidden");
            document.getElementById("cambiarContra").classList.add("hidden");
        }

        function showRegister() {
            document.getElementById("register").classList.remove("hidden"); 
            document.getElementById("login").classList.add("hidden");
            document.getElementById("cambiarContra").classList.add("hidden");
        }

        function showCambiar() {
            document.getElementById("cambiarContra").classList.remove("hidden"); 
            document.getElementById("login").classList.add("hidden");
            document.getElementById("register").classList.add("hidden");
        }
        function mostrarOcultar() {
            actualizarProductos();
            var x = document.getElementById("productosCarrito");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
    
    <script>
        function toggleBar() {
            const 
            input = document.
            querySelector
            (".search__input");
            input.classList.
            toggle("hidden");
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    
</body>
</html>