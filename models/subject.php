<?php
    class Subject
    {
        private $connection;
      
        public $code;
        public $institution_id;
        public $coordinator1;
        public $coordinator2;
        public $subject_id;
        public $session_expiry;
        
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
                        FROM ((((staff_allocation AS staff 
                            INNER JOIN subject_session AS session ON staff.subject_id = session.id))
                            INNER JOIN subject ON session.subject_id = subject.id)
                            INNER JOIN institution AS uni ON subject.i_id = uni.id)
                        WHERE staff.username = '{$username}'";

            $stmt = $this->connection->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function readSubject($institution_id, $username)
        {
            $query = "SELECT session.id, subject.code
                        FROM (staff_allocation AS staff 
                            INNER JOIN subject_session AS session ON staff.subject_id = session.id )
                            INNER JOIN subject ON session.subject_id = subject.id
                        WHERE subject.i_id = {$institution_id}  AND staff.username ='{$username}'";

            $stmt = $this->connection->prepare($query);

            $stmt->execute();     
            
            return $stmt;
        }

        public function create()
        {
            $query = "INSERT INTO subject(code, coordinator1, i_id)VALUES(:code, :coordinator1, :i_id)";
            $stmt = $this->connection->prepare($query);
            //Bind data to SQL variables
            $stmt->bindValue(":code", $this->code, PDO::PARAM_STR);
            $stmt->bindValue(":coordinator1", $this->coordinator1, PDO::PARAM_STR);
            $stmt->bindParam(":i_id", $this->institution_id, PDO::PARAM_INT);

            $this->connection->beginTransaction();
            $isSuccessful = $stmt->execute();
            $isSuccessful ? $this->connection->commit(): $this->connection->rollback();

            return $isSuccessful;           
        }

        public function activateSubject()
        {
            $query = "INSERT INTO subject_session(subject_id, session_expiry, isActive) VALUES(:subject, DATE('{$this->session_expiry}'), :isActive)";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(":subject", $this->subject_id, PDO::PARAM_INT);
            $stmt->bindValue(":isActive", true, PDO::PARAM_BOOL);

           return $stmt->execute();

        }   
    }
?>