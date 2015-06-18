drop table if exists Categoria;
drop table if exists Sconto;
drop table if exists Scaglioni;
drop table if exists Dipendente;
drop table if exists Prodotto;
drop table if exists Scontrino;
drop table if exists Iscritto;
drop table if exists Fornitore;
drop table if exists Fattura;

CREATE TABLE Categoria(
NomeCategoria	CHAR(20) PRIMARY KEY
) ENGINE=InnoDB;

CREATE TABLE Scaglioni(
Categoria    CHAR(20),
Livello	     SMALLINT,

PRIMARY KEY (Categoria, Livello),
FOREIGN KEY (Categoria) REFERENCES Categoria (NomeCategoria),
FOREIGN KEY (Livello) REFERENCES Sconto (Livello)
) ENGINE=InnoDB;

CREATE TABLE Sconto(
Categoria    CHAR(20),
Livello	     SMALLINT,
PercentualeSconto INT(2) DEFAULT 0 NOT NULL,
TettoMax	  SMALLINT,

PRIMARY KEY (Categoria,Livello),
FOREIGN KEY (Categoria) REFERENCES Scaglioni (Categoria)
) ENGINE=InnoDB;

CREATE TABLE Dipendente(
CodDipendente	SMALLINT,
Nome		CHAR(15) NOT NULL,
Cognome		CHAR(15) NOT NULL,
DataNascita	DATE NOT NULL,
CodFiscale	CHAR(16) NOT NULL,
Telefono	CHAR(10) NOT NULL,
Mail		CHAR(50),
DataInizio	DATE NOT NULL,
Indirizzo	CHAR(50),
Categoria	CHAR(20),

PRIMARY KEY (CodDipendente),
FOREIGN KEY (Categoria) REFERENCES Categoria (NomeCategoria)
) ENGINE=InnoDB;

CREATE TABLE Prodotto(
CodProdotto  INT AUTO_INCREMENT,
Nome	     CHAR(50) NOT NULL,
Descrizione  TEXT,
Quantita     SMALLINT DEFAULT 0 NOT NULL,
Costo	     INT DEFAULT 0 NOT NULL,
PercentualeIVA	 INT(2) DEFAULT 0 NOT NULL,
Foto		 MEDIUMBLOB,
Categoria	 CHAR(20),

PRIMARY KEY (CodProdotto),
FOREIGN KEY (Categoria) REFERENCES Categoria(NomeCategoria)
) ENGINE=InnoDB;

CREATE TABLE Scontrino(
Prodotto     INT,
Data	     DATE,
CodScontrino INT,
Quantita     SMALLINT NOT NULL,
SubTotale    INT NOT NULL,
Iscritto     INT,

PRIMARY KEY (Prodotto,Data,CodScontrino),
FOREIGN KEY (Prodotto) REFERENCES Prodotto (CodProdotto),
FOREIGN KEY (Iscritto) REFERENCES Iscritto (CodIscritto)
) ENGINE=InnoDB;

CREATE TABLE Certifica(
Prodotto     INT,
Data	     Date,
CodScontrino    INT,

PRIMARY KEY (Prodotto, Data, Scontrino)
FOREIGN KEY (Prodotto) REFERENCES Prodotto (CodProdotto),
FOREIGN KEY (Data,CodScontrino) REFERENCES Scontrino (Data,CodScontrino),
) ENGINE = InnoDB;

CREATE TABLE Iscritto(
CodIscritto  INT AUTO_INCREMENT,
Nome	     CHAR(20) NOT NULL,
Cognome	     CHAR(20) NOT NULL,
Fax	     CHAR(20),
Telefono     CHAR(20),
Mail	     CHAR(20),
Indirizzo    CHAR(50),

PRIMARY KEY (CodIscritto)
) ENGINE=InnoDB;

CREATE TABLE Fornitore(
Nome   CHAR(50),
Fax    CHAR(10),
Telefono	CHAR(10) NOT NULL,
Mail		CHAR(10) NOT NULL,
Indirizzo	CHAR(50) NOT NULL,

PRIMARY KEY (Nome)
) ENGINE=InnoDB;

CREATE TABLE Fattura(
Prodotto     INT,
CodFattura   INT,
Data	     DATE,
Quantita     SMALLINT,
Fornitore    CHAR(50),

PRIMARY KEY (Prodotto,CodFattura),
FOREIGN KEY (Prodotto) REFERENCES Registrato (CodProdotto),
FOREIGN KEY (Fornitore) REFERENCES Fornitore (Nome)
) ENGINE = InnoDB;

CREATE TABLE Registrato(
Prodotto     INT,
Fattura	     INT,

PRIMARY KEY (Prodotto,Fattura),
FOREIGN KEY (Prodotto) REFERENCES Prodotto (CodProdotto),
FOREIGN KEY (Fattura) REFERENCES Fattura (CodFattura)
) ENGINE=InnoDB;
