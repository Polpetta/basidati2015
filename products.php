<!DOCTYPE html>

<?php

$category=$_GET['cat'];

function printCategory($category=""){
    if(!isset($category)){
        echo "Non hai selezionato alcuna categoria";
    }

    ?>

    <table id="products" style align="center">

        <tr>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Foto</th>
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
            <p><?php printCategory($category); ?></p>
        </div>
    </body>
</html>
