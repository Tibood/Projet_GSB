<?php

/**
 * Gestion de la déconnexion
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
    case 'demandeDeconnexion':
        if (Utilitaires::estConnecte()) {
            Utilitaires::deconnecter();
            include PATH_VIEWS . 'v_deconnexion.php';
        } else {
            Utilitaires::ajouterErreur("Vous n'êtes pas connecté");
            include PATH_VIEWS . 'v_erreurs.php';
            include PATH_VIEWS . 'v_connexion.php';
        }
        break;
    default:
        include PATH_VIEWS . 'v_connexion.php';
        break;
}
