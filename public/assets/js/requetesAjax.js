
// let listVisiteur = document.getElementById("listVisiteur");

// listVisiteur.addEventListener("onchange",function() {
//     getMois(value)
// })

// let listMois = document.getElementById("listMois");
// listVisiteur.addEventListener("onchange", () => {
//     if(getComputedStyle(d1).display != "none"){
//         listMois.style.display = "none";
//     } else {
//         listMois.style.display = "block";
//     }
// })

// function reset()
// {
//     document.getElementsByClassName("fraisForfait").reset();
//     document.getElementsByClassName("fraisHorsForfait").reset();
// }
function corrigerFraisForfait(){
    let Fofait_Etape = document.getElementById("Fofait_Etape").value;
    let Frais_Kilometrique = document.getElementById("Frais_Kilometrique").value;
    let Nuitee_Hotel = document.getElementById("Nuitee_Hotel").value;
    let Repas_Restaurant = document.getElementById("Repas_Restaurant").value;
    $.ajax({
        type: "POST",
        url: "index.php?uc=validerFicheFrais&action=corrigerFraisForfait&a=ajax",
        data: {
            Fofait_Etape: Fofait_Etape,
            Frais_Kilometrique: Frais_Kilometrique,
            Nuitee_Hotel: Nuitee_Hotel,
            Repas_Restaurant: Repas_Restaurant,
        },
        dataType: 'text',
        success: function(retour){
            console.log(retour);
        }
    });
}

function getMois(idvisiteur)
{
    if (!document.getElementById("listMois").value) {
    $.ajax({
        type: "POST",
        url: "index.php?uc=validerFicheFrais&action=getMois&a=ajax",
        data: {
            id: idvisiteur
        },
        //dataType: 'text',
        success: function(retour){
            $("#listMois").html(retour);
        }
    });
    } else {
        getInfo(idvisiteur, document.getElementById("listMois").value);
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
    cell1.innerHTML = "<input type='date' class='form-control' value=" + date + " name='date' required>";
    cell2.innerHTML = "<input type='text' class='form-control' value='" + libelle + "' name='libelle' size='30' required>";
    cell3.innerHTML = "<input type='number' class='form-control' value=" + montant + " name='montant' step='.01' required>";
    cell4.innerHTML = "<input type='button' value='Corriger' class='btn btn-success'>&nbsp</input><input type='button' value='Reinitialiser' class='btn btn-danger'></input>";
}


