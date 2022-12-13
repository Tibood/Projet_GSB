<?php

/**
 * Vue Entête
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

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="UTF-8">
        <title>Intranet du Laboratoire Galaxy-Swiss Bourdin</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./styles/bootstrap/bootstrap.css" rel="stylesheet">
        <link href="./styles/style.css" rel="stylesheet">
<?php
if ($_SESSION['metier'] === 'Comptable'){
?>
        <link href="./styles/styleComptable.css" rel="stylesheet">
<?php
}
?>
    </head>
    <body>
        <div class="container">
            <?php

            // La variable 'uc' est 'GET' sur une page et filtre les caractères spéciaux (<, >, &, etc...)
            $uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($estConnecte) {
                ?>
            <div class="header">
                <div class="row vertical-align">
                    <div class="col-md-4">
                        <h1>
                            <img src="./images/logo.jpg" class="img-responsive"
                                alt="Laboratoire Galaxy-Swiss Bourdin"
                                title="Laboratoire Galaxy-Swiss Bourdin">
                        </h1>
                    </div>
                    <div class="col-md-8">
                        <ul class="nav nav-pills pull-right" role="tablist">
                            <?php
                            if ($_SESSION['metier'] === 'Comptable'){
                                ?>
                            <li <?php if (!$uc || $uc == 'accueil') { ?>class="active" <?php } ?>>
                                <a href="index.php">
                                    Accueil
                                </a>
                            </li>
                            <li <?php if ($uc == 'validerFicheFrais') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=validerFicheFrais&action=saisirInfo">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    Valider les fiches de frais
                                </a>
                            </li>
                            <li <?php if ($uc == 'suivrePaiementFicheFrais') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=suivrePaiementFiche&action=saisirInfo">
                                    <span class="glyphicon glyphicon-euro"></span>
                                    Suivre le paiement des fiches de frais
                                </a>
                            </li>
                            <li
                            <?php if ($uc == 'deconnexion') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=deconnexion&action=demandeDeconnexion">
                                    Déconnexion
                                </a>
                            </li>
                            <?php
                            } else {
                                ?>
                            <li <?php if (!$uc || $uc == 'accueil') { ?>class="active" <?php } ?>>
                                <a href="index.php">
                                    <span class="glyphicon glyphicon-home"></span>
                                    Accueil
                                </a>
                            </li>
                            <li <?php if ($uc == 'gererFrais') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=gererFrais&action=saisirFrais">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                    Renseigner la fiche de frais
                                </a>
                            </li>
                            <li <?php if ($uc == 'etatFrais') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=etatFrais&action=selectionnerMois">
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    Afficher mes fiches de frais
                                </a>
                            </li>
                            <li
                            <?php if ($uc == 'deconnexion') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=deconnexion&action=demandeDeconnexion">
                                    <span class="glyphicon glyphicon-log-out"></span>
                                    Déconnexion
                                </a>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
            } else {
                ?>
                <h1>
                    <img src="./images/logo.jpg"
                        class="img-responsive center-block"
                        alt="Laboratoire Galaxy-Swiss Bourdin"
                        title="Laboratoire Galaxy-Swiss Bourdin">
                </h1>
                <?php
            }
