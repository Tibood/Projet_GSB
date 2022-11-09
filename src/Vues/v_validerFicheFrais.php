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

<label>Choisir le visiteur :</label>
	<select id="listVisiteur">
		<option value="">--Please choose an option--</option>
	</select>
<label>Mois :</label>
	<select id="listMois">
		<option value="">--Please choose an option--</option>
	</select>

<h1>Valider la fiche de frais</h1>
<h2>Eléments forfaitisé</h2>

<label>Fofait Etape</label>
<input type="text" id="name" name="name" required
    minlength="4" maxlength="8" size="10">
<label>Frais Kilometrique</label>
<input type="text" id="name" name="name" required
    minlength="4" maxlength="8" size="10">
<label>Repas Restaurant</label>
<input type="text" id="name" name="name" required
    minlength="4" maxlength="8" size="10">

<button type="button" class="btn btn-success">Corriger</button>
<button type="button" class="btn btn-danger">Reinitialiser</button>

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