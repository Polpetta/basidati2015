DROP TRIGGER IF EXISTS delete_fornitore;

DELIMITER ||
CREATE TRIGGER delete_fornitore
BEFORE DELETE ON Fornitore
FOR EACH ROW
BEGIN

DELETE FROM Registrato WHERE Fattura = ANY 
			(SELECT F.Id 
			 FROM Fattura F 
			 WHERE F.Fornitore = old.Nome);


END ||
DELIMITER ;

