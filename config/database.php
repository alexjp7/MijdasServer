
<?php
    class Database
    {
        //Connection Credentials
        private $host = "localhost";
        private $db_name = "MijdasTest";    
        private $username = "MijdasTestUser";
        private $password = "mijdas123";
        private $connnection;

        public function getConnection()
        {
            $this->connnection = null;

            try
            {
                $this->connnection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->connnection->exec("set names utf8");
            }
            catch(PDOException $exception)
            {
                echo "Error establishing connection";
                echo "Connection error: " . $exception->getMessage();
            }
     
            return $this->connnection;

        }


    }
?>