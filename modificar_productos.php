<?php
    $host = "localhost:33065";
    $usuario = "root";
    $clave = "";
    $basededatos = "oasis";

    $conexion = mysqli_connect($host, $usuario, $clave, $basededatos);

    if ($conexion->connect_errno) {
        die('Error en la conexión: ' . $conexion->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['modificar'])) {
            // Obtener los datos del formulario de modificación
            $id_producto_modificar = $_POST['id_producto'];
            $marca = $_POST['marca'];
            $nombre = $_POST['nombre'];
            $categoria = $_POST['categoria'];
            $encabezado = $_POST['encabezado'];
            $descripcion = $_POST['descripcion'];
            $existencia = $_POST['existencia'];
            $precio = $_POST['precio'];
            $descuento = $_POST['descuento'];

            $contador=1;
            $sql="SELECT Imagen1 FROM productos WHERE Categoria='$categoria'";
            $resultado=$conexion->query($sql);
            if ($resultado -> num_rows){
                while( $fila = $resultado -> fetch_assoc()){
                    $contador++;
                }
            }

            if (isset($_FILES["imagen1"]) && isset($_FILES["imagen2"]) && isset($_FILES["imagen3"]) && isset($_FILES["imagen4"]) 
                    && !(empty($_FILES["imagen1"]["tmp_name"])) && !(empty($_FILES["imagen2"]["tmp_name"])) && !(empty($_FILES["imagen3"]["tmp_name"]))
                        && !(empty($_FILES["imagen4"]["tmp_name"]))) {
                $targetDir = "images/productos/";  // Directorio donde se guardarán las imágenes
                if($categoria=="Hombre"){
                    $carpeta="hombre";
                }else{
                    $carpeta="mujer";
                }
                $estructura = $categoria."/".$carpeta;
                $estructura .= $contador."/";
                $targetDir .= $estructura;
                mkdir($targetDir, 0777);
                $subir = $estructura . basename($_FILES["imagen1"]["name"]);
                $subir2 = $estructura . basename($_FILES["imagen2"]["name"]);
                $subir3 = $estructura . basename($_FILES["imagen3"]["name"]);
                $subir4 = $estructura . basename($_FILES["imagen4"]["name"]);

                $targetFile = $targetDir . basename($_FILES["imagen1"]["name"]);
                $targetFile2 = $targetDir . basename($_FILES["imagen2"]["name"]);
                $targetFile3 = $targetDir . basename($_FILES["imagen3"]["name"]);
                $targetFile4 = $targetDir . basename($_FILES["imagen4"]["name"]);

                // Mover la imagen al directorio de destino
                move_uploaded_file($_FILES["imagen1"]["tmp_name"], $targetFile);
                move_uploaded_file($_FILES["imagen2"]["tmp_name"], $targetFile2);
                move_uploaded_file($_FILES["imagen3"]["tmp_name"], $targetFile3);
                move_uploaded_file($_FILES["imagen4"]["tmp_name"], $targetFile4);

                // Almacenar la ruta del archivo en una variable
                $imagen1 = $subir;
                $imagen2 = $subir2;
                $imagen3 = $subir3;
                $imagen4 = $subir4;
            }

            // Actualizar los datos en la base de datos
            $sql_modificar = "UPDATE productos SET 
                        Marca='$marca', 
                        Nombre='$nombre', 
                        Categoria='$categoria', 
                        Encabezado='$encabezado', 
                        Descripcion='$descripcion', 
                        Existencia=$existencia, 
                        Precio=$precio, 
                        Imagen1='$imagen1', 
                        Imagen2='$imagen2', 
                        Imagen3='$imagen3', 
                        Imagen4='$imagen4', 
                        Descuento=$descuento 
                        WHERE id=$id_producto_modificar";
            $resultado_modificar = $conexion->query($sql_modificar);

            if ($resultado_modificar) {
                echo "<script>window.location.href = 'admin.php?tipo=cambios';</script>";
            }
        }
    }
?>