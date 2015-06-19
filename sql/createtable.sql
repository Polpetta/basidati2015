drop table if exists Categoria;
drop table if exists Sconto;
drop table if exists Scaglione;
drop table if exists Dipendente;
drop table if exists Prodotto;
drop table if exists Scontrino;
drop table if exists Iscritto;
drop table if exists Fornitore;
drop table if exists Fattura;

drop trigger if exists Categoria_Scaglione;

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
FOREIGN KEY (Categoria) REFERENCES Categoria (NomeCategoria) ON DELETE CASCADE,
FOREIGN KEY (Sconto) REFERENCES Sconto(Id) ON DELETE CASCADE
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
Indirizzo	CHAR(50) NOT NULL,
Categoria	CHAR(20),

PRIMARY KEY (CodDipendente),
FOREIGN KEY (Categoria) REFERENCES Categoria (NomeCategoria) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE Prodotto(
CodProdotto  INT AUTO_INCREMENT,
Nome	     CHAR(50) NOT NULL,
Descrizione  TEXT,
Quantita     SMALLINT DEFAULT 0 NOT NULL,
Costo	     DECIMAL(5,2) DEFAULT 0 NOT NULL,
PercentualeIVA	 INT(2) DEFAULT 0 NOT NULL,
Foto		 MEDIUMBLOB,
Categoria	 CHAR(20),

PRIMARY KEY (CodProdotto),
FOREIGN KEY (Categoria) REFERENCES Categoria(NomeCategoria) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE Iscritto(
CodIscritto  INT AUTO_INCREMENT,
Nome	     CHAR(20) NOT NULL,
Cognome	     CHAR(20) NOT NULL,
Fax	     CHAR(20),
Telefono     CHAR(20) NOT NULL,
Mail	     CHAR(20),
Indirizzo    CHAR(50) NOT NULL,

PRIMARY KEY (CodIscritto)
) ENGINE=InnoDB;

CREATE TABLE Scontrino(
Prodotto     INT,
Data	     DATE,
CodScontrino INT,
Quantita     SMALLINT NOT NULL,
SubTotale    DECIMAL(5,2) NOT NULL,
Iscritto     INT,

PRIMARY KEY (Prodotto,Data,CodScontrino)
) ENGINE=InnoDB;

CREATE INDEX IScontrino
ON Scontrino (Prodotto);

CREATE INDEX IScontrino2
ON Scontrino (Data,CodScontrino);

CREATE TABLE Certifica(
Prodotto     INT,
Data	     Date,
CodScontrino    INT,

PRIMARY KEY (Prodotto, Data, CodScontrino)
) ENGINE = InnoDB;

CREATE INDEX ICertifica
ON Certifica (Prodotto);

CREATE INDEX ICertifica2
ON Certifica (Data,CodScontrino);

ALTER TABLE Scontrino
      ADD CONSTRAINT fkScontrino_Certifica FOREIGN KEY (Prodotto) REFERENCES Certifica (Prodotto),
      ADD CONSTRAINT fkScontrino_Iscritto FOREIGN KEY (Iscritto) REFERENCES Iscritto (CodIscritto) ON DELETE CASCADE;

ALTER TABLE Certifica
      ADD CONSTRAINT fkCertifica_Prodotto FOREIGN KEY (Prodotto) REFERENCES Prodotto (CodProdotto) ON DELETE CASCADE,
      ADD CONSTRAINT fkCertifica_Scontrino FOREIGN KEY (Data,CodScontrino) REFERENCES Scontrino (Data,CodScontrino) ON DELETE CASCADE;

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
Data	     DATE NOT NULL,
Quantita     SMALLINT NOT NULL,
Fornitore    CHAR(50),

PRIMARY KEY (Prodotto,CodFattura)
) ENGINE = InnoDB;

CREATE INDEX IFattura
ON Fattura (Prodotto);

CREATE INDEX IFattura2
ON Fattura (CodFattura);

CREATE TABLE Registrato(
Prodotto     INT,
Fattura	     INT,

PRIMARY KEY (Prodotto,Fattura)
) ENGINE=InnoDB;

CREATE INDEX IRegistrato
ON Registrato (Prodotto);

CREATE INDEX IRegistrato2
ON Registrato (Fattura);

ALTER TABLE Fattura
      ADD CONSTRAINT fkFattura_Registrato FOREIGN KEY (Prodotto) REFERENCES Registrato (Prodotto),
      ADD CONSTRAINT fkFattura_Fornitore FOREIGN KEY (Fornitore) REFERENCES Fornitore (Nome) ON DELETE CASCADE; #da controllare

ALTER TABLE Registrato
      ADD CONSTRAINT fkRegistrato_Prodotto FOREIGN KEY (Prodotto) REFERENCES Prodotto (CodProdotto),
      ADD CONSTRAINT fkRegistrato_Fattura FOREIGN KEY (Fattura) REFERENCES Fattura(CodFattura);
