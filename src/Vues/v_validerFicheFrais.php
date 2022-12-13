<?php

/**
 * Vue valider les Fiche de Frais
 *
 * PHP Version 8
 *
 * @category  PPE
 * @package   GSB
 * @author    BROUILLET THIBAUD
 */
?>
<script src = "assets/js/ValiderFicheFrais.js"></script>
<script src = "//code.jquery.com/jquery-1.12.0.min.js"></script>
<link href="styles/styleComptable.css" rel="stylesheet" type="text/css">

<!--SELECTION-->
<br>
<br>
<div>
    <label for ='listVisiteur'>Choisir le visiteur:</label>
    <select class="form-control" name="listVisiteur" id='listVisiteur' onchange="getMois();" >
    <option selected value="0" disabled>-- Sélectionner un visiteur --</option>
        <?php
        foreach ($visiteurs as $unVisiteur) {
            $id = $unVisiteur['id'];
            $nom = $unVisiteur['nom'];
            $prenom = $unVisiteur['prenom'];
            ?>
                <option value="<?php echo $id ?>">
                    <?php echo $nom .' '. $prenom ?>
                </option>
            <?php
            }
        ?>
    </select>
    &nbsp;
    <label for="listMois">Mois :</label>
    <select class="form-control" name="listMois" id="listMois" onchange="getInfo();" >
        <?php
        if (!$lesMois)
        {
            ?>
            <option selected value=""></option>
            <?php
        }
        ?>
    </select>
    </div>
</div>



<!--AFFICHAGE-->
<div class='container'>
    <h1>Valider la fiche de frais</h1>
    <div class="input-group" id='fraisForfait'>
        <h3>Eléments forfaitisé</h3>
        <label>Fofait Etape</label>
        <br/>
        <input type="number" class='form-control' id="Fofait_Etape" name="ETP" min="0" disabled required>
        <br/>
        <label>Frais Kilometrique</label>
        <br/>
        <input type="number" class='form-control' id="Frais_Kilometrique" name="KM" min="0" disabled required>
        <br/>
        <label>Nuitée Hôtel</label>
        <br/>
        <input type="number" class='form-control' id="Nuitee_Hotel" name="NUI" min="0" disabled required>
        <br/>
        <label>Repas Restaurant</label>
        <br/>
        <input type="number" class='form-control' value='' id="Repas_Restaurant" name="REP" min="0" disabled required>
        <br/>
        <br/>
        <br/>
        <input type="button" value="Corriger"class="btn btn-success" onclick="corrigerFraisForfait()" disabled></input>
        &nbsp;
        <input type="reset" value="Reinitialiser" class="btn btn-danger" onclick="getFraisForfait()" disabled></input>
    </div>
    <br/>
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
    <label for="Nb_justificatif">Nombre de justificatifs :</label>
    <input type="number" id="Nb_justificatif" name="Nb_justificatif" class='form-control' min="0"patern=[0-9]* disabled required>
    <br/>
    <br/>
    <input type="button" value="Valider" class="btn btn-success" onclick="validerFicheFrais()" disabled></input>
    <input type="button" value="Reinitialiser" class="btn btn-danger" onclick="getInfo()" disabled></input>
</div>