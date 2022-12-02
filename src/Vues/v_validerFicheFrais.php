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
    <br>
        <label for ='listVisiteur'>Choisir le visiteur:</label>
        <select class="form-control" name="listVisiteur" id='listVisiteur' onchange="getMois(this.value);" >
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
        <select class="form-control" name="listMois" id="listMois">
            <?php
            /*
            foreach ($lesMois as $unMois) {
                $mois = $unMois['mois'];
                $numAnnee = $unMois['numAnnee'];
                $numMois = $unMois['numMois'];
                if ($mois == $_POST['listMois']) {
                    ?>
                    <option selected value="<?php echo $mois ?>">
                        <?php echo $numMois . '/' . $numAnnee ?> </option>
                    <?php
                } else {
                    ?>
                    <option value="<?php echo $mois ?>">
                        <?php echo $numMois . '/' . $numAnnee ?> </option>
                    <?php
                }
                }
                ?>
                */
                ?>
        </select>
        </div>
    </form>
</div>
<br>
<!--AFFICHAGE-->
<div class='container'>
<h1>Valider la fiche de frais</h1>

    <div class="input-group" id="retour">
    </div>


    <div class="input-group">
        <h2>Eléments forfaitisé</h2>
        <label>Fofait Etape</label>
        <br/>
        <input type="text" value='<?php $fEtape = 2?>' id="Fofait_Etape" name="Fofait_Etape" required
            minlength="4" maxlength="8" size="10">
        <br/>
        <label>Frais Kilometrique</label>
        <br/>
        <input type="text" value='<?php $fKilometrique = 2?>' id="Frais_Kilometrique" name="Frais_Kilometrique" required
            minlength="4" maxlength="8" size="10">
        <br/>
        <label>Repas Restaurant</label>
        <br/>
        <input type="text" value='<?php $repResto = 2?>' id="Repas_Restaurant" name="Repas_Restaurant" required
            minlength="4" maxlength="8" size="10">
    </div>
    <br/>
    <input type="button" value="Corriger"class="btn btn-success"></input>
    <input type="button" value="Reinitialiser"class="btn btn-danger"></input>
</div>
<br/>
<div class='panel panel-info'>
    <div class="panel-heading">Descriptif des éléments hors forfait</div>
    <table class='table table-bordered table-responsive'>
        <tbody>
            <tr>
                <th>Date</th>
                <th>Libellé</th>
                <th>Montant</th>
                <th></th>
            </tr>
            <tr>
                <td><div id="date"></div>test</td>
                <td><div id="Libelle"></div>Cell4</td>
                <td><div id="Montant"></div>Cell4</td>
                <td>
                <button type="button" class="btn btn-success">Corriger</button>
                <button type="button" class="btn btn-danger">Reinitialiser</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
