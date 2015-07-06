<?php

include_once("../../../include/lib/mysql/query.php");
include_once("../../../include/page.php");

getCss();

//CREATE PROCEDURE NuovaCategoria(NCategoria CHAR(20), NDip CHAR(15), CDip CHAR(15), DData DATE, DCodF CHAR(16), DTel CHAR(10), DMail CHAR(50),DDatainizio DATE, DInd CHAR(50), DPswd CHAR(64), SLvl SMALLINT, PrcSconto INT(2), STettoMax SMALLINT)

if(isset($_POST['NCategoria']) && isset($_POST['NDip']) && isset($_POST['CDip']) && isset($_POST['DData']) && isset($_POST['DCodF']) && isset($_POST['DTel']) && isset($_POST['DMail']) && isset($_POST['DDatainizio']) && isset($_POST['DInd']) && isset($_POST['DPswd']) && isset($_POST['SLvl']) && isset($_POST['PrcSconto'])){
    if(isset($_POST['STettoMax'])){
        execadd($_POST['NCategoria'], $_POST['NDip'], $_POST['CDip'], $_POST['DData'], $_POST['DCodF'], $_POST['DTel'], $_POST['DMail'], $_POST['DDatainizio'], $_POST['DInd'], $_POST['DPswd'], $_POST['SLvl'], $_POST['PrcSconto'], $_POST['STettoMax']);
    }else{
        execadd($_POST['NCategoria'], $_POST['NDip'], $_POST['CDip'], $_POST['DData'], $_POST['DCodF'], $_POST['DTel'], $_POST['DMail'], $_POST['DDatainizio'], $_POST['DInd'], $_POST['DPswd'], $_POST['SLvl'], $_POST['PrcSconto']);
    }
}else{
    form();
}

function execadd($NCategoria,$NDip,$CDip,$DData,$DCodF,$DTel,$DMail,$DDatainizio,$DInd,$DPswd,$SLvl,$PrcSconto,$STettoMax=""){
    $newCat = new Query();
    if($STettoMax == ""){
        $add = $newCat->exec("CALL NuovaCategoria('$NCategoria','$NDip','$CDip','$DData','$DCodF','$DTel','$DMail','$DDatainizio', '$DInd','$DPswd',$SLvl,$PrcSconto,NULL);");
    }else{
        $add = $newCat->exec("CALL NuovaCategoria('$NCategoria','$NDip','$CDip','$DData','$DCodF','$DTel','$DMail','$DDatainizio', '$DInd','$DPswd',$SLvl,$PrcSconto,$STettoMax);");
    }

    ?><p>Nuova Categoria aggiunta. <a href="addCategory.php">Aggiungi una nuova Categoria.</a></p><?php
}

function form(){
    ?>

    <form action="addCategory.php" method="post">
        <table style align="center">

            <tr>
                <td>NCategoria</td><td><input type="text" name="NCategoria"></td>
            </tr>
            <tr>
                <td>NDip</td><td><input type="text" name="NDip"></td>
            </tr>
            <tr>
                <td>CDip</td><td><input type="text" name="CDip"></td>
            </tr>
            <tr>
                <td>DData</td><td><input type="text" name="DData"></td>
            </tr>
            <tr>
                <td>DCodF</td><td><input type="text" name="DCodF"></td>
            </tr>
            <tr>
                <td>DTel</td><td><input type="text" name="DTel"></td>
            </tr>
            <tr>
                <td>DMail</td><td><input type="text" name="DMail"></td>
            </tr>
            <tr>
                <td>DDatainizio</td><td><input type="text" name="DDatainizio"></td>
            </tr>
            <tr>
                <td>DInd</td><td><input type="text" name="DInd"></td>
            </tr>
            <tr>
                <td>DPswd</td><td><input type="password" name="DPswd"></td>
            </tr>
            <tr>
                <td>SLvl</td><td><input type="text" name="SLvl"></td>
            </tr>
            <tr>
                <td>PrcSconto</td><td><input type="text" name="PrcSconto"></td>
            </tr>
            <tr>
                <td>STettoMax (opzionale)</td><td><input type="text" name="STettoMax"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Aggiungi Categoria"></td>
            </tr>

        </table>
    </form>
<?php
}

?>
