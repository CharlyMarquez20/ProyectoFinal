<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/encabezado.css">
    <link rel="stylesheet" href="css/general.css">

    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
                            <form class="search" action="" method="post">
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
                            <button id="usuario" data-bs-toggle="modal" data-bs-target="#Login">
                                <img src="images/encabezado/user.png" alt="">
                            </button>

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
                                                <form action="leerDatos.php" method="post">
                                                    <h2>Inicio de Sesion</h2>
                                                    <label for="email" name="correo">Email:</label>
                                                    <input type="email" required>

                                                    <br>

                                                    <label for="password" name="contra">Contraseña:</label>  
                                                    <input type="password" required>

                                                    <input type="hidden" name="tipo" value="inicioSesion">
                                                    <br>
                                                    <button type="submit" class="btn btn-success">Enviar</button>
                                                </form>
                                            </div>
                                            <div class="form hidden" id="register">
                                                <div>
                                                    <h2>Registrarse</h2>      
                                                    <form action="leerDatos.php" method="post" onsubmit="return validarContraseña()">
                                                        <div class="col-12">
                                                            <label for="nombre">Nombre:</label>
                                                            <input type="text" id="nombre" name="nombre" required>

                                                            <label for="cuenta">Cuenta:</label>
                                                            <input type="text" id="cuenta" name="cuenta" required>

                                                            <label for="correo">Correo:</label>  
                                                            <input type="email" id="correo" name="correo" required>

                                                            <label for="comida">Comida favorita:</label>
                                                            <input type="text" id="comida" name="pregunta" required>

                                                            <label for="contraseña">Contraseña:</label>
                                                            <input type="password" id="contrasena" required> 

                                                            <label for="repetirContraseña">Repetir contraseña:</label>
                                                            <input type="password" id="repetirContrasena" required>
                                                            
                                                            <input type="hidden" name="tipo" value="registro">
                                                        </div>
                                                        <br>
                                                        <button type="submit" class="btn btn-success">Enviar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="col-lg-12">
                    <div id="inferior">
                        <div id="inferiorDentro">
                            <div class="col-md-3">
                                <h6><a href="#" style="text-decoration: none; color: #6f706c;">Filtrar</a></h6>
                            </div>
                            <div class="col-md-3">
                                <h6><a href="#" style="text-decoration: none; color: #6f706c;">Catálogo</a></h6>
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
        }

        function showRegister() {
        document.getElementById("register").classList.remove("hidden"); 
        document.getElementById("login").classList.add("hidden");
        }
    </script>
    <script>
        function validarContraseña() {
            var contrasena = document.getElementById("contrasena").value;
            var repetirContrasena = document.getElementById("repetirContrasena").value;

            if (contrasena !== repetirContrasena) {
                // alert("Las contraseñas no coinciden. Por favor, inténtalo de nuevo.");
                swal("¡Error!", "¡¡Las contraseñas no coinciden, favor de volver a intentarlo!!", "error");
                return false;
            }else{
                swal("¡Correcto!", "Registro exitoso", "success");
                return true;
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
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
</body>
</html>