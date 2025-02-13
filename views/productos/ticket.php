<?php
// Verifica si el parámetro idsede está presente en la URL
$id_sede = isset($_GET['idsede']) ? $_GET['idsede'] : null;

if ($id_sede !== null) {
    require_once '../../config.php';
    require_once '../../models/reporte.php';
    require('../fpdf/fpdf.php');

    // Instancia del modelo de productos
    $productos = new Reporte();
    $data = $productos->getProducts($id_sede); // Aquí usamos el parámetro correcto

    // Verifica si hay datos
    if (!$data) {
        die("NO HAY PRODUCTOS EN ESTA SEDE.");
    }

    // Creación del PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(190, 10, "Reporte de Productos por Sede", 0, 1, 'C');
    $pdf->Ln(5); // Salto de línea

    // Encabezado de la tabla
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(50, 10, "Categoria", 1, 0, 'C');
    $pdf->Cell(30, 10, "Producto", 1, 0, 'C');
    $pdf->Cell(60, 10, "Descripcion", 1, 0, 'C');
    $pdf->Cell(20, 10, "Stock", 1, 0, 'C');
    $pdf->Cell(30, 10, "Precio", 1, 1, 'C');
    $pdf->SetFont('Arial', '', 10);

    // Llenado de la tabla con datos
    foreach ($data as $row) {
        $pdf->Cell(50, 10, utf8_decode($row['nameCategoria']), 1);
        $pdf->Cell(30, 10, utf8_decode($row['nombre']), 1);
        $pdf->Cell(60, 10, utf8_decode($row['descripcion']), 1);
        $pdf->Cell(20, 10, $row['stock_total'], 1, 0, 'C');
        $pdf->Cell(30, 10, "S/. " . number_format($row['precio'], 2), 1, 1, 'C');
    }

    $pdf->Output();
} else {
    echo "PÁGINA NO ENCONTRADA";
}
?>