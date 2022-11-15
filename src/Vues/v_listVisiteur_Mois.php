<div>
    <form action="index.php?uc=validerFicheFrais&action=afficherLigneFrais" method="post" role="form">
        <div class="form-group container-fluid">
            <label for ='listVisiteur'>Choisir le visiteur :</label>
            <select class="form-control" id='listVisiteur'name="listVisiteur" onchange="this.form.submit()">
                <?php
                foreach ($visiteurs as $unVisiteur) {
                    $id = $unVisiteur['id'];
                    $nom = $unVisiteur['nom'];
                    $prenom = $unVisiteur['prenom'];
                    if ($id == $_POST['listVisiteur']) {
                    ?>
                        <option selected value="<?php echo $mois ?>">
                            <?php echo $nom . ' ' . $prenom ?> </option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $id ?>">
                            <?php echo $nom .' '. $prenom ?>
                        </option>
                    <?php
                    }
                }
                ?>
            </select>
            &nbsp;
            <label for="listMois">Mois :</label>
            <select class="form-control" id="listMois" id="listMois">
                <?php
                foreach ($lesMois as $unMois) {
                    $mois = $unMois['mois'];
                    $numAnnee = $unMois['numAnnee'];
                    $numMois = $unMois['numMois'];
                    if ($mois == $_POST['listMois']) {
                        ?>
                        <option selected value="<?php echo $mois ?>">
                            <?php echo $numMois . '/' . $numAnnee ?> </option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo $mois ?>">
                            <?php echo $numMois . '/' . $numAnnee ?> </option>
                        <?php
                    }
                    }
                    ?>
            </select>
        </div>
    </form>
</div>