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
    <div class="input-group mb-3">
        <label>Mois :</label>
            <select id="listMois">
                <option value="">--Please choose an option--</option>
            </select>
    </div>
</div>

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


<table class="table">
    <thead>
        <tr>
            <th scope="col">Descriptif des éléments hors forfais</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="col">Date</td>
            <td scope="col">Libellé</td>
            <td scope="col">Montant</td>
            <td scope="col"></td>
        </tr>
<?php
//foreach ($azf as $value) {
?>
        <tr>
            <td scope="row">Cell3</td>
            <td scope="row">Cell4</td>
        </tr>
<?php
//}
?>
    </tbody>
</table>
<body>