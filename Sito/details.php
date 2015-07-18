<?php

include_once("include/lib/mysql/query.php");

$Pid=$_GET['id'];

function getInfo($id){
    $info = new Query();
	$query = $info->exec ("SELECT Nome,Descrizione,Quantita,Costo,PercentualeIVA,Categoria FROM Prodotto WHERE CodProdotto = '$id'");

	if (mysql_num_rows($query) == 1) {
        $row = mysql_fetch_row($query);


    $result = array(
        "CodProdotto" => $id,
        "Nome" => $row[0],
        "Descrizione" => $row[1],
        "Qta" => $row[2],
        "Costo" => $row[3],
        "IVA" => $row[4],
        "Categoria" => $row[5],
        );
    }
    else
        $result = 0;

    return $result;
}

if (!isset($Pid)){
    header("Location: products.php");
    exit;
} else {
    $product = getInfo($Pid);
}

?>
<!DOCTYPE html>

<html>
    <?php
        //Creo l'header in cui includo il foglio di stile e setto la pagina del titolo
        include("include/page.php");
        getHeader("Dettagli su: " .$product["Nome"],"details.css");
    ?>
    <body>
        <?php
            //La funzione mi aggiunge il menu alla pagina
            getMenu();
        ?>
        <div id="main">
            <?php
                    if ($product == 0){
                        die("Non è stato trovato il prodotto selezionato.");
                    }

                    if ($product["Qta"] == -1)
                        die("Spiacenti, il prodotto non è più in vendita");
            ?>
            <h1>
                <?php
                    echo $product["Nome"];
                ?>
            </h1>

            <div id="cst">
                Prezzo: <b><?php echo $product["Costo"];?></b> &euro;
            </div>
            <br>
            <div id="cat">
                Prodotto in <b><a href="products.php?cat=<?php echo $product["Categoria"];?>"><?php echo $product["Categoria"];?></a></b>
            </div>
            <br>
            <div id="qta">
                Disponibili ancora <b><?php echo $product["Qta"];?> </b> unit&agrave;
            </div>
            <div id="description">
            <h2>
                Descrizione
            </h2>
            <p>
               <?php
                    echo $product["Descrizione"];
                ?>
            </p>
            </div>
        </div>
    </body>
</html>
