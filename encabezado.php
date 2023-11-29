<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/encabezado.css">
    <link rel="stylesheet" href="css/general.css">

    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css"rel="stylesheet"/>
</head>
<body>
    <div class="padreEncabezado">
        <div id="slogan">
            <p style="font-weight: bold;">Encuentra tu paraíso en cada paso: Oasis, donde los tenis son tu escape.</p>
        </div>

        <div id="navbar">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row" id="superior" style="margin-top: 10px; margin-bottom: 10px;">
                        <div class="col-md-4" id="Busqueda">
                            <form class="search">
                                <div class="search__input-container">
                                    <input type="text" placeholder="Search" class="search__input" />
                                </div>
                                <button type="button" class="search__button" onclick="toggleBar()">
                                    <i  class="ri-search-2-line"></i>
                                </button>
                            </form>
                        </div>
                        <div class="col-md-4" id="Logo">
                            <a href="index.php"><img src="images/logo/Logo2.png" alt="" height="60px"></a>
                        </div>
                        <div class="col-md-4" id="Carrito">
                            <h1>C</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row" id="inferior">
                        <div id="inferiorDentro">
                            <div class="col-md-3">
                                <h6><a href="#" style="text-decoration: none; color: #6f706c;">Filtrar</a></h6>
                            </div>
                            <div class="col-md-3">
                                <h6><a href="#" style="text-decoration: none; color: #6f706c;">Catálogo</a></h6>
                            </div>
                            <div class="col-md-3">
                                <h6><a href="#" style="text-decoration: none; color: #6f706c;">Contacto</a></h6>
                            </div>
                            <div class="col-md-3">
                                <h6><a href="#" style="text-decoration: none; color: #6f706c;">Preguntas frecuentes</a></h6>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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