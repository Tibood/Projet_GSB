function getMois(value)
{
    $.ajax({
        type: "POST",
        url: "index.php?a=ajax&uc=validerFicheFrais&action=getMois",
        data: {
            id: value
        },
        //dataType: 'text',
        success: function(retour){
            console.log(retour)
            $("#listMois").html(retour);
        }
    });
}

