function getInfo(){
    const moisFicheFrais = document.getElementById("listFiche").value;
    const idvisiteurFicheFrais = document.getElementById("listFiche").value;
    $.ajax({
        type: "POST",
        url: "index.php?uc=suivrePaiement&action=getInfo&a=ajax",
        data: {
            mois: moisFicheFrais,
            //id: idvisiteurFicheFrais
        },
        dataType: 'json',
        success: function(retour){
            echo(retour);
        }
    });

}

function miseEnPaiement(){
    confirm('mettre en payement')
    {
        alert('mois en paiement')
    }
}