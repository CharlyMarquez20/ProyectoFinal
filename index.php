<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/logo/Logo.png">
    <link rel="stylesheet" href="css/general.css">

    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>OASIS</title>
</head>
<body class="fondo">
    <header>
        <?php
            include("encabezado.php");
        ?>
    </header>
    

    <section>
        <?php
            include("inicio.php");
            if($_SERVER["REQUEST_METHOD"] == 'GET'){
                if(isset($_GET['tipo'])){
                    $tipo=$_GET['tipo'];
                    if($tipo=="mandarCorreo"){
                        ?>
                            <script>
                                Swal.fire({
                                icon: "success",
                                title: "¡Genial!",
                                text: "Tu correo ha sido enviado. Entra a tu bandeja para más detalles."
                                });
                            </script>
                        <?php
                    }elseif($tipo=="error"){
                        ?>
                            <script>
                                Swal.fire({
                                icon: "error",
                                title: "¡Ups!",
                                text: "Tu correo no ha podido ser enviado ):"
                                });
                            </script>
                        <?php
                    }
                }
            }
        ?>
    </section>


    <footer>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>