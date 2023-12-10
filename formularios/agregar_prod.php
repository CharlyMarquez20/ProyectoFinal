<?php
    $servidor='localhost:33065';
    $cuenta='root';
    $password='';
    $bd='oasis';    

    $conexion = new mysqli($servidor,$cuenta,$password,$bd);

    if ($conexion->connect_errno) {
        die('Error en la conexión: ' . $conexion->connect_error);
    }

    $sql = "SELECT nombre, marca, categoria, precio FROM productos";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Tienda</title>
    <link rel="stylesheet" href="estilos.css"> <!-- Agrega tus estilos aquí -->
</head>
<body>
    <form action="datos_personales.php" method="post">
        <label for="producto">Producto:</label>
        <input type="text" id="producto" name="producto" required>

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" required>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" required>

        <!-- Agrega un campo para la imagen del producto (puedes usar un input de tipo "file") -->

        <button type="submit">Agregar al carrito</button>
    </form>
</body>
</html>
