<?php

include_once("../../../include/lib/mysql/query.php");
include_once("../../../include/page.php");

getCss();

if(isset($_POST['CProdotto'])){
    hide($_POST['CProdotto']);
}else{
    form();
}

function hide($id){

    $qry = new Query();

    $result = $qry->exec("UPDATE Prodotto SET Quantita = -1 WHERE CodProdotto = $id;");

    ?><p>Prodotto Nascosto. <a href="hideProduct.php">Nascondi un altro Prodotto.</a></p><?php

}

function form(){
?><form action="hideProduct.php" method="POST">
                <table style align="center">
                    <tr>
                        <td>Prodotto</td>
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
                        <td><input type="submit" value="Elimina"></td>
                    </tr>
                </table>
</form>
<?php
}
