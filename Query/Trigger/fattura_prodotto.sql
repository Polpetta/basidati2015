DROP TRIGGER IF EXISTS increaseqta;
DELIMITER // 
CREATE TRIGGER increaseqta
AFTER INSERT ON Fattura
FOR EACH ROW
BEGIN
DECLARE oldqta INT;
DECLARE nuovo_prodotto INT;
SELECT CodProdotto INTO nuovo_prodotto
FROM Prodotto as P, Fattura as F, Registrato as R
WHERE F.Id=New.Id &&
	  F.Id=R.Fattura && 
	  R.Prodotto=P.CodProdotto;

SELECT P.Quantita INTO oldqta
FROM Prodotto AS P
WHERE P.CodProdotto=nuovo_prodotto;

IF(oldqta=-1)
	THEN set oldqta=0;
END IF;
SET P.Quantita=oldqta+new.Quantita
WHERE nuovo_prodotto=Prodotto.CodProdotto;
END IF;
END//
DELIMITER ;
