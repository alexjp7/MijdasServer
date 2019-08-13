<?php
    class Institution
    {
        private $connection;
        private $table = "institution";

        private $name;
        private $domain;
        private $institution_id;

        function __construct($connection)
        {
            $this->connection = $connection;
        }

        public function readAllUserInstituions($username)
        {
            $query =   "SELECT institution.name, institution.id FROM {$this->table}
                        JOIN user_institution ON  {$this->table}.id = user_institution.institution_id
                        WHERE username ='{$username}'";

            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            
            return $stmt;
        }

        

    }

?>