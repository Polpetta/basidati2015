DROP PROCEDURE IF EXISTS NuovoLivello;
DELIMITER ||

CREATE PROCEDURE 
NuovoLivello(NLivello SMALLINT,NPercSconto INT(2), 
			 NTettoMax	SMALLINT, NCategoria CHAR(50))
BEGIN
DECLARE IdSconto INT;

IF (NPercSconto >=0)
THEN
IF EXISTS(SELECT* FROM Categoria C WHERE C.NomeCategoria=NCategoria)
THEN
IF NOT EXISTS(SELECT * FROM Sconto SC, Scaglione SCA,Categoria C
	WHERE SCA.Categoria=C.NomeCategoria AND 
		  SCA.Sconto=SC.Id AND 
		  C.NomeCategoria=NCategoria AND
		  SC.Livello=NLivello)
THEN
IF NOT EXISTS(SELECT * FROM Sconto SC, Scaglione SCA,Categoria C
			  WHERE SCA.Categoria=C.NomeCategoria AND 
					SCA.Sconto=SC.Id AND 
					C.NomeCategoria=NCategoria AND
					SC.TettoMax >= NTettoMax)
THEN
IF NOT EXISTS(SELECT * FROM Sconto SC, Scaglione SCA,Categoria C
			  WHERE SCA.Categoria=C.NomeCategoria AND
					SCA.Sconto=SC.Id AND 
					C.NomeCategoria=NCategoria AND
					SC.Livello<NLivello AND 
					SC.PercSconto >= NPercSconto)
THEN
INSERT INTO Sconto(Livello, PercSconto, TettoMax)
			VALUES (NLivello,NPercSconto,NTettoMax);

SELECT Max(Id) INTO IdSconto FROM Sconto;

INSERT INTO Scaglione(Categoria,Sconto) VALUES(NCategoria,IdSconto);
ELSE

INSERT INTO Sconto SELECT * FROM Sconto LIMIT 1;

END IF;

ELSE

INSERT INTO Sconto SELECT * FROM Sconto LIMIT 1;

END IF;

ELSE

INSERT INTO Sconto SELECT * FROM Sconto LIMIT 1;

END IF;

ELSE 

INSERT INTO Sconto SELECT * FROM Sconto LIMIT 1;

END IF;
END IF;
END ||
DELIMITER ;
