<?php

class Query
{
    private $dbConnection;
    private $dbUser="dpolonio";
    private $dbPass="L3LVdBdX";
    private $dbName="dpolonio-PR"; //database da selezionare
    private $dbURL="basidati1004.studenti.math.unipd.it";
    private $dbPort="3306";

    public function __construct(){
        $this->openDB();
    }

    private function openDB(){
        if(isset($dbConnection)){
            return $this->dbConnection;
        }else{
            $this->dbConnection=$this->connect();
        }
        return $this->dbConnection;
    }

    private function closeDB(){
        if(isset($this->dbConnection)){
             mysql_close($this->dbConnection);
        }
    }

    private function connect(){
        $db=$this->dbURL.":".$this->dbPort;
        $this->dbConnection= mysql_connect( $db, $this->dbUser, $this->dbPass) or die('Could not connect to server.' );
        mysql_select_db($this->dbName, $this->dbConnection) or die("Could not select database $this->dbName.");
        return $this->dbConnection;
    }

    public function exec($query){
        $result=mysql_query($query,$this->openDB());
        $this->closeDB();
        return $result;
    }
}

?>
