<php
include('config.php');

DROP TABLE IF EXISTS news ;

CREATE TABLE  `siteJulien`.`news` (
`news_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`news_titre` VARCHAR( 255 ) NOT NULL ,
`news_auteur` VARCHAR( 255 ) NOT NULL,
`news_contenu` TEXT NOT NULL
)
CREATE TABLE  `siteJulien`.`membres` (
`login` VARCHAR( 30 ) PRIMARY KEY ,
`password` VARCHAR( 30 ) NOT NULL ,
`membres_nom` VARCHAR( 30 ) NOT NULL ,
`membres_prenom` VARCHAR( 30 ) NOT NULL ,
)