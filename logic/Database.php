<?php

class Database {

    protected $db;

    function __construct(){
    }

    function connect(){

        $servername="localhost";
        $username="root";
        $password = "";
        try {
            $this->db = new PDO("mysql:host=$servername;dbname=bstage", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        }catch(PDOException $e){
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
        }
        //$this->db = mysqli_connect('localhost', 'root', '', 'bstage');

        if($this->db){
            return $this->db;
        }else{
            return die('Connection error!');
        }

    }

    function query($q=""){
        //return mysqli_query($this->connect(), $q);
        return $this->connect()->query($q);
    }
}

    function finish(){
      $this->db->close();
    }

?>
