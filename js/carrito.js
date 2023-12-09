function agregarCarrito(idProducto, NombreProducto, PrecioProducto) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var respuesta = JSON.parse(this.responseText);
        document.getElementById("contadorProductos").innerHTML = respuesta.contadorProductos;
        if (respuesta.success) {
            Swal.fire({
                icon: "success",
                title: "Producto agregado al carrito"
            });
        } else {
            Swal.fire({
                icon: "error",
                title: "Has llegado al límite de productos"
            });
        }
    }
    xhttp.open("POST", "carrito.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + idProducto+"&nombre="+NombreProducto+"&precio="+PrecioProducto+"&cantidad=1");
}

function agregarCarrito2(idProducto, NombreProducto, PrecioProducto) {
    var cantidad = document.getElementById('cantidad').value;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var respuesta = JSON.parse(this.responseText);
        document.getElementById("contadorProductos").innerHTML = respuesta.contadorProductos;
        if (respuesta.success) {
            Swal.fire({
                icon: "success",
                title: "Producto agregado al carrito"
            });
        } else {
            Swal.fire({
                icon: "error",
                title: "Has llegado al límite de productos"
            });
        }
    }
    xhttp.open("POST", "carrito.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + idProducto+"&nombre="+NombreProducto+"&precio="+PrecioProducto+"&cantidad="+cantidad);
}
