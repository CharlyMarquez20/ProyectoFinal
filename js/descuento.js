function verificarDescuento() {
    var descuento = document.getElementById("descuento").value;
    console.log(descuento);
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var respuesta = JSON.parse(this.responseText);
        document.getElementById("Total").innerHTML = respuesta.descuento;
        document.querySelector('input[name="descuentoAplicar"]').value = respuesta.valueCampo;
        document.querySelector('input[name="valorDescuento"]').value = respuesta.valorDescuento;
        if (respuesta.success) {
            Swal.fire({
                icon: "success",
                title: "Cupón aplicado"
            });
        } else {
            Swal.fire({
                icon: "error",
                title: "El cupón no existe"
            });
        }

        if (respuesta.desactivar) {
            document.querySelector('input[name="desactivar"]').disabled = true;
        } 
    }
    xhttp.open("POST", "verificarDescuento.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("descuento="+descuento);
}