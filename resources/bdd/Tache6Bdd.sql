ALTER TABLE `gsb_frais`.`visiteur` 
ADD COLUMN `typeVehicule` VARCHAR(45) NOT NULL DEFAULT '4CV Diesel' COMMENT 'Le type du vehicule qui influencent le frais kilomètrique\n' AFTER `email`;
