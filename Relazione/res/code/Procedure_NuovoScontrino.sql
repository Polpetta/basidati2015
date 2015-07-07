DROP PROCEDURE IF EXISTS NuovoScontrino;

DELIMITER ||

CREATE PROCEDURE 
NuovoScontrino(SData DATE, SCodScontrino INT,
	SQuantita SMALLINT, SIscritto INT,
	CProdotto INT)
BEGIN
DECLARE SSubTotale DECIMAL(8,2);
DECLARE UltimoScontrino INT;
DECLARE QtaPrd INT;
DECLARE Iva INT;
DECLARE Piva INT;
DECLARE Psconto INT;
DECLARE Scont INT;
DECLARE Cat CHAR(50);

IF (SQuantita>0)
	THEN
	SELECT Quantita INTO QtaPrd 
	FROM Prodotto 
	WHERE CodProdotto = CProdotto;

	IF (QtaPrd != -1 AND SQuantita <= QtaPrd)
	THEN
		SELECT Costo INTO SSubTotale 
		FROM Prodotto 
		WHERE CodProdotto = CProdotto;

		SET SSubTotale = SQuantita * SSubTotale;
		SELECT PercentualeIVA INTO Piva 
		FROM Prodotto 
		WHERE CodProdotto=CProdotto;
		
		SET Iva=(SSubTotale*Piva)/100;
		SET SSubTotale= SSubTotale+Iva;

		INSERT INTO Scontrino (Data,CodScontrino,
				Quantita,SubTotale,Iscritto) 
				VALUES (SData,SCodScontrino,
				SQuantita,SSubTotale,SIscritto);

		SELECT MAX(Id) INTO UltimoScontrino FROM Scontrino;

		INSERT INTO Certifica 
		VALUES (CProdotto,UltimoScontrino);

		SELECT P.Categoria INTO Cat 
		FROM Prodotto P 
		WHERE P.CodProdotto=CProdotto;
		
		UPDATE Prodotto SET Quantita=Quantita-SQuantita 
		WHERE CodProdotto=CProdotto;
		
		SELECT max(SC.PercSconto) INTO Psconto
		FROM Scontrino S,Categoria C,Sconto SC,Iscritto I,
			 Certifica CE, Prodotto P,Scaglione SCA
		WHERE S.Iscritto=I.CodIscritto AND
			  CE.Scontrino=S.Id AND 
			  CE.Prodotto=P.CodProdotto AND 
			  P.Categoria=C.NomeCategoria AND 
			  SCA.Categoria=C.NomeCategoria AND 
			  SCA.Sconto=SC.Id AND 
			  I.CodIscritto=SIscritto AND 
			  C.NomeCategoria=Cat;
		
		SET Scont=(SSubTotale*Psconto)/100;
		UPDATE Scontrino SET SubTotale=SSubTotale-Scont 
		WHERE Scontrino.Id=UltimoScontrino;
	ELSE
		INSERT INTO Prodotto SELECT * FROM Prodotto LIMIT 1;

	END IF;
ELSE 
	INSERT INTO Scontrino SELECT * FROM Scontrino LIMIT 1;
END IF;
END||
DELIMITER ;
