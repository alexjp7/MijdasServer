<?php
    class Student
    {
        private $connection;

    

        public function __construct($connection)
        {
            $this->connection = $connection;
        }

        public function addToSubject($studentList, $subjectId)
        {
            $this->connection->beginTransaction();
            $stmt = $this->connection->prepare("INSERT INTO student_subject (student_id, subject_session_id) VALUES(:student, :subject)");
    
            foreach($studentList as $student)
            {
                $stmt->bindParam(":student", $student);
                $stmt->bindParam(":subject", $subjectId);

                if(!$stmt->execute())
                {   //If an insertion does not execute correctly, rollnback transaction.    
                    $this->connection->rollBack();
                    return  false;
                }
            }   
            //Succesful batch insert completed, new data is commited in database
            $this->connection->commit();
            return true;
        }
        
        public function getByAssessment($a_id)
        {
            $query = "SELECT student_id, result FROM student_results WHERE a_id = {$a_id}";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            
            return $stmt;
        }

    }
?>