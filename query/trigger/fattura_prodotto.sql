DROP TRIGGER IF EXISTS increaseqta;

DELIMITER $$

CREATE TRIGGER increaseqta
AFTER INSERT ON Fattura
FOR EACH ROW
BEGIN
IF EXISTS (SELECT * FROM Prodotto WHERE Prodotto.CodProdotto=New.Prodotto)
THEN
	DECLARE oldqta int;
	(SELECT P.Quantita INTO oldqta
	FROM Prodotto AS P
	WHERE P.CodProdotto=New.Prodotto);
	
	IF(oldqta=-1)
		THEN set oldqta=0;
	END IF;
	(SET P.Quantita=oldqta+new.Quantita
	WHERE New.Prodotto=Prodotto.CodProdotto);
END IF;
END$$

DELIMITER ;
