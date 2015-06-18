drop table if exists Categoria;
drop table if exists Sconto;
drop table if exists Scaglioni;
drop table if exists Dipendente;

CREATE TABLE Categoria(
NomeCategoria	CHAR(20) PRIMARY KEY
) ENGINE=InnoDB;

CREATE TABLE Sconto(
Categoria    CHAR(20),
Livello	     SMALLINT,
PercentualeSconto INT(2) DEFAULT 0 NOT NULL,

PRIMARY KEY (Categoria,Livello),
FOREIGN KEY (Categoria) REFERENCES Scaglioni (Categoria)
) ENGINE=InnoDB;

CREATE TABLE Scaglioni(
Categoria    CHAR(20),
Livello	     SMALLINT,

PRIMARY KEY (Categoria,Livello),
FOREIGN KEY (Categoria) REFERENCES Categoria (NomeCategoria),
FOREIGN KEY (Livello) REFERENCES Sconto (Livello)
);#ENGINE=InnoDB;

CREATE TABLE Dipendente(
CodDipendente	SMALLINT,
Nome		CHAR(15) NOT NULL,
Cognome		CHAR(15) NOT NULL,
DataNascita	DATE NOT NULL,
CodFiscale	CHAR(10) NOT NULL,
Telefono	CHAR(10) NOT NULL,
Mail		CHAR(20),
DataInizio	DATE NOT NULL,
Categoria	CHAR(20),

PRIMARY KEY (CodDipendente),
FOREIGN KEY (Categoria) REFERENCES Categoria (NomeCategoria)
) ENGINE=InnoDB;

