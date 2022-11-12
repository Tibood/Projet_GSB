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



if ($_SESSION['metier'] === 'Comptable' ) {
    $visiteurs = getLesVisiteurs($pdo2);
    $lesMois = $pdo->getLesMoisDisponibles($_SESSION['idVisiteur']);
    $lesCles = array_keys($lesMois);
    $moisASelectionner = $lesCles[0];
    include PATH_VIEWS . 'v_validerFicheFrais.php';
} else {
    Utilitaires::ajouterErreur("Vous n'êtes pas comptable");
    include PATH_VIEWS . 'v_erreurs.php';
}

