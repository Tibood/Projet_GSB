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
    <option selected value="0" disabled>-- Sélectionner une fiche frais --</option>
        <?php
        foreach ($lesfichesfrais as $uneFicheFrais) {
            $mois = $uneFicheFrais['mois'];
            $idvisiteur = $uneFicheFrais['idvisiteur'];
            $etat = $uneFicheFrais['idetat'];
            foreach($visiteurs as $unVisiteur){
                if($unVisiteur['id'] === $idvisiteur){
                    $idvisiteur = $unVisiteur['nom'] . ' ' . $unVisiteur['prenom'];
                }
            }
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
<div class='container'>
    <h1>Suivre paiement fiche de frais</h1>
<div>
    <h3>
        Frais Forfait Fiche

    </h3>
</div>
<div>
    <h3>
        Frais Hors Forfait Fiche
    </h3>
    <input type="button" value="Valider" class="btn btn-success" onclick="miseEnPaiement()" ></input>
</div>