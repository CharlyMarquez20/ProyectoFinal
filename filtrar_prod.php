<head>
    <link rel="stylesheet" href="css/catalogo.css">
</head>
<?php

$servername = "127.0.0.1:33065";
$username = "root";
$password = "";
$database = "oasis";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener valores del formulario
    $minPrecio = $_POST["rango-min"];
    $maxPrecio = $_POST["rango-max"];
    
    $categoriaMujer = isset($_POST["categoria-mujer"]) ? 1 : 0;
    $categoriaHombre = isset($_POST["categoria-hombre"]) ? 1 : 0;
    
    $marcaNike = isset($_POST["marca-nike"]) ? 1 : 0;
    $marcaAdidas = isset($_POST["marca-adidas"]) ? 1 : 0;

    // Construir la consulta SQL
    $sql = "SELECT * FROM productos WHERE Precio BETWEEN $minPrecio AND $maxPrecio";

    if ($categoriaMujer || $categoriaHombre) {
        $sql .= " AND (";
        if ($categoriaMujer) $sql .= "Categoria = 'Mujer' OR ";
        if ($categoriaHombre) $sql .= "Categoria = 'Hombre' OR ";
        $sql = rtrim($sql, " OR "); // Eliminar el último "OR"
        $sql .= ")";
    }

    if ($marcaNike || $marcaAdidas) {
        $sql .= " AND (";
        if ($marcaNike) $sql .= "Marca = 'Nike' OR ";
        if ($marcaAdidas) $sql .= "Marca = 'Adidas' OR ";
        $sql = rtrim($sql, " OR "); // Eliminar el último "OR"
        $sql .= ")";
    }

    // Ejecutar la consulta
    $result = $conn->query($sql);

    // Almacenar resultados en una variable
    $htmlResultados = "";

    // Construir el HTML con los resultados
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
            $htmlResultados = '<div class="containerP " id="productos-container">';
                $htmlResultados .= '<div class="producto">';
                    $htmlResultados .= '<div class="img_contenedor">';
                            $htmlResultados .= '<img class="img_tenis" src="' . $row["Imagen"] . '" alt="">';
                            $htmlResultados .= '<div class="overlay">';
                                $htmlResultados .= '<div class="texto">' . $row["Descripcion"] . '</div>';
                            $htmlResultados .= '</div>';
                    $htmlResultados .= '</div>';
                    $htmlResultados .= '<h5 class="p-nombre">' . $row["Nombre"] . '</h5>';
                    $htmlResultados .= '<h6 class="p-precio">$' . $row["Precio"] . '</h6>';
                    $htmlResultados .= '<a href="detalles_prod.php?id_producto=' . $row["Id"] . '" class="buy-btn">Comprar</a>';
                $htmlResultados .= '</div>';
            $htmlResultados .= '</div>';
        }
    } else {
        $htmlResultados = "No se encontraron productos con los criterios seleccionados.";
    }

    // Imprimir los resultados
    // echo $htmlResultados;

    // Cerrar la conexión
    $conn->close();
}
?>
