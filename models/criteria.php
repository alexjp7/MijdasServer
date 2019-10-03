<?php
    /************************************************
     Author:  Alex Perceval 
     Date:    3/10/2018
     Group:   Mijdas(kw01)
     Purpose: Criteria , and to provide an interface 
                for database transactions
    ************************************************/
    class Criteria
    {
        private $connection;

        public $a_id;
        public $c_id;
        public $element;
        public $max_mark;
        public $display_text;

        public function __construct($connection)
        {
            $this->connection = $connection;
        }

        public function getBySubject($a_id)
        {
            $query = "SELECT c_id, element, max_mark, display_text
                      FROM criteria_item 
                      WHERE a_id = {$a_id} ORDER BY c_id;";
                      
            $stmt = $this->connection->prepare($query);
            $stmt->execute();

            return $stmt;
        }
        public function create()
        {
            $query = "CALL create_criteria(:a_id, :element, :max_mark, :display_text)";
            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(":a_id", $this->a_id,PDO::PARAM_INT);
            $stmt->bindParam(":element", $this->element,PDO::PARAM_INT);
            $stmt->bindParam(":max_mark", $this->max_mark);
            $stmt->bindValue(":display_text",$this->display_text,PDO::PARAM_STR);

            return $stmt->execute();
        }
        
    }
?>