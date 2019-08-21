<?php
    class Assessment
    {
        private $connection;


        public $a_number;
        public $subject_id;

        public function __construct($connection)
        {
            $this->connection = $connection;
        }

        public function getBySubject($subject_id)
        {   
            $query = "SELECT id, a_number, name FROM assessment WHERE subject_session_id = {$subject_id}";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();

            return $stmt;

        }

    }

?>