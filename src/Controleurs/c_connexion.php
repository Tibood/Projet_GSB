g<?php

/**
 * Gestion de la connexion
 *
 * PHP Version 8
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */

use Outils\Utilitaires;

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (!$uc) {
    $uc = 'demandeconnexion';
}

switch ($action) {
    case 'demandeConnexion':
        include PATH_VIEWS . 'v_connexion.php';
        break;
    case 'valideConnexion':

        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($visiteur = $pdo->getInfosVisiteur($login)) {
            if (!password_verify($mdp, $pdo->getMdpVisiteur($login))) {
                Utilitaires::ajouterErreur('Login ou mot de passe incorrect');
                include PATH_VIEWS . 'v_erreurs.php';
                include PATH_VIEWS . 'v_connexion.php';
            } else {
            $id = $visiteur['id'];
            $nom = $visiteur['nom'];
            $prenom = $visiteur['prenom'];
            $_SESSION['metier'] = 'Visiteur';
            }
        } elseif ($comptable = $pdo->getInfosComptable($login)) {
            if (!password_verify($mdp, $pdo->getMdpComptable($login))) {
                Utilitaires::ajouterErreur('Login ou mot de passe incorrect');
                include PATH_VIEWS . 'v_erreurs.php';
                include PATH_VIEWS . 'v_connexion.php';
            } else {
            $id = $comptable['id'];
            $nom = $comptable['nom'];
            $prenom = $comptable['prenom'];
            $_SESSION['metier'] = 'Comptable';
            }
        }
        Utilitaires::connecter($id, $nom, $prenom);
        //$email = $visiteur['email'];
        $email = 'Verif.A2F.GSB.ATR@protonmail.com';
        $code = rand(1000, 9999);
        if ($_SESSION['metier'] === 'Comptable') {
            $pdo->setCodeA2fComptable($id,$code);
        } else {
            $pdo->setCodeA2f($id,$code);
        }
        Utilitaires::emailBuilder($email, $code);
        //mail($email, '[GSB-AppliFrais] Code de vérification', "Code : $code");
        include PATH_VIEWS . 'v_code2facteurs.php';
        break;
    case 'valideA2fConnexion':
        $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_NUMBER_INT);
        if ($_SESSION['metier'] === 'Comptable') {
            if ($pdo->getCodeComptable($_SESSION['idVisiteur']) !== $code) {
                Utilitaires::ajouterErreur('Code de vérification incorrect');
                include PATH_VIEWS . 'v_erreurs.php';
                include PATH_VIEWS . 'v_code2facteurs.php';
            } else {
                Utilitaires::connecterA2f($code);
                header('Location: index.php');
            };
        }
        if ($_SESSION['metier'] === 'Visiteur') {
            if($pdo->getCodeVisiteur($_SESSION['idVisiteur']) !== $code) {
                Utilitaires::ajouterErreur('Code de vérification incorrect');
                include PATH_VIEWS . 'v_erreurs.php';
                include PATH_VIEWS . 'v_code2facteurs.php';
            } else {
                Utilitaires::connecterA2f($code);
                header('Location: index.php');
            }
        }
        break;
    default:
        include PATH_VIEWS . 'v_connexion.php';
        break;
}
