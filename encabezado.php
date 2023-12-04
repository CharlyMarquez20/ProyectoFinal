<?php
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
            <p style="font-weight: bold;">Encuentra tu paraíso en cada paso: Oasis, donde los tenis son tu escape.</p>
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
                            ?>
                                <button id="usuario" data-bs-toggle="modal" data-bs-target="">
                                    <img src="images/encabezado/carrito.png" alt="">
                                </button>
                                <?php
                                    if(!empty($_SESSION['admin'])){
                                        ?>
                                        <div class="alert alert-light" role="alert" id="nombreUsuario">
                                            <i style="font-weight: bold;">ADMINISTRADOR</i>
                                        </div>
                                        <form action="#" method="post">
                                            <button type="submit" name="admin" class="btn btn-outline-warning" id="cerrarSesion">Administrar</button> 
                                        </form>
                                        <form action="logout.php" method="post">
                                            <button type="submit" name="cerrarSesion" class="btn btn-outline-danger" id="cerrarSesion2">Cerrar Sesion</button> 
                                        </form>
                                        <?php
                                    }else{
                                        ?>
                                        <div class="alert alert-light" role="alert" id="nombreUsuario">
                                            <i style="font-weight: bold;">Hola, <?php echo $_SESSION['cuenta']; ?></i>
                                        </div>
                                        <form action="logout.php" method="post">
                                            <button type="submit" name="cerrarSesion" class="btn btn-outline-danger" id="cerrarSesion">Cerrar Sesion</button> 
                                        </form>
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
                                <h6><a href="index.php" style="text-decoration: none; color: #6f706c;">Inicio</a></h6>
                            </div>
                            <div class="col-md-3">
                                <h6><a href="catalogo.php" style="text-decoration: none; color: #6f706c;">Catálogo</a></h6>
                            </div>
                            <div class="col-md-3">
                                <h6><a href="contactanos.php" style="text-decoration: none; color: #6f706c;">Contacto</a></h6>
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