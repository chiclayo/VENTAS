<?php
$id_venta = (empty($_GET['sale'])) ? null : $_GET['sale'];
if ($id_venta != null) {
    require_once '../../config.php';
    require_once '../../models/reporte.php';
    require '../models/Productos.php';
    
    $ventas = new Reporte();
    $datos = $ventas->getConfiguracion();
    $result = $ventas->getSale($id_venta);
    $products = $ventas->getProductsVenta($id_venta);
   
    require('../fpdf/fpdf.php');

if (!empty($_GET['sede'])) {
    $productos = new Productos();
    $data = $productos->getProducts($_GET['sede']);

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(190, 10, "Reporte de Productos por Sede", 0, 1, 'C');

    $pdf->SetFont('Arial', '', 10);
    foreach ($data as $row) {
        $pdf->Cell(50, 10, $row['nombre'], 1);
        $pdf->Cell(40, 10, $row['categoria'], 1);
        $pdf->Cell(30, 10, $row['stock'], 1);
        $pdf->Cell(30, 10, "S/. " . $row['precio'], 1, 1);
    }

    $pdf->Output();
   } else {
    echo 'PAGINA NO ENCONTRADA';
}
}