<?php

include_once("include/lib/mysql/query.php");

//STATS************************************************************************

function query9(){
    $stats = new Query();

    $q9 = $stats->exec ("SELECT I.CodIscritto,I.Nome,I.Cognome, MAX(SC.Livello) AS Livello_massimo
FROM Iscritto I, Sconto SC, Scontrino S, Scaglione SCA,Certifica CE,Prodotto P, Categoria C
WHERE SCA.Categoria=C.NomeCategoria AND SCA.Sconto=SC.Id AND P.Categoria=C.NomeCategoria AND CE.Prodotto=P.CodProdotto AND CE.Scontrino=S.Id AND S.Iscritto=I.CodIscritto
AND C.NomeCategoria=(SELECT P.Categoria
						  FROM Prodotto P, Categoria C, Certifica CE, Scontrino S
						  WHERE P.Categoria=C.NomeCategoria AND CE.Prodotto=P.CodProdotto AND CE.Scontrino=S.Id AND Month(S.Data)=Month(now())
						  GROUP BY C.NomeCategoria
						  ORDER BY SUM(S.SubTotale) DESC
						  LIMIT 1);"
                       );

    if(mysql_num_rows($q9) > 0){
        echo "<h3>Livello di sconto piu alto nella categoria che ha venduto di pi&ugrave; questo mese</h3>";
            ?><table style align="center" border="1">
            <tr>
                <th>CodIscritto</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Livello_massimo</th>
            </tr> <?php
        while($row = mysql_fetch_row($q9)){
            ?>
            <tr>
				<td><?php echo $row[0];?></td>
				<td><?php echo $row[1];?></td>
                <td><?php echo $row[2];?></td>
                <td><?php echo $row[3];?></td>
            </tr>
            <?php
        }
    ?></table><?php
        }
}

function query8(){
    $stats = new Query();

    $q8 = $stats->exec ("SELECT C.NomeCategoria as Categoria, D.Nome, COUNT(S.Id) AS Num_Scontrini
                            FROM Dipendente D, Categoria C, Prodotto P, Certifica CE, Scontrino S
                            WHERE D.Categoria=C.NomeCategoria AND P.Categoria=C.NomeCategoria AND CE.Prodotto=P.CodProdotto AND CE.Scontrino=S.Id
                            GROUP BY D.Nome
                            ORDER BY Num_Scontrini DESC
                            LIMIT 1;"
                       );

    if(mysql_num_rows($q8) == 1){
        $row = mysql_fetch_row($q8);
        echo "<h3>Miglior dipendente</h3>";
        echo "$row[1] è il dipendente responsabile della categoria $row[0] che ha stampato il maggior numero di scontrini, $row[2]. <br>";
    }

}

function query7(){
    $stats = new Query();

    $q7 = $stats->exec ("SELECT S.Data, SUM(S.SubTotale) AS Tot_vendite
                            FROM Scontrino S
                            GROUP BY S.Data
                            ORDER BY Tot_vendite DESC
                            LIMIT 1;"
                       );
    if(mysql_num_rows($q7) > 0){
        echo "<h3>Giorno della settimana dove vi è stato il maggior guadagno</h3>";
        ?><table style align="center" border="1">
            <tr>
                <th>Data</th>
                <th>Totale</th>
            </tr> <?php
        while($row = mysql_fetch_row($q7)){
            ?>
            <tr>
				<td><?php echo $row[0];?></td>
				<td><?php echo $row[1];?></td>
            </tr>
            <?php
        }
    ?></table><?php

    }

}

function query6(){
    echo "<h3>Iscritti che non hanno mai comprato prodotti da una certa categoria</h3>";

    ?><iframe src="include/lib/admin/q6.php" scrolling="auto"></iframe><?php


}

function query5(){
    $stats = new Query();

    $q5 = $stats->exec ("SELECT P.Categoria, SUM(S.SubTotale) AS Guadagno_Max
                            FROM Prodotto P, Categoria C, Certifica CE, Scontrino S
                            WHERE P.Categoria=C.NomeCategoria AND CE.Prodotto=P.CodProdotto AND CE.Scontrino=S.Id
                            GROUP BY C.NomeCategoria
                            ORDER BY Guadagno_Max DESC
                            LIMIT 1;"
                       );

    if(mysql_num_rows($q5) > 0){
        echo "<h3>Categoria che ha venduto pi&ugrave; prodotti</h3>";
        ?>
        <table style align="center" border="1">
            <tr>
                <th>Categoria</th>
                <th>Guadagno</th>
            </tr>
        <?php

        while($row = mysql_fetch_row($q5)){ ?>
            <tr>
				<td><?php echo $row[0];?></td>
				<td><?php echo $row[1];?></td>
            </tr> <?php
        }
        ?>
        </table> <?php
    }
}

function query4(){
    $stats = new Query();

    $q4 = $stats->exec ("SELECT FO.Nome, FO.Fax, FO.Telefono, FO.Mail, FO.Indirizzo, count(*) AS Numero_acquisto FROM Fornitore FO JOIN Fattura F ON FO.Nome=F.Fornitore GROUP BY FO.Nome ORDER BY Numero_acquisto DESC LIMIT 1;");

    if(mysql_num_rows($q4) > 0){
        echo "<h3>Fornitore da cui ho comprato di pi&ugrave;</h3>";
        ?> <table style align="center" border="1">
            <tr>
                <th>Nome</th>
                <th>Fax</th>
                <th>Telefono</th>
                <th>Mail</th>
                <th>Indirizzo</th>
                <th>Numero di acquisti</th>
            </tr>
        <?php

        while($row = mysql_fetch_row($q4)){ ?>
            <tr>
				<td><?php echo $row[0];?></td>
				<td><?php echo $row[1];?></td>
                <td><?php echo $row[2];?></td>
                <td><?php echo $row[3];?></td>
                <td><?php echo $row[4];?></td>
                <td><?php echo $row[5];?></td>
				</tr> <?php
        }
?> </table> <?php
    }
}

function adminStats(){
    echo "<h2>Statistiche</h2>";
    query4();
    query5();
    query6();
    query7();
    query8();
    query9();
}

//*****************************************************************************
//ADD**************************************************************************

function addInvoice(){
    echo "<h3>Aggiungi Fattura</h3>";
    ?><iframe src="include/lib/admin/addInvoice.php" scrolling="auto"></iframe><?php
}

function addTicket(){
    echo "<h3>Emetti Scontrino</h3>";
    ?><iframe src="include/lib/admin/addTicket.php" scrolling="auto"></iframe><?php
}

function addCategory(){
    echo "<h3>Aggiungi Categoria</h3>";
    ?><iframe src="include/lib/admin/addCategory.php" scrolling="auto"></iframe><?php
}

function addSupplier(){
    echo "<h3>Aggiungi Fornitore</h3>";
    ?><iframe src="include/lib/admin/addSupplier.php" scrolling="auto"></iframe><?php
}

function removeSupplier(){
    echo "<h3>Rimuovi Fornitore</h3>";
    ?><iframe src="include/lib/admin/removeSupplier.php" scrolling="auto"></iframe><?php
}

function addUser(){
    echo "<h3>Aggiungi Utente</h3>";
    ?><iframe src="include/lib/admin/addUser.php" scrolling="auto"></iframe><?php
}

function removeUser(){
    echo "<h3>Rimuovi Utente</h3>";
    ?><iframe src="include/lib/admin/removeUser.php" scrolling="auto"></iframe><?php
}

function adminOp(){
    /*qui ci andranno le funzioni per inserire i dati come le fatture,
    le nuove categorie con i nuovi dipendenti e per emettere nuovi scontrini*/
    addCategory();
    addTicket();
    addInvoice();
    addSupplier();
    removeSupplier();
    addUser();
    removeUser();
}

//USER*************************************************************************

function query10($user){
    $q10 = new Query();

    $result = $q10->exec("SELECT COUNT(S.Id) AS Numero_Acquisti,C.NomeCategoria, max(SC.Livello) AS Livello_attuale FROM Scontrino S,Categoria C,Sconto SC,Iscritto I, Certifica CE, Prodotto P,Scaglione SCA WHERE S.Iscritto=I.CodIscritto AND CE.Scontrino=S.Id AND CE.Prodotto=P.CodProdotto AND P.Categoria=C.NomeCategoria AND SCA.Categoria=C.NomeCategoria AND SCA.Sconto=SC.Id AND I.CodIscritto=$user GROUP BY C.NomeCategoria;");

    if(mysql_num_rows($result) > 0){
        echo "<h3>I tuoi scontrini</h3>";
        ?> <table style align="center" border="1">
            <tr>
                <th>Numero Acquisti</th>
                <th>Nome Categoria</th>
                <th>Livello</th>
            </tr>
        <?php

        while($row = mysql_fetch_row($result)){ ?>
            <tr>
				<td><?php echo $row[0];?></td>
				<td><?php echo $row[1];?></td>
                <td><?php echo $row[2];?></td>
				</tr> <?php
        }
?> </table> <?php
    }
}

function userStats($user){
    query10($user);
}

function showServices($userType,$user){
    if ($userType == "admin"){
        //fai le robe di admin
        echo "<h1>Amministrazione</h1>";
        adminOp();
        adminStats();
    }else{
        //fai le robe di user
        echo "<h1>Zona Utente</h1>";
        userStats($user);
    }
}

function doLogin(){
    ?>
    <h1>Login</h1>

            <form action="login.php" method="POST">
                <table style align="center">
                    <tr>
                        <td>id</td> <td><input type="text" name="userid"></td>
                    </tr>
                    <tr>
                        <td>Password</td> <td><input type="password" name="passid"></td>
                    </tr>
                    <tr>
                        <td>User</td><td><input type="radio" name="isUser" value="true" CHECKED></td>
                    </tr>
                    <tr>
                        <td>Admin</td><td><input type="radio" name="isUser" value="false"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Login"></td>
                    </tr>
                </table>
            </form>
<?php
}


function login($user,$pass,$type){
    $result = false;
    $pass = sha1($pass);

    $login = new Query();
    if ($type == "user"){
        $user = $login->exec("SELECT * FROM Iscritto WHERE CodIscritto = '$user' && Password = '$pass'");

        if (mysql_num_rows($user) == 1){
            $result = true;
            }


    }else{
        $admin = $login->exec("SELECT * FROM Dipendente WHERE CodDipendente = '$user' && Password = '$pass'");

        if (mysql_num_rows($admin) == 1){
            $result = true;
        }
    }
    return $result;
}


?>


<!DOCTYPE html>


<html>
    <?php
        //Creo l'header in cui includo il foglio di stile e setto la pagina del titolo
        include("include/page.php");
        getHeader("Area Riservata");
    ?>
    <body>
        <?php
            //La funzione mi aggiunge il menu alla pagina
            getMenu();
        ?>
        <div id="main">
           <?php

                if(isset($_POST['userid']) && isset($_POST['passid'])){

                    $user = $_POST['userid'];
                    $pass = $_POST['passid'];

                    if($_POST['isUser'] == "true" ){
                        $type = "user";
                    }else{
                        $type = "admin";
                    }

                    if(login($user,$pass, $type)){
                        showServices($type,$user);
                    }else{
                     die("Username o password errati. Riprova.");
                    }

                }else{
                        doLogin();

                    }

            ?>
        </div>
    </body>
</html>
