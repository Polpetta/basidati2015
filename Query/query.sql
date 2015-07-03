#query nr 1

SELECT P.CodProdotto ,P.Nome, P.Descrizione, P.Costo, P.PercentualeIVA, P.Categoria,COUNT(C.Prodotto) AS Num_venduti
FROM Prodotto P, Certifica C, Scontrino S 
WHERE P.CodProdotto=C.Prodotto AND S.Id=C.Scontrino
GROUP BY C.Prodotto, P.CodProdotto ,P.Nome, P.Descrizione, P.Quantita, P.Costo, P.PercentualeIVA, P.Categoria
HAVING MAX(Num_venduti);
					  
						   
//query nr2

SELECT P1.CodProdotto 
FROM Prodotto P1
WHERE P1.CodProdotto <> ALL(SELECT C.Prodotto
						FROM Certifica C);

//query nr3

SELECT P.CodProdotto ,P.Nome, P.Descrizione, P.Costo, P.PercentualeIVA, P.Categoria
FROM Prodotto P,Certifica C, Scontrino S
WHERE C.Prodotto=P.CodProdotto AND C.Scontrino=S.Id AND S.Iscritto=1;
		
//query nr4 

SELECT FO.Nome, FO.Fax, FO.Telefono, FO.Mail, FO.Indirizzo, count(*) AS Numero_acquisto
FROM Fornitore FO JOIN Fattura F
ON FO.Nome=F.Fornitore
GROUP BY FO.Nome
ORDER BY  Numero_acquisto DESC
LIMIT 1
;
//query nr5

SELECT P.Categoria, SUM(S.SubTotale) AS Guadagno_Max
FROM Prodotto P, Categoria C, Certifica CE, Scontrino S
WHERE P.Categoria=C.NomeCategoria AND CE.Prodotto=P.CodProdotto AND CE.Scontrino=S.Id
GROUP BY C.NomeCategoria
ORDER BY Guadagno_Max DESC
LIMIT 1;


//query nr 6

SELECT *
FROM Iscritto I1
WHERE I1.CodIscritto = ANY (SELECT I.CodIscritto
						FROM Iscritto I
						WHERE I.CodIscritto <> ALL
						(SELECT S.Iscritto
						FROM Prodotto P JOIN Scontrino S
						ON P.Categoria='dildi'));
			
// query nr 7

SELECT S.Data, SUM(S.SubTotale) AS Tot_vendite
FROM Scontrino S
GROUP BY S.Data
ORDER BY Tot_vendite DESC
LIMIT 1;

//query nr 8

SELECT D.Nome, COUNT(S.Id) AS Num_Scontrini
FROM Dipendente D, Categoria C, Prodotto P, Certifica CE, Scontrino S
WHERE D.Categoria=C.NomeCategoria AND P.Categoria=C.NomeCategoria AND CE.Prodotto=P.CodProdotto AND CE.Scontrino=S.Id
GROUP BY D.Nome
ORDER BY Num_Scontrini DESC
LIMIT 1;

//query nr 9

SELECT I.CodIscritto,I.Nome,I.Cognome,MAX(SC.Livello) AS Livello_massimo
FROM Iscritto I, Sconto SC, Scontrino S, Scaglione SCA,Certifica CE,Prodotto P, Categoria C
WHERE SCA.Categoria=C.NomeCategoria AND SCA.Sconto=SC.Id AND P.Categoria=C.NomeCategoria AND CE.Prodotto=P.CodProdotto AND CE.Scontrino=S.Id AND S.Iscritto=I.CodIscritto 
AND C.NomeCategoria=(SELECT P.Categoria 
						  FROM Prodotto P, Categoria C, Certifica CE, Scontrino S
						  WHERE P.Categoria=C.NomeCategoria AND CE.Prodotto=P.CodProdotto AND CE.Scontrino=S.Id AND Month(S.Data)=Month(now())
						  GROUP BY C.NomeCategoria
						  ORDER BY SUM(S.SubTotale) DESC
						  LIMIT 1);

//query nr 10

SELECT COUNT(S.Id) AS Numero_Acquisti,C.NomeCategoria, max(SC.Livello) AS Livello_attuale
FROM Scontrino S,Categoria C,Sconto SC,Iscritto I, Certifica CE, Prodotto P
WHERE S.Iscritto=I.CodIscritto AND CE.Scontrino=S.Id AND CE.Prodotto=P.CodProdotto AND P.Categoria=C.NomeCategoria AND I.CodIscritto=1 
GROUP BY C.NomeCategoria;
