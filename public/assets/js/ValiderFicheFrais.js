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


// function getNbJustificatif()
// {
//     let moisSelectionner = document.getElementById("listMois").value;
//     let idVisiteurSelectionner = document.getElementById("listVisiteur").value;
//     $.ajax({
//         type: "POST",
//         url: "index.php?uc=validerFicheFrais&action=getNbJustificatif&a=ajax",
//         data: {
//             id: idVisiteurSelectionner,
//             mois: moisSelectionner
//         },
//         success: function(retour){
//             $("#Nb_justificatif").val(retour);
//         }
//     });
// }

function ajoutLigne(date,libelle,montant,fraisid,index = null)
{
    let tableaufraisHorsForfait = document.getElementById("tablo_fraisHorsForfait")
    if (index != null) {
        tableaufraisHorsForfait.deleteRow(index)
        var row = tableaufraisHorsForfait.insertRow(index)
    } else {
        var row = tableaufraisHorsForfait.insertRow();
    }
    let cell1 = row.insertCell(0);
    let cell2 = row.insertCell(1);
    let cell3 = row.insertCell(2);
    let cell4 = row.insertCell(3);
    row.className = "table-light";
    row.id = fraisid;
    cell1.innerHTML = "<input type='date' class='form-control' value=" + date + " name='date' required>";
    cell2.innerHTML = '<input type="text" class="form-control" value="' + libelle + '" name="libelle" size="30" required>';
    cell3.innerHTML = "<input type='number' class='form-control' value=" + montant + " name='montant' step='.01' required>";
    cell4.innerHTML = '<input type="button" value="Corriger" class="btn btn-success">&nbsp</input><input type="button" value="Reinitialiser" class="btn btn-danger" onclick="ReinitiliserleFraisHorsForfait('+row.rowIndex+')"></input>';
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
            mois: moisSelectionner,
            mois: moisSelectionner
        },
        dataType: 'json',
        success: function(retour){
            $("#Fofait_Etape").val(retour['fraisForfait'][0]['quantite']);
            $("#Frais_Kilometrique").val(retour['fraisForfait'][1]['quantite']);
            $("#Nuitee_Hotel").val(retour['fraisForfait'][2]['quantite']);
            $("#Repas_Restaurant").val(retour['fraisForfait'][3]['quantite']);
            $("#tablo_fraisHorsForfait tr").remove();
            retour['fraisHorsForfait'].forEach(element => ajoutLigne(element[4],element['libelle'],element['montant'],element['id']));
            $("#Nb_justificatif").val(retour['nbJustificatif']);
        }
    });
}


function ReinitiliserleFraisHorsForfait(indexLigneReinitialiser)
{
    const moisSelectionner = document.getElementById("listMois").value;
    const idVisiteurSelectionner = document.getElementById("listVisiteur").value;
    $.ajax({
        type: "POST",
        url: "index.php?uc=validerFicheFrais&action=getFraisHorsForfait&a=ajax",
        data: {
            id: idVisiteurSelectionner,
            mois: moisSelectionner
        },
        dataType: 'json',
        success: function(retour) {
            retour.forEach(function(element) {
                if (retour.indexOf(element) === indexLigneReinitialiser) {
                    ajoutLigne(element[4],element['libelle'],element['montant'],element['id'],indexLigneReinitialiser);
                }
            });
        }
    });
}















// -------------------------------------------------------------------------------------------------------



function corrigerFraisForfait(){
    let moisSelectionner = document.getElementById("listMois").value;
    let idVisiteurSelectionner = document.getElementById("listVisiteur").value;
    let fraisForfait = {};
    if (confirm("Vous êtes sur le point de corriger les frais forfaitisés. Voulez-vous continuer ?")){
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

function validerFicheFrais(){
    //corrigerFraisForfait();
    //corrigerFraisHorsForfait();
    corrigerNbJustificatif();
}

function corrigerNbJustificatif()
{
    let moisSelectionner = document.getElementById("listMois").value;
    let idVisiteurSelectionner = document.getElementById("listVisiteur").value;
    let nbJustificatif = document.getElementById("Nb_justificatif").value;
    $.ajax({
        type: "POST",
        url: "index.php?uc=validerFicheFrais&action=corrigerNbJustificatif&a=ajax",
        data: {
            id: idVisiteurSelectionner,
            mois: moisSelectionner,
            nbJustificatif: nbJustificatif,
        },
        success: function(){
            console.log('La modification a bien été prise en compte (Nbjustificati)');
        }
    });
}





// $('#someInput').bind('input', function() {
//     $(this).val() // get the current value of the input field.
// });

// $('#someInput').on('input', function() {
//     $(this).val() // get the current value of the input field.
// });

// $('#someInput').keyup(function() {
//     $(this).val() // get the current value of the input field.
// });