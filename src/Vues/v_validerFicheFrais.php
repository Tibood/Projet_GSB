<?php

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="UTF-8">
        <title>Intranet du Laboratoire Galaxy-Swiss Bourdin</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./styles/bootstrap/bootstrap.css" rel="stylesheet">
        <link href="./styles/style.css" rel="stylesheet">
        <link href="./styles/comptable.css" rel="stylesheet">
    </head>
    <body>
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

<table>
    <thead>
        <tr>
            <th>Descriptif des éléments hors forfais</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Date</td>
            <td>Libellé</td>
            <td>Montant</td>
            <td></td>
        </tr>
        <?php
        foreach ($azf as $value){
        ?>
        <tr>
            <td>Cell3</td>
            <td>Cell4</td>
        </tr>
        <?php }?>
        
    </tbody>
</table>


<body>