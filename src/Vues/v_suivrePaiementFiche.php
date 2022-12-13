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
<script src = "assets/js/SuivrePaiement.js"></script>
<script src = "//code.jquery.com/jquery-1.12.0.min.js"></script>
<link href="styles/styleComptable.css" rel="stylesheet" type="text/css">

<!--SELECTION-->
<br>
<br>

<div>
    <label for ='listFiche'>Choisir la Fiche Frais:</label>
    <select class="form-control" name="listFiche" id='listFiche' onchange="getInfo()" >
    <option selected value="0">-- Sélectionner une fiche frais --</option>
        <?php
        foreach ($lesfichesfrrais as $uneFicheFrais) {
            $mois = $uneFicheFrais['mois'];
            $idvisiteur = $uneFicheFrais['idvisiteur'];
            $etat = $uneFicheFrais['idetat'];
            if($etat === 'VA'){
                ?>
                <option value="<?php echo $mois ?>">
                    <?php echo $mois .' '. $etat .' '. $idvisiteur?>
                </option>
            <?php
            }
        }
        ?>
    </select>
</div>
    <input type="button" value="Valider" class="btn btn-success" onclick="" ></input>
