<?php

include_once("include/lib/mysql/query.php");

$Pid=$_GET['id'];

if (!isset($Pid)){
    header("Location: products.php");
    exit;
} else {
 $product=array(
     "CodProdotto" => $Pid,
     "Nome" => getInfo ("Nome",$Pid),
     "Descrizione" => getInfo ("Descrizione",$Pid),
     "Qta" => getInfo ("Quantità",$Pid),
     "Costo" => getInfo ("Costo",$Pid),
     "IVA" => getInfo ("PercentualeIVA",$Pid),
     "Categoria" => getInfo ("Categoria",$Pid),
     );
}


function getInfo($attribute="*",$product){
 /*
 In questa funzione si restituisce il nome del prodotto di cui si vogliono
 i dettagli.

 In questa funzione si ritorna un array con tutte le informazioni di base sul
 prodotto in questione. Ancora da finire l'implementazione.
 */
	$info = new Query();
	$query = $info->exec ("SELECT Nome,Descrizione,Quantita,Costo,PercentualeIVA,Categoria FROM Prodotto WHERE CodProdotto = '$product'");

	if (mysql_num_rows($query) > 0) {
        $row = mysql_fetch_row($query);
	}


    return "Gianni"; //test
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
            <h1>
                <?php
                    echo $product["Nome"];
                ?>
            </h1>
            <div id="cat">
                Prodotto in <b><?php echo $product["Categoria"];?></b>
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
