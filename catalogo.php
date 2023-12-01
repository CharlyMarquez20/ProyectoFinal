<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/catalogo.css">
    <link rel="stylesheet" href="css/general.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Tienda</title>
</head>
<body>
    <?php
    require "encabezado.php";
    ?>

    <section class="catalogo">
        <div class="filtro-container">
            <label for="categoria">Ordenar por:</label>
            <select id="categoria" name="categoria">
                <option value="todos">Todos</option>
                <option value="hombre">Hombre</option>
                <option value="mujer">Mujer</option>
            </select>
        </div>
        <div class="containerP " id="productos-container">
            <div class="producto" data-categoria="mujer">
                <div class="img_contenedor">
                    <img class="img_tenis" src="images/productos/Mujer/mujer1/blazer2.jpg" alt="">
                
                <div class="overlay">
                    <div class="texto">Elegancia atemporal para un estilo versátil y sofisticado.</div>
                </div>
                </div>
                <h5 class="p-nombre">Nike Blazer Mid'77</h5>
                <h6 class="p-precio">$1,800.00</h6>
                <button class="buy-btn">Comprar</button>
            </div>
            <div class="producto ">
                <div class="img_contenedor">
                    <img class="img_tenis" src="images/productos/Mujer/mujer2/dunk4.jpg" alt="">
                
                <div class="overlay">
                    <div class="texto">Estilo urbano vibrante con diseño moderno y llamativo.</div>
                </div>
                </div>
                <h5 class="p-nombre">Dunk Low</h5>
                <h6 class="p-precio">$1,800.00</h6>
                <button class="buy-btn">Comprar</button>
            </div>
            <div class="producto ">
                <div class="img_contenedor">
                    <img class="img_tenis" src="images/productos/Mujer/mujer3/dunklow3.jpg" alt="">
                
                    <div class="overlay">
                        <div class="texto">Variantes exclusivas con detalles únicos y ediciones limitadas.</div>
                    </div>
                </div>
                <h5 class="p-nombre">Dunk Low SE</h5>
                <div id="detalles">
                    <h6 class="p-precio">$1,800.00</h6>
                    <h6 class="p-descuento">$2,100.00</h6>
                </div>
                <button class="buy-btn">Comprar</button>
            </div>
            <div class="producto ">
                <div class="img_contenedor">
                    <img class="img_tenis" src="images/productos/Mujer/mujer4/duramo1.jpg" alt="">
                
                    <div class="overlay">
                        <div class="texto">Tenis deportivos para rendimiento, comodidad y soporte óptimo.</div>
                    </div>
                </div>
                <h5 class="p-nombre">Duramo RC</h5>
                <p></p>
                <h6 class="p-precio">$1,800.00</h6>
                <button class="buy-btn">Comprar</button>
            </div>
            <div class="producto ">
                <div class="img_contenedor">
                    <img class="img_tenis" src="images/productos/Mujer/mujer5/forum1.jpg" alt="">
                
                    <div class="overlay">
                        <div class="texto">Clásicos del baloncesto que fusionan estilo retro y funcionalidad.</div>
                    </div>
                </div>
                <h5 class="p-nombre">Forum</h5>
                <h6 class="p-precio">$1,800.00</h6>
                <button class="buy-btn">Comprar</button>
            </div>
            <div class="producto">
                <div class="img_contenedor">
                    <img class="img_tenis" src="images/productos/Mujer/mujer6/cort3.jpg" alt="">
                
                    <div class="overlay">
                        <div class="texto">Elegancia inspirada en la cancha para un estilo casual.</div>
                    </div>
                </div>
                <h5 class="p-nombre">Nike Court</h5>
                
                <h6 class="p-precio">$1,800.00</h6>
                <button class="buy-btn">Comprar</button>
            </div>
            <div class="producto ">
                <div class="img_contenedor">
                    <img class="img_tenis" src="images/productos/Mujer/mujer7/questar1.jpg" alt="">
                
                    <div class="overlay">
                        <div class="texto">Diseño contemporáneo que combina moda y funcionalidad diaria.</div>
                    </div>
                </div>
                <h5 class="p-nombre">Questar</h5>
                <h6 class="p-precio">$1,800.00</h6>
                <button class="buy-btn">Comprar</button>
            </div>
            <div class="producto ">
                <div class="img_contenedor">
                    <img class="img_tenis" src="images/productos/Mujer/mujer8/run1.jpg" alt="">
                
                    <div class="overlay">
                        <div class="texto">Estilo avanzado y tecnología para un rendimiento excepcional en running.</div>
                    </div>
                </div>
                <h5 class="p-nombre">Running Tracefinder</h5>
                <div id="detalles">
                    <h6 class="p-precio">$1,800.00</h6>
                    <h6 class="p-descuento">$2,100.00</h6>
                </div>
                <button class="buy-btn">Comprar</button>
            </div>
            <div class="producto ">
                <div class="img_contenedor">
                    <img class="img_tenis" src="images/productos/Mujer/mujer9/ultra1.jpg" alt="">
                
                    <div class="overlay">
                        <div class="texto">Comodidad y amortiguación para actividades diarias con ajuste acolchado.</div>
                    </div>
                </div>
                <h5 class="p-nombre">Ultrabounce</h5>
                <h6 class="p-precio">$1,800.00</h6>
                <button class="buy-btn">Comprar</button>
            </div>
            <div class="producto ">
                <div class="img_contenedor">
                    <img class="img_tenis" src="images/productos/Hombre/hombre1/sandalia1.jpg" alt="">
                
                    <div class="overlay">
                        <div class="texto">Chanclas icónicas, cómodas y versátiles, perfectas para el verano.</div>
                    </div>
                </div>
                <h5 class="p-nombre">Adilette</h5>
                <div id="detalles">
                    <h6 class="p-precio">$1,800.00</h6>
                    <h6 class="p-descuento">$2,100.00</h6>
                </div>
                <button class="buy-btn">Comprar</button>
            </div>
            <div class="producto ">
                <div class="img_contenedor">
                    <img class="img_tenis" src="images/productos/Hombre/hombre2/airforce3.jpg" alt="">
                
                    <div class="overlay">
                        <div class="texto">Clásicos de baloncesto con estilo urbano y detalles modernos</div>
                    </div>
                </div>
                <h5 class="p-nombre">Air Force 1 High</h5>
                <h6 class="p-precio">$1,800.00</h6>
                <button class="buy-btn">Comprar</button>
            </div>
            <div class="producto ">
                <div class="img_contenedor">
                    <img class="img_tenis" src="images/productos/Hombre/hombre3/blanco4.jpg" alt="">
                
                    <div class="overlay">
                        <div class="texto">Clásicos blancos con suela Air, atemporales y cómodos.</div>
                    </div>
                </div>
                <h5 class="p-nombre">Air Force 1</h5>
                <h6 class="p-precio">$1,560.00</h6>
                <button class="buy-btn">Comprar</button>
            </div>
            <div class="producto ">
                <div class="img_contenedor">
                    <img class="img_tenis" src="images/productos/Hombre/hombre4/avryn1.jpg" alt="">
                
                    <div class="overlay">
                        <div class="texto"></div>
                    </div>
                </div>
                <h5 class="p-nombre">Avryn</h5>
                <h6 class="p-precio">$1,800.00</h6>
                <button class="buy-btn">Comprar</button>
            </div>
            <div class="producto ">
                <div class="img_contenedor">
                    <img class="img_tenis" src="images/productos/Hombre/hombre5/torino1.jpg" alt="">
                
                    <div class="overlay">
                        <div class="texto">Estilo retro inspirado en canchas de tenis clásicas.</div>
                    </div>
                </div>
                <h5 class="p-nombre">Court Tourino</h5>
                <div id="detalles">
                    <h6 class="p-precio">$1,800.00</h6>
                    <h6 class="p-descuento">$2,100.00</h6>
                </div>
                <button class="buy-btn">Comprar</button>
            </div>
            <div class="producto ">
                <div class="img_contenedor">
                    <img class="img_tenis" src="images/productos/Hombre/hombre6/duramo1.jpg" alt="">
                
                    <div class="overlay">
                        <div class="texto">Enfoque en rendimiento, ideales para correr y entrenar.</div>
                    </div>
                </div>
                <h5 class="p-nombre">Duramo RC</h5>
                <h6 class="p-precio">$1,800.00</h6>
                <button class="buy-btn">Comprar</button>
            </div>
            <div class="producto">
                <div class="img_contenedor">
                    <img class="img_tenis" src="images/productos/Hombre/hombre7/run2.jpg" alt="">
                
                    <div class="overlay">
                        <div class="texto">Diseñados para correr, con amortiguación y soporte adecuados.</div>
                    </div>
                </div>
                <h5 class="p-nombre">Quest 5</h5>
                <h6 class="p-precio">$1,800.00</h6>
                <button class="buy-btn">Comprar</button>
            </div>
            <div class="producto ">
                <div class="img_contenedor">
                    <img class="img_tenis" src="images/productos/Hombre/hombre8/response1.jpg" alt="">
                
                    <div class="overlay">
                        <div class="texto">Combinan estilo y funcionalidad, ideales para actividades deportivas.</div>
                    </div>
                </div>
                <h5 class="p-nombre">Response CL</h5>
                <div id="detalles">
                    <h6 class="p-precio">$1,800.00</h6>
                    <h6 class="p-descuento">$2,100.00</h6>
                </div>
                <button class="buy-btn">Comprar</button>
            </div>
            <div class="producto " data-categoria="hombre">
                <div class="img_contenedor">
                    <img class="img_tenis" src="images/productos/Hombre/hombre9/stan1.jpg" alt="">
                
                    <div class="overlay">
                        <div class="texto">Clásicos del tenis, diseño simple y elegante, versatilidad inigualable.</div>
                    </div>
                </div>
                <h5 class="p-nombre">Stan Smith</h5>
                <h6 class="p-precio">$1,800.00</h6>
                <button class="buy-btn">Comprar</button>
            </div>
        </div>
    </section>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>