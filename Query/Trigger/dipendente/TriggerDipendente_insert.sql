DROP TRIGGER IF EXISTS Dipendente_psw_insert ;

DELIMITER ||
CREATE TRIGGER Dipendente_psw_insert
BEFORE INSERT ON Dipendente
FOR EACH ROW

BEGIN

IF((year(New.DataInizio )-year(New.DataNascita))<18)
THEN 
	INSERT INTO Categoria SELECT * FROM Categoria LIMIT 1;
ELSE
	SET New.Password=SHA1(New.Password);
END IF;

END ||
DELIMITER ;
