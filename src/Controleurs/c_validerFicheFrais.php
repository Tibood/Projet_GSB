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
require '../bin/gendatas/fonctions.php';

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
            $moisDejaselectionner = filter_input(INPUT_POST, 'moisDejaSeclection', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            echo "<option selected value='0' disabled> -- Sélectionner un mois -- </option>";
            foreach ($lesMois as $unMois) {
                $mois = $unMois['mois'];
                $numAnnee = $unMois['numAnnee'];
                $numMois = $unMois['numMois'];
                if($moisDejaselectionner === $mois){
                    echo "<option selected value='$moisDejaselectionner'>$numMois/$numAnnee</option>";
                } else {
                    echo "<option value='$mois'> $numMois/$numAnnee </option>";
                }
            };
            exit();
            break;
        case 'getInfo':
            $fraisForfait = $pdo->getLesFraisForfait($idVisiteurSelectionner,$moisSelectionner);
            $fraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteurSelectionner,$moisSelectionner);
            $nbJustificatif = $pdo->getNbjustificatifs($idVisiteurSelectionner,$moisSelectionner);
            $fichefrais = $pdo->getLesInfosFicheFrais($idVisiteurSelectionner,$moisSelectionner);
            $reponse = array(
                'fichefraisetat' => $fichefrais['idEtat'],
                'fraisForfait' => $fraisForfait,
                'fraisHorsForfait' => $fraisHorsForfait,
                'nbJustificatif' => $nbJustificatif
            );
            echo json_encode($reponse);
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
        case 'reporterLeFraisHorsForfait':
            error_reporting(0);
            $lefrais = filter_input(INPUT_POST, 'lefrais', FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY);
            $moisSuivant = getMoisSuivant($moisSelectionner);
            $libelle = "REFUSE/" . $_POST['lefrais']['libelle'];
            if (!strlen($libelle) >= 100){
                $diff = strlen($libelle) -100 ;
                $libelle = substr($libelle,0,$diff);
            }
            $haveFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteurSelectionner,$moisSuivant);
            $reponse = [];
            if ($haveFicheFrais == false)
            {
                $pdo->creeNouvellesLignesFrais($idVisiteurSelectionner,$moisSuivant);
                array_push($reponse,'creation nouvelle fiche');
            }
            $pdo->creeNouveauFraisHorsForfait($idVisiteurSelectionner,$moisSuivant,$libelle,$lefrais['date'],$lefrais['montant']);
            $pdo->supprimerFraisHorsForfait($lefrais['idfrais']);
            array_push($reponse,$moisSuivant);
            echo (json_encode($reponse));
            exit();
            break;
        case 'corrigerFraisForfait':
            $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
            if(Utilitaires::lesQteFraisValides($lesFrais)) {
                foreach ($lesFrais as $key => $unFrais) {
                    $pdo->majFraisForfait($idVisiteurSelectionner,$moisSelectionner,$lesFrais);
                exit();
                }
            }
            echo ("Les valeurs des champs ne sont pas valides");
            exit();
            break;
        case 'corrigerFraisHorsForfait':
            error_reporting(0);
            $lefrais = filter_input(INPUT_POST, 'lefrais', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
            Utilitaires::valideInfosFrais($lefrais['date'],$_POST['lefrais']['libelle'],$lefrais['montant']);
            if (!$_REQUEST['erreurs']) {
                $pdo->majFraisHorsForfait($idVisiteurSelectionner,$moisSelectionner,$_POST['lefrais']['libelle'], Utilitaires::dateFrancaisVersAnglais($lefrais['date']),$lefrais['montant'],$lefrais['idfrais']);
                echo('{}');
                exit();
            }
            echo(json_encode($_REQUEST['erreurs']));
            exit();
            break;
        case 'validerFicheFrais':
            error_reporting(0);
            $nbJustificatif = filter_input(INPUT_POST, 'nbJustificatif', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $etat = $pdo->getLesInfosFicheFrais($idVisiteurSelectionner,$moisSelectionner);
            if($etat['idEtat']=== "CL"){
                $pdo->majNbJustificatifs($idVisiteurSelectionner,$moisSelectionner,$nbJustificatif);
                $pdo->majEtatFicheFrais($idVisiteurSelectionner,$moisSelectionner,'VA');
                echo("Fiche frait valider et mise en attente de payement");
                exit();
            }
            echo("La fiche a déjà été traiter");
            exit();
            break;
    }
} else {
    Utilitaires::ajouterErreur("Vous n'êtes pas comptable");
    include PATH_VIEWS . 'v_erreurs.php';
}


