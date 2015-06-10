<!DOCTYPE html>


<html>
    <?php
        //Creo l'header in cui includo il foglio di stile e setto la pagina del titolo
        include("include/page.php");
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

                <form id="makelamp" action="include/lib/lamp.php">
                    <select>
                        <option value="321432">Nome_Paralume</option>
                    </select>
                </form>

            </div>
        </div>
    </body>
</html>
