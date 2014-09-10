DROP TABLE IF EXISTS galette_event_individu;
CREATE TABLE IF NOT EXISTS galette_event_individu (
    individu_id int(10) unsigned NOT NULL AUTO_INCREMENT,
    id_adherent int(10) unsigned NOT NULL,
    nourriture varchar(25) DEFAULT NULL,
    boisson varchar(25) DEFAULT NULL,
    voiture tinyint(1) NOT NULL,
    PRIMARY KEY (individu_id),
    KEY id_adherent (id_adherent)
)ENGINE=InnoDB ;


DROP TABLE IF EXISTS galette_event_event;
CREATE TABLE IF NOT EXISTS galette_event_event (
    event_id int(10) unsigned NOT NULL AUTO_INCREMENT,
    nom varchar(25) NOT NULL,
    dateEvent datetime NOT NULL,
    ouvertureInsc datetime,
    fermetureInsc datetime,
    lieu varchar(255),
    description text,
    prixParticipation integer,
    nbPlaces integer,
    PRIMARY KEY (event_id)
)ENGINE=InnoDB ;

DROP TABLE IF EXISTS galette_event_participe;
CREATE TABLE IF NOT EXISTS galette_event_participe (
    participe_id int(10) unsigned NOT NULL AUTO_INCREMENT,
    dateParticipe datetime NOT NULL,
    commentaire text,
    individu int(10) unsigned NOT NULL,
    event int(10) unsigned NOT NULL,
    PRIMARY KEY (participe_id),
    KEY individu (individu),
    KEY event (event)
)ENGINE=InnoDB ;

ALTER TABLE galette_event_individu
    ADD CONSTRAINT FK_event_individu_1 FOREIGN KEY (id_adherent) REFERENCES galette_adherents (id_adh) ON DELETE NO ACTION ON UPDATE NO ACTION;
