CREATE TABLE usager(
	id_usager int AUTO_INCREMENT,
    nom_usager varchar(15)NOT NULL, 
    password varchar(255),
    profil_usager TINYINT(1),
    PRIMARY KEY(id_usager)    
    );
    ALTER TABLE usager ENGINE=INNODB;
	
CREATE TABLE sujet(
    id_sujet int AUTO_INCREMENT,
	id_usager int,
	title varchar(64),
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id_sujet),
    FOREIGN KEY(id_usager) REFERENCES usager(id_usager)
	);
    ALTER TABLE sujet ENGINE=INNODB;

CREATE TABLE message(
	id_message int AUTO_INCREMENT,
	id_usager int,
	id_sujet int,
	message_title varchar(64),
	message text,
	date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id_message),
    FOREIGN KEY (id_usager) REFERENCES usager(id_usager),
    FOREIGN KEY (id_sujet) REFERENCES sujet(id_sujet)
	);
	ALTER TABLE message ENGINE=INNODB;
	
/* 
	CREATE ADMIN ACCOUNT
	username: admin
	password: test
*/
INSERT INTO `usager` (`id_usager`, `nom_usager`, `password`, `profil_usager`) VALUES
(1, 'admin', '$2y$10$qoRPySKxZdf1fbADTidISuLU5nIH6miEnfkINkRyb6a1lTrpCAydu', 1);