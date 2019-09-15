<?php
    class Student
    {
        private $connection;

        public $studentId;
        public $results;
        public $assessment;

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
            $query = "SELECT student_id, SUM(result) AS result FROM student_results WHERE student_results.a_id = {$a_id}";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            
            return $stmt;
        }

        public function submitMark()
        {
            
            $this->connection->beginTransaction();
            foreach($this->results as $result)
            {
               
                $query = "UPDATE student_results set result =:mark, comment =:comment WHERE a_id =  :a_id AND c_id = :c_id AND student_id = :student";
                $stmt = $this->connection->prepare($query);
                $stmt->bindParam(":a_id", $this->assessment);
                $stmt->bindParam(":c_id", $result->c_id);
                $stmt->bindParam(":c_id", $result->c_id);
                $stmt->bindParam(":mark", $result->result);
                $stmt->bindValue(":student", $this->studentId,PDO::PARAM_STR);
                $stmt->bindValue(":comment", $result->comment,PDO::PARAM_STR);
        
                if(!$stmt->execute())
                {
                    $this->connection->rollback();
                    return false;
                }
            }

            $this->connection->commit();
            return true;
        }
    }
?>