<?php

/**
 * Vue suivre paiement des Fiche de Frais
 *
 * PHP Version 8
 *
 * @category  PPE
 * @package   GSB
 * @author    BROUILLET THIBAUD
 */
?>

<script src = "//code.jquery.com/jquery-1.12.0.min.js"></script>
<link href="styles/styleComptable.css" rel="stylesheet" type="text/css">

<!--SELECTION-->
<span class="badge badge-primary">Connecté sur le compte de <?php echo($_SESSION['prenom']." ". $_SESSION['nom'])?></span>
<br>
<br>

<div>
    <label for ='listFiche'>Choisir la Fiche Frais:</label>
    <select class="form-control" name="listFiche" id='listFiche' onchange="" >
    <option selected value="0">-- Sélectionner une fiche frais --</option>
        <?php
        foreach ($lesfichesfrrais as $uneFicheFrais) {
            $mois = $uneFicheFrais['mois'];
            $idvisiteur = $uneFicheFrais['idvisiteur'];
            $etat = $uneFicheFrais['idetat'];
            if($etat === 'VA' || $etat === 'CL'){
                ?>
                <option value="<?php echo $mois ?>">
                    <?php echo $mois . $etat ?>
                </option>
            <?php
            }
        }
        ?>
    </select>