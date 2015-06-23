DROP PROCEDURE IF EXISTS NuovoProdotto;

DELIMITER $$

CREATE PROCEDURE NuovoProdotto(NNome CHAR(50), NDescrizione TEXT, NCosto DECIMAL(5,2), NQuantita SMALLINT, NPercIVA INT(2), NCategoria CHAR(20), NCodFattura INT, NData DATE, NFornitore CHAR(50))
BEGIN
DECLARE IdFattura INT;
DECLARE IdProdotto INT;
INSERT INTO Prodotto (Nome,Descrizione,Costo,PercentualeIVA,Categoria) VALUES (NNome,NDescrizione,NCosto,NPercIVA,NCategoria);

SELECT MAX(CodProdotto) INTO IdProdotto FROM Prodotto;

INSERT INTO Fattura (CodFattura,Data,Quantita,Fornitore) VALUES (NCodFattura,NData,NQuantita,NFornitore);

SELECT MAX(Id) INTO IdFattura FROM Fattura;

INSERT INTO Registrato VALUES (IdProdotto,IdFattura);

END$$
DELIMITER ;
