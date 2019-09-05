<?php
    class User
    {
        //Database Credentials
        private $tableName = "user";
        private $connection;
        //Object Properties
        public $username;
        public $password;
        public $email;
        public $permissionType;

        function __construct($connection)
        {
            $this->connection = $connection;
        }
        //SELECT * from database
        public function read()
        {
            $query = "SELECT * FROM ".$this->tableName;
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            
            return $stmt;
        }

        //SELECT from database
        public function readOne($id)
        {
          
            $query = "SELECT * FROM ".$this->tableName. " WHERE username = '{$id}'";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            
            return $stmt;
        }
        //INSERT to database
        public function create()    
        {
            $query = "INSERT INTO ".$this->tableName." VALUES ('{$this->username}','{$this->password}','{$this->email}','{$this->permissionType}')";
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

    }
?>