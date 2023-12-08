function actualizarProductos() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("ProductosTabla").innerHTML = this.responseText;
    }
    xhttp.open("GET", "productosCarrito.php");
    xhttp.send();
}