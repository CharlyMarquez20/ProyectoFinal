<?php
    // Conectar a la base de datos
    $servidor='localhost:33065';
    $cuenta='root';
    $password='';
    $bd='oasis';
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);
    // Verificar la conexión
    if(!$conexion){
        die("Error de conexión: " . mysqli_connect_error());
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/logo/Logo.png">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/admin.css">

    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Administrador</title>
</head>
<body class="fondo">
    <header>
        <?php
            include("encabezado.php");
        ?>
    </header>    
    <main>
        <?php
            if($_SERVER["REQUEST_METHOD"] == 'GET'){
                if(isset($_GET['tipo'])){
                    $tipo=$_GET['tipo'];
                    if($tipo=="altas"){
                        ?>
                            <script>
                                Swal.fire({
                                icon: "success",
                                title: "¡Genial!",
                                text: "El producto ha sido dado de alta"
                                });
                            </script>
                        <?php
                    }elseif($tipo=="bajas"){
                        ?>
                            <script>
                                Swal.fire({
                                icon: "success",
                                title: "¡Genial!",
                                text: "El producto ha sido dado de baja correctamente"
                                });
                            </script>
                        <?php
                    }
                }
            }
        ?>
        <div>
            <button id="btn1">Inicio</button>
            <button id="btn2">Altas</button> 
            <button id="btn3">Bajas</button>
            <button id="btn4">Cambios</button>
        </div>
        
        <div id="content1" style="display: block;">
            <br>
            <table>
                <tr>
                <th>Id</th>
                <th>Marca</th>
                <th>Nombre</th>
                <th>Categoría</th> 
                <th>Encabezado</th>
                <th>Descripción</th>
                <th>Existencia</th>
                <th>Precio</th>
                <th>Imagen1</th>
                <th>Imagen2</th>  
                <th>Imagen3</th>
                <th>Imagen4</th>
                <th>Descuento</th>
                </tr>
                <?php
                    $sql = "SELECT Id, Marca, Nombre, Categoria, Encabezado, Descripcion, Existencia, Precio, Imagen1, Imagen2, Imagen3, Imagen4, Descuento FROM productos";
                    $result = mysqli_query($conexion, $sql);
                    if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td>" . $row["Id"] . "</td>";
                        echo "<td>" . $row["Marca"] . "</td>";
                        echo "<td>" . $row["Nombre"] . "</td>"; 
                        echo "<td>" . $row["Categoria"] . "</td>";
                        echo "<td>" . $row["Encabezado"] . "</td>";
                        echo "<td class='description';>" . $row["Descripcion"] . "</td>";
                        echo "<td>" . $row["Existencia"] . "</td>";
                        echo "<td>" . $row["Precio"] . "</td>";
                        echo "<td class='description';>" . $row["Imagen1"] . "</td>";
                        echo "<td class='description';>" . $row["Imagen2"] . "</td>";
                        echo "<td class='description';>" . $row["Imagen3"] . "</td>";  
                        echo "<td class='description';>" . $row["Imagen4"] . "</td>";
                        echo "<td>" . $row["Descuento"] . "</td>";
                        echo "</tr>";
                    }
                    }else {
                    echo "<tr><td colspan='13'>No hay datos</td></tr>";
                    }
                ?>
            </table>
        </div>
        
        <div id="content2" style="display: none;">
            <br>
            <h2>Altas</h2>
            <form action="altas.php" method="post" enctype="multipart/form-data">

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-3">
                            <label id="Encabezados">Marca</label>
                            <input type="text" name="marca">
                        </div>
                        <div class="col-md-3">
                            <label id="Encabezados">Nombre</label>
                            <input type="text" name="nombre">
                        </div>
                        <div class="col-md-3">
                            <label id="Encabezados">Encabezado</label>
                            <input type="text" name="encabezado"></input>
                        </div>
                        <div class="col-md-3">
                            <label id="Encabezados">Descripcion</label>
                            <input type="textarea" name="descripcion"></input>
                        </div>
                        
                    </div>
                </div>
                
                <br>

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-3">
                            <label id="Encabezados">Categoria</label>
                            <div style="text-align: center;">
                               <label class="categoria"><input type="radio" id="hombre" name="categoria" value="Hombre">Hombre</label>
                                <label class="categoria"><input type="radio" id="mujer" name="categoria" value="Mujer">Mujer</label> 
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label id="Encabezados">Existencia</label>
                            <input type="number" name="existencia">
                        </div>
                        <div class="col-md-3">
                            <label id="Encabezados">Precio</label>
                            <input type="number" name="precio">
                        </div>
                        <div class="col-md-3">
                            <label id="Encabezados">Descuento</label>
                            <input type="number" name="descuento">
                        </div>
                    </div>
                </div>
                    
                <br>
                
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-3">
                            <label id="Encabezados">Imagen 1</label>
                            <input type="file" name="imagen1" id="imagen1" accept="image/*">
                        </div>
                        <div class="col-md-3">
                            <label id="Encabezados">Imagen 2</label>
                            <input type="file" name="imagen2" id="imagen2" accept="image/*">
                        </div>
                        <div class="col-md-3">
                            <label id="Encabezados">Imagen 3</label>
                            <input type="file" name="imagen3" id="imagen3" accept="image/*">
                        </div>
                        <div class="col-md-3">
                            <label id="Encabezados">Imagen 4</label>
                            <input type="file" name="imagen4" id="imagen4" accept="image/*">
                        </div>
                    </div>
                </div>
                
                <br>
                
                <div class="col-lg-3">
                    <button type="submit" name="submit" class="btn btn-dark">Enviar</button>
                </div>
            </form>
        </div> 
        
        <div id="content3" style="display: none;">
            <br>
            <h2>Bajas</h2>
            <form action="bajas.php" method="post">
                <label for="id_producto">ID del producto a eliminar:</label>
                <input type="number" name="id_producto" min="1">
                <br>
                <button type="submit" name="eliminar" class="btn btn-dark">Eliminar Producto</button>
            </form>
            <br>
            <table>
                <tr>
                <th>Id</th>
                <th>Marca</th>
                <th>Nombre</th>
                <th>Categoría</th> 
                <th>Encabezado</th>
                <th>Descripción</th>
                <th>Existencia</th>
                <th>Precio</th>
                <th>Imagen1</th>
                <th>Imagen2</th>  
                <th>Imagen3</th>
                <th>Imagen4</th>
                <th>Descuento</th>
                </tr>
                <?php
                    $sql = "SELECT Id, Marca, Nombre, Categoria, Encabezado, Descripcion, Existencia, Precio, Imagen1, Imagen2, Imagen3, Imagen4, Descuento FROM productos";
                    $result = mysqli_query($conexion, $sql);
                    if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td>" . $row["Id"] . "</td>";
                        echo "<td>" . $row["Marca"] . "</td>";
                        echo "<td>" . $row["Nombre"] . "</td>"; 
                        echo "<td>" . $row["Categoria"] . "</td>";
                        echo "<td>" . $row["Encabezado"] . "</td>";
                        echo "<td class='description';>" . $row["Descripcion"] . "</td>";
                        echo "<td>" . $row["Existencia"] . "</td>";
                        echo "<td>" . $row["Precio"] . "</td>";
                        echo "<td class='description';>" . $row["Imagen1"] . "</td>";
                        echo "<td class='description';>" . $row["Imagen2"] . "</td>";
                        echo "<td class='description';>" . $row["Imagen3"] . "</td>";  
                        echo "<td class='description';>" . $row["Imagen4"] . "</td>";
                        echo "<td>" . $row["Descuento"] . "</td>";
                        echo "</tr>";
                    }
                    }else {
                    echo "<tr><td colspan='13'>No hay datos</td></tr>";
                    }
                ?>
            </table>
        </div>
        
        <div id="content4" style="display: none;">
            <br>
            <h2>Cambios</h2>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Marca</th>
                    <th>Nombre</th>
                    <th>Categoría</th> 
                    <th>Encabezado</th>
                    <th>Descripción</th>
                    <th>Existencia</th>
                    <th>Precio</th>
                    <th>Imagen1</th>
                    <th>Imagen2</th>  
                    <th>Imagen3</th>
                    <th>Imagen4</th>
                    <th>Descuento</th>
                </tr>
            </table>
        </div>


    </main>
    <script>
        const btn1 = document.getElementById('btn1');
        const btn2 = document.getElementById('btn2');
        const btn3 = document.getElementById('btn3');
        const btn4 = document.getElementById('btn4');

        const content1 = document.getElementById('content1');
        const content2 = document.getElementById('content2');
        const content3 = document.getElementById('content3');
        const content4 = document.getElementById('content4');

        btn1.addEventListener('click', () => {
        content1.style.display = 'block';
        content2.style.display = 'none';
        content3.style.display = 'none';
        content4.style.display = 'none';
        });

        btn2.addEventListener('click', () => {
        content1.style.display = 'none'; 
        content2.style.display = 'block';
        content3.style.display = 'none';
        content4.style.display = 'none';
        });

        btn3.addEventListener('click', () => {
        content1.style.display = 'none';
        content2.style.display = 'none';
        content3.style.display = 'block';
        content4.style.display = 'none';  
        });

        btn4.addEventListener('click', () => {
        content1.style.display = 'none';
        content2.style.display = 'none';
        content3.style.display = 'none';
        content4.style.display = 'block';  
        });
    </script>      
</body>
</html>