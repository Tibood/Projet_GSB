function getMois(idvisiteur)
{
    let listMois = document.getElementById("listMois");
    if (!listMois.value) {
    $.ajax({
        type: "POST",
        url: "index.php?uc=validerFicheFrais&action=getMois&a=ajax",
        data: {
            id: idvisiteur
        },
        success: function(retour){
            $("#listMois").html(retour);
        }
    });
    } else {
        getInfo(idvisiteur, listMois.value);
    }
}

function getInfo(idvisiteur, mois)
{
    $.ajax({
        type: "POST",
        url: "index.php?uc=validerFicheFrais&action=getInfo&a=ajax",
        data: {
            id: idvisiteur,
            mois: mois,
        },
        dataType: 'json',
        success: function(retour){
            $("#Fofait_Etape").val(retour['fraisForfait'][0]['quantite']);
            $("#Frais_Kilometrique").val(retour['fraisForfait'][1]['quantite']);
            $("#Nuitee_Hotel").val(retour['fraisForfait'][2]['quantite']);
            $("#Repas_Restaurant").val(retour['fraisForfait'][3]['quantite']);
            $("#tablo_fraisHorsForfait tr").remove();
            retour['fraisHorsForfait'].forEach(element => ajoutLigne(element[4],element['libelle'],element['montant']));
            $("#Nb_justificatif").val(retour['nbJustificatif']);
        }
    });
}


function ajoutLigne(date,libelle,montant)
{
    let tableaufraisHorsForfait = document.getElementById("tablo_fraisHorsForfait")
    let row = tableaufraisHorsForfait.insertRow();
    let cell1 = row.insertCell(0);
    let cell2 = row.insertCell(1);
    let cell3 = row.insertCell(2);
    let cell4 = row.insertCell(3);
    row.className = "table-light";
    cell1.innerHTML = "<input type='date' class='form-control' value=" + date + " name='date' required>";
    cell2.innerHTML = '<input type="text" class="form-control" value="' + libelle + '" name="libelle" size="30" required>';
    cell3.innerHTML = "<input type='number' class='form-control' value=" + montant + " name='montant' step='.01' required>";
    cell4.innerHTML = "<input type='button' value='Corriger' class='btn btn-success'>&nbsp</input><input type='reset' value='Reinitialiser' class='btn btn-danger'></input>";
}

function corrigerNbJustificatif()
{
    let nbJustificatif = document.getElementById("Nb_justificatif");
    let moisSelectionner = document.getElementById("listMois");
    let idVisiteurSelectionner = document.getElementById("listVisiteur");
    let nomVisiteur = idVisiteurSelectionner.options[idVisiteurSelectionner.selectedIndex].text;
    let nomMois = moisSelectionner.options[moisSelectionner.selectedIndex].text;
    if(confirm("souhaiter vous mettre à jour le nombre de justificatif à " + nbJustificatif.value + " pour " + nomVisiteur +" le "
    + nomMois + "?" ))
    {
    $.ajax({
        type: "POST",
        url: "index.php?uc=validerFicheFrais&action=corrigerNbJustificatif&a=ajax",
        data: {
            id: idVisiteurSelectionner.value,
            mois: moisSelectionner.value,
            nbJustificatif: nbJustificatif.value,
        },
        success: function(retour){
            alert('La modification a bien été prise en compte');
        }
    });
    };
}

// function corrigerFraisForfait(idvisiteur,mois,fraisForfait){
//     alert("Fofait_Etape =" + document.getElementById("Fofait_Etape").value + document.getElementById("Fofait_Etape").name
//     + "\nFrais_Kilometrique =" + document.getElementById("Frais_Kilometrique").value + document.getElementById("Frais_Kilometrique").name
//     + "\nNuitee_Hotel =" + document.getElementById("Nuitee_Hotel").value + document.getElementById("Nuitee_Hotel").name
//     + "\nRepas_Restaurant =" + document.getElementById("Repas_Restaurant").value + document.getElementById("Repas_Restaurant").name);
//     $.ajax({
//         type: "POST",
//         url: "index.php?uc=validerFicheFrais&action=corrigerFraisForfait&a=ajax",
//         data: {
//             id: idvisiteur,
//             mois: mois,
//             lesFrais: fraisForfait
//         },
//         success: function(retour){
//             $("#Fofait_Etape").val(retour['fraisForfait'][0]['quantite']);
//             $("#Frais_Kilometrique").val(retour['fraisForfait'][1]['quantite']);
//             $("#Nuitee_Hotel").val(retour['fraisForfait'][2]['quantite']);
//             $("#Repas_Restaurant").val(retour['fraisForfait'][3]['quantite']);
//             $("#tablo_fraisHorsForfait tr").remove();
//             retour['fraisHorsForfait'].forEach(element => ajoutLigne(element[4],element['libelle'],element['montant']));
//             $("#Nb_justificatif").val(retour['nbJustificatif']);
//         }
//     });
// }

