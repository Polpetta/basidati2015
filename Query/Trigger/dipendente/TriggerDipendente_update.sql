DROP TRIGGER IF EXISTS Dipendente_psw_update;

DELIMITER ||
CREATE TRIGGER Dipendente_psw_update
BEFORE UPDATE ON Dipendente
FOR EACH ROW

BEGIN

IF((year(New.DataInizio )-New.DataNascita)<18)
THEN 
	INSERT INTO Dipendente SELECT * FROM Dipendente LIMIT 1;
ELSE
	SET New.Password=SHA1(New.Password);
END IF;
END ||
DELIMITER ;

