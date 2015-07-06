drop table if exists Categoria;
drop table if exists Sconto;
drop table if exists Scaglione;
drop table if exists Dipendente;
drop table if exists Prodotto;
drop table if exists Scontrino;
drop table if exists Iscritto;
drop table if exists Fornitore;
drop table if exists Fattura;
drop table if exists Registrato;
drop table if exists Certifica;

CREATE TABLE Categoria (
NomeCategoria	CHAR(50),

PRIMARY KEY (NomeCategoria)
) ENGINE=InnoDB;

CREATE TABLE Sconto (
Id	INT AUTO_INCREMENT,
Livello SMALLINT DEFAULT 0 NOT NULL,
PercSconto	INT(2) DEFAULT 0 NOT NULL,
TettoMax	SMALLINT,

PRIMARY KEY(Id)
) ENGINE=InnoDB;

CREATE TABLE Scaglione (
Categoria	CHAR(50),
Sconto	INT,

PRIMARY KEY (Categoria,Sconto),
FOREIGN KEY (Categoria) REFERENCES Categoria (NomeCategoria)
ON DELETE CASCADE,
FOREIGN KEY (Sconto) REFERENCES Sconto(Id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE Dipendente(
CodDipendente	INT AUTO_INCREMENT,
Nome		CHAR(15) NOT NULL,
Cognome		CHAR(15) NOT NULL,
DataNascita	DATE NOT NULL,
CodFiscale	CHAR(16) NOT NULL,
Telefono	CHAR(10) NOT NULL,
Mail		CHAR(50),
DataInizio	DATE NOT NULL,
Indirizzo	CHAR(50) NOT NULL,
Categoria	CHAR(20),
Password     CHAR(64) NOT NULL,

PRIMARY KEY (CodDipendente),
FOREIGN KEY (Categoria) REFERENCES Categoria (NomeCategoria)
ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE Prodotto(
CodProdotto  INT AUTO_INCREMENT,
Nome	     CHAR(50) NOT NULL,
Descrizione  TEXT,
Quantita     SMALLINT DEFAULT 0 NOT NULL,
Costo	     DECIMAL(8,2) DEFAULT 0 NOT NULL,
PercentualeIVA	 INT(2) DEFAULT 0 NOT NULL,
Categoria	 CHAR(20),

PRIMARY KEY (CodProdotto),
FOREIGN KEY (Categoria) REFERENCES Categoria(NomeCategoria)
) ENGINE=InnoDB;

CREATE TABLE Iscritto(
CodIscritto  INT AUTO_INCREMENT,
Nome	     CHAR(20) NOT NULL,
Cognome	     CHAR(20) NOT NULL,
Fax	     CHAR(10),
Telefono     CHAR(10) NOT NULL,
Mail	     CHAR(50) NOT NULL,
Indirizzo    CHAR(50) NOT NULL,
Password     CHAR(64) NOT NULL,

PRIMARY KEY (CodIscritto)
) ENGINE=InnoDB;

CREATE TABLE Scontrino (
Id	INT AUTO_INCREMENT,
Data	DATE NOT NULL,
CodScontrino	INT NOT NULL,
Quantita	SMALLINT NOT NULL,
SubTotale	DECIMAL(8,2) NOT NULL,
Iscritto	INT,

PRIMARY KEY (Id),
FOREIGN KEY (Iscritto) REFERENCES Iscritto(CodIscritto)
ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE Certifica (
Prodotto	INT,
Scontrino	INT,

PRIMARY KEY (Prodotto, Scontrino),
FOREIGN KEY (Prodotto) REFERENCES Prodotto (CodProdotto),
FOREIGN KEY (Scontrino) REFERENCES Scontrino (Id)
) ENGINE = InnoDB;

CREATE TABLE Fornitore(
Nome   CHAR(50),
Fax    CHAR(10),
Telefono	CHAR(10) NOT NULL,
Mail		CHAR(50) NOT NULL,
Indirizzo	CHAR(50) NOT NULL,

PRIMARY KEY (Nome)
) ENGINE=InnoDB;

CREATE TABLE Fattura(
Id	INT AUTO_INCREMENT,
CodFattura	INT NOT NULL,
Data	DATE NOT NULL,
Quantita	SMALLINT NOT NULL,
Fornitore	CHAR(50),

PRIMARY KEY (Id),
FOREIGN KEY (Fornitore) REFERENCES Fornitore (Nome) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE Registrato(
Prodotto	INT,
Fattura		INT,

PRIMARY KEY (Prodotto, Fattura),
FOREIGN KEY (Prodotto) REFERENCES Prodotto (CodProdotto),
FOREIGN KEY (Fattura) REFERENCES Fattura (Id)
) ENGINE = InnoDB;
