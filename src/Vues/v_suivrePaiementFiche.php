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
<script src="assets/js/SuivrePaiement.js"></script>
<script src = "//code.jquery.com/jquery-1.12.0.min.js"></script>
<link href="styles/styleComptable.css" rel="stylesheet" type="text/css">

<!--SELECTION-->
<br>
<br>

<div>
    <label for ='listFiche'>Choisir la Fiche Frais en attente de paiement:</label>
    <select class="form-control" name="listFiche" id='listFiche' onchange="getInfo()" >
    <option selected value="0" disabled>-- Sélectionner une fiche frais --</option>
        <?php
        foreach ($lesfichesfrais as $uneFicheFrais) {
            $mois = $uneFicheFrais['mois'];
            $id= $uneFicheFrais['idvisiteur'];
            $visiteur = $uneFicheFrais['idvisiteur'];
            $etat = $uneFicheFrais['idetat'];
            foreach($visiteurs as $unVisiteur){
                if($unVisiteur['id'] === $visiteur){
                    $visiteur = $unVisiteur['nom'] . ' ' . $unVisiteur['prenom'];
                }
            }
            if($etat === 'VA'){
                ?>
                <option id="<?php echo $id . '/' . $mois?>" value="<?php echo $id . '/' . $mois?>">
                    <?php echo $visiteur . ' / ' . $mois ?>
                </option>
            <?php
            }
        }
        ?>
    </select>
</div>
<h1>Suivre paiement fiche de frais</h1>
<div class='container' >

    <h3>Frais forfait correspondant à la fiche</h3>
    <div class="container">
        <div class="mb-3 row">
            <label for="Fofait_Etape" class="col-sm-3 col-form-label">Fofait Etape</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control" id="Fofait_Etape" value="">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="Frais_Kilometrique" class="col-sm-3 col-form-label">Frais Kilometrique</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control" id="Frais_Kilometrique" value="">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="Nuitee_Hotel" class="col-sm-3 col-form-label">Nuitée Hôtel</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control" id="Nuitee_Hotel" value="">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="Repas_Restaurant" class="col-sm-3 col-form-label">Repas Restaurant</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control" id="Repas_Restaurant" value="">
            </div>
        </div>
    </div>

    <h3>Frais hors forfait correspondant à la fiche</h3>
    <div class='panel panel-info'>
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
        <table class='table table-bordered table-responsive table-hover border-warning' id="tablo_fraisHorsForfait">
            <tbody>
                <tr>
                    <th>Date</th>
                    <th>Libellé</th>
                    <th>Montant</th>
                    <th></th>
                </tr>
                </tr>
            </tbody>
        </table>
    </div>
    <input type="button" value="Mettre en paiement" id="btn_valider"class="btn btn-success" onclick="miseEnPaiement()" disabled></input>
</div>