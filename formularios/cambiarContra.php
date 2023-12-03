<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h6>Este formulario solo será funcional si la cuenta ingresada tiene los permisos para cambiar su contraseña</h6>
    <form action="login.php" method="post" onsubmit="return validar()">
        <label for="contraseña">Correo:</label>
        <input type="email" name="correo" id="email" required> 

        <label for="contraseña">Nueva contraseña:</label>
        <input type="password" name="contra" id="contra" required> 
                    
        <label for="repetirContraseña">Repetir contraseña:</label>
        <input type="password" id="repetirContra" required>
        <br>
        <input type="hidden" name="tipo" value="cambiarContra">
        <button type="submit" name="submit" class="btn btn-success">Enviar</button>
    </form>

    <script>
        function validar() {
            var contrasena = document.getElementById("contra").value;
            var repetirContrasena = document.getElementById("repetirContra").value;

            if (contrasena !== repetirContrasena) {
                Swal.fire({
                    title: "¡Error!",
                    text: "¡¡Las contraseñas no coinciden, favor de volver a intentarlo!!",
                    icon: "error"
                });
                return false;
            }else{
                return true;
            }
        }
    </script>
</body>
</html>