<?php

include_once("../../../include/lib/mysql/query.php");
include_once("../../../include/page.php");

getCss();

if(isset($_POST['NNome']) && isset($_POST['NCognome']) && isset($_POST['NTelefono']) && isset($_POST['NIndirizzo']) && isset($_POST['NPassword']) && isset($_POST['NMail'])){
    if(isset($_POST['NFax'])){
        execadd($_POST['NNome'], $_POST['NCognome'], $_POST['NTelefono'], $_POST['NIndirizzo'], $_POST['NPassword'], $_POST['NMail'], $_POST['NFax']);
    }else{
        execadd($_POST['NNome'], $_POST['NCognome'], $_POST['NTelefono'], $_POST['NIndirizzo'], $_POST['NPassword'],$_POST['NMail'], "");
    }
}else{
    form();
}

function execadd($NNome, $NCognome, $NTelefono, $NIndirizzo, $NPassword,$NMail, $NFax=""){
    $add = new Query();
    if($NFax != ""){
        $result = $add->exec("INSERT INTO Iscritto (Nome,Cognome,Fax,Telefono,Mail,Indirizzo,Password) VALUES ('$NNome','$NCognome','$NFax','$NTelefono','$NMail','$NIndirizzo','$NPassword');");
    }else{
        $result = $add->exec("INSERT INTO Iscritto (Nome,Cognome,Fax,Telefono,Mail,Indirizzo,Password) VALUES ('$NNome','$NCognome',NULL,'$NTelefono','$NMail','$NIndirizzo','$NPassword');");
    }

    ?><p>Nuovo User aggiunto. <a href="addUser.php">Aggiungi un nuovo User.</a></p><?php
}

function form(){
    ?>

    <form action="addUser.php" method="post">
        <table style align="center">

            <tr>
                <td>NNome</td><td><input type="text" name="NNome"></td>
            </tr>
            <tr>
                <td>Cognome</td><td><input type="text" name="NCognome"></td>
            </tr>
            <tr>
                <td>Telefono</td><td><input type="text" name="NTelefono"></td>
            </tr>
            <tr>
                <td>Fax</td><td><input type="text" name="NFax"></td>
            </tr>
            <tr>
                <td>Mail</td><td><input type="text" name="NMail"></td>
            </tr>
            <tr>
                <td>Indirizzo</td><td><input type="text" name="NIndirizzo"></td>
            </tr>
            <tr>
                <td>Password</td><td><input type="password" name="NPassword"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Aggiungi Utente"></td>
            </tr>

        </table>
    </form>
<?php
}
