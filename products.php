<!DOCTYPE html>

<?php

$category=$_GET['cat'];

function getCategory(){
 /*
    In questa funizone si effettuerà la query:
    SELECT * FROM Categoria;
    In modo da ottenere tutte le categorie disponibili
 */
    ?>

<a id="category" href="#home">Home</a>
<a id="category" href="#news">Nebgbcgfdnhgfcnhgnhgnhgnhnhgws</a>
<a id="category" href="#contact">Contact</a>
<a id="category" href="#about">About</a>
<a id="category" href="#news">Nebgbcgfdnhgfcnhgnhgnhgnhnhgws</a>
<a id="category" href="#contact">Contact</a>
<a id="category" href="#about">About</a>
<a id="category" href="#news">Nebgbcgfdnhgfcnhgnhgnhgnhnhgws</a>
<a id="category" href="#contact">Contact</a>
<a id="category" href="#about">About</a>

<?php

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
            <td>ffffff</td>
        </tr>
        <tr class="alt">
            <td>Vaso</td>
            <td>Porcellane</td>
            <td>ffffff</td>
        </tr>
        <tr>
            <td>Pentola figa</td>
            <td>Pentolame</td>
            <td>ffffff</td>
        </tr>
        <tr class="alt">
            <td>Tovaglia blu</td>
            <td>Tovaglie</td>
            <td>ffffff</td>
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
