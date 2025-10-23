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
require '../bin/gendatas/fonctions.php';

$pdo2 = new PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=gsb_frais', $_ENV['DB_USER'], $_ENV['DB_ROOT_PASSWORD']);
$pdo2->query('SET CHARACTER SET utf8');

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$visiteurFicheFrais = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$moisFicheFrais = filter_input(INPUT_POST, 'mois', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


if ($_SESSION['metier'] === 'Comptable' ) {
    switch ($action) {
        case 'saisirInfo':
            $visiteurs = getLesVisiteurs($pdo2);
            $lesfichesfrais = getLesFichesFrais($pdo2);
            include PATH_VIEWS . 'v_suivrePaiementFiche.php';
            break;
        case 'getInfo':
            $fichefrais = $pdo->getLesInfosFicheFrais($visiteurFicheFrais,$moisFicheFrais);
            $fraisForfait = $pdo->getLesFraisForfait($visiteurFicheFrais,$moisFicheFrais);
            $fraisHorsForfait = $pdo->getLesFraisHorsForfait($visiteurFicheFrais,$moisFicheFrais);
            echo json_encode(
                array(
                'fichefrais' => $fichefrais,
                'fraisForfait' => $fraisForfait,
                'fraisHorsForfait' => $fraisHorsForfait
                )
            );
            exit();
            break;
        case 'miseEnPaiement':
            $pdo->majEtatFicheFrais($visiteurFicheFrais,$moisFicheFrais,'RB');
            exit();
            break;
    }
} else {
    Utilitaires::ajouterErreur("Vous n'êtes pas comptable");
    include PATH_VIEWS . 'v_erreurs.php';
}
