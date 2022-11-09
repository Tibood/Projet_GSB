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


if ($_SESSION['metier'] === 'Comptable' ) {
    include PATH_VIEWS . 'v_validerFicheFrais.php';
} else {
    Utilitaires::ajouterErreur("Vous n'êtes pas comptable");
    include PATH_VIEWS . 'v_erreurs.php';
}

