<?php
    /************************************************
     Author:  Alex Perceval 
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
        
        public function getDomainByAssessment($assessment_id) 
        {   
            $query = "SELECT uni.domain 
                      FROM institution AS uni INNER JOIN subject ON uni.id = subject.i_id
                      INNER JOIN assessment AS task ON task.subject_id = subject.id
                      WHERE task.id ={$assessment_id};";

            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            
            return $stmt->fetch()["domain"];
        }
    }
?>