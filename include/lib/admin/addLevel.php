<?php

include_once("../../../include/lib/mysql/query.php");
include_once("../../../include/page.php");

getCss();

if(isset($_POST['NCategoria']) && isset($_POST['NLivello']) && isset($_POST['NPercSconto'])){
    if (isset($_POST['NTettoMax'])){
        execadd($_POST['NCategoria'],$_POST['NLivello'],$_POST['NPercSconto'],$_POST['NTettoMax']);
    }else{
        execadd($_POST['NCategoria'],$_POST['NLivello'],$_POST['NPercSconto']);
    }
}else{
    form();
}

function execadd($NCategoria,$NLivello,$NPercSconto,$NTettoMax = ""){
    $add = new Query();

    if($NTettoMax != ""){
        $newlvl = $add->exec("CALL NuovoLivello ($NLivello,$NPercSconto,$NTettoMax,'$NCategoria');");
    }else{
        $newlvl = $add->exec("CALL NuovoLivello ($NLivello,$NPercSconto,NULL,'$NCategoria');");
    }

    ?><p>Nuovo Livello di sconto aggiunto. <a href="addLevel.php">Aggiungi un nuovo Livello.</a></p><?php
}

function form(){
    ?>
    <form action="addLevel.php" method="POST">
                <table style align="center">
                    <tr>
                        <td>NLivello</td><td><input type="text" name="NLivello"></td>
                    </tr>
                    <tr>
                        <td>NPercSconto</td><td><input type="text" name="NPercSconto"></td>
                    </tr>
                    <tr>
                        <td>NTettoMax (opzionale)</td><td><input type="text" name="NTettoMax"></td>
                    </tr>
                    <tr>
                        <td>Categoria</td>
                        <td>
                            <select id="NCategoria" name="NCategoria"><?php
                                     $cat = new Query();
                                     $list = $cat->exec("SELECT NomeCategoria FROM Categoria;");
                                     while($row = mysql_fetch_row($list)){
                                        ?><option value="<?php echo $row[0];?>" id="NCategoria" name="NCategoria"><?php echo $row[0];?></option><?php
                                     }


                                ?></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Aggiungi Livello Sconto"></td>
                    </tr>
        </table>
    </form>
<?php
}

?>
