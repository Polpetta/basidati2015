<?php

include_once("../../../include/lib/mysql/query.php");
include_once("../../../include/page.php");

getCss();

if(isset($_POST['NNome']) && isset($_POST['NTelefono']) && isset($_POST['NMail']) && isset($_POST['NIndirizzo'])){
    if(isset($_POST['NFax'])){
        execadd($_POST['NNome'], $_POST['NTelefono'], $_POST['NMail'], $_POST['NIndirizzo'], $_POST['NFax']);
    }else{
        execadd($_POST['NNome'], $_POST['NTelefono'], $_POST['NMail'], $_POST['NIndirizzo']);
    }
}else{
    form();
}

function execadd($NNome, $NTelefono, $NMail, $NIndirizzo, $NFax = ""){
    $add = new Query();
    if($NFax == ""){
        $result = $add->exec("INSERT INTO Fornitore VALUES ('$NNome',NULL,'$NTelefono','$NMail','$NIndirizzo');");
    }else{
        $result = $add->exec("INSERT INTO Fornitore VALUES ('$NNome','$NFax','$NTelefono','$NMail','$NIndirizzo');");
    }

    ?><p>Nuovo Fornitore aggiunto. <a href="addSupplier.php">Aggiungi un nuovo Fornitore.</a></p><?php
}

function form(){
    ?>

    <form action="addSupplier.php" method="post">
        <table style align="center">

            <tr>
                <td>NNome</td><td><input type="text" name="NNome"></td>
            </tr>
            <tr>
                <td>NFax</td><td><input type="text" name="NFax"></td>
            </tr>
            <tr>
                <td>NTelefono</td><td><input type="text" name="NTelefono"></td>
            </tr>
            <tr>
                <td>NMail</td><td><input type="text" name="NMail"></td>
            </tr>
            <tr>
                <td>NIndirizzo</td><td><input type="text" name="NIndirizzo"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Aggiungi Fornitore"></td>
            </tr>

        </table>
    </form>
<?php
}
