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
    $test = new Query;
    $query = $test->exec("SELECT * FROM Categoria");

    if (mysql_num_rows($query) > 0) {
        while($row = mysql_fetch_row($query)){
            for ( $i = 0; $i <count($row); $i++){
                ?><a id="category" href="products.php?cat=<?php echo $row[$i];?>"><?php echo $row[$i];?></a><?php
            }
        }
    }
}

function printSelectedCategory($category=""){
    if(!isset($category)){
        echo "Non hai selezionato alcuna categoria";
    } else {
        ?><p>Sei sulla categoria: <?php echo $category;?>. <a href="products.php">Visualizza tutti i prodotti.</a></p>
    <?php
    }
    ?>

    <table id="products" style align="center">

        <tr>
            <th>Nome</th>
            <th>Categoria</th>
        </tr>
        <tr>
            <td>Tazza</td>
            <td>Stoviglie</td>
            <td><a href="details.php?id=1">Dettagli</a></td>
        </tr>
        <tr class="alt">
            <td>Vaso</td>
            <td>Porcellane</td>
            <td><a href="details.php?id=2">Dettagli</a></td>
        </tr>
        <tr>
            <td>Pentola figa</td>
            <td>Pentolame</td>
            <td><a href="details.php?id=3">Dettagli</a></td>
        </tr>
        <tr class="alt">
            <td>Tovaglia blu</td>
            <td>Tovaglie</td>
            <td><a href="details.php?id=4">Dettagli</a></td>
        </tr>
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
