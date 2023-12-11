<?php
    include("baseGraficas.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualización de datos con ChartJS</title>
    
    <link rel="stylesheet" href="css/grafica.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <main>
        <div id="grafica">
            <h1>Oasis</h1>
            <p>Visualización de estadísticas de productos</p>
            <hr>
            <section class="cols-2">
                <figure>
                    <h2>Comparativa de marcas</h2>
                    <canvas id="modelsChart"></canvas>
                </figure>
                <figure>
                    <h2>Comparativa de Categorias:</h2>
                    <canvas id="featuresChart"></canvas>
                </figure>
                <figure>
                    <h2>Precios por marca</h2>
                    <canvas id="yearsChart" ></canvas>
                </figure>
            </section>
        </div>
    </main>
    <script src="js/helpers.js"></script>
    <script src="js/handlers.js"></script>
    <script src="js/app.js"></script>
</body>

</html>