<?php
require('fpdf/fpdf.php');
$pdf = new FPDF('P', 'mm', 'A4');
session_start();

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../imagenes/logo.jpg', 10, 8, 33);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 18);
        // Movernos a la derecha
        $this->Cell(60);
        // Título
        $this->Cell(60, 10, 'Factura Figure BioSpa', 0, 1, 'C');
        // Salto de línea
        $this->Ln(20);
        
    }

    // Pie de página
    function Footer()
    {   $this->SetY(-20);
        // Posición: a 1,5 cm del final
       
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
$x = 10;
date_default_timezone_set('America/Mexico_City');
$fechaHora = Date("F_j_Y");
$NombreArchivo = $_SESSION['usuario'].$fechaHora."_pedido.json";
$Total = 0;
$TotalF = 0;
$IvaTotal = 0;
if (file_exists($NombreArchivo)) {
    $archivo = file_get_contents($NombreArchivo);
    $productos = json_decode($archivo);
    $pdf->SetY(50);
    $pdf->Cell(60, 6, 'Producto', 1, 0);
    $pdf->Cell(40, 6, 'Precio Unitario', 1, 0);
    $pdf->Cell(25, 6, 'Cantidad', 1, 0);
    $pdf->Cell(25, 6, 'Subtotal', 1, 1);
    foreach ($productos as $producto) {
        $pdf->Cell(60, 6, '' . $producto->{'nombre'} . '', 1, 0);
        $pdf->Cell(40, 6, '' . $producto->{'precio'} . '', 1, 0, 'c');
        $pdf->Cell(25, 6, $producto->{'cantidad'}, 1, 0, 'c');
        $pdf->Cell(25, 6, $producto->{'subTotal'}, 1, 1, 'c');

        $Total = $Total + $producto->{'subTotal'};
    }
    $TotalF = $Total + $IvaTotal;
    $pdf->SetXY(105, 170);
    $pdf->SetXY(105, 175);
    $pdf->Cell(40, 5, 'SubTotal', 1, 0, 'c');
    $pdf->Cell(40, 5, $Total, 1, 1, 'c');
    $pdf->SetXY(105, 180);
    $pdf->Cell(40, 5, 'Total a pagar', 1, 0, 'c');
    $pdf->Cell(40, 5, $TotalF, 1, 1, 'c');

    $pdf->SetXY(25,40);
    $pdf->Cell(60,5,'Eric Arana Martinez 22310401');
    $pdf->SetXY(25,42);
    $num = rand(0, 32000);
    $pdf->Cell(60, 7, "Num de Factura: " . $num, "", 0, "L");
    $Date = date('d-m-Y', time());
    $hora = date('h:i a', time());
    $pdf->Cell(60, 7, "Fecha: " . $Date, "", 0, "L");
    $pdf->SetDrawColor(255, 255, 255);
    $pdf->SetTextColor(0, 0, 0);
    
    
   
    $pdf->SetXY($x+10,205);
    $pdf->Image('../imagenes/codigo.png',70,215,80,0,'PNG','');
   
}

$pdf->Output('F','pdf/factura.pdf');
if (file_exists($NombreArchivo)) {
require 'mail.php';
unlink($NombreArchivo);
echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=../index.php">';
echo "<script> alert ('Correo Enviado con Exito'); window.location='../index.php'</script>";
}else {
    echo "El archivo $archivo no existe.";
}

?>
