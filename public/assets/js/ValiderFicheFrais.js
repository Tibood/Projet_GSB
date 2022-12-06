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
        getInfo();
    }
}

function getInfo()
{
    getFraisForfait();
    getFraisHorsForfait();
    getNbJustificatif();

}

function getFraisForfait()
{
    let moisSelectionner = document.getElementById("listMois").value;
    let idVisiteurSelectionner = document.getElementById("listVisiteur").value;
    $.ajax({
        type: "POST",
        url: "index.php?uc=validerFicheFrais&action=getFraisForfait&a=ajax",
        data: {
            id: idVisiteurSelectionner,
            mois: moisSelectionner
        },
        dataType: 'json',
        success: function(retour){
            $("#Fofait_Etape").val(retour[0]['quantite']);
            $("#Frais_Kilometrique").val(retour[1]['quantite']);
            $("#Nuitee_Hotel").val(retour[2]['quantite']);
            $("#Repas_Restaurant").val(retour[3]['quantite']);
        }
    });
}

function getFraisHorsForfait()
{
    let moisSelectionner = document.getElementById("listMois").value;
    let idVisiteurSelectionner = document.getElementById("listVisiteur").value;
    $.ajax({
        type: "POST",
        url: "index.php?uc=validerFicheFrais&action=getFraisHorsForfait&a=ajax",
        data: {
            id: idVisiteurSelectionner,
            mois: moisSelectionner
        },
        dataType: 'json',
        success: function(retour){
            $("#tablo_fraisHorsForfait tr").remove();
            retour.forEach(element => ajoutLigne(element[4],element['libelle'],element['montant']));
        }
    });
}

function getNbJustificatif()
{
    let moisSelectionner = document.getElementById("listMois").value;
    let idVisiteurSelectionner = document.getElementById("listVisiteur").value;
    $.ajax({
        type: "POST",
        url: "index.php?uc=validerFicheFrais&action=getNbJustificatif&a=ajax",
        data: {
            id: idVisiteurSelectionner,
            mois: moisSelectionner
        },
        success: function(retour){
            $("#Nb_justificatif").val(retour);
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

// -------------------------------------------------------------------------------------------------------

function corrigerFraisForfait(){
    if (confirm("Vous etes sur le point de corriger les frais forfaitisés. Voulez-vous continuer ?")){
    let moisSelectionner = document.getElementById("listMois").value;
    let idVisiteurSelectionner = document.getElementById("listVisiteur").value;
    let fraisForfait = {};
    $('#fraisForfait :input[type="number"]').each(function(e){
        fraisForfait[this.name] = this.value;
    });
    $.ajax({
        type: "POST",
        url: "index.php?uc=validerFicheFrais&action=corrigerFraisForfait&a=ajax",
        data: {
            id: idVisiteurSelectionner,
            mois: moisSelectionner,
            lesFrais: fraisForfait
        },
        success: function(){
            alert('Les modifications ont bien été enregistrées');
        }
    });
    }
}

function corrigerFicheFraisAll(){
    corrigerFraisForfait();
    corrigerFraisHorsForfait();
    corrigerNbJustificatif();
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














// $('#someInput').bind('input', function() {
//     $(this).val() // get the current value of the input field.
// });

// $('#someInput').on('input', function() {
//     $(this).val() // get the current value of the input field.
// });

// $('#someInput').keyup(function() {
//     $(this).val() // get the current value of the input field.
// });