<!DOCTYPE html>


<html>
    <?php
        //Creo l'header in cui includo il foglio di stile e setto la pagina del titolo
        include("include/page.php");
        include_once("include/lib/lamp/lamp.php");
        getHeader("Crea la tua lampada");
    ?>
    <body>
        <?php
            //La funzione mi aggiunge il menu alla pagina
            getMenu()
        ?>
        <div id="main">
            <h1>Crea la tua lampada</h1>
            <p>Seleziona il paralume e il vaso che preferisci, e noi creeremo la tua lampada personalizzata.</p>
            <div id="makelamp">

                <form id="makelamp" action="include/lib/lamp/order.php">
                    <select>
                        <?php getLampshade(); ?>
                    </select>

                    <select>
                        <?php getVase(); ?>
                    </select>

                    <input type="submit" value="Submit">
                </form>

            </div>
        </div>
    </body>
</html>
