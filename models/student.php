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
            $query = "SELECT student_id, SUM(result) AS result FROM student_results WHERE student_results.a_id = {$a_id} GROUP BY student_id";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            
            return $stmt;
        }

        public function getBySubject($subject_id, $hasAssessment)
        {   //If a subject as assessments, query for results talble otherwise return students enrolled in subject.
            $query = $hasAssessment ? "SELECT subject.student_id, assessment.name, results.a_id, sum(result) as result FROM (student_subject AS subject 
                                            INNER JOIN student_results AS results ON subject.student_id = results.student_id)
                                            INNER JOIN assessment ON results.a_id = assessment.id
                                        WHERE subject.subject_session_id = {$subject_id}
                                        GROUP BY results.student_id, results.a_id ORDER BY subject.student_id, results.a_id ASC;"
                                    : "SELECT student_id FROM student_subject WHERE subject_session_id = {$subject_id}";

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