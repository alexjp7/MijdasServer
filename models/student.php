<?php
    /************************************************
     Author:  Alex Perceval 
     Group:   Mijdas(kw01)
     Purpose: Student model, and to provide an interface 
                for database transactions
    ************************************************/
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
        //need to check coordinator view subjects
        public function addToSubject($studentList, $subjectId)
        {
            /* First, add student to the subject table */
            $this->connection->beginTransaction();
            $stmt = $this->connection->prepare("INSERT INTO student_subject (student_id, subject_session_id) VALUES(:student, :subject)");
            foreach($studentList as $student)
            {
                $stmt->bindParam(":student", $student);
                $stmt->bindParam(":subject", $subjectId);

                if(!$stmt->execute())
                {   //If an insertion does not execute correctly, rollback transaction.    
                    $this->connection->rollBack();
                    return  false;
                }
            }   
            //Succesful batch insert completed, new data is commited in database
            $this->connection->commit();

            // Determine if student is being added 'late' to a subject, via the count the active assessments
            $assessmentCount = "SELECT count(*) as count    
                                FROM assessment 
                                INNER JOIN subject ON assessment.subject_id = subject.id 
                                INNER JOIN subject_session AS session ON session.subject_id = subject.id
                                WHERE session.id = {$subjectId} AND assessment.isActive = true";

            $stmt = $this->connection->prepare($assessmentCount);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            //insert student into existing student_results table with a null result
            if($row["count"] > 0)
            {
                $stmt = $this->connection->prepare("CALL add_late_student(:subject_id,:student_id)");
                foreach($studentList as $student)
                {
                    $stmt->bindValue(":student_id",$student,PDO::PARAM_STR);
                    $stmt->bindParam(":subject_id",$subjectId,PDO::PARAM_INT);

                    if(!$stmt->execute())
                        return false;
                }
            }
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
            $query = $hasAssessment ? "SELECT results.student_id, assessment.name, results.a_id, sum(result) as result FROM student_results as results
                                        INNER JOIN assessment ON results.a_id = assessment.id
                                        WHERE assessment.subject_id = {$subject_id}
                                        GROUP BY results.student_id, results.a_id ORDER BY results.student_id, results.a_id ASC"
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
        
        public function getSubjectsEnrolled()
        {
            $query = "SELECT subject.code, subject.id as subject_id
                        FROM student_subject AS student 
                        INNER JOIN subject_session AS session ON student.subject_session_id = session.id
                        INNER JOIN subject ON session.subject_id = subject.id WHERE student.student_id = '{$this->studentId}'";
            $stmt = $this->connection->prepare($query);
            $stmt ->execute();
            return $stmt;
        }
        public function getActiveTasks($assessment_id)
        {
            $query = "SELECT id as assessment_id, name FROM assessment WHERE subject_id = {$assessment_id} AND isActive = true";
            $stmt = $this->connection->prepare($query);
            $stmt ->execute();
            return $stmt;
        }

        public function getResultPerAssessment() 
        {
            $query = "SELECT DISTINCT criteria.display_text, student.result, criteria.max_mark,student.comment
                      FROM student_results student 
                      INNER JOIN  criteria_item criteria ON student.a_id = criteria.a_id AND student.c_id = criteria.c_id
                      WHERE student.student_id = :student AND  criteria.a_id = :assessment ";

            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":student",$this->studentId, PDO::PARAM_STR);
            $stmt->bindParam(":assessment",$this->assessment, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt;
        }

        function getAllResultsPerAssessment()
        {
            $query = "SELECT SUM(result) as result FROM student_results WHERE a_id = :assessment GROUP BY (student_id)";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(":assessment",$this->assessment, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt;          
               
        }

    }
?>