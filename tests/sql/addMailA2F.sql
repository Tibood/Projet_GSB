SHOW DATABASES;
USE gsb_frais_cyber;

SET SQL_SAFE_UPDATES=0;

ALTER TABLE visiteur ADD email TEXT NULL;
UPDATE visiteur SET email = CONCAT(login,"@swiss-galaxy.com");

SELECT login, email, codea2f FROM visiteur;
SET SQL_SAFE_UPDATES=1;

ALTER TABLE visiteur ADD codea2f CHAR(4);

SELECT codea2f FROM visiteur;
SELECT * FROM visiteur;

