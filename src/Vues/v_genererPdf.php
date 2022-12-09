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
$pdf->Text($marge + 10, 220, utf8_decode("REMBOURSEMENT DE FRAIS ENGAGÉS"));

//RECT_CORPS
$pdf->Rect($marge, 230, $rect_size, 500);

//Presentation visiteur
$pdf->text($marge * 2, 230 + $marge,         "Visiteur          NRD/A-131           SEBASTIEN");

//Mois 
$pdf->Text($marge * 2, 230 + $marge * 1.5,   "Mois              Juillet 2022");

//FRAIS FORFAIT

//RECUPERE INFOS VISITEUR
$info = $pdo->getLesFraisForfait($_SESSION["idVisiteur"],$_SESSION["date"]);
$info_ForfaitEtape = $info[0][2];
$info_ForfaitEtape_MontantUnitaire = 110;

$info_FraisKilometrique = $info[1][2];
$info_FraisKilometrique_MontantUnitaire = 0.62;

$info_NuiteeHotel = $info[2][2];
$info_NuiteeHotel_MontantUnitaire = 80;

$info_RepasRestaurant = $info[3][2];
$info_RepasRestaurant_MontantUnitaire = 25;

//Les fonctions
function CreateRow_Forfait ($txt,$xIndex,$yIndex) {
    global $pdf,$xSize;
    
    $ysize = 20;
    
    $xpos = calc_xpos($xIndex);
    $ypos = calc_ypos_Forfait($yIndex);
    
    $pdf->Rect($xpos, $ypos,$xSize,$ysize);   
    $pdf->Text($xpos + 5,$ypos + $ysize / 2 + 3,$txt );
}

$pourcentActuelUtilisé = 0;

function CreateRow_HorsForfait ($txt,$yIndex,$pourcentRect) {
    global $pdf,$rect_xSize,$pourcentActuelUtilisé;
    
    $ysize = 20;
    
    $xpos = calc_xpos(0)+ $pourcentActuelUtilisé * $rect_xSize / 100;
    $ypos = calc_ypos_HorsForfait($yIndex);
    
    $pourcentActuelUtilisé += $pourcentRect;
    
    $pdf->Rect($xpos, $ypos,$rect_xSize * $pourcentRect / 100,$ysize);   
    $pdf->Text($xpos + 5,$ypos + $ysize / 2 + 3,utf8_decode($txt) );
}

function calc_xpos (int $index) : float {
    global $marge, $xSize;
    
    return $marge * 1.5  + $xSize * $index;
}

function calc_ypos_Forfait (int $index) : float {
    global $marge,$ySize, $rect_yPos;
    
    return $rect_yPos + $marge * 2.5 + $ySize * $index + 20;
}

function calc_ypos_HorsForfait (int $index) : float {
    global $ySize,$yPos_HorsForfaitTitre;
    
    return $yPos_HorsForfaitTitre + $ySize * $index;
}

function CreateFraisForfaitaires ($titre,$indexY,$Quantite,$MontantUnitaire) {
    CreateRow_Forfait($titre,0,$indexY);
    CreateRow_Forfait($Quantite,1,$indexY);
    CreateRow_Forfait($MontantUnitaire,2,$indexY);
    CreateRow_Forfait($MontantUnitaire * $Quantite,3,$indexY);
}

function CreateFraisHorsForfais ($indexY,$Date,$Libelle,$Montant) {
    CreateRow_HorsForfait($Date,$indexY,20);
    CreateRow_HorsForfait($Libelle,$indexY,60);
    CreateRow_HorsForfait($Montant,$indexY,20);
}

//Rect
$rect_xSize = $rect_size - $marge * 1.5;

$rect_yPos = 200;

$nbValeurs= 4;

$xSize = $rect_xSize / $nbValeurs;

$ySize = 20;

$xMarge_Texte = 5;

//Element forfaitisé
$yPos_ForfaitTitre = $rect_yPos  + $marge * 2.5 + 13;

$pdf->Rect($marge * 1.5, $yPos_ForfaitTitre - 13,$rect_size - $marge * 1.5 ,20);
$pdf->SetFontSize(10);
$pdf->Text(calc_xpos(0) + $xMarge_Texte, $yPos_ForfaitTitre, "Les frais forfaitaires");
$pdf->Text(calc_xpos(1) + $xMarge_Texte, $yPos_ForfaitTitre, utf8_decode("Quantité"));
$pdf->Text(calc_xpos(2) + $xMarge_Texte, $yPos_ForfaitTitre, "Montant unitaire");
$pdf->Text(calc_xpos(3) + $xMarge_Texte, $yPos_ForfaitTitre, "Total");

$pdf->SetFontSize(10);

CreateFraisForfaitaires(utf8_decode("Forfait Étape"), 0,$info_ForfaitEtape,$info_ForfaitEtape_MontantUnitaire);

CreateFraisForfaitaires(utf8_decode("Frais Kilométrique"), 1,$info_FraisKilometrique,$info_FraisKilometrique_MontantUnitaire);

CreateFraisForfaitaires(utf8_decode("Nuitée Hôtel"), 2,$info_NuiteeHotel,$info_NuiteeHotel_MontantUnitaire);

CreateFraisForfaitaires("Repas Restaurant", 3,$info_RepasRestaurant,$info_RepasRestaurant_MontantUnitaire);

//Element hors Forfait

//Recup info hors Forfait
$info_horsForfait = $pdo->getLesFraisHorsForfait($_SESSION["idVisiteur"],$_SESSION["date"]);

$nbValeurs = 3;

$xSize = $rect_xSize / $nbValeurs;

$yPos_HorsForfaitTitre = $yPos_ForfaitTitre + 120;

$pdf->Rect($marge * 1.5, $yPos_HorsForfaitTitre - 20,$rect_size - $marge * 1.5 ,20);
$pdf->Text(calc_xpos(0) + $xMarge_Texte, $yPos_HorsForfaitTitre - 5, "Date");
$pdf->Text(calc_xpos(1) + $xMarge_Texte, $yPos_HorsForfaitTitre - 5, utf8_decode( "Libellé"));
$pdf->Text(calc_xpos(2) + $xMarge_Texte, $yPos_HorsForfaitTitre - 5, "Montant");

$yIndex = 0;

foreach ($info_horsForfait as $currentInfo) {
    CreateFraisHorsForfais($yIndex, date('d-m-Y'), $currentInfo[3], $currentInfo[5]);
    $yIndex++;
    $pourcentActuelUtilisé = 0;
}

//Text -> Fait le ... a Toulon
//setlocale(LC_TIME, "fr_FR");

$pdf->text($pdf_xSize - 200,$pdf_ySize - 150,"Fait le " .date('d'). " " .date('F') ." a Toulon");

//SIGNATURE
$signature = '../resources/signatureComptable.png';
$signature_size = getimagesize($signature); // [0] = width [1] = Height
$xpos_signature = $pdf_xSize - $signature_size[0] * 0.75;
$pdf->Image($signature, $xpos_signature - $marge, $pdf_ySize - $signature_size[1] * 0.75 - $marge);

$pdf->Output();

ob_end_flush();

