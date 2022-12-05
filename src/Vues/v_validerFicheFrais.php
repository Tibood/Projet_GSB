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
<script src = "assets/js/requetesAjax.js"></script>
<script src = "//code.jquery.com/jquery-1.12.0.min.js"></script>
<link href="styles/styleComptable.css" rel="stylesheet" type="text/css">

<!--SELECTION-->
<div>
        <label for ='listVisiteur'>Choisir le visiteur:</label>
        <select class="form-control" name="listVisiteur" id='listVisiteur' onchange="getMois(this.value);" >
        <option selected value="">-- Selectionner un visiteur --</option>
            <?php
            foreach ($visiteurs as $unVisiteur) {
                $id = $unVisiteur['id'];
                $nom = $unVisiteur['nom'];
                $prenom = $unVisiteur['prenom'];
                if ($id == $_POST['listVisiteur']) {
                ?>
                    <option selected value="<?php echo $id ?>">
                        <?php echo $nom . ' ' . $prenom ?> </option>
                <?php
                } else {
                ?>
                    <option value="<?php echo $id ?>">
                        <?php echo $nom .' '. $prenom ?>
                    </option>
                <?php
                }
            }
            ?>
        </select>
        &nbsp;
        <label for="listMois">Mois :</label>
        <select class="form-control" name="listMois" id="listMois" onchange="getInfo(document.getElementById('listVisiteur').value,this.value);" >
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
    </form>
</div>



<!--AFFICHAGE-->
<div class='container'>
    <h1>Valider la fiche de frais</h1>
    <div class="input-group fraisForfait">
        <h3>Eléments forfaitisé</h3>
        <label>Fofait Etape</label>
        <br/>
        <input type="number" class='form-control' id="Fofait_Etape" name="ETP" required>
        <br/>
        <label>Frais Kilometrique</label>
        <br/>
        <input type="number" class='form-control' id="Frais_Kilometrique" name="KM" required>
        <br/>
        <label>Nuitée Hôtel</label>
        <br/>
        <input type="number" class='form-control' id="Nuitee_Hotel" name="NUI" required>
        <br/>
        <label>Repas Restaurant</label>
        <br/>
        <input type="number" class='form-control' value='' id="Repas_Restaurant" name="REP" required>
        <br/>
    <br/>
    <br/>
    <input type="button" value="Corriger"class="btn btn-success"></input>
    &nbsp;
    <input type="reset" value="Reinitialiser" class="btn btn-danger"></input>
    </div>
    <br/>
    <div class='panel panel-info'>
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
        <table class='table table-bordered table-responsive' id="tablo_fraisHorsForfait">
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
    <input type="number" value='' id="Nb_justificatif" name="Nb_justificatif" class='form-control'required>
    <br/>
    <br/>
    <input type="button" value="Valider" class="btn btn-success" onclick="corrigerNbJustificatif()"></input>
    <input type="button" value="Reinitialiser" class="btn btn-danger"></input>
</div>