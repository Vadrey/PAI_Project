<?php

class Database {
    protected $db;

    function __construct(){}

    function connect(){
        $this->db = mysqli_connect('localhost', 'root', '', 'bstage');

        if($this->db){
            return $this->db;
        }else{
            return die('Connection error!');
        }

    }

    function query($q=""){
        return mysqli_query($this->connect(), $q);
    }
}

    function finish(){
      $this->db->close();
    }

?>
