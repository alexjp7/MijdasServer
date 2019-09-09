<?php
    class Assessment
    {
        private $connection;
        private $errorMessage;

        public $a_number;
        public $subject_id;
        public $assessment_id;
        public $task_name;
        

        public function __construct($connection)
        {
            $this->connection = $connection;
        }

        public function getErrorMessage()
        {
            return $this->errorMessage;
        }

        public function getBySubject($subject_id)
        {   
            $query = "SELECT id, a_number, name, isActive 
                      FROM assessment 
                      WHERE subject_id = {$subject_id} AND isActive = 1 ORDER BY id ASC, a_number ASC";

            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function create()
        {   //Makes use of stored procedure to validate data
            $query = "call create_assessment(:subject_id,:name)";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(":subject_id",$this->subject_id, PDO::PARAM_INT);
            $stmt->bindValue(":name",$this->task_name, PDO::PARAM_STR);

            return $stmt->execute();
        }

        public function getMaxMark($assessment_id)
        {
            $query = "select sum(max_mark) as max_mark from criteria_item where a_id = {$assessment_id} group by (a_id)";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt;
        }
    
        public function toggleActivation()
        {
            //Determine if assessment is valid via its criteria_item count.
            $countQuery = "SELECT count_criteria({$this->assessment_id}) as count";
            $countStmt = $this->connection->prepare($countQuery);
            $countStmt->execute();
            $hasCriteria = $countStmt->fetch()["count"];
            
            //Determine if an activation or deactivation is being requested
            $isActiveSelect = "SELECT isActive, subject_id FROM assessment WHERE id = {$this->assessment_id}";
            $isActiveStmt = $this->connection->prepare($isActiveSelect); 
            $isActiveStmt->execute();
            $result = $isActiveStmt->fetch();
            //Assume succesful transaction unless flagged
            //As unsuccesful by exception handlers.
            $isSuccesful = true;

            if(isset($result) || $selectStmt->rowCount() !== 1)
            {
                if($hasCriteria) 
                {   //Assessment is being activated
                    $this->subject_id = $result["subject_id"];
                    $update = "UPDATE assessment  SET isActive = NOT isActive  WHERE id = {$this->assessment_id}";
                    $updateStmt = $this->connection->prepare($update);
                    $updateStmt->execute();
                    !$result["isActive"] ? $this->addStudent($isSuccesful) : $this->removeStudent($isSuccesful);  
                }
                else
                {   //Assessment is being de-activated
                    $this->errorMessage = "Assessment requries criteria to be enabled!";
                    $isSuccesful = false;
                }
            }
            else
            {
                $this->errorMessage = "Assessment failed to be enabled/disabled";
                $isSuccesful = false;
            }
            return $isSuccesful;
        }

        private function addStudent(&$isSuccesful)
        {   //Grab all students enrolled in a subject
            $studentQuery = "SELECT student_id 
                             FROM student_subject student 
                             INNER JOIN subject_session session 
                             ON student.subject_session_id =  session.subject_id  
                             WHERE session.subject_id = {$this->subject_id}";

            $stmt = $this->connection->prepare($studentQuery);
            $stmt->execute();
            $this->connection->beginTransaction();
            try
            {   //Insert them into student results, default result as null.
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    extract($row);
                    $query = "INSERT INTO student_results (student_id, a_id, result) VALUES('{$student_id}', {$this->assessment_id}, null )";
                    $stmt2 = $this->connection->prepare($query);
                    
                    if(!$stmt2->execute())
                    {
                        $isSuccesful = false;
                        $this->connection->rollBack();
                        break;
                    }
                }
                $this->connection->commit();
            }
            catch(Exception $e)
            {
                $this->errorMessage = "Student already exists";
            }
        }
   
        private function removeStudent(&$isSuccesful)
        {
            $this->connection->beginTransaction();
            try
            {  //Delete Students from results table .
                $query = "DELETE FROM student_results WHERE a_id ={$this->assessment_id}";
                $stmt = $this->connection->prepare($query);
                if(!$stmt->execute())
                {
                    $isSuccesful = false;
                    $this->connection->rollBack();
                }
                $this->connection->commit();
            }
            catch(Exception $e)
            {
                $this->errorMessage = "Student couldn't be removed from assessment";
            }
        }
    }
?>