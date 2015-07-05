<?php

include_once("include/lib/mysql/query.php");

//STATS************************************************************************

function query9(){

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

}

function adminOp(){
    /*qui ci andranno le funzioni per inserire i dati come le fatture,
    le nuove categorie con i nuovi dipendenti e per emettere nuovi scontrini*/
    addCategory();
    addTicket();
    addInvoice();
}

function showServices($userType){
    if ($userType == "admin"){
        //fai le robe di admin
        echo "<h1>Amministrazione</h1>";
        adminOp();
        adminStats();
    }else{
        //fai le robe di user
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
                        showServices($type);
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
