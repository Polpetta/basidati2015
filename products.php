<!DOCTYPE html>

<?php

$category=$_GET['cat'];

function getCategory(){
 /*
    In questa funizone si effettuerà la query:
    SELECT * FROM Categoria;
    In modo da ottenere tutte le categorie disponibili
 */

    include_once("include/lib/mysql/query.php");
    $cat = new Query;
    $query = $cat->exec("SELECT * FROM Categoria");

    if (mysql_num_rows($query) > 0) {
        while($row = mysql_fetch_row($query)){
            for ( $i = 0; $i <count($row); $i++){
                ?><a id="category" href="products.php?cat=<?php echo $row[$i];?>"><?php echo $row[$i];?></a><?php
            }
        }
    }
}

function printSelectedCategory($category=""){
	$prd = new Query;
    if(!isset($category)){
        echo "Non hai selezionato alcuna categoria";
		$result = $prd->exec ("SELECT Nome,Categoria,CodProdotto FROM Prodotto");
    } else {
        ?><p>Sei sulla categoria: <?php echo $category;?>. <a href="products.php">Visualizza tutti i prodotti.</a></p>
    <?php
		$result = $prd->exec ("SELECT Nome,Categoria,CodProdotto FROM Prodotto WHERE Categoria = '$category'");
    }

	


    ?>

    <table id="products" style align="center">

        <tr>
            <th>Nome</th>
            <th>Categoria</th>
        </tr>
        <tr>

	<?php

		if (mysql_num_rows($result) > 0) {
        while($row = mysql_fetch_row($result)){
                ?>
				<tr>
				<td><?php echo $row[0];?></td>
				<td><?php echo $row[1];?></td>
				<td><a href="details.php?id=<?php echo $row[2];?>">Dettagli</a></td>
				</tr>
<?php
        }
    }

?>
    </table>

<?php
}

?>


<html>
    <?php
        //Creo l'header in cui includo il foglio di stile e setto la pagina del titolo
        include("include/page.php");
        getHeader("Prodotti");
    ?>
    <body>
        <?php
            //La funzione mi aggiunge il menu alla pagina
            getMenu()
        ?>
        <div id="main">
            <h1>Prodotti</h1>
            <p>
                <?php
                    getCategory();
                ?>
            </p>
            <p>
                <?php
                    printSelectedCategory($category);
                ?>
            </p>
        </div>
    </body>
</html>
