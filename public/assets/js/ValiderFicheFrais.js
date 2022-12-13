function getMois(idvisiteur)
{ // todo redemander les mois quand on change de user
    let idVisiteurSelectionner = document.getElementById("listVisiteur").value;
    let listMois = document.getElementById("listMois");
    if (listMois.value) {
        getInfo(listMois.value);
    }
    $.ajax({
        type: "POST",
        url: "index.php?uc=validerFicheFrais&action=getMois&a=ajax",
        data: {
            id: idVisiteurSelectionner,
            moisDejaSeclection: listMois.value
        },
        success: function(retour){
            $("#listMois").html(retour);
        }
    });
}

function getInfo(moisDejaSeclection = null)
{
    let moisSelectionner = document.getElementById("listMois").value;
    if (moisDejaSeclection != null) {
        moisSelectionner = moisDejaSeclection;
    }
    let idVisiteurSelectionner = document.getElementById("listVisiteur").value;
    $.ajax({
        type: "POST",
        url: "index.php?uc=validerFicheFrais&action=getInfo&a=ajax",
        data: {
            id: idVisiteurSelectionner,
            mois: moisSelectionner,
        },
        dataType: 'json',
        success: function(retour){
            $("#Fofait_Etape").val(retour['fraisForfait'][0]['quantite']);
            $("#Frais_Kilometrique").val(retour['fraisForfait'][1]['quantite']);
            $("#Nuitee_Hotel").val(retour['fraisForfait'][2]['quantite']);
            $("#Repas_Restaurant").val(retour['fraisForfait'][3]['quantite']);
            $("#tablo_fraisHorsForfait tr").remove();
            retour['fraisHorsForfait'].forEach(element => ajoutLigne(element['date'],element['libelle'],element['montant'],element['id']));
            $("#Nb_justificatif").val(retour['nbJustificatif']);
        }
    });
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
    row.id = fraisid;// <input type='date'
    cell1.innerHTML = "<input type='text' class='form-control' value=" + date + " name='date' placeholder='Date' required>"; //Todo mettre un restriction de saisie de la date que dans le mois de la fiche
    cell2.innerHTML = '<input type="text" class="form-control" value="' + libelle + '" name="libelle" placeholder="Description" size="30" required>';
    cell3.innerHTML = "<input type='number' class='form-control' value=" + montant + " name='montant'placeholder='Montant' step='.01' required>";
    cell4.innerHTML = '<input type="button" value="Corriger" onclick="corrigerFraisHorsForfait('+fraisid+')"class="btn btn-success"></input>&nbsp\
                        <input type="button" value="Reinitialiser" class="btn btn-danger" onclick="ReinitiliserleFraisHorsForfait('+row.rowIndex+')"></input>&nbsp\
                        <input type="button" value="Reporter" onclick="reporterLeFraisHorsForfait('+fraisid+')"class="btn btn-link"></input>';
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
                    ajoutLigne(element['date'],element['libelle'],element['montant'],element['id'],indexLigneReinitialiser);
                }
            });
        }
    });
}















// -------------------------------------------------------------------------------------------------------

function reporterLeFraisHorsForfait(idFraisHorsForfait)
{
    if (confirm("Vous êtes sur le point de reporter le frais hors forfait. Voulez-vous continuer ?")){
        const idVisiteurSelectionner = document.getElementById("listVisiteur").value;
        const moisSelectionner = document.getElementById("listMois").value;
        let idfrais = idFraisHorsForfait;
        //corrigerFraisHorsForfait(idFraisHorsForfait, reporter = true);
        let libelle = document.getElementById(idfrais).cells[1].children[0].value;
        let lefrais = {
            "date": document.getElementById(idfrais).cells[0].children[0].value,
            "libelle": libelle,
            "montant": document.getElementById(idfrais).cells[2].children[0].value,
            "idfrais": idfrais,
        }
        $.ajax({
            type: "POST",
            url: "index.php?uc=validerFicheFrais&action=reporterLeFraisHorsForfait&a=ajax",
            data: {
                id: idVisiteurSelectionner,
                mois: moisSelectionner,
                lefrais: lefrais
            },
            dataType: 'json',
            success: function(retour){
                if (retour['success'] == true) {
                    alert("Le frais hors forfait a bien été reporter");
                    getInfo();
                } else {
                    alert("Le frais hors forfait n'a pas pu être reporter");
                }
            }
        });
    }
}


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
        success: function(retour)
        {
            if(retour){
                alert(retour);
            } else {
                alert('Les modifications ont été enregistrées');
            }
        },


    });
    }
}

function corrigerFraisHorsForfait(idfrais,reporter = false) {
    const moisSelectionner = document.getElementById("listMois").value;
    const idVisiteurSelectionner = document.getElementById("listVisiteur").value;
    var libelle = document.getElementById(idfrais).cells[1].children[0].value;
    if (reporter == true) {
        var libelle = " REFUSE " + document.getElementById(idfrais).cells[1].children[0].value;
    }
    let lefrais = {
        "date": document.getElementById(idfrais).cells[0].children[0].value,
        "libelle": libelle,
        "montant": document.getElementById(idfrais).cells[2].children[0].value,
        "idfrais": idfrais,
    }
    $.ajax({
        type: "POST",
        url: "index.php?uc=validerFicheFrais&action=corrigerFraisHorsForfait&a=ajax",
        data: {
            id: idVisiteurSelectionner,
            mois: moisSelectionner,
            lefrais: lefrais
            },
        dataType: 'json',
        success: function(retour) {
            if(JSON.stringify(retour) ==='{}'){
                alert('Les modifications ont été enregistrées');
            } else {
                alert((retour));
            }
        }
        });
}

function validerFicheFrais()
{
    if (confirm("Vous êtes sur le point de valider la fiche de frais. Voulez-vous continuer ?")){
        let moisSelectionner = document.getElementById("listMois").value;
        let idVisiteurSelectionner = document.getElementById("listVisiteur").value;
    //corrigerFraisForfait();
    //corrigerFraisHorsForfait();

    corrigerNbJustificatif();
    $.ajax({
        type: "POST",
        url: "index.php?uc=validerFicheFrais&action=validerFicheFrais&a=ajax",
        data: {
            id: idVisiteurSelectionner,
            mois: moisSelectionner,
        },
        success: function(retour){
            alert("La fiche de frais a bien été validée")
        }
    });
    }
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
            console.log('Mofiication du nombre de justificatif');
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
// })