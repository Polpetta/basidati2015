DROP TRIGGER IF EXISTS Scontrino_check_data;

DELIMITER ||
CREATE TRIGGER Scontrino_check_data
BEFORE INSERT ON Scontrino
FOR EACH ROW

BEGIN
IF(New.Data > Date(Now()))
THEN 
	INSERT INTO Scontrino SELECT * FROM Scontrino LIMIT 1;
END IF;

END ||
DELIMITER ;

