DROP PROCEDURE IF EXISTS NuovaCategoria;
DELIMITER $$

CREATE PROCEDURE NuovaCategoria(NCategoria CHAR(20), NDip CHAR(15), CDip CHAR(15), DData DATE, DCodF CHAR(16), DTel CHAR(10), DMail CHAR(50),DDatainizio DATE, DInd CHAR(50), DPswd CHAR(64), SLvl SMALLINT, PrcSconto INT(2), STettoMax SMALLINT)
BEGIN
DECLARE UltimaCategoria INT;


INSERT INTO Sconto (Livello, PercSconto,TettoMax) VALUES (SLvl,PrcSconto,STettoMax);

INSERT INTO Categoria VALUES (NCategoria);

SELECT MAX(Id) INTO UltimaCategoria FROM Sconto;

INSERT INTO Scaglione VALUES (NCategoria, UltimaCategoria); 


INSERT INTO Dipendente (Nome,Cognome,DataNascita,CodFiscale,Telefono,Mail,DataInizio,Indirizzo,Categoria,Password) VALUES (NDip,CDip,DData,DCodF,DTel,DMail,DDatainizio,DInd,NCategoria,SHA1(DPswd));

END$$
DELIMITER ;
