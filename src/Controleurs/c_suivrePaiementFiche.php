<?php
/**
 * Gestion de l'affichage et du Suivis de payement des fiches de frais
 *
 * PHP Version 8
 *
 * @category  PPE
 * @package   GSB
 * @author    BROUILLET THIBAUD
 */
use Outils\Utilitaires;
require '..\bin\gendatas\fonctions.php';

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($_SESSION['metier'] === 'Comptable' ) {
    switch ($action) {
        case 'saisirInfo':
            $visiteurs = getLesVisiteurs($pdo);
            include PATH_VIEWS . 'v_suivrePaiementFiche.php';
            break;
        case 'getInfo':
            $fichefrais = $pdo->getLesInfosFicheFrais($idVisiteurSelectionner,$moisSelectionner);
            echo json_encode($fichefrais);
            exit();
            break;
        case 'miseEnPaiement':
            exit();
            break;
    }
} else {
    Utilitaires::ajouterErreur("Vous n'êtes pas comptable");
    include PATH_VIEWS . 'v_erreurs.php';
}
