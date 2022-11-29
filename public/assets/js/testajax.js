function getMois(value)
{
    $.ajax({
        type: "POST",
        url: "index.php?a=ajax&uc=validerfrais&action=getmois",
        data: {
            id: value
        },
        dataType: 'text',
        success: function(retour){
          console.log(retour)
           $("#Fofait_Etape").html(retour);
        }
    });
}


//function getMois(value){
//    var retour = document.getElementById("retour")
//    var xhr = new XMLHttpRequest();
//    console.log(this);
//    if (this.readyState == 4 && this.status == 200){
//        retour.innerHTML = this.response
//        var data = this.response
//        console.log(data)
//    }
//xhr.open("POST","index.php?uc=validerFicheFrais&action=getMois",true)
//xhr.responseType = "text";
//xhr.send(value);
//};