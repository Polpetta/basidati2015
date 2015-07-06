DROP TRIGGER IF EXISTS DeleteCategoria;

DELIMITER $$
CREATE TRIGGER DeleteCategoria
BEFORE DELETE ON Categoria
FOR EACH ROW
BEGIN
IF EXISTS (SELECT * FROM Prodotto P WHERE P.Categoria=old.NomeCategoria)
THEN
	INSERT INTO Categoria SELECT * FROM Categoria LIMIT 1;
ELSE
	DELETE FROM Sconto WHERE Id = ANY (SELECT S.Sconto FROM Scaglione S WHERE S.Categoria = old.NomeCategoria);
END IF;
END $$
DELIMITER ;
