function actualizarProductos() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("ProductosTabla").innerHTML = this.responseText;
    }
    xhttp.open("GET", "productosCarrito.php");
    xhttp.send();
}

function quitarCarrito() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var respuesta = JSON.parse(this.responseText);
        document.getElementById("contadorProductos").innerHTML = respuesta.contadorProductos;
    }
    xhttp.open("POST", "carrito.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("tipo=quitar");
}

function eliminarProducto(idProductoEliminar) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("ProductosTabla").innerHTML = this.responseText;
        actualizarProductos();
        quitarCarrito();
    }
    xhttp.open("POST", "productosCarrito.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + idProductoEliminar);
}