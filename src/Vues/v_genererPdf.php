<?php

ob_start();

require('../vendor/fpdf184/fpdf.php');

$pdf = new FPDF('P', 'pt', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetFontSize(14);

//LOGO
$img = 'images/logo.jpg';
$img_size = getimagesize($img); // [0] = width [1] = Height
$pdf_xSize = $pdf->GetPageWidth();
$pdf_ySize = $pdf->GetPageHeight();
$xpos = $pdf_xSize / 2 - $img_size[0] / 2 * 0.75;
$pdf->Image($img, $xpos, 20);

//RECT_TITRE
$marge = 50;
$rect_size = $pdf_xSize - $marge * 2;
$pdf->Rect($marge, 200, $rect_size, 30);

//TITRE
$pdf->Text($marge + 10, 220, "REMBOURSEMENT DE FRAIS ENGAGES");

//RECT_CORPS
$pdf->Rect($marge, 230, $rect_size, 300);

//Presentation visiteur
$pdf->text($marge * 2, 230 + $marge,         "Visiteur          NRD/A-131           SEBASTIEN");

//Mois 
$pdf->Text($marge * 2, 230 + $marge * 1.5,   "Mois              Juillet 2022");

//Rect
$pdf->Rect($marge * 2,230 + $marge * 2.5,$rect_size - $marge * 2,20);

//Text -> Fait le ...
$pdf->SetFontSize(12);
$pdf->text($pdf_xSize - 200,$pdf_ySize - 150,"Fait le 22 novembre a Toulon");

//SIGNATURE
$signature = '../resources/signatureComptable.png';
$signature_size = getimagesize($signature); // [0] = width [1] = Height
$xpos_signature = $pdf_xSize - $signature_size[0] * 0.75;
$pdf->Image($signature, $xpos_signature - $marge, $pdf_ySize - $signature_size[1] * 0.75 - $marge);

$pdf->Output();

ob_end_flush();

