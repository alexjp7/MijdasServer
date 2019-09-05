<?php
    class Student
    {
        private $connection;

        public $studentId;
        public $result;
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
            $query = "SELECT student_id, result FROM student_results WHERE a_id = {$a_id}";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            
            return $stmt;
        }

        public function submitMark()
        {
            $stmt = $this->connection->prepare("UPDATE student_results 
                                                SET result = :result 
                                                WHERE student_id = :s_id
                                                AND a_id = :assessment");
 
            $stmt->bindParam(':result', $this->result);
            $stmt->bindValue(':s_id', $this->studentId, PDO::PARAM_STR);
            $stmt->bindParam(':assessment', $this->assessment, PDO::PARAM_INT);
            $stmt->execute();
  
            return $stmt->rowCount() === 1;
        }

    }
?>