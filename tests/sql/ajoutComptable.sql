USE gsb_frais;
DROP TABLE IF EXISTS COMPTABLE;

CREATE TABLE IF NOT EXISTS COMPTABLE (
	id Char(4) NOT NULL,
    nom char(30) DEFAULT NULL,
    prenom char(30)  DEFAULT NULL,
    login char(20) DEFAULT NULL,
    mdp char(255) DEFAULT NULL,
    email Text DEFAULT NULL,
    codea2f CHAR(4) DEFAULT NULL,
    CONSTRAINT PK_COMPTABLE PRIMARY KEY (ID)
);

INSERT INTO COMPTABLE VALUES ('F3d7', 'ralie','leo','leoralie','azerty','test.mail@gmail.com',NULL);

select * from comptable;
-- --------------------------------
SELECT COUNT(*) AS nbPasComptable
FROM Visiteur
WHERE Visiteur.id NOT IN 
(SELECT COMPTABLE.IDVISITEUR FROM COMPTABLE);

SELECT * FROM visiteur;

ALTER TABLE visiteur
MODIFY COLUMN mdp VARCHAR(255);

UPDATE visiteur 
SET mdp = '$2y$12$EdJlIhnJ1zpFx6GnVZnrOu4jzuujaJmCrUbEtnNgkPDr.EVkErR/a'
WHERE id = 'a131';
>>>>>>> origin/branch_Adrien
