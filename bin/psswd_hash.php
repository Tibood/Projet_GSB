<?php

require 'gendatas/fonctions.php';


$pdo = new PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);

$visiteurs = getLesVisiteurs($pdo);
$comptables = getLesComptables($pdo);

foreach ($visiteurs as $unVisiteur ) {
    $mdp = $unVisiteur['mdp'];
    $hashMdp = password_hash($mdp, PASSWORD_DEFAULT);
    $id = $unVisiteur['id'];
    $req = $pdo->prepare('UPDATE visiteur SET mdp= :hashMdp  WHERE id= :unId ');
    $req->bindParam(':hashMdp', $hashMdp, PDO::PARAM_STR);
    $req->bindParam(':unId', $id, PDO::PARAM_STR);
    $req->execute();
    echo 'le Mdp '. $mdp . ' de '. $unVisiteur['nom']. 'a été hasher => ' . $hashMdp . "\r\n";

}

foreach ($comptables as $unComptable){
    $mdp = $unComptable['mdp'];
    $hashMdp = password_hash($mdp, PASSWORD_DEFAULT);
    $id = $unComptable['id'];
    $req = $pdo->prepare('UPDATE comptable SET mdp= :hashMdp  WHERE id= :unId ');
    $req->bindParam(':hashMdp', $hashMdp, PDO::PARAM_STR);
    $req->bindParam(':unId', $id, PDO::PARAM_STR);
    $req->execute();
    echo 'le Mdp '. $mdp . ' de '. $unComptable['nom']. 'a été hasher => ' . $hashMdp . "\r\n";
}