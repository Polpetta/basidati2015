DROP TRIGGER IF EXISTS scontrino_prodotto;
DELIMITER //
CREATE TRIGGER scontrino_prodotto
BEFORE INSERT ON Scontrino
FOR EACH ROW
BEGIN
DECLARE vecchia_qta SMALLINT;
DECLARE nuovo_prodotto INT;
DECLARE qta_necessaria SMALLINT;
DECLARE Forn CHAR;	

SELECT CodProdotto INTO nuovo_prodotto FROM Prodotto JOIN Scontrino ON Scontrino.CodScontrino=New.CodScontrino;
SELECT Quantita INTO vecchia_qta FROM Prodotto AS P WHERE P.CodProdotto=nuovo_prodotto;

IF vecchia_qta=-1
	THEN SET vecchia_qta=0;
END IF;
IF ((vecchia_qta-New.quantita) < 0)
THEN
	SET qta_necessaria=(vecchia_qta-New.Quantita)*(-1);
	SELECT Fornitore INTO Forn FROM Fattura INNER JOIN Prodotto ON Prodotto=nuovo_prodotto;
	INSERT INTO Fattura (Prodotto,CodFattura,Data,Quantita,Fornitore)
	VALUES (nuovo_prodotto,999,sysdate(),qta_necessaria,Forn);
	UPDATE Prodotto
	SET Prodotto.Quantita=0 WHERE nuovo_prodotto=CodProdotto;
ELSE
	UPDATE Prodotto
	SET Prodotto.Quantita=vecchai_qta-New.quantita WHERE nuovo_prodotto=CodProdotto;
END IF;
END//
DELIMITER ;


