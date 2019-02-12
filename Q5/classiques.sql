USE dev_web;
CREATE TABLE classiques (
 auteur VARCHAR(128),
 titre VARCHAR(128),
 categorie VARCHAR(16),
 annee SMALLINT,
 isbn CHAR(13),
 INDEX(auteur(20)),
 INDEX(titre(20)),
 INDEX(categorie(4)),
 INDEX(annee),
 PRIMARY KEY (isbn)) ENGINE MyISAM CHARSET utf8;

