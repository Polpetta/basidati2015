DROP TRIGGER IF EXISTS ScontoCategoria;

DELIMITER $$

CREATE TRIGGER ScontoCategoria
AFTER INSERT ON Categoria
FOR EACH ROW

BEGIN
DECLARE UltimaCategoria INT;
INSERT INTO Sconto (Livello, PercSconto,TettoMax) VALUES (0,0,NULL);


SELECT MAX(Id) INTO UltimaCategoria FROM Sconto;

INSERT INTO Scaglione VALUES (New.NomeCategoria, UltimaCategoria);

END$$

DELIMITER ;
