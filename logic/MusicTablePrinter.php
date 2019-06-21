<?php

class MusicTablePrinter{

    private $db;
    private $q;
    private $result;

    function __construct($q){
        $this->db = new Database();
        $this->q = $q;
    }

    function executeQuery(){
        $this->result = $this->db->query($this->q);
    }

    function printTable()
    {
        $this->executeQuery();
        foreach($this->result as $row) {
            echo "<td>" . $row["performer"] . "</td>";
            echo "<td>" . $row["title"] . "</td>";
            echo "<td>" . $row["year"] . "</td>";
            echo "<td>" . $row['ftype'] . "</td>";
            echo "<td>" . $row['gname'] . "</td>";
            echo "</tr>";
        }
    }

}

?>