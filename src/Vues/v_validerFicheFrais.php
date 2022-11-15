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
    <input type="button" value="Corriger"class="btn btn-success"></input>
    <input type="button" value="Reinitialiser"class="btn btn-danger"></input>
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
