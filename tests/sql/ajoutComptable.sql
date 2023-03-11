USE gsb_frais;

DROP TABLE IF EXISTS Comptable;

SELECT codea2f FROM gsb_frais.VIsIteUr WHERE login = 'lvillachane';
SELECT codea2f FROM gsb_frais.Comptable WHERE login = 'tbro';

CREATE TABLE IF NOT EXISTS Comptable(
	id INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    login VARCHAR(20) NOT NULL,
    mdp VARCHAR(255) NOT NULL,
    email TEXT NOT NULL,
    codea2f CHAR(4) DEFAULT NULL,
    PRIMARY KEY (id)
);

# mdp = azerty
INSERT INTO Comptable (id, nom, prenom, login, mdp, email, codea2f) VALUES(
    1,
    "Brouillet",
    "Thibaud",
    "tbro",
    "$2y$10$F5LK4IlxbvmfK/WJ15LBIeVAR7wQfNTyLrSB4cK6ekVfJm0U6ltSi",
    "tbrouillet@swiss-galaxy.com",
    null
);

SELECT * FROM Comptable;