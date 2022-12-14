function getInfo(){
    let values = document.getElementById('listFiche').value;
    let Parts = values.split("/");
    let idvisiteurFicheFrais = Parts[0];
    let moisFicheFrais = Parts[1];
    $.ajax({
        type: "POST",
        url: "index.php?uc=suivrePaiementFiche&action=getInfo&a=ajax",
        data: {
            mois: moisFicheFrais,
            id: idvisiteurFicheFrais
        },
        dataType: 'json',
        success: function(retour){
            $($("input").removeAttr("disabled", true));
            $("#Fofait_Etape").val(retour['fraisForfait'][0]['quantite']);
            $("#Frais_Kilometrique").val(retour['fraisForfait'][1]['quantite']);
            $("#Nuitee_Hotel").val(retour['fraisForfait'][2]['quantite']);
            $("#Repas_Restaurant").val(retour['fraisForfait'][3]['quantite']);
            $("#tablo_fraisHorsForfait td").remove();
            retour['fraisHorsForfait'].forEach(element => ajoutLigne(element['date'],element['libelle'],element['montant'],element['id']));
        }
    });

}

function ajoutLigne(date,libelle,montant,fraisid,)
{
    let tableaufraisHorsForfait = document.getElementById("tablo_fraisHorsForfait")
    var row = tableaufraisHorsForfait.insertRow();
    let cell1 = row.insertCell(0);
    let cell2 = row.insertCell(1);
    let cell3 = row.insertCell(2);
    row.className = "table-light";
    row.id = fraisid;// <input type='date'
    cell1.innerHTML = "<input type='text'readonly class='form-control' value=" + date + " name='date' placeholder='Date'>";
    cell2.innerHTML = '<input type="text" readonly class="form-control" value="' + libelle + '" name="libelle" placeholder="Description" size="50">';
    cell3.innerHTML = "<input type='number' readonly class='form-control' value=" + montant + " name='montant'placeholder='Montant' >";
}


function miseEnPaiement(){
    confirm('Vouloir mettre en paiement ?')
    {
        let values = document.getElementById('listFiche').value;
        let Parts = values.split("/");
        let idvisiteurFicheFrais = Parts[0];
        let moisFicheFrais = Parts[1];
        $.ajax({
            type: "POST",
            url: "index.php?uc=suivrePaiementFiche&action=miseEnPaiement&a=ajax",
            data: {
                mois: moisFicheFrais,
                id: idvisiteurFicheFrais
            },
            success: function(retour){
                $("#btn_valider").attr("disabled", true);
                alert("L'état de la fiche a été mis à remboursé");
            }
        });
    }
}