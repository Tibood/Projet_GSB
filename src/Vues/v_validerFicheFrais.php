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
        </select>
        </div>
    </form>
</div>



<!--AFFICHAGE-->
<div class='container'>
    <h1>Valider la fiche de frais</h1>
    <div class="input-group">
        <h3>Eléments forfaitisé</h3>
        <label>Fofait Etape</label>
        <br/>
        <input type="number" value='<?php echo $fraisForfait[0]['quantite']?>' id="Fofait_Etape" name="Fofait_Etape" required>
        <br/>
        <label>Frais Kilometrique</label>
        <br/>
        <input type="number" value='<?php echo $fraisForfait[1]['quantite']?>' id="Frais_Kilometrique" name="Frais_Kilometrique" required>
        <br/>
        <label>Repas Restaurant</label>
        <br/>
        <input type="number" value='<?php echo $fraisForfait[3]['quantite'] ?>' id="Repas_Restaurant" name="Repas_Restaurant" required>
    </div>
    <br/>
    <input type="button" value="Corriger"class="btn btn-success"></input>
    <input type="button" value="Reinitialiser"class="btn btn-danger"></input>
    <br/>
    <br/>
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
                    <?php
                    foreach ($fraisHorsForfait as $unFraisHorsForfait) {
                        ?>
                        <tr>
                            <td>
                                <input type="text" value='<?php echo $unFraisHorsForfait['date'] ?>'
                                        name="date" required>
                            </td>
                            <td>
                                <input type="text" value='<?php echo $unFraisHorsForfait['libelle'] ?>'
                                        name="libelle" required>
                            </td>
                            <td>
                                <input type="number" value='<?php echo $unFraisHorsForfait['montant'] ?>'
                                        name="montant" required>
                            </td>
                            <td>
                                <input type="button" value="Corriger" class="btn btn-success"></input>
                                <input type="button" value="Reinitialiser" class="btn btn-danger"></input>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
    <label for="Nb_justificatif">Nombre de justificatifs :</label>
    <input type="number" value='<?php echo $nbJustificatif?>' id="Nb_justificatif" name="Nb_justificatif" required>
    <br/>
    <br/>
    <input type="button" value="Valider" class="btn btn-success"></input>
    <input type="button" value="Reinitialiser" class="btn btn-danger"></input>
</div>