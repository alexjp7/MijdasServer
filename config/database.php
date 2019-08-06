
<?php
    //local import for connection credentials
    include_once("connect.php");

    class Database
    {
        private $connnection;

        public function getConnection()
        {
            $this->connnection = null;

            try
            {
                $this->connnection = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USERNAME, PASSWORD);
                $this->connnection->exec("set names utf8");
            }
            catch(PDOException $exception)
            {
                echo "Error establishing connection \n";
                echo "Connection error: " . $exception->getMessage();
                echo "\n";
            }
     
            return $this->connnection;
        }
    }
?>