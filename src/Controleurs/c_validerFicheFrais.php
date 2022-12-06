<?php
/**
 * Gestion de l'affichage et de la validations des fiches de frais
 *
 * PHP Version 8
 *
 * @category  PPE
 * @package   GSB
 * @author    BROUILLET THIBAUD
 */
use Outils\Utilitaires;
require '..\bin\gendatas\fonctions.php';

$pdo2 = new PDO('mysql:host=localhost;dbname=gsb_frais', 'userGsb', 'secret');
$pdo2->query('SET CHARACTER SET utf8');

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$idVisiteurSelectionner = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$moisSelectionner = filter_input(INPUT_POST, 'mois', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($_SESSION['metier'] === 'Comptable' ) {
    switch ($action) {
        case 'saisirInfo':
            $visiteurs = getLesVisiteurs($pdo2);
            include PATH_VIEWS . 'v_validerFicheFrais.php';
            break;
        case 'getMois':
            $lesMois = $pdo->getLesMoisDisponibles($idVisiteurSelectionner);
            echo "<option selected value='0'> -- Sélectionner un mois -- </option>";
            foreach ($lesMois as $unMois) {
                $mois = $unMois['mois'];
                $numAnnee = $unMois['numAnnee'];
                $numMois = $unMois['numMois'];
                echo "<option value='$mois'> $numMois/$numAnnee </option>";
            };
            exit();
            break;
        case 'getFraisForfait':
            $fraisForfait = $pdo->getLesFraisForfait($idVisiteurSelectionner,$moisSelectionner);
            echo json_encode($fraisForfait);
            exit();
            break;
        case 'getFraisHorsForfait':
            $fraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteurSelectionner,$moisSelectionner);
            echo json_encode($fraisHorsForfait);
            exit();
            break;
        case 'getNbJustificatif':
            $nbJustificatif = $pdo->getNbjustificatifs($idVisiteurSelectionner,$moisSelectionner);
            echo $nbJustificatif;
            exit();
            break;
        case 'getInfo':
            $fraisForfait = $pdo->getLesFraisForfait($idVisiteurSelectionner,$moisSelectionner);
            $fraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteurSelectionner,$moisSelectionner);
            $nbJustificatif = $pdo->getNbjustificatifs($idVisiteurSelectionner,$moisSelectionner);
            $reponse = array(
                'fraisForfait' => $fraisForfait,
                'fraisHorsForfait' => $fraisHorsForfait,
                'nbJustificatif' => $nbJustificatif
            );
            echo json_encode($reponse);
            exit();
            break;
        case 'corrigerFraisForfait':
            $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
            //$pdo->majFraisForfait($idVisiteurSelectionner,$moisSelectionner,$lesFrais);
            exit();
            break;
        case 'corrigerFraisHorsForfait':
            exit();
            break;
        case 'corrigerNbJustificatif':
            $nbJustificatif = filter_input(INPUT_POST, 'nbJustificatif', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pdo->majNbJustificatifs($idVisiteurSelectionner,$moisSelectionner,$nbJustificatif);
            exit();
            break;
    }
} else {
    Utilitaires::ajouterErreur("Vous n'êtes pas comptable");
    include PATH_VIEWS . 'v_erreurs.php';
}


