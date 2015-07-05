DROP PROCEDURE IF EXISTS NuovoScontrino;

DELIMITER $$

CREATE PROCEDURE NuovoScontrino(SData DATE, SCodScontrino INT, SQuantita SMALLINT, SIscritto INT, CProdotto INT)
BEGIN
DECLARE SSubTotale DECIMAL(8,2);
DECLARE UltimoScontrino INT;
DECLARE QtaPrd INT;
DECLARE Iva INT;
DECLARE Piva INT;

SELECT Quantita INTO QtaPrd FROM Prodotto WHERE CodProdotto = CProdotto;

IF (QtaPrd != -1 AND SQuantita <= QtaPrd)
THEN
SELECT Costo INTO SSubTotale FROM Prodotto WHERE CodProdotto = CProdotto;

SET SSubTotale = SQuantita * SSubTotale;
SELECT PercentualeIVA INTO Piva FROM Prodotto WHERE CodProdotto=CProdotto;
SET Iva=(SSubTotale*Piva)/100;
SET SSubTotale= SSubTotale+Iva;

INSERT INTO Scontrino (Data,CodScontrino,Quantita,SubTotale,Iscritto) VALUES (SData,SCodScontrino,SQuantita,SSubTotale,SIscritto);

SELECT MAX(Id) INTO UltimoScontrino FROM Scontrino;

INSERT INTO Certifica VALUES (CProdotto,UltimoScontrino);


UPDATE Prodotto SET Quantita=Quantita-SQuantita WHERE CodProdotto=CProdotto;

ELSE
INSERT INTO Prodotto SELECT * FROM Prodotto LIMIT 1;

END IF;

END$$
DELIMITER ;
