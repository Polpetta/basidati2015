<?php

include_once("../../../include/lib/mysql/query.php");
include_once("../../../include/page.php");

getCss();

if(isset($_POST['category']) && $_POST['category'] != ""){
    execq6($_POST['category']);
}else{
    formq6();
}

function execq6($cat){
    //echo "<h3>Iscritti che non hanno mai comprato prodotti da una certa categoria</h3>";
    ?><a href="q6.php">Esegui una nuova ricerca</a><?php
    $stats = new Query();

    $q6 = $stats->exec ("SELECT *
                            FROM Iscritto I1
                            WHERE I1.CodIscritto = ANY (SELECT I.CodIscritto
                            FROM Iscritto I
                            WHERE I.CodIscritto <> ALL
                            (SELECT S.Iscritto
                            FROM Prodotto P JOIN Scontrino S
                            ON P.Categoria='$cat'));");

    ?>
    <table style align="center" border="1">
            <tr>
                <th>Codice Iscritto</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Fax</th>
                <th>Telefono</th>
                <th>Mail</th>
                <th>Indirizzo</th>
            </tr>
    <?php

    while($row = mysql_fetch_row($q6)){ ?>
            <tr>
				<td><?php echo $row[0];?></td>
				<td><?php echo $row[1];?></td>
                <td><?php echo $row[2];?></td>
                <td><?php echo $row[3];?></td>
                <td><?php echo $row[4];?></td>
                <td><?php echo $row[5];?></td>
                <td><?php echo $row[6];?></td>
            </tr> <?php
        }
        ?></table><?php
}

function formq6(){
    //echo "<h3>Visualizza iscritti che non hanno mai comprato prodotti da una certa categoria</h3>";
    ?>
            <form action="q6.php" method="POST">
                <table style align="center">
                    <tr>
                        <td>Categoria</td>
                        <td>
                            <select id="category" name="category"><?php
                                 /*<option value="" selected>Seleziona...</option>*/
                                     $cat = new Query();
                                     $list = $cat->exec("SELECT NomeCategoria FROM Categoria");
                                     while($row = mysql_fetch_row($list)){
                                        ?><option value="<?php echo $row[0];?>" id="category" name="category"><?php echo $row[0];?></option><?php
                                     }


                                ?></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Visualizza"></td>
                    </tr>
                </table>
            </form><?php
}

?>




