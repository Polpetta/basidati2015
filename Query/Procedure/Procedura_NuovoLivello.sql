DROP PROCEDURE IF EXISTS NuovoLivello;
DELIMITER ||

CREATE PROCEDURE NuovoLivello(NLivello SMALLINT,NPercSconto INT(2), NTettoMax	SMALLINT, NCategoria CHAR(50))
BEGIN
DECLARE IdSconto INT;

IF EXISTS(SELECT* FROM Categoria C WHERE C.NomeCategoria=NCategoria)
THEN
	INSERT INTO Sconto(Livello, PercSconto, TettoMax) VALUES (NLivello,NPercSconto,NTettoMax);
	SELECT Max(Id) INTO IdSconto FROM Sconto;
	INSERT INTO Scaglione(Categoria,Sconto) VALUES(NCategoria,IdSconto);
ELSE 
	INSERT INTO Sconto SELECT * FROM SCONTO LIMIT 1;
END IF;
END ||
DELIMITER ;
