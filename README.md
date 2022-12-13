# Avancée :

- Planifier les tâches avec Trello
- Mettre à jour PHP > 8 (click sur logo Wamp en barre des tâches => PHP => Version => Sélectionner PHP 8)
- Mettre le PATH de PHP 8.1 dans variable d'environnement windows
- Créer un virtualhost avec le chemin du projet pointant sur le répertoire 'public'
- Importer et lancer le script 'resources\bdd\gsb_restore.sql' dans PHPMyAdmin / MySQL Workbench
- Lancer la commande 'php majGSB.php' dans le dossier '/bin/gendatas'
- Bug corrigé sur fiche de frais hors forfait mal renseigné
- Hashage de mot de passe : "echo password_hash('password', PASSWORD_BCRYPT, ['cost' => 12]);"
- Pour mail depuis serveur : composer require sendinblue/api-v3-sdk "8.3.1"
- Spécifier chemin du fichier resources/cacert.pem dans wamp64/bin/apache/apachexxx/bin/php.ini
	(curl.cainfo="Chemin/Vers/cacert.pem" et openssl.cafile="Chemin/Vers/cacert.pem" (décommenté))

# Documents principaux :

Fichier PDF :
- Partie 1 = Infos sur le contexte de l'entreprise
- Partie 2 = Infos sur l'appli existante
- Partie 3 = Infos sur les missions à réaliser
- Partie 4 = Documents pour les missions


# PRESENTATION DU CONTEXTE :

Galaxy Swiss Bourdin (GSB) = Laboratoire médical / Conglomérat international / fusion de plusieurs organismes = Mélange diforme (Galaxy + Swiss-Bourdin).
Galaxy = Américain et Swiss Bourdin = Conglomérat européen

Conglomérat = Ensemble d'entreprises réunies par des liens juridiques et financiers plus ou moins précis et s'adonnant à des activités très diverses ayant parfois peu de rapport entre elles.
Visiteurs médicaux = Démarcheurs / vendeurs de médicaments.

La France est le témoin pour l’amélioration du suivi de l’activité de visite. 480 visiteurs médicaux en France métropolitaine et 60 en outre-mer français. GSB Europe a son siège administratif à Paris.

Différences entre les visiteurs des deux entreprises à corriger :
Galaxy = Carte bancaire au nom de l'entreprise, Swiss-Boudin = Gestion forfaitaire puis remboursement après retour des pièces justificatives.

# OBJECTIFS DE L’ENTREPRISE :

- Améliorer le contact entre acteurs mobiles autonomes et les différents services du siège parisien de l'entité Europe : Uniformiser la gestion du suivi des frais et des visites.

- Moderniser l’activité de visite médicale que ça soit au niveau personnel ou administratif (thème bleu pour personnels, thème orange pour comptables).

- Intégrer les données de la partie commerciale pour : Obtenir une vision plus régulière et efficace de l'activité menée sur le terrain auprès des praticiens,
mais aussi redonner confiance aux équipes malmenées par les fusions récentes.

- Gestion unique des frais de remboursement pour l'ensemble de la flotte visite

- Accès direct aux données du personnel

# TÂCHES CONCRETES :

- Stocker l’information en provenance des visiteurs.
- Gérer les frais de déplacemement, de restauration et d'hébergement générés par l'activité de visite médicale.
- Permettre aux visiteurs d'inscrire leurs dépenses, visualiser la prise en charge des remboursements (enregistré, validé, remboursé).
- Veiller au respect du RGPD.
- Respecter les bonnes pratiques de développement, architecture dossiers, MVC, etc (Document 2, séquence 4).
- Au plus tard le 20 de chaque mois, le service comptable adresse aux visiteurs la fiche de demande de remboursement pour le mois en cours.
- Hasher les mots de passes.
- Ne générer qu’une seule fois les fichiers PDF.
- Utiliser un serveur web et développer sous PHP.
- Coder la partie comptable en respectant le cas d’utilisation correspondant.

# OUTILS :
- IDE NetBeans
- Langage PHP (version > 8)
- Serveur web + MariaDB (login PhpMyAdmin = 'root' + '' et y importer fichier 'resources/bdd/gsb_restore.sql' après avoir créé 'userGsb')
- MVC : Modèle contient les données à afficher, Vue contient la présentation de l’interface graphique, Contrôleur contient la logique des actions utilisateurs.

#Debugger PHP7 Netbeans Xampp :
https://bitbucket.org/guimotri/debugger-php7-avec-netbeans-8.2-et-xampp/src/master/

# Requêtes SQL utiles :

-- Liste les utilisateurs :

SELECT user FROM mysql.user;


-- Créer un nouvel utilisateur 'userGsb' avec le mot de passe 'secret' :

CREATE USER userGsb@localhost IDENTIFIED BY 'secret';


-- Donne TOUS les droits à l'utilisateur 'userGsb', sur toutes les tables de la BDD 'gsb_frais' :

GRANT ALL PRIVILEGES ON gsb_frais.* TO 'userGsb'@'localhost';


-- Actualise les privilèges :

FLUSH PRIVILEGES;


-- Montre les privilèges pour userGsb :

SHOW GRANTS FOR 'userGsb'@'localhost';


-- Modifie une colonne pour y stocker un hash

ALTER TABLE nomTableUtilisateurs
MODIFY COLUMN passwordColumn VARCHAR(255);


UPDATE nomTableUtilisateurs
SET passwordColumn = hash
WHERE id = idChoisi;


# Bonus PowerShell :

#Trouver un fichier :
Get-ChildItem -Recurse nomFichier

#Trouver un fichier contenant un texte recherché :
Get-ChildItem -Recurse | Select-String "Ici le texte à chercher" -List | Select Path
