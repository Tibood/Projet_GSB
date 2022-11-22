function getMois(value){
    console.log("test");
    $.ajax({
        type: "POST",
        url: "index.php?uc=validerFicheFrais&action=getMois",
        data: {
            id: value
        },
        success: function(data){
            console.log("succès"),
            $("#listMois").html(data);
        }
    });
}

    
    