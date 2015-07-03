DROP TRIGGER IF EXISTS Dipendente_psw_update;

DELIMITER ||
CREATE TRIGGER Dipendente_psw_update
BEFORE UPDATE ON Dipendente
FOR EACH ROW

BEGIN

SET New.Password=SHA1(New.Password);

END ||
DELIMITER ;

