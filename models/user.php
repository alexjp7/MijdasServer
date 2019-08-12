<?php

    class User
    {

        private const TABLE_NAME = "user";
        private $connection;
        private $username;
        private $passowrd;
        private $email;
        private $permissionType;
        private $institutionId;

        function __construct($connection)
        {
            $this->connection = $connection;
        }

        public function read()
        {
            $query = "SELECT * FROM ".self::TABLE_NAME;
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            
            return $stmt;
        }

        public function readOne($id)
        {
          
            $query = "SELECT * FROM ".self::TABLE_NAME. " WHERE username = '{$id}'";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            
            return $stmt;
        }
    }


?>