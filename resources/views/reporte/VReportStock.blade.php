<?php
$pdf->AddPage();
$pdf->SetFillColor(228, 228, 228);
$pdf->SetLeftMargin(30);

$pdf->Image('img/logo.png', 20, 5, 30, 30);
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 20);
$pdf->cell(0, 20, "REPORTE DE STOCK", 0, 1, 'C', FALSE);

$pdf->SetFont('Arial', '', 10);
$pdf->cell(20, 10, "Nro", 1, 0, 'C', TRUE);
$pdf->cell(100, 10, "NOMBRE", 1, 0, 'C', TRUE);
$pdf->cell(30, 10, "STOCK", 1, 1, 'C', TRUE);
$c = 1;
foreach ($articulos as $a) {
    $pdf->cell(20, 10, '  ' . $c, 1, 0, 'C');
    $pdf->cell(100, 10, '  ' . $a->nombre, 1, 0, 'L');
    $pdf->cell(30, 10, $a->stock, 1, 1, 'C');
    $c++;
}

$pdf->Output();
exit;
