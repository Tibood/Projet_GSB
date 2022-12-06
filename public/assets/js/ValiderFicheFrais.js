function getMois(idvisiteur)
{
    let idVisiteurSelectionner = document.getElementById("listVisiteur").value;
    let listMois = document.getElementById("listMois");
    if (!listMois.value) {
    $.ajax({
        type: "POST",
        url: "index.php?uc=validerFicheFrais&action=getMois&a=ajax",
        data: {
            id: idVisiteurSelectionner
        },
        success: function(retour){
            $("#listMois").html(retour);
        }
    });
    } else {
        getInfo(idvisiteur, listMois.value);
    }
}

function getInfo()
{
    let moisSelectionner = document.getElementById("listMois").value;
    let idVisiteurSelectionner = document.getElementById("listVisiteur").value;
    $.ajax({
        type: "POST",
        url: "index.php?uc=validerFicheFrais&action=getInfo&a=ajax",
        data: {
            id: idVisiteurSelectionner,
            mois: moisSelectionner
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
    cell4.innerHTML = "<input type='button' value='Corriger' class='btn btn-success'>&nbsp</input><input type='reset' value='Reinitialiser' class='btn btn-danger' onclick='getInfo()'></input>";
}



//function corrigerNbJustificatif()
//{
//    let nbJustificatif = document.getElementById("Nb_justificatif");
//    let moisSelectionner = document.getElementById("listMois");
//    let idVisiteurSelectionner = document.getElementById("listVisiteur");
//    let nomVisiteur = idVisiteurSelectionner.options[idVisiteurSelectionner.selectedIndex].text;
//    let nomMois = moisSelectionner.options[moisSelectionner.selectedIndex].text;
//    if(confirm("souhaiter vous mettre à jour le nombre de justificatif à " + nbJustificatif.value + " pour " + nomVisiteur +" le "
//    + nomMois + "?" ))
//    {
//    $.ajax({
//        type: "POST",
//        url: "index.php?uc=validerFicheFrais&action=corrigerNbJustificatif&a=ajax",
//        data: {
//            id: idVisiteurSelectionner.value,
//            mois: moisSelectionner.value,
//            nbJustificatif: nbJustificatif.value,
//        },
//        success: function(){
//            alert('La modification a bien été prise en compte');
//        }
//    });
//    };
//}


//const
 function corrigerFraisForfait(){
    if (confirm("toto")){
    let fraisForfait = [];
    $('#fraisForfait :input[type="number"]').each(function(e){
        fraisForfait.push({
            idfrais:this.name,
            quantite:this.value
        });
    });
    let moisSelectionner = document.getElementById("listMois").value;
    let idVisiteurSelectionner = document.getElementById("listVisiteur").value;
    $.ajax({
        type: "POST",
        url: "index.php?uc=validerFicheFrais&action=corrigerFraisForfait&a=ajax",
        data: {
            id: idVisiteurSelectionner,
            mois: moisSelectionner,
            lesFrais: fraisForfait
        },
        success: function(){
            alert('ça marche');
        }
    });
}
 }

