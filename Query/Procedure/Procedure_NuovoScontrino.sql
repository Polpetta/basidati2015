DROP PROCEDURE IF EXISTS NuovoScontrino;

DELIMITER $$

CREATE PROCEDURE NuovoScontrino(SData DATE, SCodScontrino INT, SQuantita SMALLINT, SIscritto INT, CProdotto INT)
BEGIN
DECLARE SSubTotale DECIMAL(8,2);
DECLARE UltimoScontrino INT;

SELECT Costo INTO SSubTotale FROM Prodotto WHERE CodProdotto = CProdotto;

SET SSubTotale = SQuantita * SSubTotale;

INSERT INTO Scontrino (Data,CodScontrino,Quantita,SubTotale,Iscritto) VALUES (SData,SCodScontrino,SQuantita,SSubTotale,SIscritto);

SELECT MAX(Id) INTO UltimoScontrino FROM Sconto;

INSERT INTO Certifica VALUES (CProdotto,UltimoScontrino);


END$$
DELIMITER ;
