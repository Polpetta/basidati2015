DROP TRIGGER IF EXISTS scontrino_prodotto;

DELIMITER //
CREATE TRIGGER scontrino_prodotto
BEFORE INSERT ON Scontrino
FOR EACH ROW
BEGIN

DECLARE vecchia_qta SMALLINT;
SELECT P.Quantita INTO vecchia_qta FROM Prodotto AS P WHERE P.CodProdotto=New.Prodotto;

IF vecchia_qta=-1
	THEN SET vecchia_qta=0;
END IF;

IF vecchia_qta-New.quantita < 0
THEN
	DECLARE id_necessario INT;
	SELECT MAX(Id) INTO id_necessario FROM Fattura;
	id_necessario=id_necessario+1;
	
	DECLARE qta_necessaria SMALLINT;
	qta_necessaria=vecchia_qta-New.Quantita*-1;
	
	DECLARE Forn CHAR;	
	SELECT F.Fornitore INTO Forn FROM Fattura AS F WHERE F.Prodotto=New.Prodotto;
	
	INSERT INTO Fattura (Id,Prodotto,CodFattura,Data,Quantita,Fornitore)
	VALUES (id_necessario,New.Prodotto,999,sysdate(),qta_necessaria,Forn);
	
	UPDATE Prodotto
	SET Prodotto.Quantita=0 WHERE New.Prodotto=CodProdotto;
ELSE
	UPDATE Prodotto
	SET Prodotto.Quantita=vecchai_qta-New.quantita WHERE New.Prodotto=CodProdotto;
END IF;
END;//
DELIMITER;


