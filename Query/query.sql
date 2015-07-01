#query nr 1

SELECT *
FROM Prodotto P
WHERE P.CodProdotto=SELECT C.Prodotto
					FROM Scontrino S, Certifica C
					WHERE C.Scontrino=S.Id
					GROUP BY C.Prodotto
					HAVING max(count(S.Id));
						   
//query nr2

(select p1.nome 
from prodotto as p1)
except
(select p.nome
from prodotto as p join scontrino as s);

//query nr3

(select *
from prodotto as p join scontrino as s
		on s.iscritto=$nome);
		
//query nr4

select *
from fornitore for
where for.nome =( select f.fornitore
				 from (select f.fornitore, count(*) as numero_fatture
					   from fattura f
						goup by fornitore)
				group by fornitore
				having max(numero_fatture));

//query nr5

select p.categoria
from prodotto p join scontrino s
where sum(s.subTotale)= select max(sum(s1.subTotale))
						from scontrino s1
						group by s1.data

//query nr 6

select *
from iscritto i1
where i1.cod.iscritto = select i.cod.iscritto
						from iscritto i
						except
						select s.iscritto
						from prodotto p join scontrino s
								on p.categoria=$categoria
			
// query nr 7

select day(s.data)
from scontrino s
where sum(s.subtoTale) = select max(sum(s1.subtotale))
						 from scontrino s1
						 group by s1.data

//query nr 8

select dip.nome
from dipendente dip
where dip.categoria=select p.categoria
					from prodotto p join scontrino s
					where sum(s.subTotale)= select max(sum(s1.subTotale))
											from scontrino s1
											group by s1.data
