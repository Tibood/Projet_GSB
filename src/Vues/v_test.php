<?php

require('../vendor/fpdf184/fpdf.php');

class v_test extends FPDF {



}

// Instanciation of inherited class
$pdf = new v_test();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
for ($i = 1; $i <= 40; $i++) {
    $pdf->Cell(0, 10, 'Printing line number ' . $i, 0, 1);
}
$pdf->Output();
