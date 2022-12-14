USE gsb_frais;
DROP TABLE IF EXISTS COMPTABLE;

CREATE TABLE IF NOT EXISTS comptable (
	id Char(4) NOT NULL,
    nom char(30) DEFAULT NULL,
    prenom char(30)  DEFAULT NULL,
    login char(20) DEFAULT NULL,
    mdp char(255) DEFAULT NULL,
    email Text DEFAULT NULL,
    codea2f CHAR(4) DEFAULT NULL,
    CONSTRAINT PK_COMPTABLE PRIMARY KEY (ID)
);

# mdp = azerty
INSERT INTO COMPTABLE VALUES ('F3d7', 'ralie','leo','leoralie','$2y$10$jNirelhMBPNo64aCGO0pOezXofKZTbEQHgMAsA2M/UD9/FlUHhzWi','test.mail@gmail.com',NULL);

