DROP TRIGGER IF EXISTS Iscritto_psw_insert;

DELIMITER ||
CREATE TRIGGER Iscritto_psw_insert
BEFORE INSERT ON Iscritto
FOR EACH ROW

BEGIN

SET New.Password=SHA1(New.Password);

END ||
DELIMITER ;

