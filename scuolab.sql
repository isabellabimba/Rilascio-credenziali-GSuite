-- create an empty database. Name of the database:
SET default_storage_engine=InnoDB;
SET FOREIGN_KEY_CHECKS=1;
CREATE DATABASE IF NOT EXISTS Database_Allievi;

-- use Database_Allievi
use Database_Allievi;

-- drop tables if they already exist
DROP TABLE IF EXISTS Dati;
DROP TABLE IF EXISTS Alunni_Genitori;

SET AUTOCOMMIT=0;
START TRANSACTION;

-- create tables
CREATE TABLE Dati (
	Cognome CHAR(50) NOT NULL ,
  	Nome CHAR(50) NOT NULL ,
	Classe CHAR(50) NOT NULL ,
	Sezione CHAR(5) NOT NULL,
  	Anno INTEGER NOT NULL,
  	Gruppo CHAR(10) NOT NULL,
  	Email CHAR(100) NOT NULL,
  	Password CHAR(50) NOT NULL,
	PRIMARY KEY (Nome1, Cognome1, Email, Password)
);

CREATE TABLE Fine(
	GruppoS CHAR(20) NOT NULL,
	Scuola_Classe CHAR(70) NOT NULL,
	Cognome2 CHAR(50) NOT NULL,
	Nome2 CHAR(50) NOT NULL,
  	CodFisc CHAR(50) NOT NULL,
	CodiceStud CHAR(15) NOT NULL,
	PRIMARY KEY (Nome2, Cognome2, CodFisc, CodiceStud)
);


COMMIT;
START TRANSACTION;
