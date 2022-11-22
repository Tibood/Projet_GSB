document.getElementById("test").addEventListener("submit", function(e) {
	e.preventDefault();

	var data = new FormData(this);

	var xhr = new XMLHttpRequest();

	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			console.log(this.response);
			var res = this.response;
			if (res.success) {
				console.log("Utilisateur inscrit !");
			} else {
				alert(res.msg);
			}
		} else if (this.readyState == 4) {
			alert("Une erreur est survenue...");
		}
	};

	xhr.open("POST", "src/Vues/v_listVisiteur_Mois.php", true);
	xhr.responseType = "text";
	// xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(data);

	return false;
});​

function getMois(val) {
    $.ajax({
    type: "POST",
    url: "src/Vues/v_listVisiteur_Mois.php",
    data:'idVisiteur='+val,
    success: function(data){
        $("#listMois").html(data);
    }
    });
}

