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

if ($_SESSION['metier'] === 'Comptable' ) {
    switch ($action) {
        case 'saisirInfo':
            $visiteurs = getLesVisiteurs($pdo2);
            include PATH_VIEWS . 'v_validerFicheFrais.php';
            break;
        case 'getMois':
            $idVisiteurSelectionner = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $lesMois = $pdo->getLesMoisDisponibles($idVisiteurSelectionner);
            echo "<option selected value=''> --Selectionner un mois-- </option>";
            foreach ($lesMois as $unMois) {
                $mois = $unMois['mois'];
                $numAnnee = $unMois['numAnnee'];
                $numMois = $unMois['numMois'];
                echo "<option value='$mois'> $numMois/$numAnnee </option>";
            };
            exit();
            break;
        case 'getInfo':
            $idVisiteurSelectionner = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $moisSelectionner = filter_input(INPUT_POST, 'mois', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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
            exit();
            break;
    }
} else {
    Utilitaires::ajouterErreur("Vous n'êtes pas comptable");
    include PATH_VIEWS . 'v_erreurs.php';
}


