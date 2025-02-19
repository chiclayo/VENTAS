<?php
$id_venta = (empty($_GET['sale'])) ? null : $_GET['sale'];
if ($id_venta != null) {
    require_once '../../config.php';
    require_once '../../models/reporte.php';
    $ventas = new Reporte();
    $datos = $ventas->getConfiguracion();
    $result = $ventas->getSale($id_venta);
    $products = $ventas->getProductsVenta($id_venta);
    date_default_timezone_set('America/Lima'); 

    require('../fpdf/fpdf.php');

    $pdf = new FPDF('P', 'mm', array(100, 200));
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(80, 10, $datos['nombre'], 0, 'C');
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(80, 5, mb_convert_encoding('Ruc: ' . $datos['ruc'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
    $pdf->Cell(80, 5, mb_convert_encoding('Direcion: ' . $datos['direccion'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
    $pdf->Cell(80, 5, utf8_decode('Fecha: ' . $result['fecha'] . ' - Hora: ' . date('H:i:s')), 0, 1, 'C');
    $pdf->Cell(80, 5, utf8_decode('Forma Pago: ' . $result['metodo']), 0, 1, 'C');
    $pdf->Cell(80, 5, utf8_decode('Ticket: ' . $result['correlativo']), 0, 1, 'C');
    $pdf->Cell(80, 5, '-------------------------------------------------------------------------', 0, 1, 'C');
    //########## Datos del cliente
    $pdf->Cell(80, 5, utf8_decode('Nombre: ' . $result['nombre']), 0, 1, 'L');
    $pdf->Cell(80, 5, utf8_decode('Dni/Ruc: ' . $result['tipo_documento']), 0, 1, 'L');
    $pdf->Cell(80, 5, utf8_decode('Dirección: ' . $result['direccion']), 0, 1, 'L');


    $pdf->Cell(80, 5, '--------------------------------------------------------------------------', 0, 1, 'C');

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(30, 5, utf8_decode('Cant - Precio: '), 0, 0, 'L');
    $pdf->Cell(40, 5, utf8_decode('Producto: '), 0, 1, 'C');
    $pdf->SetFont('Arial', '', 11);
    $total = 0;
    foreach ($products as $product) {
        $total += $product['cantidad'] * $product['precio'];
        $pdf->Cell(30, 5, $product['cantidad'] . ' x ' . $product['precio'], 0, 0, 'C');
        $pdf->MultiCell(40, 5, $product['nombre'], 0, 'C');
        $pdf->Cell(80, 5, number_format($product['cantidad'] * $product['precio'], 2), 0, 1, 'R');
    }
        $pdf->Cell(80, 5, '----------------------------------------------------------------------', 0, 1, 'C');

    if($result['metodo'] === 'DONACION') {
        $donacion = $total;
        $subtotal = $total;
        $total = 0.00;
    } else {
        $subtotal = $total;
        $donacion = 0.00;
        $total = $total;
    }

    $pdf->Cell(80, 5, 'Sub Total: ' . number_format($subtotal, 2), 0, 1, 'R');
    $pdf->Cell(80, 5, 'Donacion: ' . number_format($donacion, 2), 0, 1, 'R');
    $pdf->Cell(80, 5, 'Total: ' . number_format($total, 2), 0, 1, 'R');
    $pdf->Cell(80, 5, 'Usuario: ' . $result['user'], 0, 1, 'L');
    $pdf->Ln(2);
 

    $pdf->Output();
} else {
    echo 'PAGINA NO ENCONTRADA';
}
