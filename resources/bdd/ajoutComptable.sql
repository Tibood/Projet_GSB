USE gsb_frais;
drop table metiers;
DROP TABLE IF exists Roles;
CREATE TABLE Roles (	
	IDVISITEUR CHAR(4) NOT NULL,
    Role VARCHAR(50) NOT NULL,
    
    CONSTRAINT PK_Roles PRIMARY KEY (IDVISITEUR,Role),
    CONSTRAINT FK_Roles_VISITEUR FOREIGN KEY (IDVISITEUR)
		REFERENCES VISITEUR (ID)
);
insert into metiers value ('f4','Comptable');
insert into metiers value ('f39','Comptable');

/*
Solution n°1
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
WHERE COMPTABLE.LIBELLE = 'Comptable';
*/

-----------------------------------------------------------
/* 
solution 2
Drop table if exists metiers;
create Table metiers (
    IdVisiteur VARCHAR(20) NOT NULL,
    IdRoles int not null,
    constraint PK_Metiers primary key (IdVisiteur,IdMetier),
    Constraint FK_Metier_Roles foreign key (IdRoles)
        references roles(id),
    Constraint FK_roles_visiteur foreign key (IdVisiteur)
        references Visiteur(id)
);

Drop table if exists roles;
create table roles (
    id int not null auto_increment,
    libelle varchar (30) not null,
    constraint PK_roles primary key (id)
);

insert into roles value (1,'Comptable');
insert into metiers value ('f4',1);
insert into metiers value ('f39',1);


Select visiteur.nom,visiteur.prenom
from visiteur inner join metiers
on visiteur.id = metiers.IdVisiteur
where metiers.IdMetier = 1;

*/

