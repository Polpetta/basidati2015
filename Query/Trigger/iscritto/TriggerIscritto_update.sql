DROP TRIGGER IF EXISTS Iscritto_psw_update;

DELIMITER ||
CREATE TRIGGER Iscritto_psw_update
BEFORE UPDATE ON Iscritto
FOR EACH ROW

BEGIN

SET New.Password=SHA1(New.Password);

END ||
DELIMITER ;

