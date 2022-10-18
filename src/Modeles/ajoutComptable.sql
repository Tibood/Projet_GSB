USE gsb_frais;
DROP TABLE IF EXISTS COMPTABLE;

CREATE TABLE IF NOT EXISTS COMPTABLE (
    LIBELLE VARCHAR(50) NOT NULL,
    IDVISITEUR CHAR(4) NOT NULL,
    CONSTRAINT PK_COMPTABLE PRIMARY KEY (LIBELLE, IDVISITEUR),
    CONSTRAINT FK_COMPTABLE_VISITEUR FOREIGN KEY (IDVISITEUR)
		REFERENCES VISITEUR (ID)
);

INSERT INTO COMPTABLE VALUES ('Comptable', 'f4');
INSERT INTO COMPTABLE VALUES ('Comptable', 'f39');

SELECT Visiteur.mdp FROM Visiteur
INNER JOIN COMPTABLE 
ON COMPTABLE.IDVISITEUR = Visiteur.id
<<<<<<< HEAD
WHERE COMPTABLE.LIBELLE = 'Comptable';

SELECT COUNT(*) AS nbPasComptable
FROM Visiteur
WHERE Visiteur.id NOT IN 
(SELECT COMPTABLE.IDVISITEUR FROM COMPTABLE);
=======
WHERE COMPTABLE.LIBELLE = 'Comptable';
>>>>>>> 6a78f3189e3732ff8584e608831a7d434b81c3c9
