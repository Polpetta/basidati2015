DROP PROCEDURE IF EXISTS NuovaFattura;
DELIMITER $$

CREATE PROCEDURE NuovaFattura(NFattura INT, NFornitore CHAR(50), FQuantita SMALLINT, FData DATE,CProdotto  INT,PNome CHAR(50), PDescrizione  TEXT, PCosto DECIMAL(8,2), PPercentualeIVA	 INT(2), PCategoria	 CHAR(20))
BEGIN
DECLARE UltimaFattura INT;
DECLARE IdProdotto INT;
DECLARE Oldqta SMALLINT;
DECLARE Newqta SMALLINT;

IF NOT EXISTS(SELECT * FROM Prodotto WHERE CodProdotto=CProdotto)
THEN
	INSERT INTO Prodotto (Nome, Descrizione, Quantita, Costo, PercentualeIVA, Categoria) VALUES (PNome, PDescrizione, FQuantita, PCosto, PPercentualeIVA, PCategoria);

	SELECT MAX(CodProdotto) INTO IdProdotto FROM Prodotto;

ELSE

SET IdProdotto = CProdotto;

SELECT P.Quantita INTO Oldqta FROM Prodotto P WHERE P.CodProdotto=IdProdotto;

IF Oldqta=-1
THEN 
 SET Oldqta=0;
END IF;

SET Newqta= Oldqta+FQuantita;

UPDATE Prodotto SET Quantita=Newqta WHERE CodProdotto=IdProdotto;


END IF;

INSERT INTO Fattura(CodFattura, Data, Quantita, Fornitore) VALUES (NFattura, FData, FQuantita, NFornitore);

SELECT MAX(Id) INTO UltimaFattura FROM Fattura;

INSERT INTO Registrato VALUES (IdProdotto, UltimaFattura); 

END$$
DELIMITER ;
