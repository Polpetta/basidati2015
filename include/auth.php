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

    private $query = new Query();
    private $id;
    private $password;
    private $info= array(
        type => "",
        isCorrect => false
        );


    public function login($id, $passwd){
        /*
         All'interno verrà eseguito prima il controllo per vedere se chi si
         sta loggando è un amministratore (i dipendenti) e poi si vedrà se chi
         tenta di loggarsi è un utente. In entrambe i casi bisognerà creare una
         sessione o un cookie.

        */

        if(pswdCheck($passwd, $id, "Dipendente") == true){
            $this->info["type"] = "Dipendente";
            $this->info["isCorrect"] = true;

        }elseif(pswdCheck($passwd, $id, "Iscritto") == true){
            $this->info["type"] = "Iscritto";
            $this->info["isCorrect"] = true;
        }

    }

    public function getInfo(){
        return $this->info;
    }

    private function pswdCheck($pswd, $usr, $type){
        $code= "Cod" . $type;
        $check= $this->query->exec("SELECT * FROM `$type` WHERE `$code`=`$id` && `Password`=`$pswd`");
        if (mysql_num_rows($check) == 1){
            return true;
        }
        else{
            return false;
        }
    }

}


?>
