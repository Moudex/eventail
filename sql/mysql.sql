DROP TABLE IF EXISTS galette_event_individu;
CREATE TABLE IF NOT EXISTS galette_event_individu (
    individu_id int(10) unsigned NOT NULL,
    alcool tinyint(1) NOT NULL DEFAULT 1,
    viande tinyint(1) NOT NULL DEFAULT 1,
    hallal tinyint(1) NOT NULL DEFAULT 0,
    voiture tinyint(1) NOT NULL DEFAULT 0,
    velo tinyint(1) NOT NULL DEFAULT 0,
    commentaire varchar(255),
    PRIMARY KEY (individu_id)
)ENGINE=InnoDB ;


DROP TABLE IF EXISTS galette_event_event;
CREATE TABLE IF NOT EXISTS galette_event_event (
    event_id int(10) unsigned NOT NULL AUTO_INCREMENT,
    nom varchar(25) NOT NULL,
    dateEvent datetime NOT NULL,
    ouvertureInsc datetime NOT NULL,
    fermetureInsc datetime NOT NULL,
    lieu varchar(255),
    description text,
    prixParticipation integer NOT NULL DEFAULT 5,
    nbPlaces integer NOT NULL DEFAULT 100,
    PRIMARY KEY (event_id)
)ENGINE=InnoDB ;

DROP TABLE IF EXISTS galette_event_participe;
CREATE TABLE IF NOT EXISTS galette_event_participe (
    participe_id int(10) unsigned NOT NULL AUTO_INCREMENT,
    paye tinyint(1) NOT NULL DEFAULT 0,
    datePaye datetime,
    commentaire varchar(255),
    event_id int(10) unsigned NOT NULL,
    individu_id int(10) unsigned NOT NULL,
    PRIMARY KEY (participe_id),
    KEY event_id (event_id),
    KEY individu_id (individu_id)
)ENGINE=InnoDB ;

ALTER TABLE galette_event_individu
    ADD CONSTRAINT FK_event_individu_1 FOREIGN KEY (individu_id) REFERENCES galette_adherents (id_adh) ON DELETE NO ACTION ON UPDATE NO ACTION;
