<h1>Ajouter un compte visiteur</h1>

<form action="index.php?uc=ajoutVisiteur&action=AjoutBDD" method="post">
    <div class="container">
        <div class="mb-3 row">
            <label for="nom" class="col-sm-3 col-form-label">Nom</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nom" id="nom" value="">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="prenom" class="col-sm-3 col-form-label">Prenom</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="prenom" id="prenom" value="">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="id" class="col-sm-3 col-form-label">Id</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="id" id="id" value="">
            </div>
        </div>
        <br/>
        <input type="submit" value="Ajouter" id="btn_valider"class="btn btn-success"></input>
    </div>
</form>
