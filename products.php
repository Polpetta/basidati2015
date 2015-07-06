<!DOCTYPE html>

<?php

include_once("include/lib/mysql/query.php");

if(isset($_GET['cat'])){
    $category=$_GET['cat'];
}

function search($category=""){
    /*
    Form che serve per una ricerca rapida in base alla categoria in cui sei.
    */
    ?>

     <form action="search.php" method="GET">
         Esegui una ricerca: <input list="prd" type="text" name="product">
            <datalist id="prd">
                <?php

                    $fastprd = new Query();
                    if(isset($category)){
                        $result = $fastprd->exec("SELECT Nome FROM ProdottiValidi WHERE Categoria = '$category' ");
                    }else{
                        $result = $fastprd->exec("SELECT Nome FROM ProdottiValidi");
                    }

                    if (mysql_num_rows($result) > 0) {
                        while($row = mysql_fetch_row($result)){
                                ?><option value="<?php echo $row[0];?>"><?php
                        }
                    }

                ?>
            </datalist>
         <input type="hidden" name="category" value="<?php echo $category;?>">
         <input type="submit" value="Cerca">
    </form>


<?php
}



function getCategory(){
 /*
    In questa funizone si effettuerà la query:
    SELECT * FROM Categoria;
    In modo da ottenere tutte le categorie disponibili
 */

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

function printSelectedCategory($category=false){
	$prd = new Query;
    if($category == false){
        echo "Non hai selezionato alcuna categoria";
		$result = $prd->exec ("SELECT Nome,Categoria,CodProdotto FROM ProdottiValidi ORDER BY Nome ASC");
    } else {
        ?><p>Sei sulla categoria: <?php echo $category;?>. <a href="products.php">Visualizza tutti i prodotti.</a></p>
    <?php
		$result = $prd->exec ("SELECT Nome,Categoria,CodProdotto FROM ProdottiValidi WHERE Categoria = '$category' ORDER BY Nome ASC");
    }

	


    ?>

    <table id="products" style align="center">

        <tr>
            <th>Nome</th>
            <th>Categoria</th>
        </tr>

	<?php
        $i = 0;
		if (mysql_num_rows($result) > 0) {
        while($row = mysql_fetch_row($result)){
                ?>
				<tr
                    <?php
                        if($i % 2 != 0){ ?>
                            class="alt"
                    <?php }
                    ?>
                    >
				<td><?php echo $row[0];?></td>
				<td><?php echo $row[1];?></td>
				<td><a href="details.php?id=<?php echo $row[2];?>">Dettagli</a></td>
				</tr>
<?php
            $i++;
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
                    if(isset($category)){
                        search($category);
                    }else{
                        search();
                    }
                ?>
            </p>
            <p>
                <?php
                    if(isset($category)){
                        printSelectedCategory($category);
                    }else{
                        printSelectedCategory();
                    }
                ?>
            </p>
        </div>
    </body>
</html>
