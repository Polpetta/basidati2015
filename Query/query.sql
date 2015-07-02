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
//query nr5 NON VA

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
			
// query nr 7 NON VA

SELECT DAY(S.Data)
FROM Scontrino S
WHERE SUM(S.SubTotale) = ANY (SELECT MAX(SUM(S1.SubTotale))
						 FROM Scontrino S1
						 GROUP BY S1.Data);

//query nr 8 NON VA

SELECT *
FROM Dipendente D
WHERE D.Categoria= ANY (select P.Categoria
						FROM Prodotto P JOIN Scontrino S
						WHERE sum(s.subTotale)= SELECT max(sum(s1.subTotale))
												FROM Scontrino S1
												GROUP BY S1.Data
