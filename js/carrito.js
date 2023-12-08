function agregarCarrito(idProducto, NombreProducto, PrecioProducto) {
    Swal.fire({
        icon: "success",
        title: "Producto agregado al carrito"
    });
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("contadorProductos").innerHTML = this.responseText;
    }
    xhttp.open("POST", "carrito.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + idProducto+"&nombre="+NombreProducto+"&precio="+PrecioProducto);
}
