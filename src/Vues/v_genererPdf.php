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

$pdf->Output();

