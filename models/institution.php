<?php
    /************************************************
     Author:  Alex Perceval 
     Date:    3/10/2018
     Group:   Mijdas(kw01)
     Purpose: Institution  model, and to provide an interface 
                for database transactions
    ************************************************/
    class Institution
    {
        private $connection;
        private $tableName = "institution";

        private $name;
        private $domain;
        private $institution_id;

        function __construct($connection)
        {
            $this->connection = $connection;
        }

        public function readAllUserInstituions($username)
        {
            $query =   "SELECT institution.name, institution.id FROM {$this->tableName}
                        JOIN user_institution ON  {$this->tableName}.id = user_institution.institution_id
                        WHERE username ='{$username}'";

            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            
            return $stmt;
        }    
    }
?>