<?php
    class Item
    {
        //Connection Properties
        private $connection;
        private $tableName = "object2";

        //Object Properties
        private $id;

        public function __construct($conn)
        {
            $this->connection = $conn;

        }


        public function read()
        {
            // select all query
            $query = "SELECT * FROM $this->tableName";
         
            // prepare query statement
            $stmt = $this->connection->prepare($query);
         
            // execute query
            $stmt->execute();
         
            return $stmt;
        }

        public function read_one($id)
        {
            // select all query
            $query = "SELECT id FROM $this->tableName WHERE id = '$id'";
    
            // prepare query statement
            $stmt = $this->connection->prepare($query);
        
            // execute query
            $stmt->execute();
            return $stmt;
        }
        
        public function getId()
        {
            return $this -> id;
        }

    }



?>