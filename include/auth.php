<?php

/*
In questo file verrà creata la classe Auth che servirà per eseguire il login
nel sito. L'oggetto dovrà essere in grado di capire se è un utente o se è un
amministratore quello che si sta loggando, e in tal caso, dare l'accesso a
specifiche funzioni. È necessario importare la classe Query con una relazione
di tipo has-a
*/

include_once("include/lib/mysql.php");

class Auth{

    $query = new Query();

    /*
    Nota che gli admin potrebbero anche essere i dipendenti stessi.
    */

    $admin = "nomeAdmin";
    $passAdmin = "passAdmin";

    public function login($username, $passwd){
        /*
         All'interno verrà eseguito prima il controllo per vedere se chi si
         sta loggando è un amministratore e poi si vedrà se chi tenta di
         loggarsi è un utente. In entrambe i casi bisognerà creare una sessione
         o un cookie.

         Es query:
            SELECT * FROM Iscritto WHERE Id = $username ;
        */
    }

}


?>
