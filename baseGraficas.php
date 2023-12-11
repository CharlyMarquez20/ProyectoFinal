<?php
    // Conexión a la BD
    $servidor='localhost:33065';
    $cuenta='root';
    $password='';
    $bd='oasis';
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);
    if ($conexion->connect_errno){
        die('Error en la conexion');
    }
// Consulta para obtener los datos de tu base de datos
$sql = "SELECT * FROM productos";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    // Arreglo para almacenar los datos
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    // Convertir los datos a formato JSON (puedes elegir otro formato si lo prefieres)
    $json_data = json_encode($data, JSON_PRETTY_PRINT);
    // Nombre del archivo a generar
    $archivo = 'datos.json';
    // Escribir los datos en el archivo
    if (file_put_contents($archivo, $json_data)) {
        //echo "Datos guardados en $archivo";
    } else {
        //echo "Error al guardar los datos en el archivo.";
    }
} else {
    //echo "No se encontraron datos en la base de datos.";
}
// Cerrar la conexión a la base de datos
//$conexion->close();
?>
