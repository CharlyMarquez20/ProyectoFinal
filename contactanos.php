<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/logo/Logo.png">
    <title>Contactanos</title>

    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/contactanos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="fondo">

    <header>
        <?php
            include("encabezado.php");
        ?>
    </header>

    <section class="form1">
        <br>
        <div class="textocontacto">
            <h2>¿Tienes problemas?</h2>
            <p >Haznos saber cual es tu inquietud.</p>
        </div>

        <div class="externo">
            <div class="dentro">
                <h2>CONTACTANOS</h2>
                <form action="correo.php" method="post" id="correo">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="nombre" placeholder="" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Correo:</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" name="correo" placeholder="" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Mensaje:</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="mensaje"></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-secondary">Enviar</button>
                </form>
            </div>
        </div>
    </section>

    <br><br><br>
    <footer>
        <?php
            include("piePagina.php");
        ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    

</body>
</html>