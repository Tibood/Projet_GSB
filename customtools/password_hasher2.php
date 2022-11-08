<?php

$fp = @fopen("clear_passwords.txt", "r");

if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        // Remplace les sauts de lignes qui étaient aussi hashés et causaient des soucis
        $buffer = trim(preg_replace('/\s+/', ' ', $buffer));   
        // Mot de passe ===> Même mot de passe, mais hashé 
        echo $buffer . " ===> " . password_hash($buffer, PASSWORD_BCRYPT, ["cost" => 12]);
        echo "\n";    
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