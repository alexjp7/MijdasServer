<?php

    class Criteria
    {
        private $connection;

        public $a_id;
        public $c_id;
        public $element;
        public $maxMark;
        public $displayText;

        public function __construct($connection)
        {
            $this->connection = $connection;
        }

        public function getBySubject($a_id)
        {
            $query = "SELECT c_id, element, max_mark, display_text
                      FROM criteria_item 
                      WHERE a_id = {$a_id};";
                      
            $stmt = $this->connection->prepare($query);
            $stmt->execute();

            return $stmt;
        }
    }


?>