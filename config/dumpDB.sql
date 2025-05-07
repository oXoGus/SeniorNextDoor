CREATE TABLE ehpad(
   id_ehpad serial,
   nom VARCHAR(50) ,
   localisation VARCHAR(75),
   num_tel VARCHAR(14),
   PRIMARY KEY(id_ehpad)
);

INSERT INTO ehpad (id_ehpad, nom, localisation, num_tel) VALUES (1, 'NOISY-EHPAD', '17 Rue de la Croix Biche, 93160', '01 20 30 40 50');

CREATE TABLE statut(
   code_statut CHAR(3) ,
   lib_statut VARCHAR(50) ,
   PRIMARY KEY(code_statut)
);

INSERT INTO statut (code_statut, lib_statut) VALUES 
('NPD', 'ne pas déranger'), 
('INA', 'inactif'),
('HOL', 'hors ligne'),
('ENL', 'en ligne');

CREATE TABLE evenement_perso(
   lib_evenement SMALLINT,
   date_rdv TIMESTAMP,
   PRIMARY KEY(lib_evenement)
);

CREATE TABLE utilisateur(
   id SERIAL,
   nom VARCHAR(50) ,
   prenom VARCHAR(50) ,
   date_naissance DATE,
   pseudo VARCHAR(50) NOT NULL UNIQUE,
   date_inactif TIMESTAMP,
   avatar BYTEA,
   avatar_img_type TEXT,
   bio VARCHAR(50) ,
   loisir VARCHAR(50) ,
   sexe CHAR(1) ,
   code_statut CHAR(3) NOT NULL,
   id_ehpad SMALLINT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(code_statut) REFERENCES statut(code_statut),
   FOREIGN KEY(id_ehpad) REFERENCES ehpad(id_ehpad)
);

CREATE TABLE calendrier(
   id_evenement SERIAL,
   event VARCHAR(50) ,
   nbinscrit INTEGER,
   date_e TIMESTAMP,
   lieu VARCHAR(50) ,
   PRIMARY KEY(id_evenement)
);

CREATE TABLE compte(
   login VARCHAR(25),
   mdp VARCHAR(50),
   id integer,
   PRIMARY KEY(login),
   UNIQUE(id),
   FOREIGN KEY(id) REFERENCES utilisateur(id)
);

CREATE TABLE message(
   id_emeteur integer,
   id_destinataire INTEGER,
   date_message TIMESTAMP,
   contenu_message VARCHAR(200) ,
   vue integer ,
   PRIMARY KEY(id_emeteur, id_destinataire, date_message),
   FOREIGN KEY(id_emeteur) REFERENCES utilisateur(id),
   FOREIGN KEY(id_destinataire) REFERENCES utilisateur(id)
);

CREATE TABLE ami(
   id_utilisateur INTEGER,
   id_ami INTEGER,
   date_ajout TIMESTAMP,
   PRIMARY KEY(id_utilisateur, id_ami),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id),
   FOREIGN KEY(id_ami) REFERENCES utilisateur(id)
);

CREATE TABLE bloquer(
   id_utilisateur integer,
   id_utilisateur_bloque integer,
   PRIMARY KEY(id_utilisateur, id_utilisateur_bloque),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id),
   FOREIGN KEY(id_utilisateur_bloque) REFERENCES utilisateur(id)
);

CREATE TABLE calendrier_perso(
   id_utilisateur INTEGER,
   lib_evenement SMALLINT,
   PRIMARY KEY(id_utilisateur, lib_evenement),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id),
   FOREIGN KEY(lib_evenement) REFERENCES evenement_perso(lib_evenement)
);
