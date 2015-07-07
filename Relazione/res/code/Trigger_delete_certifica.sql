DROP TRIGGER IF EXISTS delete_certifica;

DELIMITER $$
CREATE TRIGGER delete_certifica
BEFORE DELETE ON Iscritto
FOR EACH ROW
BEGIN

DELETE FROM Certifica WHERE Scontrino = ANY 
		(SELECT S.Id FROM Scontrino S 
		 WHERE S.Iscritto = old.CodIscritto);


END $$
DELIMITER ;
