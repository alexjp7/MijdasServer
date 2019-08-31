<?php
    class Subject
    {
        private $connection;
        private $tableName = "subject";

        public $code;
        public $institutionName;

        public function __construct($connection)
        {
            $this->connection = $connection;
        }

        //Doesn't nest things properly
        public function readAllUserSubjects($username)
        {
            $query =" SELECT staff.username, session.id,session.subject_code, uni.name
                    FROM (staff_allocation AS staff 
                    INNER JOIN subject_session AS session ON staff.subject_id = session.id)
                    INNER JOIN institution AS uni ON session.i_id = uni.id
                    WHERE staff.username = '{$username}'
                    ORDER BY uni.name";

            $stmt = $this->connection->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function readInstitution($username)
        {
            $query = "SELECT distinct(uni.id), uni.name 
                    FROM (staff_allocation AS staff INNER JOIN subject_session AS session ON staff.subject_id = session.id)
                    INNER JOIN institution AS uni ON session.i_id = uni.id
                    WHERE staff.username = '{$username}'";

            $stmt = $this->connection->prepare($query);
            $stmt->execute();

            return $stmt;

        }

        public function readSubject($institution_id, $username)
        {
            $query = "SELECT session.id, session.subject_code
            FROM staff_allocation AS staff INNER JOIN subject_session AS session ON staff.subject_id = session.id  
            WHERE session.i_id = {$institution_id} AND staff.username = '{$username}'";
            $stmt = $this->connection->prepare($query);

            $stmt->execute();     
            
            return $stmt;
        }

    }
?>