<?php
    session_start();
    $servidor='localhost:33065';
    $cuenta='root';
    $password='';
    $bd='oasis';    
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);

    if ($conexion->connect_errno) {
        die('Error en la conexión: ' . $conexion->connect_error);
    }

    $carrito=array();
    $mensaje="";
    $total=0;
    $sql = "SELECT Id, IdProducto, Nombre, Precio, SUM(Cantidad) AS Cantidad FROM carrito WHERE Correo='$_SESSION[correo]' GROUP BY(IdProducto);";
    $resultado=$conexion->query($sql);
    if (mysqli_num_rows($resultado) > 0){
        while( $fila = mysqli_fetch_assoc($resultado)){
            $productoBase=array(
                "Id"=>"$fila[Id]",
                "Producto"=>"$fila[IdProducto]",
                "Nombre"=>"$fila[Nombre]",
                "Cantidad"=>"$fila[Cantidad]",
                "Precio"=>"$fila[Precio]"
            );
            array_push($carrito, $productoBase);
        }
    }

    $fecha = $_SESSION['pdf'][0];
    $direccion =$_SESSION['pdf'][1];
    $cp = $_SESSION['pdf'][2];
    $ciudad=$_SESSION['pdf'][3];
    $estado=$_SESSION['pdf'][4];
    $nombre = $_SESSION['pdf'][5];
    $telefono = $_SESSION['pdf'][6];
    $correo = $_SESSION['pdf'][7];

    $direccion=$direccion.". C.P. ".$cp.", ".$ciudad.", ".$estado;

    $subtotal = $_SESSION['pdf'][8];
    $costEnvio = $_SESSION['pdf'][9];
    $impuesto = $_SESSION['pdf'][10];
    $total = $_SESSION['pdf'][11];
    $metodo = $_SESSION['pdf'][12];

    require('fpdf/fpdf.php');


    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->Image('images/pdf/Marco.png', -5, -8, 220, 312);
    $pdf->Image('images/logo/Logo2.png', 31, 43, 30, 15);

    $pdf->setXY(26, 33);
    $pdf->SetFont('Arial','B', 30);
    $pdf->Multicell(100, 10, 'NOTA DE VENTA', 0, 'C', 0);

    $pdf->setXY(10, 45);
    $pdf->SetFont('Arial','B', 12);
    $pdf->Multicell(250, 10, 'Fecha:', 0, 'C', 0);
    $pdf->setXY(37, 45);
    $pdf->SetFont('Arial','I', 12);
    $pdf->Multicell(250, 10, $fecha, 0, 'C', 0);
    
    //Nombre
    $pdf->setXY(26, 65);
    $pdf->SetFont('Arial','B', 12);
    $pdf->Multicell(60, 10, 'Nombre del Cliente:', 0, 'C', 0);
    $pdf->setXY(80, 65);
    $pdf->SetFont('Arial','I', 12);
    $pdf->Multicell(60, 10, $nombre, 0, 'C', 0);

    //Email
    $pdf->setXY(12.5, 75);
    $pdf->SetFont('Arial','B', 12);
    $pdf->Multicell(60, 5, 'Email:', 0, 'C', 0);
    $pdf->setXY(80, 75);
    $pdf->SetFont('Arial','I', 12);
    $pdf->Multicell(73, 5, $correo, 0, 'C', 0);

    //Telefono
    $pdf->setXY(15.5, 83);
    $pdf->SetFont('Arial','B', 12);
    $pdf->Multicell(60, 5, 'Telefono:', 0, 'C', 0);
    $pdf->setXY(60, 83);
    $pdf->SetFont('Arial','I', 12);
    $pdf->Multicell(93, 5, $telefono, 0, 'C', 0);

    //Direccion
    $pdf->setXY(16.5, 89);
    $pdf->SetFont('Arial','B', 12);
    $pdf->Multicell(60, 8, 'Direccion:', 0, 'C', 0);
    $pdf->setXY(50, 89);
    $pdf->SetFont('Arial','I', 12);
    $pdf->Multicell(120, 8, $direccion, 0, 'C', 0);
    
    //Tabla
    $pdf->setXY(10, 100);
    $pdf->SetFont('Arial','B', 12);
    $pdf->Multicell(60, 8, 'No.', 0, 'C', 0);
    $pdf->setXY(40, 100);
    $pdf->SetFont('Arial','B', 12);
    $pdf->Multicell(60, 8, 'Cantidad', 0, 'C', 0);
    $pdf->setXY(80, 100);
    $pdf->SetFont('Arial','B', 12);
    $pdf->Multicell(60, 8, 'Descripcion', 0, 'C', 0);
    $pdf->setXY(130, 100);
    $pdf->SetFont('Arial','B', 12);
    $pdf->Multicell(60, 8, 'Precio', 0, 'C', 0);

    //Numeros
    $posNum=100;
    for ($i = 0; $i < count($carrito); $i++){
        $posNum+=10;
        $pdf->setXY(10, ($posNum));
        $pdf->SetFont('Arial','B', 12);
        $pdf->Multicell(60, 8, ($i+1), 0, 'C', 0);
    }

    //Cantidad
    $posCant=100;
    for ($i = 0; $i < count($carrito); $i++){
        $mostrarProducto = $carrito[$i];
        $posCant+=10;
        $pdf->setXY(40, ($posCant));
        $pdf->SetFont('Arial','I', 12);
        $pdf->Multicell(60, 8, $mostrarProducto["Cantidad"], 0, 'C', 0);
    }

    //Descripcion/Nombre
    $posNom=100;
    for ($i = 0; $i < count($carrito); $i++){
        $mostrarProducto = $carrito[$i];
        $posNom+=10;
        $pdf->setXY(80, ($posNom));
        $pdf->SetFont('Arial','I', 12);
        $pdf->Multicell(60, 8, $mostrarProducto["Nombre"], 0, 'C', 0);
    }

    //Precio
    $posPres=100;
    for ($i = 0; $i < count($carrito); $i++){
        $mostrarProducto = $carrito[$i];
        $posPres+=10;
        $pdf->setXY(135, ($posPres));
        $pdf->SetFont('Arial','I', 12);
        $pdf->Multicell(60, 8, $mostrarProducto["Precio"], 0, 'C', 0);
    }

    //SubTotal
    $pdf->setXY(110, ($posPres+10));
    $pdf->SetFont('Arial','B', 11);
    $pdf->Multicell(60, 8, 'Subtotal:', 0, 'C', 0);
    $pdf->setXY(123, ($posPres+10));
    $pdf->SetFont('Arial','I', 12);
    $pdf->Multicell(60, 8, '$', 0, 'C', 0);
    $pdf->setXY(130, ($posPres+10));
    $pdf->SetFont('Arial','I', 12);
    $pdf->Multicell(60, 8, $subtotal, 0, 'C', 0);

    //Impuesto
    $pdf->setXY(110, ($posPres+20));
    $pdf->SetFont('Arial','B', 12);
    $pdf->Multicell(60, 8, 'Impuesto:', 0, 'C', 0);
    $pdf->setXY(123, ($posPres+20));
    $pdf->SetFont('Arial','I', 12);
    $pdf->Multicell(60, 8, '$', 0, 'C', 0);
    $pdf->setXY(130, ($posPres+20));
    $pdf->SetFont('Arial','I', 12);
    $pdf->Multicell(60, 8, $impuesto, 0, 'C', 0);

    //Envio
    $pdf->setXY(110, ($posPres+30));
    $pdf->SetFont('Arial','B', 12);
    $pdf->Multicell(60, 8, 'Envio:', 0, 'C', 0);
    $pdf->setXY(123, ($posPres+30));
    $pdf->SetFont('Arial','I', 12);
    $pdf->Multicell(60, 8, '$', 0, 'C', 0);
    $pdf->setXY(130, ($posPres+30));
    $pdf->SetFont('Arial','I', 12);
    $pdf->Multicell(60, 8, $costEnvio, 0, 'C', 0);

    //Total a pagar
    $pdf->setXY(110, ($posPres+40));
    $pdf->SetFont('Arial','B', 12);
    $pdf->Multicell(60, 8, 'Total:', 0, 'C', 0);
    $pdf->setXY(123, ($posPres+40));
    $pdf->SetFont('Arial','I', 12);
    $pdf->Multicell(60, 8, '$', 0, 'C', 0);
    $pdf->setXY(130, ($posPres+40));
    $pdf->SetFont('Arial','I', 12);
    $pdf->Multicell(60, 8, $total, 0, 'C', 0);

    //Metodo de Pago
    $pdf->setXY(25, ($posPres+15));
    $pdf->SetFont('Arial','B', 12);
    $pdf->Multicell(60, 8, 'Metodo de Pago:', 0, 'C', 0);
    $pdf->setXY(25, ($posPres+25));
    $pdf->SetFont('Arial','I', 12);
    $pdf->Multicell(60, 8, $metodo, 0, 'C', 0);

    //Comentarios Finales
    $pdf->setXY(73, 230);
    $pdf->SetFont('Arial','B', 15);
    $pdf->Multicell(60, 8, 'OASIS', 0, 'C', 0);
    $pdf->setXY(30, 240);
    $pdf->SetFont('Arial','I', 12);
    $pdf->Multicell(150, 8, 'Encuentra tu paraiso en cada paso: Oasis, donde los tenis son tu escape.', 0, 'C', 0);

    
    $pdf->Output('D', 'Nota_Compra.pdf');
?>