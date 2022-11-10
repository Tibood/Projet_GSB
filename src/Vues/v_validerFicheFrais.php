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
    <div class="input-group mb-3">
        <label>Choisir le visiteur :</label>
            <select class="form-select" id="listVisiteur">
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
    </div>
    <form action='' methode='post' role='form'>
    <div class="input-group mb-3">
        <label>Mois :</label>
            <select id="listMois">
                <option value=""></option>
            </select>
    </div>
    </form>
</div>
<?php
echo getMois(date('d/m/Y'));
?>
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
    <button type="button" class="btn btn-success">Corriger</button>
    <button type="button" class="btn btn-danger">Reinitialiser</button>
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
<body>