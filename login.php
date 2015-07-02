<?php




?>


<!DOCTYPE html>


<html>
    <?php
        //Creo l'header in cui includo il foglio di stile e setto la pagina del titolo
        include("include/page.php");
        getHeader("Home");
    ?>
    <body>
        <?php
            //La funzione mi aggiunge il menu alla pagina
            getMenu()
        ?>
        <div id="main">
           <h1>Login</h1>

            <form action="login.php" method="GET">
                <table style align="center">
                    <tr>
                        <td>id</td> <td><input type="text" name="useid"></td>
                    </tr>
                        <td>Password</td> <td><input type="password" name="passid"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Login"></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
