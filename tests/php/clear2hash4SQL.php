<?php

$fp = @fopen("../txt/clear_passwords.txt", "r");
$idfile = @fopen("../txt/id.txt", "r");

if ($fp) {
    while (($buffer = fgets($fp, 4096)) && ($id = fgets($idfile, 4096)) !== false) {
        // Remplace les sauts de lignes qui étaient aussi hashés et causaient des soucis
        $buffer = trim(preg_replace('/\s+/', ' ', $buffer));
        $id = trim(preg_replace('/\s+/', ' ', $id));
        // Mot de passe ===> Même mot de passe, mais hashé 
        echo "UPDATE visiteur SET mdp = '";
        // remplacer cette ligne par $buffer si on veut restorer mdp originaux :
        echo password_hash($buffer, PASSWORD_DEFAULT); // $buffer . " ===> " . 
        echo "' WHERE id = '" . $id . "';\n";    
    }
    if (!feof($fp)) {
        echo "Erreur: fgets() a échoué\n";
    }
    fclose($fp);
}

// ALTER TABLE nomTableUtilisateurs
// MODIFY COLUMN passwordColumn VARCHAR(255);

// UPDATE nomTable 
// SET passwordColumn = hash
// WHERE id = idChoisi;