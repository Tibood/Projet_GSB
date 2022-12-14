use gsb_frais;

drop table if exists vehicule;
create table if not exists vehicule
(
	id int not null auto_increment,
    libelle varchar(50) null,
    prixaukilometre float null,
    PRIMARY KEY (id)
)ENGINE=InnoDB;

insert into vehicule (id,libelle,prixaukilometre) Values
(1,"Véhicule 4CV Diesel",0.52),
(2,"Véhicule 5/6CV Diesel",0.58),
(3,"Véhicule 4CV Essence",0.62),
(4,"Véhicule 5/6CV Essence",0.67);

alter table visiteur
add idvehicule int null,
add constraint FK_visiteur_vehicule FOREIGN KEY (idvehicule) REFERENCES vehicule(id) on delete cascade;

SET SQL_SAFE_UPDATES = 0;
UPDATE visiteur
SET idvehicule = FLOOR(RAND() * 4) + 1;
SET SQL_SAFE_UPDATES = 1;

select * from visiteur;
select * from vehicule;

