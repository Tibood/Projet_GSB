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
<div>
    <form action="index.php?uc=validerFicheFrais" method="post" role="form">
        <div class="form-group container-fluid">
            <label for ='listVisiteur2'>Choisir le visiteur :</label>
            <select class="form-control" id='listVisiteur'name="listVisiteur">
            <?php
            foreach ($visiteurs as $unVisiteur) {
                $id = $unVisiteur['id'];
                $nom = $unVisiteur['nom'];
                $prenom = $unVisiteur['prenom'];
                if ($id == $_POST['listVisiteur']) {
                ?>
                    <option selected value="<?php echo $mois ?>">
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
            <label for="listMois2">Mois :</label>
            <select class="form-control" id="listMois2" id="listMois2">
            <?php
            foreach ($lesMois as $unMois) {
                $mois = $unMois['mois'];
                $numAnnee = $unMois['numAnnee'];
                $numMois = $unMois['numMois'];
                if ($mois == $_POST['listMois2']) {
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
<?php
//echo $_POST['listVisiteur2'];
//echo getMois(date('d/m/Y'));
?>
<!--
<h1>Valider la fiche de frais</h1>
<div class='container'>
    <div class="input-group">
        <h2>Eléments forfaitisé</h2>
        <label>Fofait Etape</label>
        <br/>
        <input type="text" id="name" name="name" required
            minlength="4" maxlength="8" size="10">
        <br/>
        <label>Frais Kilometrique</label>
        <br/>
        <input type="text" id="name" name="name" required
            minlength="4" maxlength="8" size="10">
        <br/>
        <label>Repas Restaurant</label>
        <br/>
        <input type="text" id="name" name="name" required
            minlength="4" maxlength="8" size="10">
    </div>
    <br/>
    <input type="button" class="btn btn-success">Corriger</input>
    <input type="button" class="btn btn-danger">Reinitialiser</input>
</div>

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
                <td>Cell3</td>
                <td>Cell4</td>
                <td>Cell4</td>
                <td>
                <button type="button" class="btn btn-success">Corriger</button>
                <button type="button" class="btn btn-danger">Reinitialiser</button></td>
            </tr>
        </tbody>
    </table>
</div>
</body>