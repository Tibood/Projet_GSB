<?php

$clearfile = @fopen("clear_passwords.txt", "r");
$hashfile = @fopen("hashed_passwords.txt", "r");


if ($clearfile) {
    while (($clear = fgets($clearfile, 4096)) && ($hash = fgets($hashfile, 4096)) !== false) {
        // Remplace les sauts de lignes qui étaient aussi hashés et causaient des soucis
        $clear = trim(preg_replace('/\s+/', ' ', $clear));
        $hash = trim(preg_replace('/\s+/', ' ', $hash));
        // Mot de passe ===> Même mot de passe, mais hashé 
        //echo $buffer . " ===> " . 
        if (password_verify($clear, $hash)) {
            echo 'Password ' . $clear . ' is valid with the hash ' . $hash;
        } else {
            echo 'Password ' . $clear . ' IS NOT VALID with the hash ' . $hash;
        }
        echo "\n";
    }
    if (!feof($clearfile) || !feof($hashfile)) {
        echo "Erreur: fgets() a échoué\n";
    }
}
