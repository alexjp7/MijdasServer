<?php
    /************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose: Subject model, and to provide an interface 
                for database transactions
    ************************************************/
    class Subject
    {
        private $connection;
        private $errorMessage;
      
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

        public function getErrorMessage()
        {
            return $this->errorMessage;
        }
        
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
        public function readCoordinatorInstitution($username)
        {
            $query = "SELECT DISTINCT uni.id as i_id, uni.name FROM subject JOIN institution as uni ON subject.i_id = uni.id WHERE subject.coordinator1 = '{$username}'";
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
        public function readID($code, $institution_id, $coordinator1)
        {
            $query = "SELECT subject.id
                        FROM subject
                        WHERE subject.code = '{$code}'
                        AND subject.i_id = {$institution_id}
                        AND subject.coordinator1 = '{$coordinator1}'";
            
            $stmt = $this->connection->prepare($query);
            $stmt->execute();

            return $stmt;
        }
        public function readCoordinatorSubject($institution_id, $username)
        {
            $query = "SELECT subject.id,subject.code FROM subject WHERE coordinator1='{$username}' AND  i_id ={$institution_id}";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();     
            return $stmt;
        }
        public function create()
        {
            $query = "INSERT INTO subject(code, coordinator1, i_id)VALUES(:code, :coordinator1, :i_id)";
            $stmt = $this->connection->prepare($query);
   
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
        
        public function addTutor($tutors)
        {
            $this->connection->beginTransaction();
            foreach($tutors as $tutor )
            {
                $query = "INSERT INTO staff_allocation(username, subject_id) VALUES(:tutor, :subject)"; 
                $stmt = $this->connection->prepare($query);
                $stmt->bindValue(":tutor",$tutor, PDO::PARAM_STR);
                $stmt->bindParam(":subject", $this->subject_id, PDO::PARAM_INT);
                
                if(!$stmt->execute())
                { 
                    $this->errorMessage = "Linking of tutors failed";
                    $this->connection->rollback();
                    return false;
                }       
            } //Commit only succesful transactions
            $this->connection->commit();
            return true;
        }
        public function getTutorsBySubject($subject_id)
        {
            $query = "SELECT username FROM staff_allocation WHERE subject_id = {$subject_id}";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function removeTutorFromSubject($subject_id, $tutor_username)
        {
            $query = "DELETE FROM staff_allocation WHERE subject_id = {$subject_id} AND username = '$tutor_username'";
            $stmt = $this->connection->prepare($query);
            return $stmt->execute();
        }

        public function getAllAssessments($s_id)
        {
            $query = "SELECT id, name FROM assessment WHERE  subject_id = {$s_id}";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt;
        }
    }
?>