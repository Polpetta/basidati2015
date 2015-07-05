<?php

include_once("../../../include/lib/mysql/query.php");
include_once("../../../include/page.php");

getCss();


if(isset($_POST['NFattura']) && isset($_POST['FData']) && isset($_POST['FQuantita']) && isset($_POST['CProdotto']) && $_POST['CProdotto'] != ""){

    execadd($_POST['NFattura'], $_POST['FData'], $_POST['FQuantita'], $_POST['NFornitore'], null, $_POST['CProdotto']);

    }else{

        if(isset($_POST['PNome']) && isset($_POST['PCosto']) && isset($_POST['PPercentualeIVA'])){

            execadd($_POST['NFattura'], $_POST['FData'], $_POST['FQuantita'], $_POST['NFornitore'], $_POST['PCategoria'], $_POST['CProdotto'], $_POST['PNome'], $_POST['PCosto'], $_POST['PPercentualeIVA'], $_POST['PDescrizione']);

        }else{
            form();
        }
}

function execadd($NFattura,$FData,$FQuantita,$NFornitore,$PCategoria="",$CProdotto="",$PNome="",$PCosto="",$PPercentualeIVA="",$PDescrizione=""){

    echo "$NFattura <br>";
    echo "$FData <br>";
    echo "$FQuantita <br>";
    echo "$NFornitore <br>";
    echo "$PCategoria <br>";
    echo "$CProdotto <br>";
    echo "$PNome <br>";
    echo "$PCosto <br>";
    echo "$PPercentualeIVA <br>";
    echo "$PDescrizione <br>";

    $add = new Query();
    if($PCategoria == "" && $PNome == "" && $PCosto == "" && $PPercentualeIVA == "" && $PDescrizione == ""){

        $newinvoice = $add->exec("CALL NuovaFattura($NFattura,'$NFornitore',$FQuantita,'$FData',$CProdotto,NULL,NULL,NULL,NULL,NULL);");

    }else{

        $newinvoice = $add->exec("CALL NuovaFattura($NFattura,'$NFornitore',$FQuantita,'$FData',NULL,'$PNome','$PDescrizione',$PCosto,$PPercentualeIVA, '$PCategoria');");
    }

    ?><p>Fattura aggiunta con successo. <a href="addInvoice.php">Aggiungi una nuova fattura.</a></p><?php
}

function form(){
    ?>
            <form action="addInvoice.php" method="POST">
                <table style align="center">
                    <tr>
                        <td>NFattura</td><td><input type="text" name="NFattura"></td>
                    </tr>
                    <tr>
                        <td>FData</td><td><input type="text" name="FData"></td>
                    </tr>
                    <tr>
                        <td>FQuantit&agrave;</td><td><input type="text" name="FQuantita"></td>
                    </tr>
                    <tr>
                        <td>Fornitore</td>
                        <td>
                            <select id="NFornitore" name="NFornitore"><?php
                                     $cat = new Query();
                                     $list = $cat->exec("SELECT Nome FROM Fornitore;");
                                     while($row = mysql_fetch_row($list)){
                                        ?><option value="<?php echo $row[0];?>" id="NFornitore" name="NFornitore"><?php echo $row[0];?></option><?php
                                     }


                                ?></td>
                    </tr>
                    <tr>
                        <td>Codice Prodotto (solo se non &egrave; nuovo prodotto)</td><td><input type="text" name="CProdotto"></td>
                    </tr>
                    <tr>
                        <td><b>Se Nuovo &egrave; un nuovo prodotto compilare anche:</b></td>
                    </tr>
                    <tr>
                        <td>Categoria</td>
                        <td>
                            <select id="PCategoria" name="PCategoria"><?php
                                     $cat = new Query();
                                     $list = $cat->exec("SELECT NomeCategoria FROM Categoria");
                                     while($row = mysql_fetch_row($list)){
                                        ?><option value="<?php echo $row[0];?>" id="PCategoria" name="PCategoria"><?php echo $row[0];?></option><?php
                                     }


                                ?></td>
                    </tr>
                    <tr>
                        <td>Nome Prodotto (opzionale)</td><td><input type="text" name="PNome"></td>
                    </tr>
                    <tr>
                        <td>Costo Prodotto (opzionale)</td><td><input type="text" name="PCosto"></td>
                    </tr>
                    <tr>
                        <td>Percentuale IVA (opzionale)</td><td><input type="text" name="PPercentualeIVA"></td>
                    </tr>
                    <tr>
                        <td>Descrizione Prodotto (opzionale)</td><td><textarea cols="40" rows="5" name="PDescrizione"></textarea></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Aggiungi"></td>
                    </tr>
                </table>
                <p>I campi definiti come opzionali si riferiscono solo in caso in cui la fattura sia di un prodotto gi&agrave; esistente.</p>
            </form><?php
}

?>


