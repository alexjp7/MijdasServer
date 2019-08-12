<?php
    include_once("record.php");

    class User extends Record
    {
        private const TABLE_NAME = "user";

        function _construct() 
        {       
       
        }

        public function read()
        {
            $query = "SELECT * FROM ".self::TABLE_NAME;
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
        
            return $stmt;

        }

    }

?>