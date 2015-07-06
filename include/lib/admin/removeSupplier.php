<?php

include_once("../../../include/lib/mysql/query.php");
include_once("../../../include/page.php");

getCss();

if(isset($_POST['Nome'])){
    execremove($_POST['Nome']);
}else{
    form();
}

function execremove($nome){
    $qry = new Query();

    $remove = $qry->exec("DELETE FROM Fornitore WHERE Nome = '$nome';");

    ?><p>Nuovo Fornitore rimosso. <a href="removeSupplier.php">Rimuovi un nuovo Fornitore.</a></p><?php
}

function form(){
    ?>

    <form action="removeSupplier.php" method="post">
        <table style align="center">

            <tr>
                        <td>Nome</td>
                        <td>
                            <select id="Nome" name="Nome"><?php
                                     $cat = new Query();
                                     $list = $cat->exec("SELECT Nome FROM Fornitore");
                                     while($row = mysql_fetch_row($list)){
                                        ?><option value="<?php echo $row[0];?>" id="Nome" name="Nome"><?php echo $row[0];?></option><?php
                                     }


                                ?></td>
            </tr>
            <tr>
                <td><input type="submit" value="Rimuovi Fornitore"></td>
            </tr>
        </table>
    </form>
<?php
}
