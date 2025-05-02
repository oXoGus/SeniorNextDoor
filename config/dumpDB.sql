CREATE TABLE ephad(
   id_ephad serial,
   nom VARCHAR(50) ,
   localisation VARCHAR(75) ,
   PRIMARY KEY(id_ephad)
);

CREATE TABLE statut(
   code_statut CHAR(3) ,
   lib_statut VARCHAR(50) ,
   PRIMARY KEY(code_statut)
);

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
   pseudo VARCHAR(50) ,
   date_inactif TIMESTAMP,
   avatar BYTEA,
   bio VARCHAR(50) ,
   loisir VARCHAR(50) ,
   sexe CHAR(1) ,
   code_statut CHAR(3) NOT NULL,
   id_ephad SMALLINT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(code_statut) REFERENCES statut(code_statut),
   FOREIGN KEY(id_ephad) REFERENCES ephad(id_ephad)
);

CREATE TABLE calendrier(
   id_evenement SERIAL,
   event VARCHAR(50) ,
   nbinscrit INTEGER,
   date_e TIMESTAMP,
   lieu VARCHAR(50) ,
   id INTEGER NOT NULL,
   PRIMARY KEY(id_evenement),
   FOREIGN KEY(id) REFERENCES utilisateur(id)
);

CREATE TABLE compte(
   login VARCHAR(25),
   mdp VARCHAR(20),
   id serial,
   PRIMARY KEY(login),
   UNIQUE(id),
   FOREIGN KEY(id) REFERENCES utilisateur(id)
);

CREATE TABLE message(
   id_emeteur serial,
   id_destinataire INTEGER,
   id_message serial,
   date_message TIMESTAMP,
   contenu_message VARCHAR(200) ,
   vue integer ,
   PRIMARY KEY(id_emeteur, id_destinataire),
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
   id_autre_utilisateur integer,
   PRIMARY KEY(id_utilisateur, id_autre_utilisateur),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id),
   FOREIGN KEY(id_autre_utilisateur) REFERENCES utilisateur(id)
);

CREATE TABLE calendrier_perso(
   id_utilisateur INTEGER,
   lib_evenement SMALLINT,
   PRIMARY KEY(id_utilisateur, lib_evenement),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id),
   FOREIGN KEY(lib_evenement) REFERENCES evenement_perso(lib_evenement)
);
