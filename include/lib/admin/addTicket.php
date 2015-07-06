<?php

include_once("../../../include/lib/mysql/query.php");
include_once("../../../include/page.php");

getCss();

if(isset($_POST['passo'])){
    if($_POST['passo'] == 1){
        if(isset($_POST['SData']) && isset($_POST['SCodScontrino']) && isset($_POST['SIscritto']) && isset($_POST['CProdotto'])){
            form2($_POST['SData'],$_POST['SCodScontrino'],$_POST['SIscritto'],$_POST['CProdotto']);
        }
    }
    if($_POST['passo'] == 2){
        if(isset($_POST['SQuantita'])){
            execadd($_POST['SData'],$_POST['SCodScontrino'],$_POST['SIscritto'],$_POST['CProdotto'],$_POST['SQuantita']);
        }
    }
}else{
    form();
}

function execadd($SData,$SCodScontrino,$SIscritto,$CProdotto,$SQuantita){

    $add = new Query();

    $newTicket = $add->exec("CALL NuovoScontrino('$SData',$SCodScontrino,$SQuantita,$SIscritto,$CProdotto);");

    ?><p>Riga scontrino registrata con successo <a href="addTicket.php">Aggiungi una riga scontrino.</a></p><?php

}


function form2($SData,$SCodScontrino,$SIscritto,$CProdotto){
    $qta = new Query();
    $getQta = $qta->exec("SELECT Quantita FROM Prodotto WHERE CodProdotto=$CProdotto");

    $maxq = mysql_fetch_row($getQta);

    ?>

        <form action="addTicket.php" method="POST">

            <table style align="center" >

                <tr>
                    <td>Scegli la quantit&agrave; (attualmente disponibili <?php echo $maxq[0];?>)</td><td><input type="number" name="SQuantita" min="1" max="<?php echo $maxq[0];?>"></td>
                </tr>

                <tr>
                    <td><input type="submit" value="Emetti"></td>
                </tr>

            </table>

            <input type="hidden" name="SData" value="<?php echo $SData; ?>">
            <input type="hidden" name="SCodScontrino" value="<?php echo $SCodScontrino; ?>">
            <input type="hidden" name="SIscritto" value="<?php echo $SIscritto; ?>">
            <input type="hidden" name="CProdotto" value="<?php echo $CProdotto; ?>">
            <input type="hidden" name="passo" value="2">

        </form>

    <?php
}


function form(){
    ?>
            <form action="addTicket.php" method="POST">
                <table style align="center">
                    <tr>
                        <td>SData</td><td><input type="text" name="SData"></td>
                    </tr>
                    <tr>
                        <td>SCodScontrino</td><td><input type="text" name="SCodScontrino"></td>
                    </tr>
                    <tr>
                        <td>SIscritto</td>
                        <td>
                            <select id="SIscritto" name="SIscritto"><?php
                                     $cat = new Query();
                                     $list = $cat->exec("SELECT CodIscritto,Nome,Cognome FROM Iscritto;");
                                     while($row = mysql_fetch_row($list)){
                                        ?><option value="<?php echo $row[0];?>" id="SIscritto" name="SIscritto"><?php echo "$row[0], $row[1] $row[2]";?></option><?php
                                     }


                                ?></td>
                    </tr>
                    <tr>
                        <td>CProdotto</td>
                        <td>
                            <select id="CProdotto" name="CProdotto"><?php
                                     $cat = new Query();
                                     $list = $cat->exec("SELECT CodProdotto,Nome FROM ProdottiValidi;");
                                     while($row = mysql_fetch_row($list)){
                                        ?><option value="<?php echo $row[0];?>" id="CProdotto" name="CProdotto"><?php echo "$row[0], $row[1]";?></option><?php
                                     }


                                ?></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Seleziona qta"></td>
                    </tr>
                </table>
                <input type="hidden" name="passo" value="1">
            </form><?php
}

?>
