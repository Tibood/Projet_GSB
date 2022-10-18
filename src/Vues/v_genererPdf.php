<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of v_genererPdf
 *
 * @author rayane.bosso
 */

require('../vendor/fpdf184/fpdf.php');

$pdf = new FPDF('P','pt','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

//LOGO
$img = 'images/logo.jpg';
$img_size = getimagesize($img); // [0] = width [1] = Height
$pdf_xSize =$pdf->GetPageWidth();
$xpos = $pdf_xSize / 2 - $img_size[0] / 2 * 0.75;
$pdf->Image($img,$xpos ,20);

//RECT_TITRE
$marge = 50;
$rect_size = $pdf_xSize - $marge * 2;
$pdf ->Rect($marge, 200, $rect_size, 30);

//TITRE
$pdf ->Text($marge + 10, 220, "REMBOURSEMENT DE FRAIS ENGAGES");

//RECT_CORPS
$pdf -> Rect($marge,230,$rect_size,300);

//Presentation visiteur
$pdf -> text($marge * 2,230 + $marge,"Visiteur          NRD/A-131           Louis VILLECHALANE");

$pdf->Output();

