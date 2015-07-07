CREATE OR REPLACE VIEW ProdottiValidi AS
SELECT * FROM Prodotto WHERE Quantita <> -1;
