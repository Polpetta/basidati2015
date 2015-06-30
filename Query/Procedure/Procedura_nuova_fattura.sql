DROP PROCEDURE IF EXISTS NuovaFattura;
DELIMITER $$

CREATE PROCEDURE NuovaFattura(NFattura INT, NFornitore CHAR(50), FQuantita SMALLINT, FData DATE,CProdotto  INT,PNome CHAR(50), PDescrizione  TEXT, PCosto DECIMAL(8,2), PPercentualeIVA	 INT(2), PCategoria	 CHAR(20))
BEGIN
DECLARE UltimaFattura INT;
DECLARE IdProdotto INT;

IF NOT EXISTS(SELECT * FROM Prodotto WHERE CodProdotto=CProdotto)
THEN
	INSERT INTO Prodotto (PNome, PDescrizione, PCosto, PPercentualeIVA, PCategoria) VALUES (PNome, PDescrizione, PCosto, PPercentualeIVA, PCategoria);
END IF;

INSERT INTO Fattura(CodFattura, Data, Quantita, Fornitore) VALUES (NFattura, FData, FQuantita, NFornitore);

SELECT MAX(Id) INTO UltimaFattura FROM Fattura;
SELECT MAX(CodProdotto) INTO IdProdotto FROM Prodotto;

INSERT INTO Registrato VALUES (IdProdotto, UltimaFattura); 

END$$
DELIMITER ;
