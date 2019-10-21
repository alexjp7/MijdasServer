<?php
    /************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose: General user model, and to provide an interface 
                for database transactions
    ************************************************/
    class User
    {
        //Database Credentials
        private $tableName = "user";
        private $connection;
        //Object Properties
        public $username;
        public $password;
        public $firstName;
        public $lastName;
        public $email;
        public $permissionType;

        function __construct($connection)
        {
            $this->connection = $connection;
        }
        public function read()
        {
            $query = "SELECT * FROM ".$this->tableName;
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            
            return $stmt;
        }
        public function readOne($id)
        {
          
            $query = "SELECT * FROM ".$this->tableName. " WHERE username = '{$id}'";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function create()    
        {
            $query = "INSERT INTO ".$this->tableName." VALUES ('{$this->username}','{$this->password}','{$this->firstName}','{$this->lastName}',NULL,'{$this->email}','{$this->permissionType}')";
            $stmt = $this->connection->prepare($query);
            return $stmt->execute();
        }
        /*******************************
         * Probably needs to deal 
          with session/user authentication
        *****************************/
        public function login()
        {
            
        }
        /* Used in match partial request for staff look-up */
        public function matchUser($queryString)
        {
            $query ="SELECT username FROM user WHERE username LIKE '{$queryString}%'";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt;
        }
    }
?>