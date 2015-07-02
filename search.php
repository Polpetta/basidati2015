<?php

include_once("include/lib/mysql/query.php");


    if(isset($_GET['product'])){
        $nameproducts = $_GET['product'];
    }

   if(isset($_GET['category'])){
           $category = $_GET['category'];
    }

function displayItem($nameproducts,$category = false){
    $elements = new Query;
    $nameproducts = "%" . $nameproducts . "%";

    if($category != false){
        $query = $elements->exec("SELECT Nome,Categoria,CodProdotto FROM Prodotto WHERE Categoria = '$category' && Nome LIKE '$nameproducts' ORDER BY Nome ASC");
    }else{
        $query = $elements->exec("SELECT Nome,Categoria,CodProdotto FROM Prodotto WHERE Nome LIKE '$nameproducts' ORDER BY Nome ASC");
    } ?>

	<?php

		if (mysql_num_rows($query) > 0) { ?>
            <table id="products" style align="center">

            <tr>
                <th>Nome</th>
                <th>Categoria</th>
            </tr>

        <?php
        $i = 0;
        while($row = mysql_fetch_row($query)){
                ?>
				<tr
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
        }else{
            echo "Non ci sono elementi";
    }

?>
    </table>

<?php
}

if (!isset($nameproducts)){
    header("Location: products.php");
    exit;
}


?>

<html>
    <?php
        //Creo l'header in cui includo il foglio di stile e setto la pagina del titolo
        include_once("include/page.php");
        getHeader("Cerca");
    ?>
    <body>
        <?php
            //La funzione mi aggiunge il menu alla pagina
            getMenu();
        ?>
        <div id="main">
            <h1>Ricerca</h1>
            <p>
                <?php
                    if (isset($category)){
                        displayItem($nameproducts,$category);
                    }else{
                        displayItem($nameproducts);
                    }

                ?>
            </p>
        </div>
    </body>
</html>
