DROP TRIGGER IF EXISTS Dipendente_psw_insert;

DELIMITER ||
CREATE TRIGGER Dipendente_psw_insert
BEFORE INSERT ON Dipendente
FOR EACH ROW

BEGIN

SET New.Password=SHA1(New.Password);

END ||
DELIMITER ;
