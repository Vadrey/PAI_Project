<?php

class EventQTablePrinter{

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
            echo "<td>" . $row["id_event"] . "</td>";
            echo "<td>" . $row["ename"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row['add_date'] . "</td>";
            echo "<td>" . $row["location"] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['id_whoadd'] . "</td>";
            echo "</tr>";
        }
    }

}

?>